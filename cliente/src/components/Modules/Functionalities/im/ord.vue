<template>
  <section>
    <v-toolbar>
      <v-toolbar-title> Historial de ordenes</v-toolbar-title>
    </v-toolbar>
    <v-data-table
        v-bind:headers="headers"
        :items="orders"
        class="elevation-1"
      >
      <template slot="items" slot-scope="props">
        <td>
          <v-btn flat @click="editar(props.item, 'editOrder')">
            <v-icon color="grey lighten-1">edit</v-icon>
          </v-btn>
          <v-btn flat @click="borrar(props.item)">
            <v-icon color="grey lighten-1">delete</v-icon>
          </v-btn>
        </td>
        <td>{{ props.item.users_id }}</td>
        <td>{{ props.item.products_id }}</td>
        <td>{{ props.item.time }}</td>
        <td>{{ props.item.date }}</td>
        <td>{{ props.item.amount }}</td>
        <td>{{ props.item.total }}</td>
      </template>
    </v-data-table>

    <v-card-text style="height: 100px; position: relative">
      <v-btn
        absolute
        dark
        fab
        top
        right
        color="pink"
      >
        <v-icon>add</v-icon>
      </v-btn>
    </v-card-text>

    <md-button  class="md-fab md-fab-bottom-right" id="addOrder" @click.native.stop="addOrder = true">
      <md-icon>add</md-icon>
    </md-button>

    <v-dialog v-model="addOrder">
        <v-card class="pa-4">
          <v-card-title class="headline">Agregar Orden</v-card-title>
          <v-text-field
              name="input-1"
              label="Cantidad"
              id="cantidad"
              v-model="newOrder.amount"
            ></v-text-field>
          <v-select
              v-bind:items="products"
              v-model="newOrder.products_id"
              label="Select"
              single-line
              bottom
              item-text="name"
              item-value="id"
            ></v-select>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" flat="flat" @click.native="addOrder = false">Cancelar</v-btn>
            <v-btn color="green darken-1" flat="flat" @click.native="agregarOrder('addOrder')">Agregar</v-btn>
          </v-card-actions>
        </v-card>
    </v-dialog>


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
        addOrder: false,
        users: [],
        products: [],
        headers: [
          {
            text: 'Acciones',
            align: 'left',
            sortable: false,
            value: 'acciones'
          },
          {
            text: 'Usuario a Cargo',
            align: 'left',
            sortable: false,
            value: 'usuario'
          },
          {
            text: 'Producto a Encargar',
            align: 'left',
            sortable: false,
            value: 'producto'
          },
          {
            text: 'Hora del Pedido',
            align: 'left',
            sortable: false,
            value: 'hora'
          },
          {
            text: 'Fecha del Pedido',
            align: 'left',
            sortable: false,
            value: 'fecha'
          },
          {
            text: 'Cantidad Pedida',
            align: 'left',
            sortable: false,
            value: 'cantidad'
          },
          {
            text: 'Costo Total del Pedido',
            align: 'left',
            sortable: false,
            value: 'costo'
          }
        ]
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
            this.addOrder = false;
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
