<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Skill;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name',40)->unique();
            $table->string('name_pl',40)->unique();
        });

        Skill::insert([
            ['name' => 'HTML',
            'name_pl' => 'HTML'],
            ['name' => 'CSS',
            'name_pl' => 'CSS'],
            ['name' => 'JS',
            'name_pl' => 'JS'],
            ['name' => 'Vue',
            'name_pl' => 'Vue'],
            ['name' => 'React',
            'name_pl' => 'React'],
            ['name' => 'Angular',
            'name_pl' => 'Angular'],
            ['name' => 'Sass',
            'name_pl' => 'Sass'],
            ['name' => 'PHP',
            'name_pl' => 'PHP'],
            ['name' => 'Symfony',
            'name_pl' => 'Symfony'],
            ['name' => 'Laravel',
            'name_pl' => 'Laravel'],
            ['name' => 'MySQL',
            'name_pl' => 'MySQL'],
            ['name' => 'Wordpress',
            'name_pl' => 'Wordpress'],
            ['name' => 'WooCommerce',
            'name_pl' => 'WooCommerce'],
            ['name' => 'PhotoShop',
            'name_pl' => 'PhotoShop'],
            ['name' => 'UI/UX',
            'name_pl' => 'interface/doświadczenia użytkownika'],
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
        Schema::dropIfExists('skills');
    }
}
