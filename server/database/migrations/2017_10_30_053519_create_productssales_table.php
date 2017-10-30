<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductssalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productssales', function (Blueprint $table) {
          $table->increments('id');
          $table->string('amount');
          $table->string('total');

          $table->integer('products_id')->unsigned()->nullable();
          $table->integer('sales_id')->unsigned()->nullable();

          $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');

          $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');

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
        Schema::dropIfExists('productssales');
    }
}
