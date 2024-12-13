<?php

use App\Http\Controllers\SimpleController;
use App\Http\Controllers\User;
use App\Http\Middleware\EnsureWebAuth;
use App\Http\Middleware\EnsureWebNoneAuth;
use Illuminate\Support\Facades\Route;
use App\Models\Users;

Route::view("/", "home", ["user" => Users::first()]);

Route::get("/user/{id}", [SimpleController::class, "detail"]);

Route::view("/under_construction", "under_construction");

Route::middleware([EnsureWebNoneAuth::class])->group(function () {
    Route::view("/signup", "signup");
    Route::post("/signup", [User::class, "signup"]);

    Route::view("/login", "login");
    Route::post("/login", [User::class, "login"]);
});

Route::middleware([EnsureWebAuth::class])->group(function () {
    Route::view("/board", "board");
    Route::get("/signout", [User::class, "logout"]);
});
