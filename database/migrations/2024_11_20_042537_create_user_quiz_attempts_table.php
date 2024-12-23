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
        Schema::create('user_quiz_attempts', function (Blueprint $table) {
            $table->bigIncrements('attempt_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('quiz_id')->index('quiz_id');
            $table->boolean('status');
            $table->timestamp('attempted_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_quiz_attempts');
    }
};
