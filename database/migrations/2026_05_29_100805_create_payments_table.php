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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('wil_applications')->onDelete('cascade');

            $table->enum('method', ['payfast', 'proof_of_payment'])->default('payfast');;
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->decimal('amount', 8, 2)->default(0.00);

            // Online payment fields
            $table->string('transaction_id')->nullable();   // From payment gateway
            $table->string('gateway_reference')->nullable();

            // Proof of payment fields
            $table->string('proof_path')->nullable();       // Uploaded proof image/PDF
            $table->string('proof_email')->nullable();      // Email proof was sent from

            $table->timestamp('paid_at')->nullable();       // When payment was confirmed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

