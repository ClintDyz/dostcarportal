<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_id', 10)->unique();
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('lastname', 50);
            $table->enum('gender', ['-', 'male', 'female']);
            $table->string('username', 20)->unique();
            $table->string('email')->unique();
            $table->string('phone_no', 20)->nullable();
            $table->string('password', 64);
            $table->string('position', 100);
            $table->integer('division');
            $table->integer('unit');
            $table->integer('role');
            $table->integer('group')->default(0);
            $table->string('avatar')->default('images/default-avatar.jpg');
            $table->string('signature')->nullable();
            $table->dateTime('last_login');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
