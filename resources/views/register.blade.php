<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}">
    <meta name="description" content="Responsive Image Gallery">
    <meta name="author" content="Tim Wells">
  
    <title>Login Cakeywakey</title>
</head>
<body>

    <div class="container">
        <div class="login">
            <form action="{{ url('/register') }}" method="POST">
                @csrf
                <h1>WELCOME!</h1>
                <div class="overlap-group">
                    <p class="already-have-an">
                        <span class="text-wrapper">Already have an account,</span>
                        <span class="span">&nbsp;</span>
                        <a href="{{ route('login') }}" class="text-wrapper-2">Sign in</a>
                    </p>
                </div>
                @if(session('success'))
                    <p style="color: green; font-size: small;">{{ session('success') }}</p>
                @endif

                <label for="name">Name</label>
                <input type="text" name="name" placeholder="name"><br>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="email" required>
                
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" required><br>
                
                @if($errors->any())
                    <div style="color: red; font-size: small;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <button type="submit">Register</button>
            </form>
        </div>
        <div class="right">
            <img class="design-sans-titre" src="{{ asset('img/Design_sans_titre_6_-removebg-preview 3.png') }}" />
        </div>
    </div>
</body>
</html>