<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('phone')->nullable();
            $table->string('link')->nullable();

            $table->bigInteger('source_id')->unsigned()->nullable();
            $table->bigInteger('unit_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('responsible_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();

            $table->foreign('source_id')->references('id')->on('sources');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('responsible_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');


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
        Schema::dropIfExists('tasks');
    }
}
