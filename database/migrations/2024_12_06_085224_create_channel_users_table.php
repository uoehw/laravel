<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("channel_users", function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("channel_id");
            $table->enum("status", [
                "requested",
                "invited",
                "member",
                // monitoring, imposing ban or restriction on member.
                "modirator",
                // monitoring, imposing ban or restriction on member or modirator.
                //  reject request joining channel from user
                //  report to owner. e.g to demote certain admin or modirator
                "admin",
                // all functionality of admin including
                // disband channel, promote or demote member role.
                "owner",
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("channel_users");
    }
};
