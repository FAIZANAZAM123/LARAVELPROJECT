<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Order</title>
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .success{
            background: green;
            color:white;

        }
        .error{
        background:red;
        color:white;
        }
    </style>
</head>

<body>
    @if ($errors->any())
    <div class="error ">
        
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        
    </div>
@endif

@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif
    <h1>Edit Order</h1>
    <form method="POST" action="{{ route('orders.update', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="order_number" class="form-label">Order Number</label>
            <input type="text" name="order_number" id="order_number" class="form-control"
                value="{{ $order->order_number }}" required>
        </div>

        <div class="form-group">
            <label for="order_date" class="form-label">Order Date</label>
            <input type="date" name="order_date" id="order_date" class="form-control"
                value="{{ $order->order_date }}" required>
        </div>

        <div class="form-group">
            <label for="customer_id" class="form-label">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id === $order->customer_id ? 'selected' : '' }}>
                    {{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="total_amount" class="form-label">Total Amount</label>
            <input type="number" name="total_amount" id="total_amount" class="form-control"
                value="{{ $order->total_amount }}" required>
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}" required>
        </div>

        <div class="form-group">
            <label for="payment_method" class="form-label">Payment Method</label>
            <input type="text" name="payment_method" id="payment_method" class="form-control"
                value="{{ $order->payment_method }}" required>
        </div>

        <div class="form-group">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <input type="text" name="shipping_address" id="shipping_address" class="form-control"
                value="{{ $order->shipping_address }}" required>
        </div>

        <div class="form-group">
            <label for="billing_address" class="form-label">
                <label for="billing_address" class="form-label">Billing Address</label>
                <input type="text" name="billing_address" id="billing_address" class="form-control"
                    value="{{ $order->billing_address }}" required>
            </div>
    
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </body>
    
    </html>
    