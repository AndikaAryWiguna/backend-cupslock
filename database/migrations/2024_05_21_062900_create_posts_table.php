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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // Code untuk relasi antar table dan dibuatkan index
            $table->foreignId('author_id')->constrained(
                table: 'users', 
                indexName: 'posts_author_id'
            );
            $table->foreignId('kategori_id')->constrained(
                table: 'kategoris', 
                indexName: 'posts_kategori_id'
            );
            $table->string('slug')->unique();
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
