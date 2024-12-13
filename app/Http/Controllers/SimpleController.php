<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Users;

class SimpleController extends Controller
{
    public function detail(string $id): View
    {
        $user = Users::where("id", "=", $id)->first();
        if (!$user) {
            return view("user_notfound", ["id" => $id]);
        } else {
            return view("home", ["user" => $user]);
        }
    }
}
