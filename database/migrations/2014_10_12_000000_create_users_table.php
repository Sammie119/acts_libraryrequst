<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('remember_token')->nullable();
            $table->string('user_type')->nullable();
            $table->string('password');
            $table->tinyInteger('user_detail_status')->default(0);
            $table->timestamps();
        });

        User::create([
            'name' => 'Samuel Sarpong-Duah',
            'email' => 'admin@acts.com',
            'user_type' => 'admin',
            'password' => Hash::make('sammie119'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
