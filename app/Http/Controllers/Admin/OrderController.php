<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            // dd(123);
            $orders=Order::where('name', 'like', '%'.request('search').'%')
            ->orWhere('address', 'like', '%'.request('search').'%')
            ->orWhere('phone', 'like', '%'.request('search').'%')
            ->orWhere('email', 'like', '%'.request('search').'%');
        } else {
            $orders=Order::orderBy('id','DESC');
        }
        if (request('status')) {
            $orders = $orders->where('status', request('status'));
        }
        // dump($orders->pluck('status'));
        // dd($orders->count());
        $orders = $orders->paginate(20);
      
        return view('admin.order.show_all_order', compact('orders'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // dd($order->orderItems()->get());
        return view('admin.order.show_order_items', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only('status');
        $order = Order::findOrfail($id);
        $order->update($data);
        return redirect()->back()->with('message','Update Th??nh C??ng');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


}
