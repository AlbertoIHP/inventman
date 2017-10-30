<template>
  <section>
<p>home works</p>
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
      return {
        hello: "hello",
        usuarioActual: ''
      }
    },
    methods:
    {

    }
  }
</script>




<style scoped>

</style>
