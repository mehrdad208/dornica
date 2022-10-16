<?php


namespace App\Http\Controllers;

use App\Http\Requests\Admin\RegisterRequest;
use App\Http\Requests\Admin\storeUserRequest;

use App\Mail\UserCreated;
use Hekmatinasser\Verta\Verta;
use App\Models\User;
use App\Models\ProvinceCity;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\updateUserRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;




class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('admin.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function editUser(User $user){
        return view('admin.user.edit', compact('user'));
     }
     public function updateUser(updateUserRequest $request,User $user){
        $user->update($request->all());
        Log::alert("admin=".Session::get('admin_id'). "update user");
        return redirect()->route('admin.user.index')->with('success','user update');
     }

     public function editPassword(User $user){
        return view('admin.user.changePassword', compact('user'));

     }

     public function updatePassword(Request $request,User $user){
        $request->validate([
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
        ]);
        Log::alert("admin=".Session::get('admin_id'). "update password");

        return redirect()->route('admin.user.index')->with('success','change password');

     }




    public function show()
    {
        $user=User::where('id',Session::get('admin_id'))->first();
        
        if($user->user_type==1){
            
            return redirect()->back()->with('error','you not access!!!');
        }
        $admins = User::where('user_type','<>',0)->get();

        return view('admin.show', compact('admins'));
    }

    public function create()
    {
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('admin.create', compact('provinces'));
    }

    public function createUser()
    {
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('admin.user.create', compact('provinces'));
    }
    public function storeUser(storeUserRequest $request){

        if ($this->checkAge($request->birthday_date) <= 10) {
            return redirect()->back()->with('erroer','your age must grather 10 years old');
        }
        if ($this->custom_check_national_code($request->national_code)) {

            $inputs = $request->all();
            $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            $inputs['user_type'] = 0;

            $user = User::create($inputs);
            Log::alert("admin=".Session::get('admin_id'). "store new user");

            return redirect()->route('admin.user.index')->with('success','user store');
        } else {
            return redirect()->back->with('error','national code incorrect!!!');
        }
    }



    public function store(RegisterRequest $request)
    {
        if ($this->checkAge($request->birthday_date) <= 10) {
            return redirect()->route('admin.create')->with('erroer','yor age must grather 10 years old');
        }
        if ($this->custom_check_national_code($request->national_code)) {

            $inputs = $request->all();
            $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            $inputs['user_type'] = 1;

            $user = User::create($inputs);
            Log::alert("admin=".Session::get('admin_id'). "store new admin");

            return redirect()->route('admin.show')->with('success','admin store');
        } else {
            return redirect()->route('admin.create')->with('error','national code incorrect!!!');
        }
    }

   


    public function checkAge($age)
    {


        $result = Jalalian::forge(substr($age, 0, 10));
        $date_of_birth = $result->format('Y-m-d');
        $age = Carbon::parse($date_of_birth)->diff(new Verta())->y;
        return $age;
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

    public function edit(User $user)
    {
        $provinces = ProvinceCity::where('parent', 0)->get();
        return view('admin.edit', compact('user', 'provinces'));
    }

    public function update(RegisterRequest $request, User $user)
    {
        if ($this->checkAge($request->birthday_date) <= 10) {
            return redirect()->back()->with('error','yor age must grather 10 years old');;
        }
        if ($this->custom_check_national_code($request->national_code)) {

            $inputs = $request->all();
            $inputs['verification_code'] = rand(100000, 999999);
            $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);
            $user->update($inputs);

            Log::alert("admin=".Session::get('admin_id'). "update admin");

            return redirect()->route('admin.show')->with('success','admin update');;

        }else{
            return redirect()->back()->with('error','national code incorrect!!!');

        }
    }
    

    

    public function destroy(User $user){
        $user->delete();
        Log::alert("admin=".Session::get('admin_id'). "delete admin");

        return redirect()->route('admin.show')->with('success','admin delete');


    }
    public function changeRole($id){
        $user=User::where('id',$id)->first();
        if($user->user_type==1){
            $user->update([
                'user_type'=> 2
            ]);
        }else{
            $user->update([
                'user_type'=> 1
            ]);
        }
        return redirect()->route('admin.show')->with('success','change admin type');
    }

    public function logout()
    {
        Session::forget('admin_id');
        Session::forget('first_name');

       

        return redirect()->route('user.login.show');
    }
}
