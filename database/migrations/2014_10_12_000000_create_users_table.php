<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('username')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->integer('transactions_number')->nullable();
            $table->integer('spending_amount')->nullable();
            $table->integer('points')->nullable();
            $table->integer('gift_value')->nullable();
            $table->timestamps();
        });

        $data = [
            ['username'=>'ArjunUnadkat', 'email'=>'a.u@gmail.com','password'=> Hash::make('password')],
            ['username'=>'EllisLakhani', 'email'=>'e.l@gmail.com','password'=> Hash::make('password')],

        ];
        DB::table('users')->insert($data);
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
}
