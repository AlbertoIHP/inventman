<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('lastname');
          $table->string('rut');
          $table->string('email');
          $table->string('phone');
          $table->string('password');

          $table->integer('local_id')->unsigned()->nullable();
          $table->integer('userstypes_id')->unsigned()->nullable();

          $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');

          $table->foreign('userstypes_id')->references('id')->on('userstypes')->onDelete('cascade');


            $table->rememberToken();
    			$table->timestamps();
    			$table->timestamp('deleted_at')->nullable();
    			$table->boolean('confirmed')->default(0);
    			$table->string('confirmation_code')->nullable();
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
