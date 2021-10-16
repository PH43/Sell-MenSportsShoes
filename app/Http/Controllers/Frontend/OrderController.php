<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\User;
use App\Order;
use App\OrderItem;
use App\Product;    

class OrderController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $cart = session::get('cart');
        // $products = Product::take(2)->get();
        // return view('frontend.orders.create', compact('products'));

        $cart = session('cart');
        $users = User::all();
        return view('frontend.orders.create', compact('cart','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $cart = session('cart');
            $dataOrder = $request->only('name','address','phone','email');
            $dataOrder['status'] = Order::ORDER_STATUS['CREATED'];
            
            $order = Order::create($dataOrder);
            $data = [];
            foreach ($cart->cartItems()->get() as $item) {
                $data[] = [
                    'product_name' => $item->name,
                    'product_id' => $item->product_id,
                    'quantity' =>  $item->quantity,
                    'price' => $item->price,
                    'order_id' => $order->id,
                ] ;
                $pd = Product::find($item->product_id);

                $pd->update(['inventory' => $pd->inventory -  $item->quantity]);
            }
            //Cập nhật lại số lượng sp trong bảng Product
            // dd($data);
    
    
            $orderDetail = OrderItem::insert($data);
            
            
            \DB::commit();

            if ($orderDetail) {
                //send mail
                $orderDetail = OrderItem::where('order_id', $order->id)->get();
                $data= [
                    'order' => $order,
                    'orderDetail' =>  $orderDetail
                ];
                
                // dd($userEmail, $dataOrder, config('mail.username'));
                \Mail::send('frontend.mails.order-detail', $data, function ($message) use ($dataOrder) {
                    $message->from('admin@gmail.com','Admin');
                    $message->to($dataOrder['email'],  $dataOrder['name']);
                    $message->subject('Confirm Order');
                });

                
                session()->forget('cart');
                 return 'Bạn đã đặt hàng thành công!';
            }
        } catch (\Exception $ex) {
            \DB::rollback();
            return redirect()->back()->with(['error' => 'add order fail']) ;
        }
        // return redirect()->back()->with(['error' => 'create order fail']) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
