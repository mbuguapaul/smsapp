<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smses', function(Blueprint $table){
                $table->increments('id');
                $table->string('sms_body', 240);
                $table->integer('contact_id');
                $table->smallInteger('status');
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
        Schema:;drop('smses');
    }
}
