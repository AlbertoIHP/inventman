<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Ciudades</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Nombre </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="city in cities" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(city, 'editCity')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(city)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ city.name }}
            </md-table-cell>
          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="cities.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>

    <md-button  class="md-fab md-fab-bottom-right" id="addCity" @click="openDialog('addCity')">
      <md-icon>add</md-icon>
    </md-button>

    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="addCity">
      <md-dialog-title>Detalles producto</md-dialog-title>

      <md-dialog-content>
          <md-input-container>
            <label>Nombre de la Ciudad</label>
            <md-input type="text"  v-model="newCity.name"></md-input>
          </md-input-container>


      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addCity')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarCiudad('addCity')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editCity">
      <md-dialog-title>Detalles producto</md-dialog-title>

      <md-dialog-content>
          <md-input-container>
            <label>Nombre de la Ciudad</label>
            <md-input type="text"  v-model="editCity.name"></md-input>
          </md-input-container>


      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editCity')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarCiudad('editCity')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>
  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioCity = new ApiConnect('cities')
  import axios from 'axios';
  export default {
    created(){
      this.obtenerCiudades()
    },
    data () {
      return {
        cities: [],
        newCity: {id: 0, name: ""},
        editCity: {id: 0, name: ""}
      }
    },
    methods: {
      obtenerCiudades()
      {
        servicioCity.query().then( data => {
          this.cities = data.body.data
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarCiudad(ref)
      {
        servicioCity.save(this.newCity).then(data => {
          this.newCity.name = ""
          this.obtenerCiudades()
          console.log(data)
          this.$refs[ref].close();
        })
      },
      borrar(ciudad)
      {
        axios.delete(servicioCity.getEndpoint()+'/'+JSON.stringify(ciudad.id))
        .then(response => {
          console.log(response)
          this.obtenerCiudades()
        })
      },
      editar(ciudad, ref)
      {
        this.editCity = JSON.parse(JSON.stringify(ciudad));
        this.$refs[ref].open();
      },
      editarCiudad(ref)
      {

        axios.put(servicioCity.getEndpoint()+'/'+JSON.stringify(this.editCity.id), this.editCity).then(data => {
          console.log(data)
          this.obtenerCiudades()
          this.$refs[ref].close();
        })
      }
    }
  }
</script>




<style scoped>

</style>
