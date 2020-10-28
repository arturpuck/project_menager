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
        });

        ProjectStatus::insert([
            ['name' => 'under_development'],
            ['name' => 'awaits'],
            ['name' => 'done'],
            ['name' => 'canceled']
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
