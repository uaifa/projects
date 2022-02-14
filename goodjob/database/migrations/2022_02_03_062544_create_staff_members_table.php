<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number_1');
            $table->string('phone_number_2');
            $table->string('profile_image')->nullable();
            $table->string('client_id')->nullable();
            $table->string('profile_background_image')->nullable();  
            $table->string('password')->nullable();
            $table->string('private_address', 1000)->nullable();
            $table->string('house_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->boolean('status')->default(1); 
            $table->unsignedBigInteger('created_by');       
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
        Schema::dropIfExists('staff_members');
    }
}
