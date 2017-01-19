<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $comments = Comment::all()->where('post_id', $request->id);
            return view('comments.index', [
                'comments' => $comments
            ]);
        }
        return redirect()->route('post.index')->withErrors('Sorry, but you are doing wrong...');
    }
    
    /**
     * Saves comment from request
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $request->user()->comments()->create([
           'text' => $request->text,
            'post_id' => 7
        ]);
        
        return redirect()->back();
    }
}
