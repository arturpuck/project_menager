<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            $table->string('name_pl',30);
        });

        Role::insert([
            ['name' => 'administrator',
             'name_pl' => 'administrator'],
            ['name' => 'project menager',
            'name_pl' => 'menadżer projektów'],
            ['name' => 'account',
             'name_pl' => 'specjalista do spraw klientów'],
            ['name' => 'team member',
            'name_pl' => 'członek zespołu'] 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
}
