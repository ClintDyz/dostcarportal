<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150);
            $table->string('abrv', 15)->nullable();
            $table->text('description')->nullable();
            $table->string('local_url', 255)->nullable();
            $table->string('public_url', 255)->nullable();
            $table->string('icon')->default('images/infosys.png');
            $table->enum('type', ['main', 'special-project', 'back-end', 'others']);
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
        Schema::drop('infosys');
    }
}
