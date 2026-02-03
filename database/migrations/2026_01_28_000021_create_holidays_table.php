<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['school_id', 'name', 'start_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
