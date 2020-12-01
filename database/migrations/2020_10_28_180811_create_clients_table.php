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
            $table->string('name',40);
            $table->string('contact_phone_number',20);
            $table->string('email',40);
            $table->string('address',40);
            $table->string('tax_identification_number',10);
            $table->string('contact_person_name',40);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Client::insert([
            ['name' => 'TVP S.A',
            'contact_phone_number' => '0700880788',
            'email' => 'tvp@wp.pl',
            'address' => 'woronicza 13a/5',
            'tax_identification_number' => '33567',
            'contact_person_name' => 'Henryk Kowalski'],

            ['name' => 'Kiełbaski z podlasia',
            'contact_phone_number' => '682456900',
            'email' => 'kiełbaski@salcesonik.pl',
            'address' => 'maślana 50b',
            'tax_identification_number' => '67800',
            'contact_person_name' => 'Piotruś Pączuś'],
            
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
