<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('project_statuses');
            $table->date('should_be_finished_at');
            $table->string('company_addres',40);
            $table->string('company_name',40);
            $table->string('project_comment',1000)->nullable();
            $table->string('company_tax_identification_number',10);
            $table->string('client_contact_person_name', 40)->nullable();
            $table->string('client_email',40)->nullable();
            $table->string('client_phone_number',20)->nullable();
            $table->unsignedBigInteger('project_menager_id');
            $table->foreign('project_menager_id')->references('id')->on('users');
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')->references('id')->on('users');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
