  <!-- Esta seccion del componente View, hace referencia al HTML-->
<template>
  <section>
    <navigation></navigation>
    <div class="abajoNavBar">
      <router-view></router-view>
    </div>
  </section>
</template>

  <!-- Esta seccion del componente View, hace referencia al JS-->
<script>
  //El script puede ser escrito como si se tratara de un fichero JS
  import navigation from '@/components/Navbar'

  //Luego exportamos el componente de navegacion para ser utilziado en el template
  export default {
    components: {
      navigation
    }
  }
</script>

  <!-- Esta seccion del componente View, hace referencia al CSS-->
<style>
.abajoNavBar
{
  padding-top: 3%
}
</style>
