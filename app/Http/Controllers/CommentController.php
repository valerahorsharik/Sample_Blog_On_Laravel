<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller
{
    public function index($id) {
        $comments = Comment::all()->where('post_id',$id);
        return view('comment.index',[
            'comments'=>$comments
        ]);
    }
}
