<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, $comment_id)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->comment_id;
        $comment->user_id = Auth::user()->id;
        $comment->trek_id = $comment_id;
        $comment->save();

        return redirect('/');
    }    
    public function store2(Request $request, $comment_id)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->comment_id;
        $comment->user_id = Auth::user()->id;
        $comment->trek_id = $comment_id;
        $comment->save();
        
        $id = $comment_id;

        return redirect()->route('detail.detail', ['id' => $id]);
    }  
    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return redirect('/');
    }
    public function destroy2(Request $request, $comment_id)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        
        $id = $comment_id;

        return redirect()->route('detail.detail', ['id' => $id]);
    }
}
