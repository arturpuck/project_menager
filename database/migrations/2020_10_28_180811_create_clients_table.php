<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name_contact_person', 40)->nullable();
            $table->string('email',40)->nullable();
            $table->string('phone_number',30)->nullable();
            $table->string('company_name',40);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Client::insert([
            ['full_name_contact_person' => 'Rysiek z klanu',
            'email' => 'rysiek@klan.pl',
            'phone_number' => '0700880788',
            'company_name' => 'TVP S.A'],

            ['full_name_contact_person' => 'Rumcajs',
            'email' => 'rumcajs@interia.pl',
            'phone_number' => '663754724',
            'company_name' => 'Futra z norek',],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
