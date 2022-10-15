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
       <title>گزارش گیری</title>
</head>
<body>
    

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>
                        گزارش گیری از کاربران 
                    </h5>
                </section>
    
                <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{route('admin.index')}}" class="btn btn-info btn-sm">بازگشت</a>
                </section>
             
    
                <section>
                    <form action="{{route('admin.report.users')}}" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <section class="row">
    
                      

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
                                    <label for="">جنسیت</label>
                                    <select name="sexuality" id="" class="form-control form-control-sm">
                                        <option value="0">مرد</option>
                                      
                                        <option value="1" >زن</option>
    
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

                            <section class="col-12 col-md-3">
                                <div class="form-group">
                                    <label for="">نوع خروجی</label>
                                    <select name="typeOfReport" id="" class="form-control form-control-sm">
                                        <option value="0">ساده</option>
                                        <option value="1" >pdf</option>
                                        <option value="2" >excel</option>

    
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

                           
    
    
                            <section class="col-12 col-md-3 ">
                                <div class="form-group mt-6">
                                <button class="btn btn-primary btn-sm">مشاهده گزارش</button>
                                </div>
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

               
    </script>

    
  

</body>
</html>



