<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateUserHasPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_position', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->timestamps();
        });

        $user = User::find(1);
        $user->positions()->sync([4]);

        $user = User::find(2);
        $user->positions()->sync([1,4]);

        $user = User::find(3);
        $user->positions()->sync([2,3]);

        $employee = User::find(1);
        $employee->skills()->sync([1,2,3,4]);
        $employee = User::find(2);
        $employee->skills()->sync([8,10,11]);
        $employee = User::find(2);
        $employee->skills()->sync([1,2,3,4,5,6,7]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_position');
    }
}
