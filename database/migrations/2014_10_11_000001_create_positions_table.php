<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Position;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
            $table->string('name_pl',30)->unique();
        });

        Position::insert([
            ['name' => 'project menager',
             'name_pl' => 'menadżer projektów'],
            ['name' => 'account',
            'name_pl' => 'specjalista do spraw klientów'],
            ['name' => 'graphic artist',
            'name_pl' => 'artysta grafik'],
            ['name' => 'developer',
            'name_pl' => 'koder'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_positions');
    }
}
