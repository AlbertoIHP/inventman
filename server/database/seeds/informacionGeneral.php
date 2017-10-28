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

  //Modulo Usuarios

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

    DB::table('functionalities')->insert([
  	  'name' =>'tipoproducto',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla productstypes'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'categoriaproducto',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla productscategories'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'proveedores',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla providers'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'productos',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla products'
  	]);
    DB::table('functionalities')->insert([
  	  'name' =>'ordenesdecompra',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla orders'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'inventarios',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla inventaries'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'ventas',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla sales'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'especificaciondeventas',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla productssales'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'ciudades',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla cities'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'localesdeventa',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla locals'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'usuarios',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla users'
  	]);

    DB::table('functionalities')->insert([
  	  'name' =>'tiposdeusuarios',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla userstypes'
  	]);


    DB::table('functionalities')->insert([
  	  'name' =>'permisosdecadafuncionalidad',
      'description' => 'Esta funcionalidad permite CRUD completo sobre la tabla permissions'
  	]);

    DB::table('locals')->insert([
  	  'address' =>'Calle Montt 0253',
  	  'name' => 'Tienda Glamour',
  	  'city_id' => 1,
  	]);


  	DB::table('locals')->insert([
  	  'address' =>'Calle Rodriguez 112',
  	  'name' => 'Tienda Fashion',
  	  'city_id' => 2,
  	]);

    DB::table('userstypes')->insert([
  	  'name' =>'Admin',
  	  'description' => 'Usuario con acceso a todas las funcionalidades',
  	]);


  	DB::table('userstypes')->insert([
  	  'name' =>'Owner',
  	  'description' => 'Usuario con acceso a toda la informacion de su tienda',
  	]);


  	DB::table('userstypes')->insert([
  	  'name' =>'Seller',
  	  'description' => 'Usuario con permisos de vendedor',
  	]);

  //Permisos para el ADMINISTRADOR (ID = 1)
    DB::table('permissions')->insert([
  	  'functionalities_id' => 1,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 2,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 3,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 4,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 5,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 6,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 7,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 8,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 9,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);


    DB::table('permissions')->insert([
  	  'functionalities_id' => 10,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);


    DB::table('permissions')->insert([
  	  'functionalities_id' => 11,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 12,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
  	]);

    DB::table('permissions')->insert([
  	  'functionalities_id' => 13,
  	  'userstypes_id' => 1,
        'write' => '1',
        'delete' => '1',
        'read'=> '1',
        'edit' => '1',
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




	//MODULO DE INVENTARIO Y PEDIDOS

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
	  'code' => '2423423',
	  'providers_id' => 1,
	  'urlimage' => 'https://images.footlocker.com/pi/66363006/zoom/nike-shox-nz-mens',
	]);

	DB::table('products')->insert([
	  'name' =>'Nike Air',
	  'description' => 'Zapatillas 20% algodon',
	  'providers_id' => 1,
	  'price' => '15000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	  'productscategories_id' => 1,
	  'code' => '123123',
	  'providers_id' => 1,
	  'urlimage' => 'https://images.nike.com/is/image/DotCom/PDP_HERO_M/599409_103_A_PREM/air-max-thea-womens-shoe.jpg',
	]);


	DB::table('products')->insert([
	  'name' =>'Nike Soft',
	  'description' => 'Zapatillas 50% algodon',
	  'providers_id' => 1,
	  'price' => '12764',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	 'productscategories_id' => 1,
	  'code' => '23434',
	  'providers_id' => 1,
	  'urlimage' => 'http://purchaze.com/pictures/nike-rosherun-soft-grey-midnight-fog-birch-total-crimson-511811-096.jpg',
	]);


	DB::table('products')->insert([
	  'name' =>'Nike  90',
	  'description' => 'Zapatillas 100% algodon',
	  'providers_id' => 2,
	  'price' => '35000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	 'productscategories_id' => 1,
	  'code' => '6456',
	  'providers_id' => 1,
	  'urlimage' => 'http://e00-marca.uecdn.es/assets/multimedia/imagenes/2017/05/04/14938528302704.jpg',
	]);


	DB::table('products')->insert([
	  'name' =>'Adidas Agresivas',
	  'description' => 'Zapatillas 40% algodon',
	  'providers_id' => 2,
	  'price' => '72888',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	  'productscategories_id' => 1,
	  'code' => '678545',
	  'providers_id' => 1,
	  'urlimage' => 'http://www.adidas.cl/dis/dw/image/v2/aaqx_prd/on/demandware.static/-/Sites-adidas-products/default/dw88ddd2b8/zoom/BY2301_01_standard.jpg?sw=2000',
	]);


	DB::table('products')->insert([
	  'name' =>'Reebok Salvajes',
	  'description' => 'Zapatillas 100% algodon',
	  'providers_id' => 3,
	  'price' => '24000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
		'productscategories_id' => 1,
	  'code' => '78354',
	  'providers_id' => 1,
	  'urlimage' => 'http://www.barlaroca.es/images/pic/YVgJsXU5-469.jpg',
	]);



	DB::table('products')->insert([
	  'name' =>'Reebok Asesinas',
	  'description' => 'Zapatillas 75% algodon',
	  'providers_id' => 3,
	  'price' => '12000',
	  'cost' => '15000',
	  'productstypes_id' => 1,
	  'productscategories_id' => 1,
	  'code' => 'df123',
	  'providers_id' => 1,
	  'urlimage' => 'http://www.reebokclassicnylon.es/images/large/reebokclassicnylon/Zapatillas%20Deportivas%20-%20Reebok%20Cross%20317_1_LRG.jpg',
	]);

	DB::table('inventaries')->insert([
	  'locals_id' => 1,
	  'products_id' => 1,
	  'amount' => 20,
	]);

	DB::table('inventaries')->insert([
	  'locals_id' => 1,
	  'products_id' => 2,
	  'amount' => 20,
	]);

	DB::table('inventaries')->insert([
	  'locals_id' => 2,
	  'products_id' => 1,
	  'amount' => 20,
	]);


	DB::table('inventaries')->insert([
	  'locals_id' => 2,
	  'products_id' => 2,
	  'amount' => 20,
	]);

	DB::table('orders')->insert([
	  'users_id' => 1,
	  'products_id' => 1,
	  'amount' => 20,
		'time' => '11:55 AM',
		'date' =>'24/10/1996'
	]);



	// MODULO DE VENTAS

	DB::table('sales')->insert([
	  'date' => Carbon::create('2017', '02', '01'),
	  'description' => 'Venta de muchas cosas',
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
