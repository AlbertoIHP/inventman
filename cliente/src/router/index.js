//Se importa la instancia principal de Vue
import Vue from 'vue'

//Se importa el componentes de ruta de Vue
import Router from 'vue-router'

//Importamos todos los componentes que deseemos enrutar
import Home from '@/components/Home'
import Actividad from '@/components/Actividad'
import Inventario from '@/components/Inventario'
import Login from '@/components/Login'
import InventaryModule from '@/components/Modules/InventaryModule'
import SellModule from '@/components/Modules/SellModule'
import UserModule from '@/components/Modules/UserModule'
//Entregamos a Vue el componente de rutas para que este lo utilice en todos los sub componentes, o todos aquellos que utilicen esta instancia
Vue.use(Router)

//Configuramos las rutas, con path se especifica la URI que tomara ese componente, el nombre su nombre, en component especificamos que compoente sera segun se haya importado, y con redirect es que en caso de detectar ese path nos llevara a esa URI, en este caso se pone solo con fines didacticos
export default new Router({
  routes:
  [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/home',
      name: 'Home',
      component: Home
    },
    {
      path: '/home/um',
      name: 'UserModule',
      component: UserModule
    },
    {
      path: '/home/im',
      name: 'InventaryModule',
      component: InventaryModule
    },
    {
      path: '/home/sm',
      name: 'SellModule',
      component: SellModule
    },
    {
      path: '/inventario',
      name: 'Inventario',
      component: Inventario
    },
    {
      path: '/actividad',
      name: 'Actividad',
      component: Actividad
    }
  ]
})
