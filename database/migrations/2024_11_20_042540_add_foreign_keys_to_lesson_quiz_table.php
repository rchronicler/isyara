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
        Schema::table('lesson_quiz', function (Blueprint $table) {
            $table->foreign(['lesson_id'], 'lesson_quiz_ibfk_1')->references(['lesson_id'])->on('lessons')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_quiz', function (Blueprint $table) {
            $table->dropForeign('lesson_quiz_ibfk_1');
        });
    }
};
