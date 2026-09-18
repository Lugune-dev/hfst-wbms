<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create schools table
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('education_level')->default('Secondary'); // Primary, Secondary, High School, Vocational, University
            $table->string('region')->default('Arusha');
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->unsignedInteger('student_capacity')->default(100);
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 2. Create school_user pivot table for multi-tenancy scoping
        Schema::create('school_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('role_in_school')->nullable(); // Teacher, Headteacher, Liaison, Coordinator
            $table->timestamps();
            $table->unique(['school_id', 'user_id']);
        });

        // 3. Add school_id to students table
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('school_id')->nullable()->after('age')->constrained('schools')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });

        Schema::dropIfExists('school_user');
        Schema::dropIfExists('schools');
    }
};
