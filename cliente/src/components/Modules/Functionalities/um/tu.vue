<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Tipos de Usuario</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Nombre </md-table-head>
            <md-table-head>Descripcion </md-table-head>
            <md-table-head>Permisos </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="usertype in userstypes" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(usertype, 'editUT')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(usertype)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ usertype.name }}
            </md-table-cell>

            <md-table-cell>
              {{ usertype.description }}
            </md-table-cell>

            <md-table-cell>
              <md-button @click="irPermisos(usertype)"><md-icon>remove_red_eye</md-icon></md-button>
            </md-table-cell>



          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="userstypes.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>




    <md-button  class="md-fab md-fab-bottom-right" id="addUT" @click="openDialog('addUT')">
      <md-icon>add</md-icon>
    </md-button>




    <md-dialog md-open-from="#addUT" md-close-to="#addUT" ref="addUT">
      <md-dialog-title>Agregar Tipo de Usuario</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre del Tipo de Usuario</label>
          <md-input type="text"  v-model="newUT.name"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Descripcion del Tipo de Usuario</label>
          <md-input type="text"  v-model="newUT.description"></md-input>
        </md-input-container>
      </md-dialog-content>



      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addUT')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarUT('addUT')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addUT" md-close-to="#addUT" ref="viewPermissions" >
      <md-dialog-title>Especificacion de Permisos</md-dialog-title>
      <md-dialog-content>
        <pu></pu>
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('viewPermissions')">Cerrar</md-button>
      </md-dialog-actions>
    </md-dialog>




    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editUT">
      <md-dialog-title>Edicion de Local</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre del Tipo de Usuario</label>
          <md-input type="text"  v-model="editUT.name"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Descripcion del Tipo de Usuario</label>
          <md-input type="text"  v-model="editUT.description"></md-input>
        </md-input-container>
        </md-input-container>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editUT')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarUT('editUT')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>




  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioUT = new ApiConnect('userTypes')

  import pu from '@/components/Modules/Functionalities/um/pu'

  import axios from 'axios';



  export default {
    components: {
      pu
    },
    created(){
      this.obtenerUT()

    },
    data () {
      return {
        userstypes: [],
        newUT: {id: 0, name: "", description: ""},
        editUT: {id: 0, name: "", description: ""}
      }
    },
    methods: {
      obtenerUT()
      {
        servicioUT.query().then(data => {
          this.userstypes = data.body.data

        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarUT(ref)
      {
        servicioUT.save(this.newUT).then(data => {
          this.newUT ={id: 0, name: "", description: ""}
          this.obtenerUT()
          this.$refs[ref].close();
        })
      },
      borrar(ut)
      {
        axios.delete(servicioUT.getEndpoint()+'/'+JSON.stringify(ut.id))
        .then(response => {
          this.obtenerUT()
        })
      },
      editar(ut, ref)
      {
        this.editUT = JSON.parse(JSON.stringify(ut));
        this.$refs[ref].open()
      },
      editarUT(ref)
      {

        axios.put(servicioUT.getEndpoint()+'/'+JSON.stringify(this.editUT.id), this.editUT).then(data => {
          this.obtenerUT()
          this.$refs[ref].close()
        })
      },
      irPermisos(ut)
      {
        localStorage.setItem('currentUT', JSON.stringify(ut))
        this.$refs['viewPermissions'].open()
      }
    }
  }
</script>




<style scoped>

</style>
