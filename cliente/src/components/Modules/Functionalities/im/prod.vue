<template>
  <section>

    <md-table-card>

      <md-toolbar>
        <h1 class="md-title">Productos </h1>
      </md-toolbar>

      <md-table>
        <md-table-header>
          <md-table-row>
            <md-table-head>Acciones </md-table-head>
            <md-table-head>Nombre </md-table-head>
            <md-table-head>Descripcion </md-table-head>
            <md-table-head>Proveedor </md-table-head>
            <md-table-head>Precio de Venta </md-table-head>
            <md-table-head>Costo de Compra </md-table-head>
            <md-table-head>Tipo de Producto </md-table-head>
            <md-table-head>Codigo  </md-table-head>
            <md-table-head>Categoria de Producto </md-table-head>
            <md-table-head>Imagen (URL) </md-table-head>
          </md-table-row>

        </md-table-header>

        <md-table-body>
          <md-table-row v-for="product in products" >
            <md-table-cell>
              <div class="row">
                <div class="col s6">
              <md-button @click="editar(product, 'editProduct')"><md-icon>edit</md-icon></md-button>
                </div>
                <div class="col s6">
              <md-button @click="borrar(product)"><md-icon>delete</md-icon></md-button>
                </div>
              </div>
            </md-table-cell>

            <md-table-cell>
              {{ product.name }}
            </md-table-cell>
            <md-table-cell>
              {{ product.description }}
            </md-table-cell>
            <md-table-cell>
              {{ product.providers_id }}
            </md-table-cell>

            <md-table-cell>
              {{ product.price }}
            </md-table-cell>


            <md-table-cell>
              {{ product.cost }}
            </md-table-cell>


            <md-table-cell>
              {{ product.productstypes_id }}
            </md-table-cell>


            <md-table-cell>
              {{ product.code }}
            </md-table-cell>


            <md-table-cell>
              {{ product.productscategories_id }}
            </md-table-cell>


            <md-table-cell>
              {{ product.urlimage }}
            </md-table-cell>

          </md-table-row>
        </md-table-body>
      </md-table>

      <md-table-pagination
        md-size="5"
        v-bind:md-total="products.length"
        md-page="1"
        md-label="Elementos"
        md-separator="de"
        :md-page-options="[5, 10, 25, 50]"></md-table-pagination>
    </md-table-card>




    <md-button  class="md-fab md-fab-bottom-right" id="addProduct" @click="openDialog('addProduct')">
      <md-icon>add</md-icon>
    </md-button>



    <md-dialog md-open-from="#addProduct" md-close-to="#addProduct" ref="addProduct">
      <md-dialog-title>Agregar nuevo Producto</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre del Producto</label>
          <md-input type="text"  v-model="newProduct.name"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Descripcion del Producto</label>
          <md-input type="text"  v-model="newProduct.description"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Precio del Producto</label>
          <md-input type="text"  v-model="newProduct.price"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Costo del Producto</label>
          <md-input type="text"  v-model="newProduct.cost"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Codigo del Producto</label>
          <md-input type="text"  v-model="newProduct.code"></md-input>
        </md-input-container>

        <md-input-container>
          <label>URL de la Imagen del Producto</label>
          <md-input type="text"  v-model="newProduct.urlimage"></md-input>
        </md-input-container>


        <md-input-container>
          <label for="movie">Proveedor del Producto</label>
          <md-select name="movie" id="movie" v-model="newProduct.providers_id">
            <md-option v-for="provider in providers" v-bind:value="provider.id" >{{provider.name}}</md-option>
          </md-select>
        </md-input-container>


        <md-input-container>
          <label for="movie">Tipo del Producto</label>
          <md-select name="movie" id="movie" v-model="newProduct.productstypes_id">
            <md-option v-for="type in productstypes" v-bind:value="type.id" >{{type.name}}</md-option>
          </md-select>
        </md-input-container>


        <md-input-container>
          <label for="movie">Categoria del Producto</label>
          <md-select name="movie" id="movie" v-model="newProduct.productscategories_id">
            <md-option v-for="categorie in productscategories" v-bind:value="categorie.id" >{{categorie.name}}</md-option>
          </md-select>
        </md-input-container>






      </md-dialog-content>



      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('addProduct')">Cancelar</md-button>
        <md-button class="md-primary" @click="agregarProduct('addProduct')">Agregar</md-button>
      </md-dialog-actions>
    </md-dialog>






    <md-dialog md-open-from="#addCity" md-close-to="#addCity" ref="editProduct">
      <md-dialog-title>Edicion de Producto</md-dialog-title>

      <md-dialog-content>
        <md-input-container>
          <label>Nombre del Producto</label>
          <md-input type="text"  v-model="editProduct.name"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Descripcion del Producto</label>
          <md-input type="text"  v-model="editProduct.description"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Precio del Producto</label>
          <md-input type="text"  v-model="editProduct.price"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Costo del Producto</label>
          <md-input type="text"  v-model="editProduct.cost"></md-input>
        </md-input-container>

        <md-input-container>
          <label>Codigo del Producto</label>
          <md-input type="text"  v-model="editProduct.code"></md-input>
        </md-input-container>

        <md-input-container>
          <label>URL de la Imagen del Producto</label>
          <md-input type="text"  v-model="editProduct.urlimage"></md-input>
        </md-input-container>


        <md-input-container>
          <label for="movie">Proveedor del Producto</label>
          <md-select name="movie" id="movie" v-model="editProduct.providers_id">
            <md-option v-for="provider in providers" v-bind:value="provider.id" >{{provider.name}}</md-option>
          </md-select>
        </md-input-container>


        <md-input-container>
          <label for="movie">Tipo del Producto</label>
          <md-select name="movie" id="movie" v-model="editProduct.productstypes_id">
            <md-option v-for="type in productstypes" v-bind:value="type.id" >{{type.name}}</md-option>
          </md-select>
        </md-input-container>


        <md-input-container>
          <label for="movie">Categoria del Producto</label>
          <md-select name="movie" id="movie" v-model="editProduct.productscategories_id">
            <md-option v-for="categorie in productscategories" v-bind:value="categorie.id" >{{categorie.name}}</md-option>
          </md-select>
        </md-input-container>
      </md-dialog-content>

      <md-dialog-actions>
        <md-button class="md-primary" @click="closeDialog('editProduct')">Cancelar</md-button>
        <md-button class="md-primary" @click="editarProduct('editProduct')">Editar</md-button>
      </md-dialog-actions>
    </md-dialog>




  </section>
