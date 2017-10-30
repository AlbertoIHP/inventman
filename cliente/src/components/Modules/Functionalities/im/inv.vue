<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Inventarios</h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Local  </md-table-head>
            <md-table-head>Producto </md-table-head>
            <md-table-head>Cantidad en Stock </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="inventarie in inventaries" >

            <md-table-cell>
              {{ inventarie.locals_id }}
            </md-table-cell>

            <md-table-cell>
              {{ inventarie.products_id }}
            </md-table-cell>
            <md-table-cell>
              {{ inventarie.amount }}
            </md-table-cell>

          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="inventaries.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>


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
        products: []
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
