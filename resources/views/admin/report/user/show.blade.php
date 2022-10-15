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
    <script src="{{asset('admin-assets/js/jquery.js')}}" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}"> 
       <title>گزارش گیری</title>
</head>
<body>
    

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                         نمایش گزارش   
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.index')}}" class="btn btn-info btn-sm">بازگشت</a>
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
                                <th>نام استان</th>
                                <th>نام شهرستان</th>
                                <th>تاریخ ثبت نام</th>
                            </tr>
                        </thead>
                        <tbody>
    
                         @foreach ($results as $key => $result)
    
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $result->email }}</td>
                                <td>{{ $result->mobile }}</td>
                                <td>{{ $result->first_name }}</td>
                                <td>{{ $result->last_name }}</td>
                                <td>{{ $result->province }}</td>
                                <td>{{ $result->small_province }}</td>

                                <th>{{Verta::instance($result->created_at)}}</th>
                              
                                 
                            </tr>
    
                            @endforeach
    
    
                        </tbody>
                    </table>
                </section>
    
               



                           
    
    
                          
                        </section>
                    </form>
                </section>
    
            </section>
        </section>
    </section>
 

    

    
  

</body>
</html>



