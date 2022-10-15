<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin-assets/css/login.css')}}">
    <title>Document</title>
</head>
<body>
    <div id="background">
        <div id="loginForm">
           <div id="loginRegister">
              <ul>
                 <li class="active"><a>Login</a></li>
                 <li><a href="{{route('user.create')}}">Register</a></li>
              </ul>
           </div>
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
              <a id="forgotPassword" href="#">Forgot Password?</a></p>
        </div>
     </div>
</body>
</html>