<template>
  <section>
    <md-layout md-gutter>
      <md-layout
      class="card-container"
      md-flex-xsmall="100"
      md-flex="50">
        <md-card md-flex>
           <md-card-header style="background-color: #b3ffb3">
            <div class="md-title">Producto mas vendido</div>
          </md-card-header>
          <md-card-content>
            <md-card-media>
              <img style="max-width: 50%; margin-left:20%;" src="https://sparta.cl/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/8/3/833591-452-1.jpg" alt="People">
            </md-card-media>
          </md-card-content>

          <md-card-header>
            <div class="md-title">Polera Nike</div>
          </md-card-header>
  
          <md-card-content>
            <p>Temporada: Verano</p>
            <p>Precio: $000</p>
            <p>Stock: 21</p>
            <p>Vendidas: 35</p>
            <p>Ultimo pedido: 4/11/2017</p>
            <p>Material: 50% algodon</p>
          </md-card-content>

          <md-card-actions>
            <md-button class="md-raised md-primary">Ver</md-button>
            <md-button class="md-raised md-primary">Actualizar información</md-button>
          </md-card-actions>

        </md-card>
      </md-layout>

      <md-layout 
      class="card-container"
      md-flex-xsmall="100"
      md-flex="50">
        <md-card>
         <md-card-content>
            <md-table v-once>
              <md-table-header>
                <md-table-row>
                  <md-table-head>Información general del dia</md-table-head>
                </md-table-row>
              </md-table-header>
              <md-table-body>
                <md-table-row v-for="(row, index) in 5" :key="index">
                  <md-table-cell>Información</md-table-cell>
                </md-table-row>
              </md-table-body>
            </md-table>
          </md-card-content>
        </md-card>
      </md-layout>

      <md-layout 
      class="card-container"
      md-flex="100">
        <md-card>
          <md-card-content>
            <md-layout>
              <highcharts 
              md-flex-xsmall="100"
              md-flex="50" 
              :options="ventastiempooptions" 
              ref="highchartsventastiempo">
              </highcharts>
              <highcharts 
              md-flex-xsmall="100"
              md-flex="50" 
              :options="clientestiempooptions" 
              ref="highchartsclientestiempo">
              </highcharts>
            </md-layout>
          </md-card-content>
        </md-card>
      </md-layout>
    </md-layout>
  </section>
</template>


<script>
  export default {
    created()
    {
      if( (this.usuarioActual = localStorage.getItem('user')))
      {
      }
      else
      {
        this.$router.push('/')
      }
    },
    data(){
      return {
        hello: "hello",
        usuarioActual: '',
        ventastiempooptions : {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Ventas/Tiempo',
            x: -20 //center
          },
          subtitle: {
            text: 'Subtitulo',
            x: -20
          },
          xAxis: {
            categories: [
            "13:00",
            "14:00",
            "16:00"
            ]
          },
          yAxis: {
            title: {
              text: 'Ventas'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          tooltip: {
            valueSuffix: 'u'
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          },
          series: [{
            name: 'Poleras',
            data: [7.0, 6.9, 9.5]
          }, {
            name: 'Zapatillas',
            data: [0.2, 0.8, 5.7]
          }, {
            name: 'Otra cosa',
            data: [0.9, 0.6, 3.5]
          }, {
            name: 'Otra otra cosa',
            data: [3.9, 4.2, 5.7]
          }]
        },
        clientestiempooptions : {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Ventas/Tiempo',
            x: -20 //center
          },
          subtitle: {
            text: 'Subtitulo',
            x: -20
          },
          xAxis: {
            categories: [
            "13:00",
            "14:00",
            "16:00"
            ]
          },
          yAxis: {
            title: {
              text: 'Ventas'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#808080'
            }]
          },
          tooltip: {
            valueSuffix: '°C'
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          },
          series: [{
            name: 'Poleras',
            data: [7.0, 6.9, 9.5]
          }, {
            name: 'Zapatillas',
            data: [0.2, 0.8, 5.7]
          }, {
            name: 'Otra cosa',
            data: [0.9, 0.6, 3.5]
          }, {
            name: 'Otra otra cosa',
            data: [3.9, 4.2, 5.7]
          }]
        }
      }
    },
    methods:
    {

    }
  }
</script>




<style scoped>
  .md-layout {
    padding: 5px;
  }

  .md-card {
    padding: 5px;
  }

  .md-card-header {
    border-radius: 2%;
    color: #006622;
  }

  .md-card {
    width: 100%;
  }
</style>
