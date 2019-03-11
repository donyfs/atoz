<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Success extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pagecontent.success');
    }
}
