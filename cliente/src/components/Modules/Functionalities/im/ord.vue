<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Historial de ordenes</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Usuario a Cargo </md-table-head>
            <md-table-head>Producto a Encargar </md-table-head>
            <md-table-head>Hora del Pedido </md-table-head>
            <md-table-head>Fecha del Pedido </md-table-head>
            <md-table-head>Cantidad Pedida </md-table-head>
            <md-table-head>Costo Total del Pedido</md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="order in orders" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(order, 'editOrder')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(order)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>


            </md-table-cell>

            <md-table-cell>
              {{ order.users_id }}
            </md-table-cell>

            <md-table-cell>
              {{ order.products_id }}
            </md-table-cell>

            <md-table-cell>
              {{ order.time }}
            </md-table-cell>

            <md-table-cell>
              {{ order.date }}
            </md-table-cell>

            <md-table-cell>
              {{ order.amount }}
            </md-table-cell>

            <md-table-cell>
              {{ order.total }}
            </md-table-cell>


          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="orders.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>




    <md-button  class="md-fab md-fab-bottom-right" id="addOrder" @click="openDialog('addOrder')">
      <md-icon>add</md-icon>
    </md-button>




    <md-dialog md-open-from="#addOrder" md-close-to="#addOrder" ref="addOrder">
      <md-dialog-title>Agregar Orden</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Cantidad</label>
          <md-input type="text"  v-model="newOrder.amount"></md-input>
        </md-input-container>

        <md-input-container>
          <label for="movie">Producto</label>
          <md-select name="movie" id="movie" v-model="newOrder.products_id">
            <md-option v-for="product in products" v-bind:value="product.id" >{{product.name}}</md-option>
          </md-select>
        </md-input-container>

      </md-dialog-content>



      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addOrder')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarOrder('addOrder')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>






    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editOrder">
      <md-dialog-title>Edicion de Orden</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Cantidad</label>
          <md-input type="text"  v-model="editOrder.amount"></md-input>
        </md-input-container>

        <md-input-container>
          <label for="movie">Producto</label>
          <md-select name="movie" id="movie" v-model="editOrder.products_id">
            <md-option v-for="product in products" v-bind:value="product.id" >{{product.name}}</md-option>
          </md-select>
        </md-input-container>

      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editOrder')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarOrder('editOrder')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>




  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioProductos = new ApiConnect('products')
  const servicioOrden = new ApiConnect('orders')
  const servicioUsuarios = new ApiConnect('users')

  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});
  import moment from 'moment'



  export default {
    created(){
      this.obtenerOrdenes()

    },
    data () {
      return {
        orders: [],
        //ESTO ESTA HARD CODEADO!!!! EL USER ID DEBE SER REEMPLAZADO DINAMICAMENTE
        newOrder: {id: 0, users_id: 1, products_id: 0, time: "", date: moment().format("DD/MM/YYYY"), amount: "", total: ""},
        editOrder: {id: 0, users_id: 1, products_id: 0, time: "", date: moment().format("DD/MM/YYYY"), amount: "", total: ""},
        users: [],
        products: []
      }
    },
    methods: {
      idToString()
      {
        for( let x =0 ; x < this.orders.length ; x ++)
        {

          for(let i = 0 ; i < this.products.length ; i++)
          {
            if(parseInt(this.orders[x].products_id) ===  parseInt(this.products[i].id))
            {
              this.orders[x].products_id =this.products[i].name
              break;
            }
          }


          for(let i = 0 ; i < this.users.length ; i++)
          {
            if(parseInt(this.orders[x].users_id) ===  parseInt(this.users[i].id))
            {
              this.orders[x].users_id =this.users[i].name
              break;
            }
          }


        }
      },
      StringToId(order)
      {

        for(let i = 0 ; i < this.users.length ; i++)
        {
          if(order.users_id ===  this.users[i].name)
          {
            order.users_id  =  parseInt(this.users[i].id)
            break;
          }
        }

        for(let i = 0 ; i < this.products.length ; i++)
        {
          if(order.products_id ===  this.products[i].name)
          {
            order.products_id  =  parseInt(this.products[i].id)
            break;
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
      obtenerProductos()
      {
        servicioProductos.query().then(data => {
          this.products = data.body.data
          this.obtenerUsuarios()
        })
      },
      obtenerOrdenes()
      {
        servicioOrden.query().then( data => {
          this.orders = data.body.data
          this.obtenerProductos()
          console.log(this.orders)
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarOrder(ref)
      {
        axios.get(servicioProductos.getEndpoint()+'/'+JSON.stringify(this.newOrder.products_id)).then(data => {
          var producto =data.data.data
          var cantProducto = parseInt(this.newOrder.amount)
          var valProducto = parseInt(producto.cost)
          var total = cantProducto*valProducto
          console.log("El total es : "+total)
          this.newOrder.total = total
          this.newOrder.time = moment().format('LT')

          console.log(this.newOrder)
          servicioOrden.save(this.newOrder).then(data => {
            this.newOrder = {id: 0, users_id: 1, products_id: 0, time: "", date: moment().format("DD/MM/YYYY"), amount: "", total: ""}
            this.obtenerOrdenes()
            this.$refs[ref].close();
          })

        })



      },
      borrar(order)
      {
        axios.delete(servicioOrden.getEndpoint()+'/'+JSON.stringify(order.id))
        .then(response => {
          this.obtenerOrdenes()
        })
      },
      editar(order, ref)
      {
        this.editOrder = JSON.parse(JSON.stringify(order));
        this.StringToId(this.editOrder)
        this.$refs[ref].open();
      },
      editarOrder(ref)
      {

        axios.get(servicioProductos.getEndpoint()+'/'+JSON.stringify(this.editOrder.products_id)).then(data => {
          var producto =data.data.data
          var cantProducto = parseInt(this.editOrder.amount)
          var valProducto = parseInt(producto.cost)
          var total = cantProducto*valProducto
          console.log("El total es : "+total)
          this.editOrder.total = total

          axios.put(servicioOrden.getEndpoint()+'/'+JSON.stringify(this.editOrder.id), this.editOrder).then(data => {
            this.obtenerOrdenes()
            this.editOrder = {id: 0, users_id: 1, products_id: 0, time: "", date: moment().format("DD/MM/YYYY"), amount: "", total: ""}
            this.$refs[ref].close();
          })

        })


      }
    }
  }
</script>




<style scoped>

</style>
