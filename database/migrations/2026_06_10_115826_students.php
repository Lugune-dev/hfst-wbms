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
         Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('first_name');
    $table->string('last_name');
    $table->enum('gender', ['Male', 'Female']);
    $table->integer('age');
    $table->string('school');
    $table->enum('education_level', ['Primary', 'Secondary', 'University']);
    $table->json('requirements'); // fees, books, uniform
    $table->enum('status', ['Active', 'Graduated', 'Dropped'])->default('Active');
    $table->text('documents')->nullable(); // JSON store
    $table->text('progress_notes')->nullable();
    $table->timestamps();
});   //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
