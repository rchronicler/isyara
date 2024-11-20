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
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->bigIncrements('entry_id');
            $table->string('words')->unique('words');
            $table->text('definition');
            $table->enum('parts_of_speech', ['noun', 'pronoun', 'adjective', 'adverb', 'verb', 'preposition', 'conjunction', 'interjection']);
            $table->text('video_url')->nullable();
            $table->text('note')->nullable();
            $table->integer('popularity')->nullable()->default(0);
            $table->unsignedBigInteger('category_id')->index('category_id');
            $table->unsignedBigInteger('submitter')->index('submitter');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictionaries');
    }
};
