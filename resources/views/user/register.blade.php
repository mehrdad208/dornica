<!DOCTYPE html>
@php
    use Mews\Captcha\Facades\Captcha;
@endphp
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/sweetalert/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}"> 
       <title>Register</title>
</head>
<body>
    

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                      ثبت نام 
                    </h5>
                </section>
            @if(session('error'))
              <div class="alert alert-danger flex-right" role="alert">
             {{session('error')}}
             </div>
             @endif
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('user.login.show')}}" class="btn btn-info btn-sm">بازگشت</a>
                </section>
                @error('wrong_national_code')
                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                    <strong>
                        {{ $message }}
                    </strong>
                </span>
            @enderror
    
                <section>
                    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">
    
                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="first_name" value="{{ old('first_name') }}">
                                </div>
                                @error('first_name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">نام خانوادگی</label>
                                    <input type="text" class="form-control form-control-sm" name="last_name" value="{{ old('last_name') }}">
                                </div>
                                @error('last_name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">کدملی</label>
                                    <input type="text" class="form-control form-control-sm" name="national_code" value="{{ old('national_code') }}">
                                </div>
                                @error('national_code')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>


                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">موبایل</label>
                                    <input type="text" class="form-control form-control-sm" name="mobile" value="{{ old('mobile') }}">
                                </div>
                                @error('mobile')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ تولد</label>
                                    <input type="text" name="birthday_date" id="birthday_date" class="form-control form-control-sm d-none">
                                    <input type="text" id="birthday_date_view" class="form-control form-control-sm">
                                </div>
                                @error('published_at')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
    
                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">جنسیت</label>
                                    <select name="sexuality" class="form-control form-control-sm">
                                        <option value="0" id="sexuality1">مرد</option>
                                      
                                        <option value="1" id="sexuality2" >زن</option>
    
                                    </select>
                                </div>
                                @error('sexuality')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3" id="soldiering_status">
                                <div class="form-group">
                                    <label for="">وضعیت نظام وظیفه</label>
                                    <select name="soldiering_status" id="" class="form-control form-control-sm">
                                        <option value="0">انجام نشده</option>
                                      
                                        <option value="1" >انجام شده</option>
    
                                    </select>
                                </div>
                                @error('soldiering_status')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
    
                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">تصویر </label>
                                    <input type="file" name="image" class="form-control form-control-sm">
                                </div>
                                @error('image')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>


                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">نام کاربری</label>
                                    <input type="text" class="form-control form-control-sm" name="user_name" value="{{ old('user_name') }}">
                                </div>
                                @error('user_name')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">رمز عبور</label>
                                    <input type="text" class="form-control form-control-sm" name="password" value="{{ old('password') }}">
                                </div>
                                @error('password')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">تکرار رمز عبور</label>
                                    <input type="text" class="form-control form-control-sm" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                </div>
                                @error('password_confirmation')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>


                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for=""> استان</label>
                                    <select name="province" id="province" onchange="giveSmallProvice(this.value)"   class="form-control form-control-sm">
                                        @foreach ($provinces as $key=>$value)
                                        <option id="province" value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
    
                                    </select>
                                </div>
                                @error('province')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">شهرستان</label>
                                    <select name="small_province" id="smallProvince" class="form-control form-control-sm">
                                      
    
                                    </select>
                                </div>
                                @error('small_province')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>


                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">اعتبارسنجی</label>
                                    <div class="row">
                                        <img id="captcha" src="{{captcha_src()}}" alt="captcha">
                                        <input type="text" name="captcha" id="">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" onclick="loadCaptcha()" class="btn btn-info">تغییر رمز</button>
                                    </div>
                                </div>
                                @error('captcha')
                                <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                            </section>
                           
    
    
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
    
            </section>
        </section>
    </section>
 

    
     <script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
     <script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
     <script type="text/javascript">
            $(document).ready(function () {


                $('#birthday_date_view').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    altField: '#birthday_date'
                });

                
            });

            function giveSmallProvice(id){

                    
                    var url="http://127.0.0.1:8000/user/giveSmallProvice/"+id;

                    $.ajax({
                        url: url,
                        dataType: "json",
                        type: "GET",
                        success: function (data) {

                            if(data.status){
                                
                                    var html = '';
                                    
                                    data.data.forEach(item => {
                                        html += "<option value="+item.id+">"+item.title+"</option>"
                                    }); 
                                    document.getElementById('smallProvince').innerHTML= html;
                                
                                return true;
                            }
                            
                        }
                    })
                    
                }

                function loadCaptcha(){
                    $.ajax({
                        url:'/captcha/load',
                        type:"post",
                        data:{
                            _token:"{{csrf_token()}}"
                        },
                            success:function(data){
                          $('#captcha').attr('src',data.imageSource)           
                                          }
                       
                    });
                }
                
                $(document).ready(function(){
                $("#sexuality1").click(function(){
               $("#soldiering_status").show();
                 });
                });

                $(document).ready(function(){
                $("#sexuality2").click(function(){
               $("#soldiering_status").hide();
                 });
                });

    </script>

    
  

</body>
</html>



