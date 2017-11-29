<template>
  <section>
    <v-tabs v-model="active">
      <v-tabs-bar class="grey">
        <v-tabs-slider></v-tabs-slider>
        <v-tabs-item
          :key="sales"
          :href="'#tab-sales'"
        >
          Ventas
        </v-tabs-item>
      </v-tabs-bar>
      <v-tabs-items>
        <v-tabs-content
          :key="sales"
          :id="'tab-sales'"
        >
        <sales></sales>
        </v-tabs-content>
      </v-tabs-items>
    </v-tabs>
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
