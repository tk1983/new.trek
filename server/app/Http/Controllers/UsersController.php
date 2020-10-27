<?php

namespace App\Http\Controllers;

use App\Trek;
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
        $users = User::find($user_id);

        $user = \Auth::user();
        if ($user) {
            $login_user_id = $user->id;
        } else {
            $login_user_id = "";
        }

        return view('users/index', ['users' => $users, 'login_user_id' => $login_user_id, 'user_id' => $user_id, 'Treks' => $Treks]);
    }

    public function store(UsersRequest $request, $user_id)
    {
        if (Storage::disk('local')->exists('public/profile_images/' . Auth::id() . '.jpg')) {
            \File::delete('public/profile_images', Auth::id() . '.jpg');
            $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');
        } else {
            $request->photo->storeAs('public/profile_images', Auth::id() . '.jpg');
        }

        return redirect('/users/' . $user_id)->with('success', '新しい写真を登録しました');
    }
}
