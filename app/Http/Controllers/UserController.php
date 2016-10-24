<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use \Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = User::find(Auth::user()->id);
        $months = ['January','February','March','April','May',
            'Jun','July','August','September','October','November'
            ,'December',];
        return view('user.index',['user'=>$user,'months'=>$months]);
    }
    
    public function bdayUpdate(Request $response) {
       echo "123";
    }
}
