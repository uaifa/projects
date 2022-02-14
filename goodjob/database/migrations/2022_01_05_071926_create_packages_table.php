<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('heading')->nullable();
            $table->longText('sub_heading')->nullable();
            $table->string('package_name');      
            $table->string('duration');
            $table->string('icon');
            $table->decimal('price')->default(0);
            $table->string('currency');
            $table->longText('package_type_text');
            $table->string('manager');
            $table->string('users');
            $table->string('support_text');
            $table->string('storage_text');
            $table->integer('storage_place_size');
            $table->text('button_text');
            $table->unsignedBigInteger('created_by');
            $table->string('slug')->nullable();
            $table->string('stripe_plan')->nullable();
            $table->string('paypal_plan')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
