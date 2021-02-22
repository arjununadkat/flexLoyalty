<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('CurrencyName');
            $table->string('CurrencyCode');
            $table->timestamps();
        });

        $data = [
            ['CurrencyName'=>'Tanzanian Shillings', 'CurrencyCode'=> 'TZS'],
            ['CurrencyName'=>'US Dollars', 'CurrencyCode'=> 'USD'],
            ['CurrencyName'=>'Great British Pounds', 'CurrencyCode'=> 'GBP'],

        ];

        DB::table('currencies')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
