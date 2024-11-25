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
      <a class="navbar-brand" href="{{ url('/home') }}">Cakey Wakey</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="{{ url('/home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/order') }}">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <!-- Cart Icon and Log Out -->
          <a href="{{ url('/cart') }}" class="btn btn-light me-2">
            <i class="fa fa-shopping-cart"></i> Cart
          </a>
          <a href="{{ url('/login') }}" class="btn btn-dark">Log Out</a>
        </form>
      </div>
    </div>
  </nav>
</header>

@yield('content')

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
