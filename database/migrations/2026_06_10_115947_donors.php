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
           Schema::create('donors', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('organization_name')->nullable();
    $table->string('phone');
    $table->text('address');
    $table->string('country');
    $table->enum('donor_type', ['Individual', 'Corporate', 'NGO']);
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
