<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('amount', 10, 2);

            $table->string('payment_method'); 
            // contoh: transfer, ewallet, cash

            $table->string('status')->default('pending');
            // pending, paid, failed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};