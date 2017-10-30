<template>
  <section>
    <md-tabs>
      <md-tab id="sales" md-label="Ventas">
          <sales></sales>
      </md-tab>
    </md-tabs>
  </section>
</template>


<script>
import sales from '@/components/Modules/Functionalities/sm/sales'
import prodsale from '@/components/Modules/Functionalities/sm/prodsale'
  export default {
    created(){
      if(localStorage.getItem('user'))
      {
      }
      else
      {
        this.$router.push('/')
      }
    },
    components: {
        sales,
        prodsale
    }
  }
</script>




<style scoped>

</style>
