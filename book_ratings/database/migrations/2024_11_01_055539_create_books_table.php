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
            $table->unsignedBigInteger('user_id');
                $table->string('author');
                $table->string('summary');
                $table->float('average_rating');
                $table->string('image_url');
                $table->text('description');
                $table->string('genre');
                $table->integer('year');
                $table->string('publisher');
                $table->string('language');
                $table->string('isbn');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
