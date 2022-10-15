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
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
    <title>email verification</title>
</head>
<body>
    

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                     
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('user.login.show')}}" class="btn btn-info btn-sm">بازگشت</a>
                </section>
              
    
                <section>
                    <form action="{{route('user.email.verification')}}" method="POST"  id="form">
                        @csrf
                        <section class="row">
    
                            </section>

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">ایمیل</label>
                                    <input type="text" class="form-control form-control-sm" name="email" value="{{old('email')}}">
                                </div>
                                @error('email')
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
    
</body>
</html>
  


