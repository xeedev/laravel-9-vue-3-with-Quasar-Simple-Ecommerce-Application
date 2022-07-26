<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;

class OrdersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return $this->sendResponse(OrderResource::collection($orders), 'Orders retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'total' => 'required',
            'transaction_id' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $order = Order::create(
            [
                'user_id' => $user_id,
                'description' => $request->description,
                'contact' => $request->contact,
                'total' => $request->total,
                'transaction_id' => $request->transaction_id,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'status' => 'unpaid',
            ]
        );
        \Illuminate\Support\Facades\Mail::to('s.zeeshanahmad141@gmail.com')->send(new \App\Mail\NewOrder(
            Auth::user()->name,
            $request->description,
            $request->contact,
            Auth::user()->email,
            $request->total,
            $request->transaction_id,
            $request->address,
            $request->city,
            $request->country,
        ));
        \Illuminate\Support\Facades\Mail::to(Auth::user()->email)->send(new \App\Mail\OrderConfirmation(
            Auth::user()->name,
            $request->description,
            $request->contact,
            Auth::user()->email,
            $request->total,
            $request->transaction_id,
            $request->address,
            $request->city,
            $request->country,
        ));
        return $this->sendResponse(new OrderResource($order), 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (is_null($order)) {
            return $this->sendError('Order not found.');
        }

        return $this->sendResponse(new OrderResource($order), 'Order retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'status' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $order->status = $input['status'];
        $order->save();
        return $this->sendResponse(new OrderResource($order), 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->sendResponse([], 'Order deleted successfully.');
    }
}
