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
        Schema::create('wil_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // WIL-specific fields (personal info pulled from users table)
            $table->string('id_number', 13)->unique();
            $table->string('phone');
            $table->string('address');
            $table->string('institution');
            $table->string('student_number')->unique();
            $table->string('field_of_study');
            $table->string('faculty')->nullable();
            $table->enum('year_of_study', ['1st', '2nd', '3rd', '4th', 'Honours', 'Postgrad']);

            // Application status flow
            $table->enum('status', [
                'draft',
                'pending_payment',
                'under_review',
                'approved',
                'rejected',
            ])->default('draft');

            $table->text('notes')->nullable(); // Admin notes/feedback

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wil_applications');
    }
};
