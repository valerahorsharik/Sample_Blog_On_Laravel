<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserData;
use App\Http\Requests;
use App\User;
use \Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Shows personal page of authorized user
     * 
     * @return \Illuminate\Http\Response
     */     
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
    
    /**
     * Show user personal page by nickName
     * 
     * @param string $nickName
     * @return \Illuminate\Http\Response
     * @throws NotFoundHttpException
     */
    public function show($nickName) {
        
        $user = User::where('nick_name', $nickName)->first();
        if (!isset($user)) {
            throw new NotFoundHttpException('No such user!');
        }
        return view('user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Updating user's data
     * 
     * @param UserData $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserData $request) {
//        if($request->hasFile('avatar')){
//            dd('Ok ');
//        }
//        dd('noto k');
        Auth::user()->update($request->except('b-date'));
        return response("Success", 200);
    }
    

}
