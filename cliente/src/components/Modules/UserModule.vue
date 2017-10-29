<template>
  <section>
    <md-tabs>

      <md-tab id="tu" md-label="Tipos de Usuario">
        <tu></tu>
      </md-tab>

      <md-tab id="u" md-label="Usuarios">
        <us></us>
      </md-tab>

      <md-tab id="lv" md-label="Locales de Venta">
        <lv></lv>
      </md-tab>

      <md-tab id="c" md-label="Ciudades">
        <c></c>
      </md-tab>

    </md-tabs>
  </section>
</template>


<script>
import pu from '@/components/Modules/Functionalities/um/pu'
import tu from '@/components/Modules/Functionalities/um/tu'
import us from '@/components/Modules/Functionalities/um/u'
import lv from '@/components/Modules/Functionalities/um/lv'
import c from '@/components/Modules/Functionalities/um/c'
  export default {
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

</style>
