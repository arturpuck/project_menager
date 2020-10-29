<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employee;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',30);
            $table->string('status',20);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Employee::insert([
            ['full_name' => 'Czesław Kowalski', 'status' => 'developer'],
            ['full_name' => 'Mikołaj Fasolski','status' => 'developer'],
            ['full_name' => 'Marian Kowalski','status' => 'project menager'],
            ['full_name' => 'Mariusz Gąsiorowski','status' => 'project menager']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
