<template>
  <section>

    <md-table>
      <md-table-header>
        <md-table-row>
          <md-table-head>Acciones</md-table-head>
          <md-table-head>Funcionalidad</md-table-head>
          <md-table-head md-numeric>Escritura</md-table-head>
          <md-table-head md-numeric>Lectura</md-table-head>
          <md-table-head md-numeric>Edicion</md-table-head>
          <md-table-head md-numeric>Eliminacion</md-table-head>
        </md-table-row>
      </md-table-header>

      <md-table-body>
        <md-table-row v-for="permiso in misPermisos">
          <md-table-cell>
            <div class="row">
              <div class="col s12">
                <md-button @click="editar(permiso)"><md-icon>edit</md-icon></md-button>
              </div>
            </div>
          </md-table-cell>

          <md-table-cell>
              {{permiso.functionalities_id}}
          </md-table-cell>


          <md-table-cell>
              <span v-if="parseInt(permiso.write) === 1"><md-icon md-theme="green" class="md-primary">check</md-icon></span>
              <span v-else><md-icon md-theme="orange" class="md-primary">clear</md-icon></span>
          </md-table-cell>

          <md-table-cell>
            <span v-if="parseInt(permiso.read) === 1"><md-icon md-theme="green" class="md-primary">check</md-icon></span>
            <span v-else><md-icon md-theme="orange" class="md-primary">clear</md-icon></span>
          </md-table-cell>

          <md-table-cell>
            <span v-if="parseInt(permiso.edit) === 1"><md-icon md-theme="green" class="md-primary">check</md-icon></span>
            <span v-else><md-icon md-theme="orange" class="md-primary">clear</md-icon></span>
          </md-table-cell>

          <md-table-cell>
            <span v-if="parseInt(permiso.erase) === 1"><md-icon md-theme="green" class="md-primary">check</md-icon></span>
            <span v-else><md-icon md-theme="orange" class="md-primary">clear</md-icon></span>
          </md-table-cell>


        </md-table-row>
      </md-table-body>
    </md-table>
    <md-button id="addPermission" class="md-icon-button md-raised md-warn" style="margin-left: 50%; margin-top: 15px" @click="openDialog('addPermission')">
      <md-icon>add</md-icon>
    </md-button>

    <md-dialog md-open-from="#addPermission" md-close-to="#addPermission" ref="addPermission" >
      <md-dialog-title>Especificacion de Permisos</md-dialog-title>
      <md-dialog-content>

        <template v-if="funcionalidadesDisponibles.length > 0">
          <md-input-container>
            <label for="movie">Seleccione la Funcionalidad</label>
            <md-select name="movie" id="movie"  v-model="currentPermise.functionalities_id">
              <md-option v-for="funcionalidad in funcionalidadesDisponibles" v-bind:value="funcionalidad.id" >{{funcionalidad.name}}</md-option>
            </md-select>
          </md-input-container>

          <div class="row">
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="currentPermise.write" class="md-primary">Escritura</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="currentPermise.read" class="md-primary">Lectura</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="currentPermise.edit" class="md-primary">Edicion</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="currentPermise.erase" class="md-primary">Eliminacion</md-checkbox>
            </div>
          </div>
        </template>
        <template v-else>
          <p>No hay funcionalidades disponibles</p>
        </template>


      </md-dialog-content>

      <md-dialog-actions>
        <md-button v-if="funcionalidadesDisponibles.length > 0" class="md-primary" @click="agregarPermiso()">Agregar</md-button>
        <md-button class="md-primary" @click="closeDialog('addPermission')">Cerrar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addPermission" md-close-to="#addPermission" ref="editPermission" >
      <md-dialog-title>Edicion de Permiso: {{editPermise.functionalities_id}}</md-dialog-title>
      <md-dialog-content>

          <div class="row">
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="editPermise.write" class="md-primary">Escritura</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="editPermise.read" class="md-primary">Lectura</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="editPermise.edit" class="md-primary">Edicion</md-checkbox>
            </div>
            <div class="col s3">
              <md-checkbox id="my-test2" name="my-test2" v-model="editPermise.erase" class="md-primary">Eliminacion</md-checkbox>
            </div>
          </div>


      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="editarPermiso()">Actualizar</md-button>
        <md-button class="md-primary" @click="closeDialog('editPermission')">Cerrar</md-button>
      </md-dialog-actions>
    </md-dialog>

  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioFuncionalidades = new ApiConnect('functionalities')
  const servicioPermisos = new ApiConnect('permises')

  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});

  export default{
    created(){
      this.$root.$on("actualizarUT", ()=>{
        this.actualizarUT()
      })

    },
    data(){
      return{
        ut: {},
        funcionalidades: [],
        permisos: [],
        misPermisos: [],
        isOpen : false,
        currentPermise: {id: 0, functionalities_id: 0, userstypes_id: 0, write: false, erase: false, read: false, edit: false},
       funcionalidadesDisponibles: [],
       editPermise:  {id: 0, functionalities_id: 0, userstypes_id: 0, write: false, erase: false, read: false, edit: false}
      }
    },
    methods: {
      filtrarFuncionalidades()
      {
        this.funcionalidadesDisponibles = JSON.parse(JSON.stringify(this.funcionalidades))
        for ( let i = 0 ; i < this.funcionalidadesDisponibles.length ; i++)
        {
          for( let j = 0 ; j < this.misPermisos.length ; j ++)
          {
            if( parseInt(this.funcionalidadesDisponibles[i].id)  === parseInt(this.misPermisos[j].functionalities_id))
            {
              this.funcionalidadesDisponibles.splice(i, 1)
            }
          }




        }
      console.log(this.funcionalidadesDisponibles)
        this.idToString()
      },
      StringToId(permiso)
      {
        for ( let i = 0 ; i < this.funcionalidades.length ; i++)
        {
          if(this.funcionalidades[i].name === permiso.functionalities_id)
          {
            permiso.functionalities_id = this.funcionalidades[i].id
            break
          }
        }
      },
      idToString()
      {
        for(  let i = 0 ; i < this.misPermisos.length ; i ++ )
        {
          for( let j = 0; j < this.funcionalidades.length ; j ++)
          {
            if(parseInt(this.misPermisos[i].functionalities_id) === parseInt(this.funcionalidades[j].id))
            {
              this.misPermisos[i].functionalities_id = this.funcionalidades[j].name
              break
            }
          }

        }


      },
      filtrarPermisos()
      {
        this.misPermisos = []
        for ( let i = 0 ; i < this.permisos.length ; i ++)
        {
          if( parseInt(this.permisos[i].userstypes_id) === parseInt(this.ut.id))
          {
            this.misPermisos.push(this.permisos[i])
          }
        }

          this.filtrarFuncionalidades()

      },
      actualizarPermisos()
      {
        servicioPermisos.query().then(data => {
          this.permisos = data.body.data
          this.filtrarPermisos()
        })
      },
      actualizarFuncionalidades()
      {
        servicioFuncionalidades.query().then(data => {
          this.funcionalidades = data.body.data
          this.actualizarPermisos()
        })
      },
      actualizarUT()
      {
        this.ut = JSON.parse(localStorage.getItem('currentUT'))
        this.actualizarFuncionalidades()
      },
      closeDialog(ref)
      {
        this.$refs[ref].close();
      },
      openDialog(ref)
      {
        this.$refs[ref].open();
      },
      agregarPermiso()
      {
      var a = JSON.parse(JSON.stringify(this.currentPermise))
        a.write ? a.write = '1' :a.write = '0'
        a.edit ? a.edit = '1' :a.edit = '0'
        a.read ? a.read = '1' :a.read = '0'
        a.erase ? a.erase = '1' :a.erase = '0'
        a.userstypes_id = this.ut.id
        console.log(a)
        servicioPermisos.save(a).then(data => {
          console.log(data)
          this.actualizarUT()
          this.currentPermise = {id: 0, functionalities_id: 0, userstypes_id: 0, write: false, erase: false, read: false, edit: false}
          this.$refs['addPermission'].close()
        })
      },
      editar(funcionalidad)
      {
        this.editPermise = JSON.parse(JSON.stringify(funcionalidad))
        this.editPermise.edit === '1' ?  this.editPermise.edit = true : this.editPermise.edit = false
        this.editPermise.erase === '1' ?  this.editPermise.erase = true : this.editPermise.erase = false
        this.editPermise.write === '1' ?  this.editPermise.write = true : this.editPermise.write = false
        this.editPermise.read === '1' ?  this.editPermise.read = true : this.editPermise.read = false
        this.$refs['editPermission'].open()
      },
      editarPermiso()
      {
        var a = JSON.parse(JSON.stringify(this.editPermise))
          a.write ? a.write = '1' :a.write = '0'
          a.edit ? a.edit = '1' :a.edit = '0'
          a.read ? a.read = '1' :a.read = '0'
          a.erase ? a.erase = '1' :a.erase = '0'

          this.StringToId(a)

          axios.put(servicioPermisos.getEndpoint()+'/'+JSON.stringify(a.id), a).then(data => {
            this.actualizarUT()
            this.editPermission = {id: 0, functionalities_id: 0, userstypes_id: 0, write: false, erase: false, read: false, edit: false}
            this.$refs['editPermission'].close()
          })

      }
    }

  }



</script>




<style scoped>

</style>
