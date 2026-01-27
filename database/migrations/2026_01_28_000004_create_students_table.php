<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('admission_no')->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->foreignId('class_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('section_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('parent_id')->nullable()->constrained('parents')->onDelete('set null');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
