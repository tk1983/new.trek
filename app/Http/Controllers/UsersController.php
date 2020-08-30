<?php

namespace App\Http\Controllers;

use App\trek;
use App\Http\Requests\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show($user_id)
    {
        $Treks = Trek::where('user_id', $user_id)->get();

        $is_image = false;
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
            $is_image = true;
        }
        $users = User::find($user_id);
        return view('users/index', ['is_image' => $is_image, 'users' => $users, 'user_id' => $user_id, 'Treks' => $Treks]);
    }

    public function store(UsersRequest $request, $user_id)
    {
        $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');

        return redirect('/users/' . $user_id)->with('success', '新しい写真を登録しました');
    }
}
