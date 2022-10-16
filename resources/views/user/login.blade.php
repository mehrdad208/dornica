<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{asset('admin-assets/css/login.css')}}">
    <title>login</title>
</head>
<body>
    <div id="background">
        <div id="loginForm">
           <div id="loginRegister">
              <ul>
                 <li class="active "><a>Login</a></li>
                 <li class="active"><a href="{{route('user.create')}}">Register</a></li>

              </ul>
           </div>
           @if(session('error'))
           <div class="alert alert-danger flex-right" role="alert">
             {{session('error')}}
            </div>
           @endif
           <form action="{{route('user.login')}}" method="Post">
            @csrf
              <label>USERNAME</label>
              <input type="text" name="user_name" class="textEnter">
              <label>PASSWORD</label>
              <input type="text" name="password" class="textEnter"type="password">
             
              <button type="submit" id="signInButton">SIGN IN</button>
           </form>
           <hr/>
           <p>
              <a id="forgotPassword" href="{{route('user.email.verification.show')}}">Email Verification</a></p>
        </div>
     </div>
</body>
</html>