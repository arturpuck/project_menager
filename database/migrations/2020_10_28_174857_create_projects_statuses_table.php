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
            $table->string('name',30)->unique();
            $table->string('name_pl',30)->unique();
            $table->engine = 'InnoDB';
        });

        ProjectStatus::insert([
            ['name' => 'programming in progress',
             'name_pl' => 'programowanie w toku'],
            ['name' => 'awaits',
            'name_pl' => 'oczekuje'],
            ['name' => 'done',
            'name_pl' => 'zrobiony'],
            ['name' => 'canceled',
            'name_pl' => 'anulowany'],
            ['name' => 'graphical design in progress',
            'name_pl' => 'projekt graficzny w toku'],
            ['name' => 'UX model in progress',
            'name_pl' => 'model UX w toku']
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
