<?php

namespace App\Http\Controllers;
use App\userModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class register extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/login';
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }
    function index(){
    	return view('pagecontent/register');
    }

    public function registerPost(Request $request){
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
            ]);

        $data =  new userModel();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success','Kamu berhasil Register');
    }
}
