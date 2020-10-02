<?php

namespace App\Http\Controllers;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\trek;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request, $id)
    {
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->trek_id = $id;
        $like->save();

        return redirect('/');
    }
    public function store2(Request $request, $id)
    {
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->trek_id = $id;
        $like->save();

        return redirect()->route('detail.detail', ['id' => $id]);
    }
    public function destroy(Request $request, $id)
    {
        $like = Like::find($request->like_id);
        $like->delete();
        return redirect('/');
    }
    public function destroy2(Request $request, $like_id)
    {
        $like = Like::find($request->like_id);
        $like->delete();
        
        $id = $like->trek_id;

        return redirect()->route('detail.detail', ['id' => $id]);
    }
}
