<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                     تغییر مشخصات کاربر 
                    </h5>
                </section>
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
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('user.index',$user->id)}}" class="btn btn-info btn-sm">بازگشت</a>
                </section>
             
    
                <section>
                    <form action="{{route('admin.user.update',$user->id)}}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')
                        <section class="row">
    
                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">نام</label>
                                    <input type="text" class="form-control form-control-sm" name="first_name" value="{{ old('first_name',$user->first_name) }}">
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
                                    <input type="text" class="form-control form-control-sm" name="last_name" value="{{ old('last_name',$user->last_name) }}">
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
                                    <input type="text" class="form-control form-control-sm" name="national_code" value="{{ old('national_code',$user->national_code) }}">
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
                                    <input type="text" class="form-control form-control-sm" name="mobile" value="{{ old('mobile',$user->mobile) }}">
                                </div>
                                @error('mobile')
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
    </script>

    
  

</body>
</html>



