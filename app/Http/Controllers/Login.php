<?php

namespace App\Http\Controllers;
use App\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class login extends Controller
{

    protected $redirectTo = '/order';
    
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    function index(){
       return view('pagecontent.login');
   }

   public function loginPost(Request $request){

        $this->validateForm($request);
        if (Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
            ])) {
            $data = userModel::where('email',$request->email)->first();
        Session::put('user_id',$data->id);
        $headerName=(empty($data->name)) ? $data->email : $data->name;
        Session::put('name',$headerName);
        Session::put('email',$data->email);
        Session::put('login',TRUE);
        return redirect('order');
        } else {
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public function validateForm(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
            ]);
    }

    public function logout(){
        Auth::logout();
        return redirect('login')->with('alert','Kamu sudah logout');
    }
}
