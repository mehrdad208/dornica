<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use App\Http\Requests\User\RegisterRequest;
use App\Mail\UserCreated;
use App\Models\User;
use App\Http\Services\Notification\Notification;
use App\Jobs\SendEmail;
use App\Models\Post;
use Carbon\Carbon;
use App\Models\ProvinceCity;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $posts=Post::all();
        return view('home.post.index', compact('user','posts'));
    }
    public function all(){
        $provinces=ProvinceCity::where('parent',0)->get();
        $users=User::where('user_type',0)->get();
        return view('admin.user.show',compact('users','provinces'));
    }
  

    public function create()
    {
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('user.register', compact('provinces'));
    }

 public function search(Request $request){
    $provinces=ProvinceCity::where('parent',0)->get();
    $users=User::where('province','like','%'.$request->province.'%')->where('email','like','%'.$request->email.'%')->where('mobile','like','%'.$request->mobile.'%')->where('user_type',0)->get();
    return view('admin.user.show',compact('users','provinces'));
}

   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVerification(User $user){
        return view('user.verification',compact('user'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        if ($this->checkAge($request->birthday_date) <= 10) {
            return redirect()->route('user.create')->with('error','your age must grather 10 years old!!!');
        }
        if ($this->custom_check_national_code($request->national_code)) {

            $inputs = $request->all();
            $inputs['verification_code'] = rand(100000, 999999);
            $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            $user = User::create($inputs);
            if ($file = $request->file('image')) {
                if ($file->getSize() <= 409600) {
                    $result = $this->uploadImages($file, 'users/' . $user->id);
                    $user->image = $result;
                    $user->save();
                } else {
                    return redirect()->route('user.create')->with('error','image size not grather 200 kb');
                }
            }
            $notification = resolve(Notification::class);
            SendEmail::dispatch($user, new UserCreated($user));
            $route = Route::current();
            if($route->getName() === 'admin.user.store'){
                return redirect()->back()->with('success','user created');



            }


            return redirect()->route('user.verification.show',$user->id)->with('success','email send for you');
        } else {

            return redirect()->route('user.create')->with('error','national code is incorrect');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function checkAge($age)
    {


        $result = Jalalian::forge(substr($age, 0, 10));

        $date_of_birth = $result->format('Y-m-d');

        $age = Carbon::parse($date_of_birth)->diff(new Verta())->y;


        return $age;
    }
    public function show()
    {
        
        return view('user.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $provinces = ProvinceCity::all();
        return view('user.edit', compact('user', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterRequest $request, User $user)
    {
        if ($this->checkAge($request->birthday_date) <= 10) {
            return redirect()->back()->with('error','your age must grather 10 years old!!!');;
        }
        if ($this->custom_check_national_code($request->national_code)) {

            $inputs = $request->all();
            if ($inputs['password']) {
                $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            }
            $user->update($inputs);
            if ($file = $request->file('image')) {
                if ($file->getSize() <= 409600) {
                    $result = $this->uploadImages($file, 'users/' . $user->id);
                    $user->image = $result;
                    $user->save();
                } else {
                    return redirect()->route('user.edit',$user->id)->with('error','image size not grather 200 kb');
                }
            }


            return redirect()->route('user.index', $user->id)->with('success','user update');
        } else {

            return redirect()->route('user.index')->with('error','national code is incorrect');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index');
    }

    function custom_check_national_code($national_code)
    {
        if (!preg_match('/^[0-9]{10}$/', $national_code))
            return false;
        for ($i = 0; $i < 10; $i++)
            if (preg_match('/^' . $i . '{10}$/', $national_code))
                return false;
        for ($i = 0, $sum = 0; $i < 9; $i++)
            $sum += ((10 - $i) * intval(substr($national_code, $i, 1)));
        $ret = $sum % 11;
        $parity = intval(substr($national_code, 9, 1));
        if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
            return true;
        return false;
    }


    public function verification(Request $request,User $user)
    {

        if ($user->verification_code == $request->verification_code) {
            $user->update([
                'email_verified_at'=>time() 
            ]);
            return redirect()->route('user.index', $user->id);
        } else {
            return redirect()->back()->with('error','code incorrect!!!');
        }
    }
    public function showEmailVerification(){
        return view('user.emailVerification');
    }

    public function sendCodeVerification(Request $request){
        
        $user=User::where('email',$request->email)->first();
       
        if($user){
           
            $notification = resolve(Notification::class);
            SendEmail::dispatch($user, new UserCreated($user));
            return redirect()->route('user.email.code.show',$user->id)->with('success','code send');

        }else{
            return redirect()->back()->with('error','email incorrect!!!');
        }
    }

    public function showCodeVerification(User $user){
        return view('user.codeVerification',compact('user'));

    }
   


    public function uploadImages($file, $path)
    {
        
        if ($file) {

            $filename = $file->getClientOriginalName();
            $file->move(public_path('Images/' . $path), $filename);
            $data['image'] = $filename;
        }
        return $data;
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name)->first();
        if (!$user) {
            return redirect()->back()->with('error','user name incorrect!!!');
        }
        if($user->email_verified_at==null){
            return redirect()->back()->with('error','do not email verification!!!');
        }
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                if($user->user_type==0){
                    Session::put('user_id',$user->id);
                    return redirect()->route('user.index', $user->id);
                }else{
                    Session::put('admin_id',$user->id);
                    Session::put('first_name',$user->first_name);
                    return redirect()->route('admin.index');
                }
            } else {
                return redirect()->route('user.login.show')->with('error','password incorrect!!!');
            }
        } else {
            return redirect()->route('user.login.show');
        }
    }


    public function giveSmallProvice($id)
    {

        $smallProvince = ProvinceCity::where('parent', $id)->get();


        if ($smallProvince) {
            return response()->json(['status' => true, 'data' => $smallProvince]);
        } else {
            return response()->json(['status' => false, 'data' => null]);
        }
    }




    public function logout()
    {
        Session::forget('admin_id');
        return redirect()->route('user.login.show');
    }
}
