<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 10 Custom Login and Registration</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body{
        background-image: url('https://cdn.pixabay.com/photo/2015/01/08/18/25/desk-593327_1280.jpg');
      }
      h1{
        color: white;
      }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Customers Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-flex">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <div class="my-5">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ url('/displaycustomers') }}" class="btn btn-primary w-100">Display Customers</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/Addcustomer') }}" class="btn btn-primary w-100">Add Customers</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ url('/orders') }}" class="btn btn-primary w-100">Show Orders</a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary w-100">Add Orders</a>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
