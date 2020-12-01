<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Task;

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
            $table->string('name', 30)->unique();
            $table->engine = 'InnoDB';
        });

        Task::insert([
            ['name' => 'copywriting'],
            ['name' => 'development'],
            ['name' => 'UX consulting'],
            ['name' => 'UX mock_ups'],
            ['name' => 'PM'],
            ['name' => 'graphical projects'],
            ['name' => 'tech leadership'],
            ['name' => 'testing'],
            ['name' => 'creating specification'],
            ['name' => 'UI'],
            ['name' => 'implementation']
        ]);
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
