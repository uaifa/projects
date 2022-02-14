<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('item_name')->nullable();
            $table->string('item_number')->nullable();
            $table->string('item_price');
            $table->string('item_price_currency');
            $table->string('paid_amount')->nullable();
            $table->string('paid_amount_currency');
            $table->string('txn_id')->nullable();
            $table->string('payment_status');
            $table->string('stripe_checkout_session_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_type', ['stripe', 'paypal']);
            $table->string('payer_id')->nullable();
            $table->string('payer_status')->nullable();
            $table->string('payment_state')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('created')->nullable();
            $table->string('modified')->nullable();            
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
        Schema::dropIfExists('transactions');
    }
}
