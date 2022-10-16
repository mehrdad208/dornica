<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="{{asset('admin-assets/css/admin.css')}}">
  <title>پنل مدیریت</title>
</head>
<body>

  <header role="banner">
    <h1>پنل مدیریت</h1>
    <ul class="utilities">
      <br>
      <li class="logout warn"><a href="">{{Session::get('first_name')}}خوش آمدید</a></li>

      <li class="logout warn"><a href="{{route('admin.logout')}}">خروج از برنامه</a></li>
    </ul>
  </header>
  @if(session('success'))
  <div class="alert alert-success flex-right" role="alert">
  {{session('success')}}
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger flex-right" role="alert">
  {{session('error')}}
  </div>
   @endif

  <nav role='navigation'>
    <ul class="main">
      <li class="dashboard"><a href="#">صفحه اصلی</a></li>
      <li class="dashboard"><a href="{{route('admin.show')}}">  مشاهده ادمین ها</a></li>
      <li class="price"><a href="{{route('admin.user.index')}}"> مشاهده کاربران </a></li>
      <li class="write"><a href="{{route('admin.province.index')}}">مدیریت استان هاوشهرستان ها</a></li>
      <li class="write"><a href="{{route('admin.post.index')}}">مدیریت پست ها</a></li>
   
      <li class="edit"><a href="{{route('admin.report.index')}}">گزارش گیری از کاربران</a></li>

    </ul>
  </nav>
