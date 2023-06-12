<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
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
@if (session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <h1>Order Details</h1>
        <table class="table">
            <tbody>
                <tr>
                    <th>Order Number</th>
                    <td>{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ $order->order_date }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $order->customer_id }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ $order->total_amount }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $order->status }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    <td>{{ $order->payment_method }}</td>
                </tr>
                <tr>
                    <th>Shipping Address</th>
                    <td>{{ $order->shipping_address }}</td>
                </tr>
                <tr>
                    <th>Billing Address</th>
                    <td>{{ $order->billing_address }}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</body>

</html>
