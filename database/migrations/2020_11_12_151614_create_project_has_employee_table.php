<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectHasEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_has_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('project_has_employee');
    }
}
