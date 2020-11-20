<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProjectStatus;

class CreateProjectsStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->engine = 'InnoDB';
        });

        ProjectStatus::insert([
            ['name' => 'programming_in_progress'],
            ['name' => 'awaits'],
            ['name' => 'done'],
            ['name' => 'canceled'],
            ['name' => 'graphical_design_in_progress'],
            ['name' => 'UX_model_in_progress']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_statuses');
    }
}
