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
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("last_name");
            $table->timestamp("birthday");
            $table->char("gender");
            $table->string("email");
            $table->string("password");
            // 0: private
            // 1: public
            // 2: searchable
            // 4: invitable
            // Note: this is bit control, therefore 0 & 2 can never happen as user must be public
            //       to be able to search by some else. Likewise, searchable need to be public therefore
            //       when set value to searchable, it will automatically add public status as well
            $table->integer("accessibility");
            $table->timestamp("deleted_at");
            // this line automatically create column `created_at` and `updated_at`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("users");
    }
};
