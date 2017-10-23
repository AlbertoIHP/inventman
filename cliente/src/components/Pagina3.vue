<template>

  <section class="container well">

    <h3> Ciudades </h3>
    <table class="table table-bordered table-hovered">

      <thead>
        <th>ID</th>
        <th>Nombre</th>
      </thead>

      <tbody>
        <tr v-for="city in cities">
          <td>{{ city.id }}</td>
          <td>{{ city.name }}</td>
        </tr>
      </tbody>
    </table>

  </section>

</template>








<script>
  //Importamos el servicio
  import { CityService } from '@/services'
  const cityService = new CityService('cities')


  export default
  {
    data: () => ({
      cities: []
    }),
    mounted ()
    {
      cityService.query().then(data => {
        console.log(data)
        this.cities = data.body.data
      })
    }
  }
</script>










<style scoped>

</style>
