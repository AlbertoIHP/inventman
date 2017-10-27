  <!-- Esta seccion del componente View, hace referencia al HTML-->
<template>
  <section>
    <md-sidenav class="md-left" ref="leftSidenav" @open="open('Left')" @close="close('Left')">
      <md-toolbar >
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

    <md-toolbar>
      <md-button  v-if="isInventario" class="md-icon-button" @click="toggleLeftSidenav">
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


    <router-view></router-view>





  </section>
</template>

  <!-- Esta seccion del componente View, hace referencia al JS-->
<script>
  //El script puede ser escrito como si se tratara de un fichero JS
  import {ApiConnect } from '@/services'
  const servicioProducto = new ApiConnect('productTypes')
  const servicioCategoria = new ApiConnect('productCategories')
  //Luego exportamos el componente de navegacion para ser utilziado en el template
  export default {

    data () {
      return {
        isInventario: false,
        categorias: [],
        productos: [],
        buscar: ""
      }
    },
    components: {
    },
    methods: {
      goHome()
      {
        this.$router.push('/home')
        this.isInventario = false
      },
      goInventario()
      {
        this.$router.push('/inventario')
        this.isInventario = true
      },
      goActividad()
      {
        this.$router.push('/actividad')
        this.isInventario = false
      },
      cerrarSesion()
      {
        this.$router.push('/')
        this.isInventario = false;
      },
      toggleLeftSidenav() {
        this.$refs.leftSidenav.toggle();
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
        })
      },
      buscartexto()
      {
        if(this.buscar === "")
        {
          localStorage.clear('buscarPor')
        }
        else
        {
          localStorage.setItem('buscarPor', this.buscar)
        }

        this.$emit("buscar")
      }
    },
    mounted ()
    {
      this.obtenerProductos();
      this.obtenerCategorias();
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
</style>
