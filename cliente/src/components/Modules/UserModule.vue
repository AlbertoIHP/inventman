<template>
  <section>
    <v-tabs v-model="active">
      <v-tabs-bar class="grey">
        <v-tabs-slider></v-tabs-slider>
        <v-tabs-item
          :key="tu"
          :href="'#tab-tu'"
        >
          Tipos de Usuario
        </v-tabs-item>
        <v-tabs-item
          :key="u"
          :href="'#tab-u'"
        >
          Usuarios
        </v-tabs-item>
        <v-tabs-item
          :key="lv"
          :href="'#tab-lv'"
        >
          Locales de Venta
        </v-tabs-item>
        <v-tabs-item
          :key="c"
          :href="'#tab-c'"
        >
          Tipos de Usuario
        </v-tabs-item>
      </v-tabs-bar>
      <v-tabs-items>
        <v-tabs-content
          :key="tu"
          :id="'tab-tu'"
        >
        <tu></tu>
        </v-tabs-content>
        <v-tabs-content
          :key="u"
          :id="'tab-u'"
        >
        <u></u>
        </v-tabs-content>
        <v-tabs-content
          :key="lv"
          :id="'tab-lv'"
        >
        <lv></lv>
        </v-tabs-content>
        <v-tabs-content
          :key="c"
          :id="'tab-c'"
        >
        <c></c>
        </v-tabs-content>
      </v-tabs-items>
    </v-tabs>
      
  </section>
</template>


<script>
import pu from '@/components/Modules/Functionalities/um/pu'
import tu from '@/components/Modules/Functionalities/um/tu'
import us from '@/components/Modules/Functionalities/um/u'
import lv from '@/components/Modules/Functionalities/um/lv'
import c from '@/components/Modules/Functionalities/um/c'
  export default {
    created(){
      if( localStorage.getItem('user'))
      {
      }
      else
      {
        this.$router.push('/')
      }
    },
    components: {
        pu,
        tu,
        us,
        lv,
        c
    }
  }
</script>




<style scoped>
  .v-tabs {
    color:white !important;
  }
</style>
