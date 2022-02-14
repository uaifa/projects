<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('name');
            $table->String('code');
            $table->String('symbol');
            $table->String('precision')->nullable();
            $table->String('thousand_separator')->nullable();
            $table->String('decimal_separator')->nullable();
            $table->tinyInteger('swap_currency_symbol')->default(0);
            $table->decimal('exchange_rate',13,4)->nullable();
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
        Schema::dropIfExists('currencies');
    }
}
