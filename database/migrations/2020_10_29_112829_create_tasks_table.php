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
            $table->string('name', 50)->unique();
            $table->string('name_pl', 50)->unique();
            $table->engine = 'InnoDB';
        });

        Task::insert([
            ['name' => 'copywriting',
             'name_pl' => 'teksty na potrzeby marketingu'],
            ['name' => 'development',
              'name_pl' => 'rozbudowa',
            ],
            ['name' => 'UX consulting',
             'name_pl' => 'konsultacje UX'
            ],
            ['name' => 'UX mock ups',
            'name_pl' => 'makiety UX'
            ],
            ['name' => 'PM',
             'name_pl' => 'zarządzanie projektem'
            ],
            ['name' => 'graphical projects',
            'name_pl' => 'projekty graficzne'],
            ['name' => 'tech leadership',
            'name_pl' => 'przywództwo technologiczne'
            ],
            ['name' => 'testing',
            'name_pl' => 'testy'
            ],
            ['name' => 'creating specification',
            'name_pl' => 'tworzenie specyfikacji'],
            ['name' => 'UI',
            'name_pl' => 'interface użytkownika'],
            ['name' => 'implementation',
            'name_pl' => 'implementacja']
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
