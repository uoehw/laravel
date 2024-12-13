<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename("channel_users", "user_channels");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename("user_channels", "channel_users");
    }
};
