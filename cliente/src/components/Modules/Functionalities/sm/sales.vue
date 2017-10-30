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
            <md-table-head>Usuario a Cargo </md-table-head>
            <md-table-head>Descripcion </md-table-head>
            <md-table-head>Fecha</md-table-head>
            <md-table-head>Hora </md-table-head>
            <md-table-head>Total vendido ($)</md-table-head>
            <md-table-head>Detalle </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="sale in sales" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(sale, 'editSale')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(sale)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ sale.users_id }}
            </md-table-cell>

            <md-table-cell>
              {{ sale.description }}
            </md-table-cell>

            <md-table-cell>
              {{ sale.date }}
            </md-table-cell>

            <md-table-cell>
              {{ sale.time }}
            </md-table-cell>

            <md-table-cell>
              {{ sale.totalsale }}
            </md-table-cell>

            <md-table-cell>
              <md-button @click="irDetalle(sale)"><md-icon>remove_red_eye</md-icon></md-button>
            </md-table-cell>

          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="sales.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>

    <md-button  class="md-fab md-fab-bottom-right" id="addSale" @click="openDialog('addSale')">
      <md-icon>add</md-icon>
    </md-button>

    <md-dialog md-open-from="#addSale" md-close-to="#addSale" ref="addSale">
      <md-dialog-title>Nueva Venta</md-dialog-title>

      <md-dialog-content>
        <!-- AQUI VA LA LOGICA-->
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addSale')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarSale('addSale')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addSale" md-close-to="#addSale" ref="editSale">
      <md-dialog-title>Edicion de Venta</md-dialog-title>

      <md-dialog-content>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editSale')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarSale('editSale')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#addUT" md-close-to="#addUT" ref="viewDetail" >
      <md-dialog-title>Detalle de Venta</md-dialog-title>
      <md-dialog-content>
        <prodsale></prodsale>
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('viewDetail')">Cerrar</md-button>
      </md-dialog-actions>
    </md-dialog>



  </section>
</template>


<script>
 import prodsale from '@/components/Modules/Functionalities/sm/prodsale'
  import { ApiConnect } from '@/services'
  const servicioVentas = new ApiConnect('sales')
  const servicioUsuarios = new ApiConnect('users')
  import moment from 'moment'
  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});
  export default {
    components: {
      prodsale
    },
    created(){
      this.obtenerVentas()
    },
    data () {
      return {
        sales: [],
        //HARDCODEADO FEOOOO
        newSale: {id: 0,  date: moment().format("DD/MM/YYYY"), amount: "", description: "", users_id: 1, totalsale: "", time: ""},
        editSale: {id: 0,  date: moment().format("DD/MM/YYYY"), amount: "", description: "", users_id: 1, totalsale: "", time: ""},
        users: []
      }
    },
    methods: {
      idToString()
      {
        for( let i = 0 ; i < this.sales.length ; i ++)
        {
          for( let j = 0 ; j < this.users.length ; j ++)
          {
            if(parseInt(this.sales[i].users_id) === parseInt(this.users[j].id))
            {
              this.sales[i].users_id = this.users[j].name
              break
            }
          }

        }
      },
      obtenerUsuarios()
      {
        servicioUsuarios.query().then(data => {
          this.users = data.body.data
          this.idToString()
        })
      },
      obtenerVentas()
      {
        servicioVentas.query().then( data => {
          this.sales = data.body.data
          this.obtenerUsuarios()
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarSale(ref)
      {
        servicioVentas.save(this.newSale).then(data => {
          this.newSale = {id: 0,  date: moment().format("DD/MM/YYYY"), amount: "", description: "", users_id: 1, totalsale: "", time: ""}
          this.obtenerVentas()
          this.$refs[ref].close();
        })
      },
      borrar(venta)
      {
        axios.delete(servicioVentas.getEndpoint()+'/'+JSON.stringify(venta.id))
        .then(response => {
          this.obtenerVentas()
        })
      },
      editar(venta, ref)
      {
        this.editSale = JSON.parse(JSON.stringify(venta));
        this.$refs[ref].open();
      },
      editarSale(ref)
      {

        axios.put(servicioVentas.getEndpoint()+'/'+JSON.stringify(this.editSale.id), this.editSale).then(data => {
          this.obtenerVentas()
          this.$refs[ref].close();
        })
      },
      irDetalle(venta)
      {
        localStorage.setItem('currentSale', JSON.stringify(venta))
        this.$refs['viewDetail'].open()
        this.$root.$emit("actualizarSale")
      }
    }
  }
</script>




<style scoped>

</style>
