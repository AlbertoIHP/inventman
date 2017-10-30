  <!-- Esta seccion del componente View, hace referencia al HTML-->
<template>
  <section>
    <md-sidenav class="md-left" ref="inventaryMenu" @open="open('Left')" @close="close('Left')" >
      <md-toolbar style="background-color: grey">
        <div class="md-toolbar-container">
            <md-layout md-gutter>
              <md-layout md-flex="80">
                <md-input-container >
                  <md-input v-model="buscar" ></md-input>
                </md-input-container>
              </md-layout>
              <md-layout>
                <md-button class="md-icon-button md-raised" @click="buscartexto()">
                  <md-icon>search</md-icon>
                </md-button>
              </md-layout>
            </md-layout>
        </div>
      </md-toolbar>
      <md-button class="botonSinBordes" style="text-align: left" disabled>Categorias</md-button>
      <div class="row" v-for="categoria in categorias">
        <div class="col s12">
          <md-button class="botonSinBordes" @click="buscarPor(categoria.name, categoria.id, 'categoria')">{{categoria.name}}</md-button>
        </div>
      </div>

      <md-button class="botonSinBordes" style="text-align: left" disabled>Productos</md-button>
      <div class="row" v-for="producto in productos">
        <div class="col s12">
          <md-button class="botonSinBordes" @click="buscarPor(producto.name, producto.id, 'tipo')">{{producto.name}}</md-button>
        </div>
      </div>

    </md-sidenav>


    <template v-if="usuarioLogeado">


    <md-sidenav class="md-left" ref="homeMenu" @open="open('Left')" @close="close('Left')">
            <md-button class="botonSinBordes" @click="ir('um')"  style="text-align: left" >Modulo de Usuarios</md-button>
            <md-button class="botonSinBordes" @click="ir('im')" style="text-align: left" >Modulo de Inventario y Pedidos</md-button>
            <md-button class="botonSinBordes" @click="ir('sm')" style="text-align: left" >Modulo de Ventas</md-button>
    </md-sidenav>





    <md-toolbar class="fixedToolbar"style="background-color: grey">
      <md-button  v-if="isInventario" class="md-icon-button" @click="openSideNav('inventary')">
        <md-icon>menu</md-icon>
      </md-button>
      <md-button  v-if="isHome" class="md-icon-button" @click="openSideNav('home')">
        <md-icon>menu</md-icon>
      </md-button>

      <md-button-toggle md-single style="heigth: 100%">
        <md-button  @click="goHome()" style="color: white">Home</md-button>
        <md-button  @click="goInventario()" style="color: white">Inventario</md-button>
        <md-button  @click="goActividad()" style="color: white">Mi Actividad</md-button>
      </md-button-toggle>
      <p style="flex: 1"></p>
      <md-menu >

        <md-button class="md-icon-button" md-menu-trigger>
          <md-icon>more_vert</md-icon>
        </md-button>

        <md-menu-content>
          <md-menu-item>Editar Perfil</md-menu-item>
          <md-menu-item @click="cerrarSesion()">Cerrar Sesion</md-menu-item>
        </md-menu-content>
      </md-menu>
    </md-toolbar>
</template>

    <router-view class="contenidoBajoToolbar"></router-view>





  </section>
</template>

  <!-- Esta seccion del componente View, hace referencia al JS-->
<script>
  //El script puede ser escrito como si se tratara de un fichero JS
  import {ApiConnect } from '@/services'
  const servicioProducto = new ApiConnect('productTypes')
  const servicioCategoria = new ApiConnect('productCategories')
  import { LocalStorageCredentialsService }  from '@/services'



  //Luego exportamos el componente de navegacion para ser utilziado en el template
  export default {
    created()
    {

      this.$root.$on('inicioSesion', ()=>{
        console.log("Alguien inicio sesion")
        this.usuarioLogeado = true
        this.isHome = true
        this.obtenerProductos();
      })
    },
    data () {
      return {
        isInventario: false,
        isHome: true,
        categorias: [],
        productos: [],
        buscar: "",
        usuarioLogeado: localStorage.getItem('user'),
        credentialService: new LocalStorageCredentialsService()
      }
    },
    components: {
    },
    methods: {
      goHome()
      {
        this.$router.push('/home')
        this.isInventario = false
        this.isHome = true
      },
      ir(lugar)
      {
        if(lugar === 'um')
        {
          this.$router.push('/home/um')
        }
        else if(lugar === 'im')
        {
          this.$router.push('/home/im')
        }
        else if( lugar === 'sm')
        {
          this.$router.push('/home/sm')
        }

      },
      goInventario()
      {
        localStorage.setItem('buscarPor', this.buscar)
        this.$router.push('/inventario')
        this.isInventario = true
        this.isHome =false
      },
      goActividad()
      {
        this.$router.push('/actividad')
        this.isInventario = false
        this.isHome = false
      },
      cerrarSesion()
      {
        this.$router.push('/')
        this.isInventario = false
        this.isHome = false
        this.usuarioLogeado = false
        this.credentialService.clearCredentials()
      },
      openSideNav(reference) {
        if(reference === 'inventary')
        {
          this.$refs.inventaryMenu.toggle();
        }
        else if(reference === 'home')
        {
          this.$refs.homeMenu.toggle();
        }

      },
      open(ref) {
        console.log('Opened: ' + ref);
      },
      close(ref) {
        console.log('Closed: ' + ref);
      },
      buscarPor(nombre, id, tipo)
      {
        var objeto = {nombre: nombre, id: id, tipo: tipo}
        localStorage.setItem('buscarPor', JSON.stringify(objeto))
        this.$emit("buscar")
      },
      obtenerCategorias()
      {
        servicioCategoria.query().then(data => {
          this.categorias = data.body.data;
        })
      },
      obtenerProductos()
      {
        servicioProducto.query().then(data => {
          this.productos = data.body.data;
          this.obtenerCategorias()
        })
      },
      buscartexto()
      {

          localStorage.setItem('buscarPor', this.buscar)

        this.$emit("buscar")
      }
    }
  }
</script>

  <!-- Esta seccion del componente View, hace referencia al CSS-->
<style>
.botonSinBordes
{
  margin-top: 0%;
  margin-left: 0%;
  margin-right: 0%;
  margin-bottom: 0%;
  width: 100%;
  background-color: white;
}

.fixedToolbar
{
  background-color: grey;
  position: fixed;
  width: 100%;
  margin-top: -0.4%;
  z-index: 9;
}

.contenidoBajoToolbar
{
  padding-top: 57px
}
</style>
