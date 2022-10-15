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


    <title>نمایش استان ها</title>
</head>
<body>
    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                   استان ها
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.province.create')}}" class="btn btn-info btn-sm">ایجاد استان جدید</a>
                    <a href="{{route('admin.index')}}" class="btn btn-info btn-sm">بازگشت</a>
                   
                </section>
                <section>
                    <div class="max-width-16-rem">
                        <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                    </div>
                </section>
    
                <section class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام استان</th>
                               
                                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
    
                         @foreach ($provinces as $key => $province)
    
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $province->title }}</td>
                                <td class="width-22-rem text-left">
                                    <a href="{{route('admin.province.barCharts',$province->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>مشاهده نمودار میله ای</a>
                                    <a href="{{route('admin.province.smallProvince',$province->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>مشاهده شهرهای زیرمجموعه</a>
                                    <a href="{{route('admin.smallProvince.create',$province->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> اضافه کردن شهرجدید</a>
                                    <a href="{{route('admin.province.edit',$province->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                    <form class="d-inline" action="{{route('admin.province.destroy',$province->id)}}" method="post">
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