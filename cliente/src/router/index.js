//Se importa la instancia principal de Vue
import Vue from 'vue'

//Se importa el componentes de ruta de Vue
import Router from 'vue-router'

//Importamos todos los componentes que deseemos enrutar
import Pagina1 from '@/components/Pagina1'
import Pagina2 from '@/components/Pagina2'
import Pagina3 from '@/components/Pagina3'

//Entregamos a Vue el componente de rutas para que este lo utilice en todos los sub componentes, o todos aquellos que utilicen esta instancia
Vue.use(Router)

//Configuramos las rutas, con path se especifica la URI que tomara ese componente, el nombre su nombre, en component especificamos que compoente sera segun se haya importado, y con redirect es que en caso de detectar ese path nos llevara a esa URI, en este caso se pone solo con fines didacticos
export default new Router({
  routes:
  [
    {
      path: '/',
      name: 'Pagina1',
      component: Pagina1
    },
    {
      path: '/pagina2',
      name: 'Pagina2',
      component: Pagina2
    },
    {
      path: '/pagina3',
      name: 'Pagina3',
      component: Pagina3
    }
  ]
})
