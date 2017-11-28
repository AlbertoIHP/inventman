<!-- Esta seccion del componente View, hace referencia al HTML-->
<template>
  <section>
    <v-app v-if="usuarioLogeado">
      <v-navigation-drawer
        temporary
        v-model="navInventario"
        light
        app
      >
        <v-toolbar flat class="transparent">
          <v-list class="pa-0">
            <v-list-tile>
              <v-list-tile-content>
                <v-text-field
                    name="input-1-3"
                    label="Buscar"
                    v-model="buscar"
                    single-line
                  ></v-text-field>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-btn icon ripple @click="buscartexto()">
                  <v-icon color="grey lighten-1">search</v-icon>
                </v-btn>
              </v-list-tile-action>
            </v-list-tile>
          </v-list>
        </v-toolbar>
        <v-list dense>
          <v-subheader inset>Categorias</v-subheader>
          <v-list-tile v-for="categoria in categorias" @click="buscarPor(categoria.name, categoria.id, 'categoria')">
            <v-list-tile-content>
              <v-list-tile-title>{{ categoria.name }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-subheader inset>Productos</v-subheader>
          <v-list-tile v-for="producto in productos" @click="buscarPor(producto.name, producto.id, 'tipo')">
            <v-list-tile-content>
              <v-list-tile-title>{{ producto.name }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>

      <v-navigation-drawer
        temporary
        v-model="navHome"
        light
        app
      >
        <v-list dense>
          <v-list-tile @click="ir('um')">
            <v-list-tile-action>
              <v-icon></v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Módulo de usuarios</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile @click="ir('im')">
            <v-list-tile-action>
              <v-icon></v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Módulo de inventario y pedidos</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile @click="ir('sm')">
            <v-list-tile-action>
              <v-icon></v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Módulo de Ventas</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-navigation-drawer>

      <v-toolbar color="grey" fixed app>
        <v-toolbar-side-icon v-if="isInventario" @click.stop="navInventario = !navInventario"></v-toolbar-side-icon>
        <v-toolbar-side-icon v-if="isHome" @click.stop="navHome = !navHome"></v-toolbar-side-icon>
        <v-toolbar-items class="hidden-sm-and-down">
          <v-btn flat @click="goHome()">Home</v-btn>
          <v-btn flat @click="goInventario()">Inventario</v-btn>
          <v-btn flat @click="goActividad()">Mi actividad</v-btn>
        </v-toolbar-items>
        <v-spacer></v-spacer>
        <v-menu offset-y>
          <v-btn icon dark slot="activator">
            <v-icon>
              more_vert
            </v-icon>
          </v-btn>
          <v-list>
            <v-list-tile>
              <v-list-tile-title>Editar perfil</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="cerrarSesion()">
              <v-list-tile-title>Cerrar sesion</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
        <v-toolbar-title></v-toolbar-title>
      </v-toolbar>
      <v-content>
        <router-view></router-view>
      </v-content>
      <v-footer color="grey" app>
        <span class="white--text">&copy; 2017</span>
      </v-footer>
    </v-app>
    <v-content v-else="usuarioLogeado">
      <router-view></router-view>
    </v-content>
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

      this.obtenerProductos();
    },
    data () {
      return {
        navInventario: false,
        navHome: false,
        isInventario: this.$route.path=='/inventario',
        isHome: this.$route.path=='/home',
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
