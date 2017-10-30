<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('products', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('description');
          $table->string('price');
          $table->string('cost');
          $table->string('code');
          $table->text('urlimage');

          $table->integer('providers_id')->unsigned()->nullable();
          $table->integer('productstypes_id')->unsigned()->nullable();
          $table->integer('productscategories_id')->unsigned()->nullable();

          $table->foreign('providers_id')->references('id')->on('providers')->onDelete('cascade');

          $table->foreign('productstypes_id')->references('id')->on('productstypes')->onDelete('cascade');

          $table->foreign('productscategories_id')->references('id')->on('productscategories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
