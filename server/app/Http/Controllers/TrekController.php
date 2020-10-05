<?php

namespace App\Http\Controllers;

use App\Trek;
use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Treks = Trek::order($request->narabi);

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
            'image_url' => 'required',
            'name' => 'required|min:2',
            'difficulty' => 'required',
            'address' => 'required|min:2',
            'comment' => 'required|min:2'
        ]);

        $user = \Auth::user();
        $time = date("YmdHis");

        $trek = new Trek;
        $trek->image_url = $request->image_url->storeAs('public/post_images', $time . '_' . Auth::user()->id . '.jpg');
        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->address = request('address');
        $trek->comment = request('comment');
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
    public function show(Request $request, $id)
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
    public function edit(Request $request, $id)
    {
        $trek = Trek::find($id);
        return view('edit', ['trek' => $trek]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trek  $trek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image_url' => 'required',
            'name' => 'required|min:2',
            'difficulty' => 'required',
            'address' => 'required|min:2',
            'comment' => 'required|min:2'
        ]);

        $time = date("YmdHis");

        $trek = Trek::find($id);
        $trek->image_url = $request->image_url->storeAs('public/post_images', $time . '_' . Auth::user()->id . '.jpg');

        $trek->name = request('name');
        $trek->area = request('area');
        $trek->difficulty = request('difficulty');
        $trek->address = request('address');
        $trek->comment = request('comment');
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
