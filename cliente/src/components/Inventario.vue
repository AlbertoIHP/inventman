<template>
  <section>
    <div class="row">
      <div class="col s12">
        <h5 style="text-align: center; margin-top: 3px">{{tipoBusqueda}}</h5>
      </div>
    </div>



    <md-button class="md-fab md-fab-bottom-right" id="fab" @click="openDialog('dialog2')">
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
        <md-button class="md-primary" @click="closeDialog('dialog2')">Cancel</md-button>
        <md-button class="md-primary" @click="closeDialog('dialog2')">Create</md-button>
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
        productosMostrar: []
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
      openDialog(ref) {
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

</style>
