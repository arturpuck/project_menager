<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectHasTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_has_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
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
        Schema::dropIfExists('project_has_tasks');
    }
}
