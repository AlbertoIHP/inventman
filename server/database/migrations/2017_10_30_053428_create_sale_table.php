<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sales', function (Blueprint $table) {
          $table->increments('id');
          $table->string('date');
          $table->string('description');
          $table->string('totalsale');
          $table->string('time');

          $table->integer('users_id')->unsigned()->nullable();
          $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

          $table->rememberToken();
          $table->timestamps();
          $table->timestamp('deleted_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
