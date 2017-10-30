<template>
  <section>
    <md-tabs>
      <md-tab id="inv" md-label="Inventarios">
          <inv></inv>
      </md-tab>

      <md-tab id="ord" md-label="Ordenes de Compra">
        <ord></ord>
      </md-tab>

      <md-tab id="prod" md-label="Productos">
        <prod></prod>
      </md-tab>

      <md-tab id="pt" md-label="Tipos de Producto">
        <pt></pt>
      </md-tab>

      <md-tab id="pc" md-label="Categorias de Producto">
        <pc></pc>
      </md-tab>

      <md-tab id="prov" md-label="Proveedores">
        <prov></prov>
      </md-tab>

    </md-tabs>
  </section>
</template>


<script>
import inv from '@/components/Modules/Functionalities/im/inv'
import ord from '@/components/Modules/Functionalities/im/ord'
import pc from '@/components/Modules/Functionalities/im/pc'
import prod from '@/components/Modules/Functionalities/im/prod'
import prov from '@/components/Modules/Functionalities/im/prov'
import pt from '@/components/Modules/Functionalities/im/pt'
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
      inv,
      ord,
      pc,
      prod,
      prov,
      pt
    }
  }
</script>




<style scoped>

</style>
