<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ProjectReportStatus;

class CreateProjectReportStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_report_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
        });

        ProjectReportStatus::insert([
            ['name' => 'in progress'],
            ['name' => 'awaits to be accepted'],
            ['name' => 'finished'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_report_statuses');
    }
}
