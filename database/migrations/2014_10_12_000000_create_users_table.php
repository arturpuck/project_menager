<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('email',30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('full_name',30);
            $table->string('phone_number',20);
            $table->unsignedFloat('rate_per_hour_set_by_deal');
            $table->unsignedFloat('real_rate_per_hour');
            $table->unsignedFloat('rate_per_month')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('note',1000)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        User::insert([[
           'login' => 'test_admin',
           'password' => Hash::make('ts)8lJO55jSL&vx(o*Vs%D4E'),
           'email' => 'admin@imaggo.pl',
           'full_name' => 'Czesław Kowalski', 
           'rate_per_hour_set_by_deal' => 15, 
           'real_rate_per_hour' => 20,
           'rate_per_month' => 3000, 
           'phone_number' => '0700880788',
           'email' => 'czesiu@wp.pl', 
           'role_id' => 1, 
           'note' => 'niezła kosa',
        ],
        [
            'login' => 'team_member',
            'password' => Hash::make('teammember'),
            'email' => 'jozek@imaggo.pl',
            'full_name' => 'Józef Wolski', 
            'rate_per_hour_set_by_deal' => 20, 
            'real_rate_per_hour' => 25,
            'rate_per_month' => 2700, 
            'phone_number' => '691955390',
            'email' => 'jozef@wp.pl', 
            'role_id' => 4, 
            'note' => 'bardzo miły pan',  
        ],
        [
            'login' => 'project_menager',
            'password' => Hash::make('projectmenager'),
            'email' => 'rysio@imaggo.pl',
            'full_name' => 'Rysio Wolski', 
            'rate_per_hour_set_by_deal' => 35, 
            'real_rate_per_hour' => 40, 
            'rate_per_month' => 4700,
            'phone_number' => '603601870',
            'email' => 'rysio@wp.pl', 
            'role_id' => 2, 
            'note' => 'Rysio z klanu',  
        ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
