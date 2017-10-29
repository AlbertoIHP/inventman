<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Locales o Puntos de Venta</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Nombre </md-table-head>
            <md-table-head>Direccion </md-table-head>
            <md-table-head>Ciudad </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="local in locales" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(local, 'editLocal')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(local)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ local.name }}
            </md-table-cell>

            <md-table-cell>
              {{ local.address }}
            </md-table-cell>

            <md-table-cell>
              {{ local.city_id }}
            </md-table-cell>

          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="locales.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>




    <md-button  class="md-fab md-fab-bottom-right" id="addLocal" @click="openDialog('addLocal')">
      <md-icon>add</md-icon>
    </md-button>




    <md-dialog md-open-from="#addLocal" md-close-to="#addLocal" ref="addLocal">
      <md-dialog-title>Agregar nuevo Punto de Venta</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre de la Ciudad</label>
          <md-input type="text"  v-model="newLocal.name"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Direccion de la Ciudad</label>
          <md-input type="text"  v-model="newLocal.address"></md-input>
        </md-input-container>

        <md-input-container>
          <label for="movie">Ciudad del Local</label>
          <md-select name="movie" id="movie" v-model="newLocal.city_id">
            <md-option v-for="city in ciudades" v-bind:value="city.id" >{{city.name}}</md-option>
          </md-select>
        </md-input-container>
      </md-dialog-content>



      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addLocal')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarLocal('addLocal')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>






    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editLocal">
      <md-dialog-title>Edicion de Local</md-dialog-title>

      <md-dialog-content>
          <md-input-container>
            <label>Nombre del Local</label>
            <md-input type="text"  v-model="editLocal.name"></md-input>
          </md-input-container>

          <md-input-container>
            <label>Direccion del Local</label>
            <md-input type="text"  v-model="editLocal.address"></md-input>
          </md-input-container>

          <md-input-container>
            <label for="movie">Ciudad del Local</label>
            <md-select name="movie" id="movie" v-model="editLocal.city_id">
              <md-option v-for="city in ciudades" v-bind:value="city.id" >{{city.name}}</md-option>
            </md-select>
          </md-input-container>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editLocal')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarLocal('editLocal')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>




  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioLocal = new ApiConnect('locals')
  const servicioCiudades = new ApiConnect('cities')



  import axios from 'axios';



  export default {
    created(){
      this.obtenerLocales()

    },
    data () {
      return {
        locales: [],
        newLocal: {id: 0, name: "", address: "", city_id: ""},
        editLocal: {id: 0, name: "", address: "", city_id: ""},
        ciudades: []
      }
    },
    methods: {
      idToString()
      {
        for( let x =0 ; x < this.locales.length ; x ++)
        {
          for(let i = 0 ; i < this.ciudades.length ; i++)
          {
            if(parseInt(this.locales[x].city_id) ===  parseInt(this.ciudades[i].id))
            {
              this.locales[x].city_id =this.ciudades[i].name
              break;
            }
          }
        }
      },
      StringToId(local)
      {
          for(let i = 0 ; i < this.ciudades.length ; i++)
          {
            if(local.city_id ===  this.ciudades[i].name)
            {
              local.city_id  =  parseInt(this.ciudades[i].id)
              break;
            }
          }

      },
      obtenerCiudades()
      {
        servicioCiudades.query().then(data => {
          this.ciudades = data.body.data
          this.idToString()
        })
      },
      obtenerLocales()
      {
        servicioLocal.query().then( data => {
          this.locales = data.body.data
          this.obtenerCiudades()
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarLocal(ref)
      {
        servicioLocal.save(this.newLocal).then(data => {
          this.newLocal = {id: 0, name: "", address: "", city_id: ""}
          this.obtenerLocales()
          this.$refs[ref].close();
        })
      },
      borrar(local)
      {
        axios.delete(servicioLocal.getEndpoint()+'/'+JSON.stringify(local.id))
        .then(response => {
          this.obtenerLocales()
        })
      },
      editar(local, ref)
      {
        this.editLocal = JSON.parse(JSON.stringify(local));
        this.StringToId(this.editLocal)
        this.$refs[ref].open();
      },
      editarLocal(ref)
      {

        axios.put(servicioLocal.getEndpoint()+'/'+JSON.stringify(this.editLocal.id), this.editLocal).then(data => {
          this.obtenerLocales()
          this.$refs[ref].close();
        })
      }
    }
  }
</script>




<style scoped>

</style>
