<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Categorias </h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Nombre </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="provider in providers" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(provider, 'editProvider')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(provider)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ provider.name }}
            </md-table-cell>
          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="providers.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>

    <md-button  class="md-fab md-fab-bottom-right" id="addProvider" @click="openDialog('addProvider')">
      <md-icon>add</md-icon>
    </md-button>

    <md-dialog md-open-from="#addProvider" md-close-to="#addProvider" ref="addProvider">
      <md-dialog-title>Agregar Categoria</md-dialog-title>

      <md-dialog-content>
          <md-input-container>
            <label>Nombre de la Categoria</label>
            <md-input type="text"  v-model="newProvider.name"></md-input>
          </md-input-container>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addProvider')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarProvider('addProvider')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editProvider">
      <md-dialog-title>Edicion de Categoria</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre de la Categoria</label>
          <md-input type="text"  v-model="editProvider.name"></md-input>
        </md-input-container>


      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editProvider')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarProvider('editProvider')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>
  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioProveedor = new ApiConnect('productCategories')
  import axios from 'axios';


  export default {
    created(){
      this.obtenerProveedores()
    },
    data () {
      return {
        providers: [],
        newProvider: {id: 0, name: ""},
        editProvider: {id: 0, name: ""}
      }
    },
    methods: {
      obtenerProveedores()
      {
        servicioProveedor.query().then( data => {
          this.providers = data.body.data
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarProvider(ref)
      {
        servicioProveedor.save(this.newProvider).then(data => {
          this.newProvider = {id: 0, name: "", description: ""}
          this.obtenerProveedores()
          this.$refs[ref].close();
        })
      },
      borrar(proveedor)
      {
        axios.delete(servicioProveedor.getEndpoint()+'/'+JSON.stringify(proveedor.id))
        .then(response => {
          this.obtenerProveedores()
        })
      },
      editar(proveedor, ref)
      {
        this.editProvider = JSON.parse(JSON.stringify(proveedor));
        this.$refs[ref].open();
      },
      editarProvider(ref)
      {

        axios.put(servicioProveedor.getEndpoint()+'/'+JSON.stringify(this.editProvider.id), this.editProvider).then(data => {
          this.obtenerProveedores()
          this.$refs[ref].close();
        })
      }
    }
  }
</script>




<style scoped>

</style>
