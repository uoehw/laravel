<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table("users")->insert([
                "first_name" => Str::random(10),
                "last_name" => Str::random(10),
                "gender" => "M",
                "birthday" => Carbon::now(),
                "email" => Str::random(10) . "@example.com",
                "password" => Hash::make("password"),
                "accessibility" => 0,
                "deleted_at" => Carbon::now(),
            ]);
        }
    }
}
