  <!-- Esta seccion del componente View, hace referencia al HTML-->
<template>
  <section>
    <md-toolbar>

      <md-button  @click="goHome()">Home</md-button>
      <md-button  @click="goInventario()">Inventario</md-button>
      <md-button  @click="goActividad()" >Mi Actividad</md-button>
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


  //Luego exportamos el componente de navegacion para ser utilziado en el template
  export default {
    components: {
    },
    methods: {
      goHome()
      {
        this.$router.push('/home')
      },
      goInventario()
      {
        this.$router.push('/inventario')
      },
      goActividad()
      {
        this.$router.push('/actividad')
      },
      cerrarSesion()
      {
        this.$router.push('/')
      }
    }
  }
</script>

  <!-- Esta seccion del componente View, hace referencia al CSS-->
<style>
</style>
