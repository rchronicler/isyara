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
        Schema::create('user_lesson_progresses', function (Blueprint $table) {
            $table->bigIncrements('progress_id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('lesson_id')->index('lesson_id');
            $table->integer('order_id');
            $table->enum('status', ['completed', 'in_progress']);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_lesson_progresses');
    }
};
