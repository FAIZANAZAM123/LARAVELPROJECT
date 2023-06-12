<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $customers = DB::table('customers')
        ->join('orders', 'customers.id', '=', 'orders.customer_id')
        ->select('customers.*', 'orders.order_number', 'orders.order_date')
        ->get();

    return view('CustomersData', ['customers' => $customers]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function insert()
    {
        
        return view('Customers');
    }
    public function create(Request $req)
    {
        $validator = \Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:customers,email|email|max:255',
            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9]{10,}$/',
            ],
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for image file
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Error: Failed to add customer!');
        }
    
        // Handle image upload
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/customers'), $imageName);
            $imagePath = 'images/customers/' . $imageName;
        } else {
            $imagePath = null; // If no image is uploaded, set the image path to null or a default value
        }
    
        DB::table('customers')->insert([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'phone' => $req->input('phone'),
            'address' => $req->input('address'),
            'city' => $req->input('city'),
            'state' => $req->input('state'),
            'country' => $req->input('country'),
            'postal_code' => $req->input('postal_code'),
            'image_path' => $imagePath, // Save the image path in the 'image_path' column
        ]);
    
        return redirect()->route('index')->with('success', 'Success: Customer added successfully!');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            $customer=DB::table('Customers')->find($id);
            return view('editform',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, string $id)
    {

     
    // Validate the input fields
    $validator = \Validator::make($req->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|unique:Customers,email|email|max:255',
        'phone' => [
            'required',
            'string',
            'max:20',
            'regex:/^[0-9]{10,}$/',
        ],
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'postal_code' => 'required|string|max:20',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rule for image file

    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error','Cant Update Error!!');
    }


    if ($req->hasFile('image')) {
        $image = $req->file('image');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/customers'), $imageName);
        $imagePath = 'images/customers/' . $imageName;
    } else {
        $imagePath = null; // If no image is uploaded, set the image path to null or a default value
    }
    DB::table('Customers')->where('id',$id)->update([
        'name' => $req->input('name'),
        'email' => $req->input('email'),
        'phone' => $req->input('phone'),
        'address' => $req->input('address'),
        'city' => $req->input('city'),
        'state' => $req->input('state'),
        'country' => $req->input('country'),
        'postal_code' => $req->input('postal_code'),
        'image_path' => $imagePath, // Save the image path in the 'image_path' column

    ]);

    // Redirect to the customer details page or any other desired page
    return redirect()->route('index')->with('success','Updated Successfully!!');;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('Customers')->where('id',$id)->delete();
        return redirect()->route('index')->with('success','Deleted Successfully!!');;;
    }
}
