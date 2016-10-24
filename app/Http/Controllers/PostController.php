<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => 'index']);
    }
    
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',
        [
            'posts'=>$posts,
        ]);
    }
    
    public function add()
    {
        return view('posts.add');
    }
    
    public function show($id) {
        
        $post = Post::find($id);
        return view('posts.show',['post'=> $post]);
        
    }
    public function store(Request $request)
    {
    
        $this->validate($request,[
            'title' => 'required|max:50',
            'article'=>'required|min:20'
        ]);
        
        $request->user()->posts()->create([
            'title'=>$request->title,
            'article'=>$request->article
        ]);
        
        return redirect()->route('post.index');
        
    }
}
