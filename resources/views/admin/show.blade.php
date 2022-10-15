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


    <title>نمایش ادمین ها</title>
</head>
<body>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                    کاربران ادمین
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.create')}}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>
                    <a href="{{route('admin.index')}}" class="btn btn-info btn-sm">بازگشت</a>

                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
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
                                <th>نقش</th>
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
    
                         @foreach ($admins as $key => $admin)
    
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->mobile }}</td>
                                <td>{{ $admin->first_name }}</td>
                                <td>{{ $admin->last_name }}</td>
                                <td>{{($admin->user_type==1)?"ادمین":"مدیر"}}</td>
                                <td class="width-22-rem text-left">


                                    <a href="{{route('admin.change.role',$admin->id)}}" class="btn btn-{{($admin->user_type==1)?'info':'warning'}} btn-sm"><i class="fa fa-edit"></i>{{($admin->user_type==1)?"مدیر":"ادمین"}}</a>


                                    <a href="{{route('admin.edit',$admin->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{route('admin.delete',$admin->id)}}" method="post">
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