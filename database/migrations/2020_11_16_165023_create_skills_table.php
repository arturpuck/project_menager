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
            $table->string('name',30);
        });

        Skill::insert([
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JS'],
            ['name' => 'Vue'],
            ['name' => 'React'],
            ['name' => 'Angular'],
            ['name' => 'Sass'],
            ['name' => 'PHP'],
            ['name' => 'Symfony'],
            ['name' => 'Laravel'],
            ['name' => 'MySQL'],
            ['name' => 'Wordpress'],
            ['name' => 'Woo'],
            ['name' => 'PhotoShop'],
            ['name' => 'UI/UX'],
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
        Schema::dropIfExists('skills');
    }
}
