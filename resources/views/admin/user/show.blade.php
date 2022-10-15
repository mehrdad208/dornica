@php
    use Hekmatinasser\Verta\Verta;

@endphp
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


    <title>نمایش کاربران</title>
</head>
<body>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                    کاربران 
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.create')}}" class="btn btn-info btn-sm">ایجاد کاربر جدید</a>
                    <a href="{{ route('admin.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                    </section>


                    <form class="d-inline" action="{{route('admin.user.search')}}" method="post">
                        @csrf
                    <section class="row">
                    <section>
                    <div class="max-width-16-rem">
                    <label for="">ایمیل</label>
                    <input type="text" name="email">
                    </div>
                    </section>

                    <section>
                    <div class="max-width-16-rem mr-2">
                    <select name="province" id="">
                        @foreach($provinces as $province)
                        <option value="{{$province->id}}">{{$province->title}}</option>
                        @endforeach
                    </select>
                    </div>
                    </section> 

                    <section>
                    <div class="max-width-16-rem mr-2">
                    <label for="">موبایل</label>
                    <input type="text" name="mobile">
                    </div>
                    </section>
                    <button class="btn btn-danger btn-sm mr-2 delete" type="submit"><i class="fa fa-trash-alt"></i> جستجو</button>
                    </form>
               
               
                   

                </section>
    
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ایمیل</th>
                                <th>شماره موبایل</th>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>تاریخ ثبت نام</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
    
                         @foreach ($users as $key => $user)
    
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                               

                                <th>{{Verta::instance($user->created_at)}}</th>
                              
                             
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <a href="{{route('admin.user.password.edit',$user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>تغییر رمز</a>
                                    <form class="d-inline" action="{{route('admin.user.destroy',$user->id)}}" method="post">
                                        @csrf
                                        {{ method_field('delete') }}
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                                </td>
                            </tr>
    
                            @endforeach
    
    
                        </tbody>
                    </table>
                </section>
    
            </section>
        </section>
    </section>
    
</body>
</html>