<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inventaries', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('amount');

          $table->integer('locals_id')->unsigned()->nullable();
          $table->integer('products_id')->unsigned()->nullable();

          $table->foreign('locals_id')->references('id')->on('locals')->onDelete('cascade');

          $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');

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
        Schema::dropIfExists('inventaries');
    }
}
