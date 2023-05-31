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
            $table->string('barcode')->nullable();
            $table->date('dateaccessioned')->nullable();
            $table->string('itemcallnumber')->nullable();
            $table->text('isbn')->nullable();
            $table->string('author')->nullable();
            $table->string('title')->nullable();
            $table->string('pages')->nullable();
            $table->text('publishercode')->nullable();
            $table->string('place')->nullable();
            $table->integer('copyrightdate')->nullable();
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
