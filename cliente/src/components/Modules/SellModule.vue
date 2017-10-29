<template>
  <section>
    <md-tabs>
      <md-tab id="sales" md-label="Ventas">
          <sales></sales>
      </md-tab>

      <md-tab id="prodsale" md-label="Detalles de venta">
       <prodsale></prodsale>
      </md-tab>

    </md-tabs>
  </section>
</template>


<script>
import sales from '@/components/Modules/Functionalities/sm/sales'
import prodsale from '@/components/Modules/Functionalities/sm/prodsale'
  export default {
    components: {
        sales,
        prodsale
    }
  }
</script>




<style scoped>

</style>
