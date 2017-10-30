<template>
  <section>
    <p>Actividad works!</p>
  </section>
</template>


<script>
  export default {
    created()
    {
      if( (this.usuarioActual = localStorage.getItem('user')))
      {
      }
      else
      {
        this.$router.push('/')
      }
    },
    data(){
      return{
          usuarioActual : ''
      }
    },
    methods:
    {

    }
  }
</script>




<style scoped>

</style>
