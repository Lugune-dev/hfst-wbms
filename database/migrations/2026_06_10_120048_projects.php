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
          Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->decimal('budget', 12, 2);
    $table->decimal('current_funding', 12, 2)->default(0);
    $table->date('start_date');
    $table->date('end_date')->nullable();
    $table->enum('status', ['Planning', 'Active', 'Completed', 'OnHold']);
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});//
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
