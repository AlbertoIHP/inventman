<template>
  <section>
    <div class="row">
      <div class="col s12">
        <h5 style="text-align: center; margin-top: 3px">{{tipoBusqueda}}</h5>
      </div>
    </div>


   <v-container fluid grid-list-sm v-for="producto in arregloAuxiliar"  fluid grid-list-md>

    <v-layout row justify-center>

      <v-flex d-flex xs12 sm6 md3 row wrap v-if="producto[0]">
        
        
        <v-card class="tarjetaProducto">
          <v-card-media>
            <img v-bind:src="producto[0].urlimage" class="imagenProducto">
          </v-card-media>

          <v-card-title>
            <div class="">{{producto[0].name}} </div>
            <div class="">{{producto[0].description}}</div>
          </v-card-title>

          <v-card-actions>
            <v-btn @click="openDialog('detallesProducto', producto[0])">Ver detalles</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>

      <v-flex d-flex xs12 sm6 md3  v-else >
      </v-flex>

      <v-flex d-flex xs12 sm6 md3 v-if="producto[1]" >      
        <v-card class="tarjetaProducto">
          <v-card-media>
            <img v-bind:src="producto[1].urlimage"  class="imagenProducto">
          </v-card-media>

          <v-card-title>
            <div class="">{{producto[1].name}} </div>
            <div class="">{{producto[1].description}}</div>
          </v-card-title>

          <v-card-actions>
            <v-btn @click="openDialog('detallesProducto', producto[1])">Ver detalles</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>

      <v-flex d-flex xs12 sm6 md3  v-else >
      </v-flex>

    </v-layout>
  </v-container>



    <v-btn style="position: fixed" class="" id="fab" @click="openDialog('dialog2')">
      <v-icon>add</v-icon>
    </v-btn>

    <v-dialog md-open-from="#fab" md-close-to="#fab" ref="dialog2">
      <v-dialog>Create new note</v-dialog>

      <v-dialog>
        <form>
          <v-container fluid>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="input-1"
                label="Note"
                textarea
              ></v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
        </form>
      </v-dialog>

      <v-dialog>
        <v-btn class="md-primary" @click="closeDialog('dialog2', '')">Cancel</v-btn>
        <v-btn class="md-primary" @click="closeDialog('dialog2', '')">Create</v-btn>
      </v-dialog>
    </v-dialog>

    <v-dialog md-open-from="#fab" md-close-to="#fab" ref="detallesProducto">
      <v-dialog>Detalles producto {{detalle.name}}</v-dialog>

      <v-dialog>
        <form>
          <v-container fluid>
          <v-layout row>
            <v-flex xs12>
              <v-text-field
                name="input-1"
                label="Note"
                textarea
              ></v-text-field>
            </v-flex>
          </v-layout>
        </v-container>
        </form>
      </v-dialog>

      <v-dialog>
        <v-btn class="md-primary" @click="closeDialog('detallesProducto')">Cancel</v-btn>
        <v-btn class="md-primary" @click="closeDialog('detallesProducto')">Create</v-btn>
      </v-dialog>
    </v-dialog>


  </section>
</template>


<script>
  import {ApiConnect } from '@/services'
  const servicioProductos = new ApiConnect('products')
  const servicioCategoria = new ApiConnect('productCategories')
  const servicioTipo = new ApiConnect('productTypes')

  export default {
    data() {
      return{
        tipoBusqueda: "",
        productos: [],
        categorias: [],
        tipos: [],
        productosMostrar: [],
        detalle: {name: ""},
        arregloAuxiliar: [],
        usuarioActual: ""
      }
    },
    created() {
      if( (this.usuarioActual = localStorage.getItem('user')))
      {
        this.$parent.$on("buscar", ()=>{
        this.buscar()
        })

        servicioCategoria.query().then(data =>{
          this.categorias =data.body.data;
        })

        servicioTipo.query().then(data => {
          this.tipos =data.body.data;
        })


        this.buscar()
      }
      else
      {
        this.$router.push('/')
      }
    },
    methods:
    {
      openDialog(ref, producto) {
        if(producto)
        {
        this.detalle = producto
        }

        this.$refs[ref].open();
      },
      closeDialog(ref) {
        this.$refs[ref].close();
      },
      onOpen() {
        console.log('Opened');
      },
      onClose(type) {
        console.log('Closed', type);
      },
      buscar()
      {
        var tipo
        try {
          tipo = JSON.parse(localStorage.getItem('buscarPor'))
          this.consultarProductos(tipo)
    }
    catch(err) {
        tipo = ""
        this.consultarProductos(tipo)
    }



      },
      organizarArreglo()
      {

        this.arregloAuxiliar = []
        var cont = 0
        for (let x = 0 ; x < this.productosMostrar.length ; x = x + 2)
        {
          this.arregloAuxiliar.push([])
          if( this.productosMostrar[x] )
          {
          this.arregloAuxiliar[cont].push(this.productosMostrar[x])
          }

          if(this.productosMostrar[(x+1)])
          {
          this.arregloAuxiliar[cont].push(this.productosMostrar[(x+1)])
        }

          cont++
        }

        console.log("MOSTRANDO ARREGLO AUXILIAR")
        console.log(this.arregloAuxiliar)
      },
      consultarProductos(tipo)
      {

        if(tipo === "")
        {
            servicioProductos.query().then(data => {
            this.productos = data.body.data
            this.tipoBusqueda = "Todos los Productos"
            this.productosMostrar = this.productos
            this.organizarArreglo();
          })
        }
        else
        {
          this.tipoBusqueda = tipo.nombre
          this.productosMostrar = []
          if(tipo.tipo === "categoria")
          {
            for( let i = 0 ; i < this.productos.length ; i ++)
            {
              if(parseInt(this.productos[i].productscategories_id) === parseInt(tipo.id))
              {
                this.productosMostrar.push(this.productos[i])
              }
            }
          }
          else if(tipo.tipo === "tipo")
          {
            for( let i = 0 ;i <  this.productos.length ; i ++)
            {
              if(parseInt(this.productos[i].productstypes_id) === parseInt(tipo.id))
              {
                this.productosMostrar.push(this.productos[i])
              }
            }
          }
          this.organizarArreglo();
        }
      }
    }
  }
</script>




<style scoped>
.imagenProducto
{
  width: 100%;
   height: 202px;
    max-width: 100%;
    max-height: 202px;
}

.tarjetaProducto
{

  width: 60%;
  margin-bottom: 30px;
}
</style>
