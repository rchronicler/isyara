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
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->foreign(['category_id'], 'dictionaries_ibfk_1')->references(['category_id'])->on('categories')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['submitter'], 'dictionaries_ibfk_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->dropForeign('dictionaries_ibfk_1');
            $table->dropForeign('dictionaries_ibfk_2');
        });
    }
};
