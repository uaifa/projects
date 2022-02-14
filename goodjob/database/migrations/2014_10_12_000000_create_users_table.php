<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('role_id')->nullable();
            $table->string('os')->nullable();
            $table->string('resolution')->nullable();
            $table->string('device_name')->nullable();
            $table->string('device_token')->nullable();
            $table->boolean('is_notification')->default(1);
            $table->boolean('is_block')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('forget_code')->nullable();
            $table->string('access_token')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->tinyInteger('package_type')->default(0);
            $table->integer('file_size')->nullable();
            $table->string('current_subscription_start')->nullable();
            $table->string('current_subscription_end')->nullable();
            $table->string('stripe_payment_status')->nullable();  
            $table->string('payment_stripe_status')->nullable();
            $table->string('payment_paypal_status')->nullable();
            $table->enum('payment_type',['paid','free'])->nullable();
            $table->timestamp('stripe_start_date')->nullable();
            $table->timestamp('stripe_end_date')->nullable();
            $table->timestamp('paypal_start_date')->nullable();
            $table->timestamp('paypal_end_date')->nullable();
            $table->timestamp('package_start_date_time')->nullable();
            $table->timestamp('package_end_date_time')->nullable();
            $table->string('private_address')->nullable();
            $table->string('house_number')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();
            $table->enum('user_type',['staffmember', 'admin', 'user'])->nullable();
            $table->string('profile_image')->nullable();
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
