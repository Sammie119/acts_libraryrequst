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
        Schema::create('book_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('request_id');
            $table->integer('user_id');
            $table->integer('user_detail_id');
            $table->bigInteger('book_id');
            $table->date('approved_date');
            $table->tinyInteger('status')->default(1)->comment('0=cancelled, 1=pending approval, 2=request approved, 3=book returned');
            $table->integer('approved_created_by');
            $table->integer('approved_updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_requests');
    }
};
