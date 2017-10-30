<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Usuarios registrados</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Rut </md-table-head>
            <md-table-head>Nombre </md-table-head>
            <md-table-head>Correo </md-table-head>
            <md-table-head>Telefono </md-table-head>
            <md-table-head>Password </md-table-head>
            <md-table-head>Tipo de Usuario </md-table-head>
            <md-table-head>Local Asignado </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="user in usuarios" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(user, 'editUser')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(user)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ user.rut }}
            </md-table-cell>

            <md-table-cell>
              {{ user.name }} {{user.lastname}}
            </md-table-cell>

            <md-table-cell>
              {{ user.email }}
            </md-table-cell>

            <md-table-cell>
              {{ user.phone }}
            </md-table-cell>

            <md-table-cell>
              {{ user.password }}
            </md-table-cell>

            <md-table-cell>
              {{ user.userstypes_id }}
            </md-table-cell>

            <md-table-cell>
              {{ user.local_id }}
            </md-table-cell>

          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="usuarios.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>




    <md-button  class="md-fab md-fab-bottom-right" id="addUser" @click="openDialog('addUser')">
      <md-icon>add</md-icon>
    </md-button>




    <md-dialog md-open-from="#addUser" md-close-to="#addUser" ref="addUser">
      <md-dialog-title>Agregar Nuevo Usuario</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Rut del Usuario</label>
          <md-input type="text"  v-model="newUser.rut"></md-input>
        </md-input-container>
          <md-input-container>
            <label>Nombres del Usuario</label>
            <md-input type="text"  v-model="newUser.name"></md-input>
          </md-input-container>
            <md-input-container>
              <label>Apellidos del Usuario</label>
              <md-input type="text"  v-model="newUser.lastname"></md-input>
            </md-input-container>
              <md-input-container>
                <label>Correo del Usuario</label>
                <md-input type="email"  v-model="newUser.email"></md-input>
              </md-input-container>
                <md-input-container>
                  <label>Telefono del Usuario</label>
                  <md-input type="text"  v-model="newUser.phone"></md-input>
                </md-input-container>
                  <md-input-container>
                    <label>Password del Usuario</label>
                    <md-input type="password"  v-model="newUser.password"></md-input>
                  </md-input-container>

        <md-input-container>
          <label for="movie">Tipo de Usuario</label>
          <md-select name="movie" id="movie" v-model="newUser.userstypes_id">
            <md-option v-for="usertype in userstypes" v-bind:value="usertype.id" >{{usertype.name}}</md-option>
          </md-select>
        </md-input-container>

        <md-input-container>
          <label for="movie">Local del Usuario</label>
          <md-select name="movie" id="movie" v-model="newUser.local_id">
            <md-option v-for="local in locals" v-bind:value="local.id" >{{local.name}}</md-option>
          </md-select>
        </md-input-container>

      </md-dialog-content>



      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addUser')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarUser('addUser')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>






    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editUser">
      <md-dialog-title>Edicion de Local</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Rut del Usuario</label>
          <md-input type="text"  v-model="editUser.rut"></md-input>
        </md-input-container>
          <md-input-container>
            <label>Nombres del Usuario</label>
            <md-input type="text"  v-model="editUser.name"></md-input>
          </md-input-container>
            <md-input-container>
              <label>Apellidos del Usuario</label>
              <md-input type="text"  v-model="editUser.lastname"></md-input>
            </md-input-container>
              <md-input-container>
                <label>Correo del Usuario</label>
                <md-input type="email"  v-model="editUser.email"></md-input>
              </md-input-container>
                <md-input-container>
                  <label>Telefono del Usuario</label>
                  <md-input type="text"  v-model="editUser.phone"></md-input>
                </md-input-container>
                  <md-input-container>
                    <label>Password del Usuario</label>
                    <md-input type="password"  v-model="editUser.password"></md-input>
                  </md-input-container>

        <md-input-container>
          <label for="movie">Tipo de Usuario</label>
          <md-select name="movie" id="movie" v-model="editUser.userstypes_id">
            <md-option v-for="usertype in userstypes" v-bind:value="usertype.id" >{{usertype.name}}</md-option>
          </md-select>
        </md-input-container>

        <md-input-container>
          <label for="movie">Local del Usuario</label>
          <md-select name="movie" id="movie" v-model="editUser.local_id">
            <md-option v-for="local in locals" v-bind:value="local.id" >{{local.name}}</md-option>
          </md-select>
        </md-input-container>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editUser')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarUser('editUser')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>




  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioLocal = new ApiConnect('locals')
  const servicioUT = new ApiConnect('userTypes')
  const servicioUsuarios = new ApiConnect('users')



  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});



  export default {
    created(){
      this.obtenerUsuarios()

    },
    data () {
      return {
        usuarios: [],
        newUser: {id: 0, name: "", lastname: "", rut: "" , email: "", phone: "", password: "", userstypes_id: 0, local_id: 0},
        editUser: {id: 0, name: "", lastname: "", rut: "" , email: "", phone: "", password: "", userstypes_id: 0, local_id: 0},
        userstypes: [],
        locals: []
      }
    },
    methods: {
      idToString()
      {
        for( let x =0 ; x < this.usuarios.length ; x ++)
        {

          for(let i = 0 ; i < this.userstypes.length ; i++)
          {
            if(parseInt(this.usuarios[x].userstypes_id) ===  parseInt(this.userstypes[i].id))
            {
              this.usuarios[x].userstypes_id =this.userstypes[i].name
              break;
            }
          }


          for(let i = 0 ; i < this.locals.length ; i++)
          {
            if(parseInt(this.usuarios[x].local_id) ===  parseInt(this.locals[i].id))
            {
              this.usuarios[x].local_id =this.locals[i].name
              break;
            }
          }


        }
      },
      StringToId(user)
      {
          for(let i = 0 ; i < this.locals.length ; i++)
          {
            if(user.local_id ===  this.locals[i].name)
            {
              user.local_id  =  parseInt(this.locals[i].id)
              break;
            }
          }

          for(let i = 0 ; i < this.userstypes.length ; i++)
          {
            if(user.userstypes_id ===  this.userstypes[i].name)
            {
              user.userstypes_id  =  parseInt(this.userstypes[i].id)
              break;
            }
          }


      },
      obtenerUT()
      {
        servicioUT.query().then(data => {
          this.userstypes = data.body.data
          this.idToString()
        })
      },
      obtenerLocales()
      {
        servicioLocal.query().then(data => {
          this.locals = data.body.data
          this.obtenerUT()
        })
      },
      obtenerUsuarios()
      {
        servicioUsuarios.query().then( data => {
          this.usuarios = data.body.data
          this.obtenerLocales()
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarUser(ref)
      {
        servicioUsuarios.save(this.newUser).then(data => {
          this.newUser = {id: 0, name: "", lastname: "", rut: "" , email: "", phone: "", password: "", userstypes_id: 0, local_id: 0}
          this.obtenerUsuarios()
          this.$refs[ref].close();
        })
      },
      borrar(user)
      {
        axios.delete(servicioUsuarios.getEndpoint()+'/'+JSON.stringify(user.id))
        .then(response => {
          this.obtenerUsuarios()
        })
      },
      editar(user, ref)
      {
        this.editUser = JSON.parse(JSON.stringify(user));
        this.StringToId(this.editUser)
        this.$refs[ref].open();
      },
      editarUser(ref)
      {

        axios.put(servicioUsuarios.getEndpoint()+'/'+JSON.stringify(this.editUser.id), this.editUser).then(data => {
          this.obtenerUsuarios()
          this.$refs[ref].close();
        })
      }
    }
  }
</script>




<style scoped>

</style>
