<template>
  <section>
    <div class="row">
      <div class="col s12">
        <h5 style="text-align: center; margin-top: 3px">{{tipoBusqueda}}</h5>
      </div>
    </div>

    <md-layout md-gutter  v-for="producto in arregloAuxiliar">
      <md-layout   md-flex-offset="20" v-if="producto[0]">
        <md-card class="tarjetaProducto">
          <md-card-media>
            <img v-bind:src="producto[0].urlimage" class="imagenProducto">
          </md-card-media>

          <md-card-header>
            <div class="md-title">{{producto[0].name}} </div>
            <div class="md-subhead">{{producto[0].description}}</div>
          </md-card-header>

          <md-card-actions>
            <md-button  @click="openDialog('detallesProducto', producto[0])">Ver detalles</md-button>
          </md-card-actions>
        </md-card>
      </md-layout>
      <md-layout v-else >

      </md-layout>


      <md-layout v-if="producto[1]" >
        <md-card class="tarjetaProducto">
          <md-card-media>
            <img v-bind:src="producto[1].urlimage"  class="imagenProducto">
          </md-card-media>

          <md-card-header>
            <div class="md-title">{{producto[1].name}} </div>
            <div class="md-subhead">{{producto[1].description}}</div>
          </md-card-header>

          <md-card-actions>
            <md-button @click="openDialog('detallesProducto', producto[1])">Ver detalles</md-button>
          </md-card-actions>
        </md-card>
      </md-layout>
      <md-layout v-else >

      </md-layout>
      <br>
    </md-layout>

    <md-button style="position: fixed" class="md-fab md-fab-bottom-right" id="fab" @click="openDialog('dialog2')">
      <md-icon>add</md-icon>
    </md-button>

    <md-dialog md-open-from="#fab" md-close-to="#fab" ref="dialog2">
      <md-dialog-title>Create new note</md-dialog-title>

      <md-dialog-content>
        <form>
          <md-input-container>
            <label>Note</label>
            <md-textarea></md-textarea>
          </md-input-container>
        </form>
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('dialog2', '')">Cancel</md-button>
        <md-button class="md-primary" @click="closeDialog('dialog2', '')">Create</md-button>
      </md-dialog-actions>
    </md-dialog>

    <md-dialog md-open-from="#fab" md-close-to="#fab" ref="detallesProducto">
      <md-dialog-title>Detalles producto {{detalle.name}}</md-dialog-title>

      <md-dialog-content>
        <form>
          <md-input-container>
            <label>Note</label>
            <md-textarea></md-textarea>
          </md-input-container>
        </form>
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('detallesProducto')">Cancel</md-button>
        <md-button class="md-primary" @click="closeDialog('detallesProducto')">Create</md-button>
      </md-dialog-actions>
    </md-dialog>


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
