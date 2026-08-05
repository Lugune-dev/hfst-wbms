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
       Schema::create('project_student', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->constrained();
    $table->foreignId('student_id')->constrained();
    $table->date('assigned_date');
    $table->enum('status', ['Active', 'Completed'])->default('Active');
    $table->timestamps();
}); //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
