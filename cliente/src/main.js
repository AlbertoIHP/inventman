// Instancia principal de Vue
import Vue from 'vue'

//Componentes utilizados
import App from './App'

//Fichero de configuracion de las rutas
import router from './router'


import VueMaterial from 'vue-material'
Vue.use(VueMaterial)

import Vuetify from 'vuetify'
Vue.use(Vuetify)

import('../node_modules/vuetify/dist/vuetify.min.css')
//Servicios
  //Servicio que permite obtener informacion desde el localStorage
import { LocalStorageCredentialsService } from './services';

//Las constantes en este caso son variables que no cambian en toda la ejecucion del codigo
import {address} from './constants'

//Traemos resource par aconsumir APIs
import VueResource from 'vue-resource'


//Usamos la librerai
Vue.use(VueResource)


//Instanciamos la clase de credenciales para poder ocupar sus metodos mediante un objeto
const credentials = new LocalStorageCredentialsService()


// ProductionTip no dice mucho en la documentacion
Vue.config.productionTip = false





//Agregamos cabeceras a todas las peticiones modificando los interceptores de la INSTANCIA de Vue, cosa de que cualquier elemento que haga uso de esta instancia utilizara estas cabezeras
Vue.http.interceptors.push((request, next) => {


console.log("SETEANDO TOKEN")
  //Se agrega el token de autorizacion, mediante el objeto de la clase LocalStorageCredentialsService
  request.headers.set('Authorization', 'Bearer '+credentials.getToken())

  //Se agrega la especificacion de Content-Type para que acepte ficheros de tipo JSON
  request.headers.set('Accept', 'application/json')

  //Hacemos referencia a la instancia de Vue con this
  let vm = this

  //Cuando se realicen peticiones a una API, cualquiera sea, se quedara esperando con una callback function y se seguira una logica en el cliente
  next( response => {

    //Si el servidor responde con un 401
    if (response.status === 401) {
      //Limpiamos las credenciales
      // credentials.clearCredentials()
    }

  })


})




//Instanciamos finalmente a Vue, y enlazamos dicha instancia, al elemento con la id app de nuestro index.html ubicado en la parte principal de la carpeta del proyecto, ademas le entregamos la configuracion de rutas, el template con el que puede ser utilziado, y finalmente nuestro componente principal ubicado en App.vue
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})