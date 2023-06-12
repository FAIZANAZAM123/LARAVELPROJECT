<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        button{
            background: blue;
            color:white;
            height: 40px;
           
            border-radius:7px; 
        }
        .error{
            background: red;
            color:white;

        }
        .success{
            background: green;
            color:white;
        }
        a{
            text-decoration: none;
            font-size: 20px;
            color:white;
        }
    </style>
</head>
<body>
   
    @if ($errors->any())
        <div class="error ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
    <h1>Customer List</h1>

    <button class="btn btn-primary"><a href="{{url('/Addcustomer')}}" >Add Customer</a></button>
<br>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
                <th>Postal Code</th>
                <th>Image</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->country }}</td>
                    <td>{{ $customer->postal_code }}</td>
                    <td><img src="{{ asset($customer->image_path) }}" alt="Customer Image" width="50"></td>
                    <td>
                        <a href="{{url('/edit',$customer->id)}} "> <button>Edit</button> </a>
                        <a href="{{url('/delete',$customer->id)}}"> <button>Delete</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
