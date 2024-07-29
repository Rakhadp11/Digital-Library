<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('cover_image')->nullable();
            $table->string('author');
            $table->string('publisher');
            $table->integer('year');
            $table->integer('pages');
            $table->text('description')->nullable();
            $table->string('pdf_file')->nullable();
            $table->boolean('is_available')->default(true); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
