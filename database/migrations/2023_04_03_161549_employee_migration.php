<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee',function(Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('Department');
             $table->string('selfid');
            $table->string('Phone');
             $table->string('Email');
            $table->string('Office');
             $table->string('Road');
            $table->string('Status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
