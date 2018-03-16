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
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->text('body');
            $table->date('start');
            $table->date('finish');
            $table->integer('weight');
            $table->json('extra_data')->nullable();

            $table->integer('sender_user_id')
                    ->unsigned();
            $table->integer('functor_user_id')
                    ->unsigned();
            $table->integer('seconder_user_id')
                    ->unsigned();
            $table->integer('task_status_id')
                    ->unsigned();

            $table->foreign('sender_user_id')
                ->references ('id')->on ('users')
                ->onUpdate ('cascade')
                ->onDelete ('cascade');

            $table->foreign('functor_user_id')
                ->references ('id')->on ('users')
                ->onUpdate ('cascade')
                ->onDelete ('cascade');

            $table->foreign('seconder_user_id')
                ->references ('id')->on ('users')
                ->onUpdate ('cascade')
                ->onDelete ('cascade');

            $table->foreign('task_status_id')
                ->references ('id')->on ('task_statuses')
                ->onUpdate ('cascade')
                ->onDelete ('cascade');
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
