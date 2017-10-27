<?php

use Illuminate\Support\Facades\Schema;
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


		Schema::table('users', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();
			$table->boolean('confirmed')->default(0);
			$table->string('confirmation_code')->nullable();

		});

    Schema::table('productscategories', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});
		Schema::table('userstypes', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});

		Schema::table('locals', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});

		Schema::table('requests', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('providers', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});




		Schema::table('products', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('requestsdetails', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});



		Schema::table('inventaries', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('cities', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('inventariestypes', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('pics', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('productstypes', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});


		Schema::table('sales', function (Blueprint $table) {
			$table->rememberToken();
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();

		});



		Schema::table('productssales', function (Blueprint $table) {
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
		Schema::dropIfExists('users');
	}
}
