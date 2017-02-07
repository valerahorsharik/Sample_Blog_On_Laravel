<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Post;
use App\Comment;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show all posts 
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = DB::table('posts')
                ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select(DB::raw('`posts`.*, `users`.`name` as author, count(`comments`.`post_id`) as comments_count'))
                ->where('posts.deleted', '=', '0')
                ->where(function($query){
                    $query->where( 'comments.deleted', '=', '0')
                    ->orWhere('comments.deleted', '=', NULL);
                })
                ->groupBy('posts.id')
                ->orderBy('posts.id', 'desc')
                ->get();
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Shows all posts that belong to the user with $nickName
     * 
     * @param string $nickName
     * @return \Illuminate\Http\Response
     * @throws NotFoundHttpException
     */
    public function showPostsByNickName($nickName) {
        try {
           $posts = DB::table('posts')
                ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->select(DB::raw('`posts`.*, `users`.`name` as author, count(`comments`.`post_id`) as comments_count'))
                ->where('posts.deleted', '=', '0')
                ->where(function($query){
                    $query->where( 'comments.deleted', '=', '0')
                    ->orWhere('comments.deleted', '=', NULL);
                })
                ->where('users.nick_name','=', $nickName)
                ->groupBy('posts.id')
                ->orderBy('posts.id', 'desc')
                ->get();
            return view('posts.index', [
                'posts' => $posts,
            ]);
        } catch (\ErrorException $ex) {
            throw new NotFoundHttpException('No such user!');
        }
    }

    /**
     * Shows a form for adding new Posts
     * 
     * @return \Illuminate\Http\Response
     */
    public function add() {
        return view('posts.add');
    }

    /**
     * Shows post by $id
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     * 
     * @throws NotFoundHttpException
     */
    public function show($id) {

        $post = Post::find($id);
        if (!isset($post)) {
            throw new NotFoundHttpException('Sorry, but we cant find that article...');
        }

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Saves post from request
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|max:50',
            'article' => 'required|min:20'
        ]);

        $request->user()->posts()->create([
            'title' => $request->title,
            'article' => $request->article
        ]);

        return redirect()->route('post.index');
    }

    /**
     * Delete post by $id
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $post = Post::find($id);
        If (Auth::user()->role != 'admin') {

            if ($post->user_id !== Auth::user()->id) {
                return redirect()->route('post.index')->withErrors('Sorry, but you are not the owner of this article.');
            }

            $createdAt = strtotime(date($post->created_at));
            $differenceInTime = time() - $createdAt;
            if ($differenceInTime > 3600) {
                return redirect()->route('post.index')->withErrors('Sorry, but you can delete post only for 1 hour.');
            }
        }

        $post->deleted = 1;
        $post->save();

        return redirect()->route('post.index');
    }

}
