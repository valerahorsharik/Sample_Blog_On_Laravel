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
        $months = ['January', 'February', 'March', 'April', 'May',
            'Jun', 'July', 'August', 'September', 'October', 'November',
            'December',];
        return view('user.index', [
            'user' => $user,
            'months' => $months,
            'date' => $date,
        ]);
    }

    public function update(Request $request) {
        if (isset($request->year) && isset($request->month) && isset($request->day)) {
            $birthDate = $request->year . '-' . $request->month . '-' . $request->day;
            Auth::user()->birth_date = $birthDate;
        }
        if (isset($request->email)) {
            Auth::user()->email = $request->email;
        }
        if (isset($request->name)) {
            Auth::user()->name = $request->name;
        }
        if (isset($request->surname)) {
            Auth::user()->surname = $request->surname;
        }

        Auth::user()->save();
    }

}
