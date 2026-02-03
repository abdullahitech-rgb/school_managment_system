<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('attendance', 'attendances');

        Schema::table('attendances', function (Blueprint $table) {
            $table->foreignId('attendance_type_id')
                ->after('attendance_date')
                ->constrained('attendance_types')
                ->onDelete('restrict');
            $table->dropColumn('status');
        });
    }

    public function down(): void
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->enum('status', ['present', 'absent', 'leave'])->default('absent');
            $table->dropForeign(['attendance_type_id']);
            $table->dropColumn('attendance_type_id');
        });

        Schema::rename('attendances', 'attendance');
    }
};
