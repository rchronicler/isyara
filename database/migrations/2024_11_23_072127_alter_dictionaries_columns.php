<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            // Drop the 'parts_of_speech' and 'note' columns
            $table->dropColumn(['parts_of_speech', 'note']);

            // Rename 'definition' to 'description'
            $table->renameColumn('definition', 'description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            // Revert the changes by adding back 'parts_of_speech' and 'note' columns
            $table->enum('parts_of_speech', ['noun', 'pronoun', 'adjective', 'adverb', 'verb', 'preposition', 'conjunction', 'interjection']);
            $table->text('note')->nullable();

            // Rename 'description' back to 'definition'
            $table->renameColumn('description', 'definition');
        });
    }
};
