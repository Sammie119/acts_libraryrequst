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
            $table->integer('user_id');
            $table->integer('user_detail_id');
            $table->string('book_barcode', 10);
            $table->date('req_date');
            $table->date('approved_date')->nullable();
            $table->tinyInteger('days_to_return')->nullable();
            $table->date('date_to_return')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=cancelled, 1=pending approval, 2=request approved, 3=book returned');
            $table->integer('approved_created_by')->nullable();
            $table->integer('approved_updated_by')->nullable();
            $table->date('returned_date')->nullable();
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
