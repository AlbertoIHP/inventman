<template>
  <section>
      <div class="row contenedorLogin" >
          <img src="https://images.g2crowd.com/uploads/product/image/social_landscape/social_landscape_1489714293/zoho-inventory.png"  class="overImage">
        <md-card style="height: 100%">
          <md-card-media-cover md-solid>
            <md-card-media >
              <img src="http://resources.emaze.com/vbscenes/layoutimages/635341971811770951_background3jpg" alt="Skyscraper" style="height: 500px" >

            </md-card-media>

            <md-card-area>
              <md-card-header>
                <md-input-container>
                <md-icon style="color: white">person</md-icon>
                <label style="color: white">Corre electronico</label>
                <md-input type="email" v-model="credentials.email" style="color: white !important"></md-input>
              </md-input-container>

              <md-input-container>
              <md-icon style="color: white">lock</md-icon>
              <label style="color: white">Contraseña</label>
              <md-input type="password" v-model="credentials.password" style="color: white" ></md-input>
            </md-input-container>
              </md-card-header>

              <md-card-actions>
                <md-button @click="iniciarSesion()" style="width: 100%">Iniciar Sesion</md-button>
              </md-card-actions>
            </md-card-area>
          </md-card-media-cover>
        </md-card>
      </div>
  </section>
</template>


<script>
import { loginService } from '@/services/Auth.service.js'
import { LocalStorageCredentialsService }  from '@/services'

  export default {
    data(){
      return {
        credentials: { email: "",  password: ""},
        credentialService: new LocalStorageCredentialsService()
      }
    },
    methods:
    {
      iniciarSesion()
      {
        if (!(this.credentials.email === "" || this.credentials.password === "") )
        {
          loginService.authenticate(this.credentials).then(data => {
            this.credentialService.setToken(data.body.token)
            this.credentialService.setCurrentUser(this.credentials.email)
            this.$root.$emit('inicioSesion')
            this.$router.push('/home')
          })
        }
      },
      registrarme()
      {

      }
    }
  }
</script>




<style scoped>
.contenedorLogin
{
  margin-left: 25%;
    margin-right: 25%;
    margin-top: -200px;
}
.overImage
{
  z-index: 5;
position: relative;
top: 250px;
height: 70%;
width: 70%;
left: 100px;
}
</style>
