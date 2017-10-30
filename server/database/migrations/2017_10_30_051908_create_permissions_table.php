<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('permissions', function (Blueprint $table) {
          $table->increments('id');
          $table->string('write');
          $table->string('erase');
          $table->string('read');
          $table->string('edit');

          $table->integer('functionalities_id')->unsigned()->nullable();
          $table->integer('userstypes_id')->unsigned()->nullable();

          $table->foreign('functionalities_id')->references('id')->on('functionalities')->onDelete('cascade');

          $table->foreign('userstypes_id')->references('id')->on('userstypes')->onDelete('cascade');

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
      Schema::dropIfExists('permissions');
    }
}
