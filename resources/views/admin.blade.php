<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Project Web - Execution</title>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/admin') }}">Cakey Wakey</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex">
          <!-- Show Cart and Logout if user is authenticated -->
          @auth
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-dark">Log Out</button>
            </form>
          @endauth

          <!-- Show Login if user is a guest -->
          @guest
            <a href="{{ route('login') }}" class="btn btn-dark">Log In</a>
          @endguest
        </div>
      </div>
    </div>
  </nav>
</header>

<div class="container mt-5">
    <h1>Admin Panel</h1>

    <!-- Cakes Table -->
    <h2>Cakes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cake ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Base Price</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cakes as $cake)
                <tr>
                    <td>{{ $cake->id }}</td>
                    <td>{{ $cake->name }}</td>
                    <td>{{ $cake->description }}</td>
                    <td>${{ number_format($cake->base_price, 2) }}</td>
                    <td><img src="{{ asset('storage/' . $cake->image) }}" width="100" alt="{{ $cake->name }}"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Orders Table -->
    <h2>Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Payments Table -->
    <h2>Payments</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->order_id }}</td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->status }}</td>
                    <td>{{ $payment->payment_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<footer>
    <div class="footer-content">
        <h3>Cakey Wakey</h3>
        <p>Thank you for visiting our website. Support us by following our social media below:</p>
        <ul class="socials">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>copyright &copy;2024 Cakey Wakey. designed by <span>Slay-Team</span></p>
    </div>
</footer>
</body>
</html>