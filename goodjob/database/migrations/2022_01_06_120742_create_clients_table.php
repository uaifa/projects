<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('street');
            $table->string('house_no');
            $table->string('zip_code');
            $table->string('town');
            $table->string('telephone');
            $table->string('branch');
            $table->string('additional_address')->nullable();
            $table->string('corporate_client')->nullable();
            $table->string('address')->nullable();
            $table->string('place')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
