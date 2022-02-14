<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['pendent', 'done', 'cancel', 'inprogress']);
            $table->longText('description');
            $table->date('date');
            $table->string('from_time_hours');
            $table->string('to_time_minutes');
            $table->unsignedBigInteger('client_id');
            $table->string('place_of_work');
            $table->string('contact_person');
            $table->string('phone');
            $table->string('email');
            $table->unsignedBigInteger('created_by');
            $table->string('signature');
            $table->integer('file_size')->nullable();
            $table->integer('role_id')->default(0);
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::dropIfExists('jobs_lists');
    }
}
