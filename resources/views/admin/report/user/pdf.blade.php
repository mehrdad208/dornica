<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pdf</title>
</head>
<body>
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
                                <td>{{ $result['email'] }}</td>
                                <td>{{ $result['mobile'] }}</td>
                                <td>{{ $result['first_name'] }}</td>
                                <td>{{ $result['last_name'] }}</td>
                                <td>{{ $result['province'] }}</td>
                                <td>{{ $result['small_province'] }}</td>

                                <th>{{Verta::instance($result['created_at'])}}</th>
                              
                                 
                            </tr>
    
                            @endforeach
    
    
                        </tbody>
                    </table>
             
</body>
</html>
                   