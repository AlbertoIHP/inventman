<template>
  <section>
    <v-data-table
        v-bind:headers="headers"
        :items="inventaries"
        class="elevation-1"
      >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.locals_id }}</td>
        <td>{{ props.item.products_id }}</td>
        <td>{{ props.item.amount }}</td>
      </template>
    </v-data-table>

  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioProductos = new ApiConnect('products')
  const servicioInventario = new ApiConnect('inventaries')
  const servicioLocal = new ApiConnect('locals')
  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});



  export default {
    created(){
      this.obtenerInventarios()

    },
    data () {
      return {
        inventaries: [],
        locals: [],
        products: [],
        headers: [
          {
            text: 'Local',
            align: 'left',
            sortable: false,
            value: 'local'
          },
          {
            text: 'Producto',
            align: 'left',
            sortable: false,
            value: 'producto'
          },
          {
            text: 'Cantidad de stock',
            align: 'left',
            sortable: false,
            value: 'cantidad'
          }
        ],
        locals: {}
      }
    },
    methods: {
      idToString()
      {
        for( let x =0 ; x < this.inventaries.length ; x ++)
        {

          for(let i = 0 ; i < this.products.length ; i++)
          {
            if(parseInt(this.inventaries[x].products_id) ===  parseInt(this.products[i].id))
            {
              this.inventaries[x].products_id =this.products[i].name
              break;
            }
          }


          for(let i = 0 ; i < this.locals.length ; i++)
          {
            if(parseInt(this.inventaries[x].locals_id) ===  parseInt(this.locals[i].id))
            {
              this.inventaries[x].locals_id =this.locals[i].name
              break;
            }
          }


        }
      },
      obtenerLocales()
      {
        servicioLocal.query().then(data => {
          this.locals = data.body.data
          this.idToString()
        })
      },
      obtenerProductos()
      {
        servicioProductos.query().then(data => {
          this.products = data.body.data
          this.obtenerLocales()
        })
      },
      obtenerInventarios()
      {
        servicioInventario.query().then( data => {
          this.inventaries = data.body.data
          this.obtenerProductos()
        })
      }
    }
  }
</script>




<style scoped>

</style>
