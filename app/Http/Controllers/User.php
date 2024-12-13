<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class User extends Controller
{
    public function signup(Request $request): RedirectResponse
    {
        $input = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
            "password_confirmation" => ["required"],
            "first_name" => ["required"],
            "last_name" => ["required"],
            "birthday" => ["required"],
            "gender" => ["required"],
        ]);

        $input["password"] = Hash::make($input["password"]);

        // accessibility and deleted_at
        $input["accessibility"] = 0;
        $input["deleted_at"] = Carbon::createFromTimestamp(0)->format(
            "Y-m-d H:i:s"
        );

        $user = Users::create($input);

        if (!$user) {
            // something is wrong
            return back();
        } else {
            $request->session()->regenerate();
            $request->session()->push("user_id", $user->id);
            return redirect()->intended("board");
        }
    }

    public function login(Request $request): RedirectResponse
    {
        $input = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        if (Auth::attempt($input)) {
            $user = Users::where("email", $input["email"])->get();
            if ($user && $user->count() == 1) {
                $request->session()->regenerate();
                $request->session()->push("user_id", $user->first()->id);
                return redirect()->intended("board");
            }
        }

        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        return redirect()->intended("login");
    }
}
