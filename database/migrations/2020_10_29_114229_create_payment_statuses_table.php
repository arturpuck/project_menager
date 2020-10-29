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
            $table->string('name')->unique();
            $table->engine = 'InnoDB';
        });

        PaymentStatus::insert([
            ['name' => 'awaits'],
            ['name' => 'sent_to_client'],
            ['name' => 'to_be_issued'],
            ['name' => 'paid']
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
