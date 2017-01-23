<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Http\Requests;
use \Illuminate\Support\Facades\Auth;

class CommentController extends Controller {

    /**
     * Show all comments by id in request
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $comments = Comment::all()
                    ->where('post_id', $request->id)
                    ->where('deleted',0);
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
        if ($request->ajax()) {
            $this->validate($request, [
                'comment' => 'required|min:5' 
            ]);
            $timeNow = Date('Y-m-d H:i:s');
            $request->user()->comments()->create([
               'comment' => $request->comment,
               'post_id' => $request->id,
               'created_at' => $timeNow
            ]);
        }

        return redirect()->route('post.index')->withErrors('Sorry, but you are doing wrong...');
    }
    
    /**
     * Delete comment from request
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function delete(Request $request) {
        if ($request->ajax()) {
            $comment  = Comment::find($request->id);
            if($comment->user_id == Auth::user()->id){
                $comment->deleted = 1;
                $comment->save();
                return response("Deleted successfully", 200);
            }
            return response("Sorry, but you are not owner of the comment.", 403);
        }
        return redirect()->route('post.index')->withErrors('Sorry, but you are doing wrong...');
    }
}
