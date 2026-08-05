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
      Schema::create('donations', function (Blueprint $table) {
    $table->id();
    $table->foreignId('donor_id')->constrained();
    $table->foreignId('student_id')->nullable()->constrained();
    $table->foreignId('project_id')->nullable()->constrained();
    $table->decimal('amount', 12, 2);
    $table->string('payment_method'); // Mobile Money, Bank Transfer
    $table->string('transaction_id')->unique();
    $table->enum('status', ['Pending', 'Confirmed', 'Failed'])->default('Pending');
    $table->text('notes')->nullable();
    $table->timestamp('confirmed_at')->nullable();
    $table->foreignId('confirmed_by')->nullable()->constrained('users');
    $table->timestamps();
});  //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
