<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('task_id')->unsigned()->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->text('comment_value')->nullable();
            $table->boolean('is_event')->default(0);

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users');


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
        Schema::dropIfExists('task_comments');
    }
}