</template>


<script>
  import { ApiConnect } from '@/services'
  const servicioPT = new ApiConnect('productTypes')
  const servicioPC = new ApiConnect('productCategories')
    const servicioProveedor = new ApiConnect('providers')
  const servicioProducto = new ApiConnect('products')

  import axi from 'axios';
import { LocalStorageCredentialsService }  from '@/services'

  var a = new LocalStorageCredentialsService()
  const axios = axi.create({
  headers: {'Authorization': 'Bearer '+a.getToken()}
});



  export default {
    created(){
      this.obtenerProductos()

    },
    data () {
      return {
        products: [],
        newProduct: {id: 0, name: "",  description: "", providers_id: 0, price: "", cost: "", productstypes_id: 0, code: "", productscategories_id: 0, urlimage: ""},
        editProduct:{id: 0, name: "",  description: "", providers_id: 0, price: "", cost: "", productstypes_id: 0, code: "", productscategories_id: 0, urlimage: ""},
        productstypes: [],
        productscategories: [],
        providers: []
      }
    },
    methods: {
      idToString()
      {
        for( let x =0 ; x < this.products.length ; x ++)
        {

          for(let i = 0 ; i < this.productstypes.length ; i++)
          {
            if(parseInt(this.products[x].productstypes_id) ===  parseInt(this.productstypes[i].id))
            {
              this.products[x].productstypes_id =this.productstypes[i].name
              break;
            }
          }

          for(let i = 0 ; i < this.productscategories.length ; i++)
          {
            if(parseInt(this.products[x].productscategories_id) ===  parseInt(this.productscategories[i].id))
            {
              this.products[x].productscategories_id =this.productscategories[i].name
              break;
            }
          }

          for(let i = 0 ; i < this.providers.length ; i++)
          {
            if(parseInt(this.products[x].providers_id) ===  parseInt(this.providers[i].id))
            {
              this.products[x].providers_id =this.providers[i].name
              break;
            }
          }


        }
      },
      StringToId(product)
      {
        for(let i = 0 ; i < this.providers.length ; i++)
        {
          if(product.providers_id ===  this.providers[i].name)
          {
            product.providers_id  =  parseInt(this.providers[i].id)
            break;
          }
        }

        for(let i = 0 ; i < this.productscategories.length ; i++)
        {
          if(product.productscategories_id ===  this.productscategories[i].name)
          {
            product.productscategories_id  =  parseInt(this.productscategories[i].id)
            break;
          }
        }
        for(let i = 0 ; i < this.productstypes.length ; i++)
        {
          if(product.productstypes_id ===  this.productstypes[i].name)
          {
            product.productstypes_id  =  parseInt(this.productstypes[i].id)
            break;
          }
        }



      },
      obtenerProveedores()
      {
        servicioProveedor.query().then(data => {
          this.providers = data.body.data
          this.idToString()
        })
      },
      obtenerPC()
      {
        servicioPC.query().then(data => {
          this.productscategories = data.body.data
          this.obtenerProveedores()
        })
      },
      obtenerPT()
      {
        servicioPT.query().then(data => {
          this.productstypes = data.body.data
          this.obtenerPC()

        })
      },
      obtenerProductos()
      {
        servicioProducto.query().then( data => {
          this.products = data.body.data
          this.obtenerPT()
        })
      },
      openDialog(ref) {
        this.$refs[ref].open();
      },
      closeDialog(ref){
        this.$refs[ref].close();
      },
      agregarProduct(ref)
      {
        servicioProducto.save(this.newProduct).then(data => {
          this.newProduct = {id: 0, name: "",  description: "", providers_id: 0, price: "", cost: "", productstypes_id: 0, code: "", productscategories_id: 0, urlimage: ""}
          this.obtenerProductos()
          this.$refs[ref].close();
        })
      },
      borrar(producto)
      {
        axios.delete(servicioProducto.getEndpoint()+'/'+JSON.stringify(producto.id))
        .then(response => {
          this.obtenerProductos()
        })
      },
      editar(producto, ref)
      {
        this.editProduct = JSON.parse(JSON.stringify(producto));
        this.StringToId(this.editProduct)
        this.$refs[ref].open();
      },
      editarProduct(ref)
      {

        axios.put(servicioProducto.getEndpoint()+'/'+JSON.stringify(this.editProduct.id), this.editProduct).then(data => {
          this.obtenerProductos()
          this.$refs[ref].close();
        })
      }
    }
  }
</script>




<style scoped>

</style>
