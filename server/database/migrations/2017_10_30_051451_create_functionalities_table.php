<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
         {
             Schema::create('functionalities', function (Blueprint $table) {
                 $table->increments('id');
                 $table->string('name');
              	$table->text('description');
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
      Schema::dropIfExists('functionalities');
    }
}
