<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use App\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index(){
        $orders = Order::with(['books', 'states', 'user'])->get();
        return $orders;
    }

    public function indexUser($userId){
        $orders = Order::where('user_id', $userId)
            ->with(['user'])
            ->first();
        return $orders;
    }

    /*
    public function getUser(){
        $orders = Order::with(['user'])->get();
        return $orders;
    }*/

    public function getOrder($order_id){
        $order = Order::where('id', $order_id)->with(['books', 'states', 'user'])->first();
        return $order;
    }

    public function updateState(string $order_id): JsonResponse{
        DB::beginTransaction();
        try {
            $state = new \App\State();
            $state->comment = '';
            $state->state = 'Offen';
            $state->order()->associate($order_id);
            $state->save();

            DB::commit();
            return response()->json($state, 201);
        }
        catch (\Exception $e){
            DB::rollBack();
            return response()->json("updating order failed: ". $e->getMessage(), 420);
        }
    }

    //update state and comment
    // wie bei Seeder: new Status()

    public function save(Request $request) : JsonResponse {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->order_date = new \DateTime();
            $order->total_price = $request['total_price'];
            $order->ust = $request['ust'];
            $user = \App\User::where('id', $request['user_id'])->first();
            $order->user()->associate($user);
            $order->save();
            $state = new \App\State();
            $state->comment = '';
            $state->state = 'Offen';
            $state->order()->associate($order);
            $state->save();
            $order->save();

            //save Books
            if (isset($request['books']) && is_array($request['books'])) {
                foreach ($request['books'] as $book){
                    $book1 = Book::firstOrNew(['isbn'=>$book['isbn'],
                        'title'=>$book['title'],
                        'subtitle'=>$book['subtitle'],
                        'price'=>$book['price'],
                        'rating'=>$book['rating']]);
                    $order->books()->save($book1, array(
                        'price' => $book['price'],
                        'amount' => $book['amount']
                    ));
                }
            }
            $order->save();

            DB::commit();
            return response()->json($order, 201);
        }
        catch (\Exception $e){
            DB::rollBack();
            return response()->json("saving order failed: ". $e->getMessage(), 420);
        }

    }

    private function parseRequest($request) : Request{
        $date = new \DateTime($request->order_date);
        $request['order_date'] = $date;
        return $request;
    }



}
