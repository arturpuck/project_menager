<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PaymentStatus;

class CreatePaymentStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name',30)->unique();
            $table->string('name_pl',30)->unique();
            $table->engine = 'InnoDB';
        });

        PaymentStatus::insert([
            ['name' => 'awaits',
             'name_pl' => 'oczekuje'],
            ['name' => 'sent to client',
            'name_pl' => 'wysłano do klienta'],
            ['name' => 'to be issued',
            'name_pl' => 'do wystawienia'],
            ['name' => 'paid',
            'name_pl' => 'zapłacono']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_statuses');
    }
}
