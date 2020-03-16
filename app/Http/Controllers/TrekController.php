<?php

namespace App\Http\Controllers;

use App\trek;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TrekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Treks = Trek::all();
        return view('detail', ['Treks' => $Treks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = Trek::all();
        return view('new', ['news' => $news]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [ 
            'name' => 'required|min:2', 
            'difficulty' => 'required',
            'access' => 'required|min:2',
            'gear' => 'required|min:2'
        ]);

        $user = \Auth::user();
        $time = date("YmdHis");

        $trek = new Trek;
        $trek->image_url = $request->image_url->storeAs('public/post_images', $time.'_'.Auth::user()->id . '.jpg');
        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->access = request('access');
        $trek->gear = request('gear');
        $trek->days = request('days');
        $trek->user_id = $user->id;
        $trek->save();
        return redirect()->route('detail.detail', ['id' => $trek->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, trek $trek, $id)
    {
        $details = Trek::find($id);
        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }
        return view('mountain', ['details' => $details, 'login_user_id' => $login_user_id, 'image_url' => str_replace('public/', 'storage/', $details->image_url)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, trek $trek, $id)
    {
        $trek = Trek::find($id);
        return view ('edit', ['trek' => $trek]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, trek $trek)
    {
        $this->validate($request, [ 
            'name' => 'required|min:2', 
            'difficulty' => 'required',
            'access' => 'required|min:2',
            'gear' => 'required|min:2'
        ]);

        $time = date("YmdHis");
        $trek1 = new Trek;
        $trek1->image_url = $request->image_url->storeAs('public/post_images', $time.'_'.Auth::user()->id . '.jpg');

        $trek = Trek::find($id);
        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->access = request('access');
        $trek->gear = request('gear');
        $trek->days = request('days');
        $trek->save();
        return redirect()->route('detail.detail', ['id' => $trek->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trek = Trek::find($id);
        $trek->delete();
        return redirect('/detail');
    }
}
