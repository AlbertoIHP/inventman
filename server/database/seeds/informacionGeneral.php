<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class informacionGeneral extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

    DB::table('productscategories')->insert([
  	  'name' =>'Deporte',
  	]);
    DB::table('productscategories')->insert([
  	  'name' =>'Formal',
  	]);
    DB::table('productscategories')->insert([
  	  'name' =>'Casual',
  	]);
    DB::table('productscategories')->insert([
  	  'name' =>'Chaquetas',
  	]);
    DB::table('productscategories')->insert([
  	  'name' =>'Pantalones',
  	]);

	DB::table('cities')->insert([
	  'name' =>'Temuco',
	]);
	DB::table('cities')->insert([
	  'name' =>'Concepcion',
	]);
	DB::table('cities')->insert([
	  'name' =>'Santiago',
	]);
	DB::table('cities')->insert([
	  'name' =>'Puerto Montt',
	]);

	DB::table('cities')->insert([
	  'name' =>'Valparaiso',
	]);
	DB::table('cities')->insert([
	  'name' =>'La Serena',
	]);

	DB::table('userstypes')->insert([
	  'name' =>'Admin',
	  'description' => 'Usuario con acceso a toda la informacion',
	]);


	DB::table('userstypes')->insert([
	  'name' =>'Owner',
	  'description' => 'Usuario con acceso a toda la informacion de su tienda',
	]);


	DB::table('userstypes')->insert([
	  'name' =>'Seller',
	  'description' => 'Usuario con permisos de vendedor',
	]);


	DB::table('providers')->insert([
	  'name' =>'Nike',
	  'description' => 'Nike es una empresa deportiva...',
	]);


	DB::table('providers')->insert([
	  'name' =>'Adidas',
	  'description' => 'Adidas es una empresa deportiva...',
	]);



	DB::table('providers')->insert([
	  'name' =>'Reebok',
	  'description' => 'Reebok es una empresa deportiva...',
	]);



	DB::table('productstypes')->insert([
	  'name' =>'Zapatillas',
	  'description' => 'Las zapatillase se ponen en los pies',
	]);


	DB::table('products')->insert([
	  'name' =>'Nike Schock',
	  'description' => 'Zapatillas 100% algodon',
	  'providers_id' => 1,
	  'price' => '35000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
     'productscategories_id' => 1,
	  'code' => '2423423'
	]);

	DB::table('products')->insert([
	  'name' =>'Nike Air',
	  'description' => 'Zapatillas 20% algodon',
	  'providers_id' => 1,
	  'price' => '15000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	     'productscategories_id' => 1,
	  'code' => '123123'
	]);


	DB::table('products')->insert([
	  'name' =>'Nike Soft',
	  'description' => 'Zapatillas 50% algodon',
	  'providers_id' => 1,
	  'price' => '12764',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		     'productscategories_id' => 1,
	  'code' => '23434'
	]);


	DB::table('products')->insert([
	  'name' =>'Adidas 90',
	  'description' => 'Zapatillas 100% algodon',
	  'providers_id' => 2,
	  'price' => '35000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		     'productscategories_id' => 1,
	  'code' => '6456'
	]);


	DB::table('products')->insert([
	  'name' =>'Adidas Agresivas',
	  'description' => 'Zapatillas 40% algodon',
	  'providers_id' => 2,
	  'price' => '72888',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		     'productscategories_id' => 1,
	  'code' => '678545'
	]);


	DB::table('products')->insert([
	  'name' =>'Reebok Salvajes',
	  'description' => 'Zapatillas 100% algodon',
	  'providers_id' => 3,
	  'price' => '24000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		     'productscategories_id' => 1,
	  'code' => '78354'
	]);



	DB::table('products')->insert([
	  'name' =>'Reebok Asesinas',
	  'description' => 'Zapatillas 75% algodon',
	  'providers_id' => 3,
	  'price' => '12000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		     'productscategories_id' => 1,
	  'code' => 'df123'
	]);



	DB::table('locals')->insert([
	  'address' =>'Calle Montt 0253',
	  'name' => 'Ropa Glamour',
	  'city_id' => 1,
	]);


	DB::table('locals')->insert([
	  'address' =>'Calle Rodriguez 112',
	  'name' => 'Ropa Fashion',
	  'city_id' => 2,
	]);



	DB::table('requests')->insert([
	  'locals_id' => 1,
	  'providers_id' => 1,
	  'total' => 209000,
	]);

	DB::table('requests')->insert([
	  'locals_id' => 2,
	  'providers_id' => 2,
	  'total' => 209000,
	]);

	DB::table('requestsdetails')->insert([
	  'requests_id' => 1,
	  'products_id' => 1,
	  'amount' => 20,
	]);

	DB::table('requestsdetails')->insert([
	  'requests_id' => 1,
	  'products_id' => 2,
	  'amount' => 20,
	]);


	DB::table('requestsdetails')->insert([
	  'requests_id' => 1,
	  'products_id' => 3,
	  'amount' => 20,
	]);


	DB::table('requestsdetails')->insert([
	  'requests_id' => 2,
	  'products_id' => 1,
	  'amount' => 20,
	]);


	DB::table('requestsdetails')->insert([
	  'requests_id' => 2,
	  'products_id' => 3,
	  'amount' => 20,
	]);


	DB::table('inventariestypes')->insert([
	  'name' => 'Inventario de zapatillas',
	  'description' => 'Aqui se guardan zapatillas',
	]);





	DB::table('inventaries')->insert([
	  'locals_id' => 1,
	  'products_id' => 1,
	  'amount' => 20,
	  'inventariestypes_id' => 1,
	]);

	DB::table('inventaries')->insert([
	  'locals_id' => 1,
	  'products_id' => 2,
	  'amount' => 20,
	  'inventariestypes_id' => 1,
	]);

	DB::table('inventaries')->insert([
	  'locals_id' => 2,
	  'products_id' => 1,
	  'amount' => 20,
	  'inventariestypes_id' => 1,
	]);


	DB::table('inventaries')->insert([
	  'locals_id' => 2,
	  'products_id' => 2,
	  'amount' => 20,
	  'inventariestypes_id' => 1,
	]);

	DB::table('users')->insert([
	  'name' => 'Alberto Ignacio',
	  'lastname' => 'Herrera Poza',
	  'rut' => '19304736k',
	  'email' => 'a.herrera07@ufromail.cl',
	  'phone' => '81962000',
	  'password' => bcrypt('bebote34'),
	  'userstypes_id' => 1,
	  'local_id' => 1,
	  'confirmed' => 1,
	]);

	DB::table('sales')->insert([
	  'date' => Carbon::create('2017', '02', '01'),
	  'description' => 'Herrera Poza',
	  'users_id' => 1,
	  'totalsale' => '25000'
	]);

	DB::table('productssales')->insert([
	  'sales_id' => 1,
	  'products_id' => 1,
	  'amount' => '5',
	  'total' => '5000'
	]);





	}
}
