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
            $table->string('comment')->nullable();
            $table->date('finished_at');
            $table->string('invoice_company_addres',40);
            $table->string('invoice_company_name',40);
            $table->string('project_comment',1000)->nullable();
            $table->unsignedBigInteger('invoice_tax_identification_number');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('full_name_contact_person', 40)->nullable();
            $table->string('contact_person_email',40)->nullable();
            $table->string('contact_person_phone_number',30)->nullable();
            $table->unsignedBigInteger('project_manager_id');
            $table->foreign('project_manager_id')->references('id')->on('employees');
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
