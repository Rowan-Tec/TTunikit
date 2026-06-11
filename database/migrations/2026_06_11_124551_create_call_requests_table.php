<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('call_requests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->enum('status', ['pending', 'completed'])->default('pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('call_requests');
    }
};

