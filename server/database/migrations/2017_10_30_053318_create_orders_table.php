<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {
          $table->increments('id');
          $table->string('time');
          $table->string('date');
          $table->string('amount');
          $table->string('total');

          $table->integer('products_id')->unsigned()->nullable();
          $table->integer('users_id')->unsigned()->nullable();

          $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');

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
      Schema::dropIfExists('orders');
    }
}
