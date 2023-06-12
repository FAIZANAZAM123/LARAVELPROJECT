<?php

namespace App\Http\Controllers;
use App\Models\Customers;
use App\Models\Order;
use Illuminate\Http\Request;

use DB;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
            ->select('orders.*', 'customers.name')
            ->get();
    
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers =DB::table('Customers')->get();
        return view('orders.create',['customers'=>$customers]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'order_number' => 'required|unique:orders,order_number',
            'order_date' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric',
            'status' => 'required',
            'payment_method' => 'required',
            'shipping_address' => 'required',
            'billing_address' => 'required',
        ]);
        
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Cannot create order!');
        }
    
        $validatedData = $validator->validated();
    
        Order::create($validatedData);
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
    
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit($id)
{
    $order = Order::findOrFail($id);
    $customers =DB::table('Customers')->get();

    return view('orders.edit',compact('customers','order'));
}


public function update(Request $request, Order $order)
{
    $validator = \Validator::make($request->all(), [
        'order_number' => 'required|unique:orders,order_number',
        'order_date' => 'required|date',
        'customer_id' => 'required|exists:customers,id',
        'total_amount' => 'required|numeric',
        'status' => 'required',
        'payment_method' => 'required',
        'shipping_address' => 'required',
        'billing_address' => 'required',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Cannot update order!');
    }

    $validatedData = $validator->validated();

    $order->update($validatedData);

    return redirect()->route('orders.index')->with('success', 'Order updated successfully');
}


    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
