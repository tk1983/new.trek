<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function show($user_id)
    {
        $users = App\User::find($user_id);
        return view('users/index', ['users' => $users, 'user_id' => '$user_id']);
    }

    public function store(UsersRequest $request)
    {
        $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');

        return redirect('profile')->with('success', '新しい写真を登録しました');
    }
}
