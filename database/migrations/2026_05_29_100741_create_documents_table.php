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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('wil_applications')->onDelete('cascade');

            $table->enum('type', [
                'cv',
                'academic_record',
                'recommendation_letter',
                'id_copy',
            ]);

            $table->string('file_path');           // Path in storage/app/private/documents/
            $table->string('original_name');       // Original filename for display
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable(); // In bytes

            $table->timestamps();

            // One document type per application
            $table->unique(['application_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
