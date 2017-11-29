<template>
  <section>
    <v-tabs v-model="active">
      <v-tabs-bar class="grey">
        <v-tabs-slider></v-tabs-slider>
        <v-tabs-item
          :key="inv"
          :href="'#tab-inv'"
        >
          Inventarios
        </v-tabs-item>
        <v-tabs-item
          :key="ord"
          :href="'#tab-ord'"
        >
          Ordenes de compra
        </v-tabs-item>
        <v-tabs-item
          :key="prod"
          :href="'#tab-prod'"
        >
          Productos
        </v-tabs-item>
        <v-tabs-item
          :key="pt"
          :href="'#tab-pt'"
        >
          Tipos de productos
        </v-tabs-item>
        <v-tabs-item
          :key="pc"
          :href="'#tab-pc'"
        >
          Categorias de productos
        </v-tabs-item>
        <v-tabs-item
          :key="prov"
          :href="'#tab-prov'"
        >
          Proveedores
        </v-tabs-item>
      </v-tabs-bar>
      <v-tabs-items>
        <v-tabs-content
          :key="inv"
          :id="'tab-inv'"
        >
        <inv></inv>
        </v-tabs-content>
        <v-tabs-content
          :key="ord"
          :id="'tab-ord'"
        >
        <ord></ord>
        </v-tabs-content>
        <v-tabs-content
          :key="prod"
          :id="'tab-prod'"
        >
        <prod></prod>
        </v-tabs-content>
        <v-tabs-content
          :key="pt"
          :id="'tab-pt'"
        >
        <pt></pt>
        </v-tabs-content>
        <v-tabs-content
          :key="pc"
          :id="'tab-pc'"
        >
        <pc></pc>
        </v-tabs-content>
        <v-tabs-content
          :key="prov"
          :id="'tab-prov'"
        >
        <prov></prov>
        </v-tabs-content>
      </v-tabs-items>
    </v-tabs>
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
