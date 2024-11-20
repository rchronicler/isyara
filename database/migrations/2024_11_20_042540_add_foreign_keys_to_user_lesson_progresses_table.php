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
        Schema::table('user_lesson_progresses', function (Blueprint $table) {
            $table->foreign(['user_id'], 'user_lesson_progresses_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['lesson_id'], 'user_lesson_progresses_ibfk_2')->references(['lesson_id'])->on('lessons')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_lesson_progresses', function (Blueprint $table) {
            $table->dropForeign('user_lesson_progresses_ibfk_1');
            $table->dropForeign('user_lesson_progresses_ibfk_2');
        });
    }
};
