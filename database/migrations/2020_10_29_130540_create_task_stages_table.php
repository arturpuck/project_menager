<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedFloat('estimated_time_of_work');
            $table->unsignedFloat('estimated_amount_of_money');
            $table->date('start_at');
            $table->date('deadline');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_stages');
    }
}
