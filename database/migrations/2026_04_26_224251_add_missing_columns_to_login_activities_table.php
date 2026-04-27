<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('login_activities', function (Blueprint $table) {
            $table->boolean('successful')->default(true)->after('user_id');
            $table->string('activity_type')->default('login')->after('successful');
            $table->string('device')->nullable()->after('user_agent');
            $table->string('browser')->nullable()->after('device');
            $table->string('platform')->nullable()->after('browser');
            $table->timestamp('login_at')->nullable()->after('platform');
            
            // Add indexes for performance
            $table->index('successful');
            $table->index('activity_type');
            $table->index('login_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('login_activities', function (Blueprint $table) {
            $table->dropIndex(['successful']);
            $table->dropIndex(['activity_type']);
            $table->dropIndex(['login_at']);
            $table->dropColumn(['successful', 'activity_type', 'device', 'browser', 'platform', 'login_at']);
        });
    }
};
