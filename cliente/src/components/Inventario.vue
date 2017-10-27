<template>
  <section>
    <div class="row">
      <div class="col s12">
        <h5 style="text-align: center; margin-top: 3px">{{tipoBusqueda}}</h5>
      </div>
    </div>

    <md-layout md-gutter  v-for="(producto, index) in productosMostrar">
      <md-layout   md-flex-offset="20">
        <md-card class="tarjetaProducto">
          <md-card-media>
            <img src="http://www.bellezachile.cl/users/producto/493.jpg" class="imagenProducto">
          </md-card-media>

          <md-card-header>
            <div class="md-title">{{producto.name}} </div>
            <div class="md-subhead">{{producto.description}}</div>
          </md-card-header>

          <md-card-actions>
            <md-button  @click="openDialog('detallesProducto', producto)">Ver detalles</md-button>
          </md-card-actions>
        </md-card>
      </md-layout>

      <md-layout  >
        <md-card class="tarjetaProducto">
          <md-card-media>
            <img src="http://www.bellezachile.cl/users/producto/493.jpg" class="imagenProducto">
          </md-card-media>

          <md-card-header>
            <div class="md-title">{{producto.name}} </div>
            <div class="md-subhead">{{producto.description}}</div>
          </md-card-header>

          <md-card-actions>
            <md-button @click="openDialog('detallesProducto', producto)">Ver detalles</md-button>
          </md-card-actions>
        </md-card>
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
        detalle: {name: ""}
      }
    },
    created() {
      this.$parent.$on("buscar", ()=>{
      this.buscar()
      })

      servicioCategoria.query().then(data =>{
        this.categorias =data.body.data;
      })

      servicioTipo.query().then(data => {
        this.tipos =data.body.data;
      })

      localStorage.clear('buscarPor')
      this.buscar("")
    },
    methods:
    {
      openDialog(ref, producto) {
        this.detalle = producto
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

        if( !(tipo = JSON.parse(localStorage.getItem('buscarPor'))))
        {
          tipo = ""
        }

        this.consultarProductos(tipo)
      },
      consultarProductos(tipo)
      {

        if(tipo === "")
        {
            servicioProductos.query().then(data => {
            this.productos = data.body.data
            this.tipoBusqueda = "Todos los Productos"
            this.productosMostrar = this.productos
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

        }
        console.log(this.productosMostrar)
      }
    }
  }
</script>




<style scoped>
.imagenProducto
{
  width: 100%;
   height: 105px;
    max-width: 100%;
    max-height: 150px;
}

.tarjetaProducto
{

  width: 60%;
  margin-bottom: 30px;
}
</style>
