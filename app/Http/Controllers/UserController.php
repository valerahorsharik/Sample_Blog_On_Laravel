<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use \Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $date = date_parse_from_format('Y-m-d', Auth::user()->birth_date);
//        var_dump($date);
//        die;
        $months = ['January', 'February', 'March', 'April', 'May',
            'Jun', 'July', 'August', 'September', 'October', 'November'
            , 'December',];
        return view('user.index', ['user' => $user,
            'months' => $months,
            'date'=>$date,
            ]);
    }

    public function updateBirthDate(Request $request) {
        $birthDate = $request->year. '-' . $request->month . '-' .$request->day;      
        Auth::user()->birth_date = $birthDate;
        Auth::user()->save();
    }

}
