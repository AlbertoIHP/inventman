<template>
  <section>
      <div class="row contenedorLogin" >
          <img src="https://images.g2crowd.com/uploads/product/image/social_landscape/social_landscape_1489714293/zoho-inventory.png"  style="z-index:1" class="overImage">
          
         <v-card style="height: 100%">
            <v-card-media src="http://resources.emaze.com/vbscenes/layoutimages/635341971811770951_background3jpg" alt="Skyscraper" style="height: 500px">

          <v-container fluid style="min-height: 0;z-index:6;padding-top:30%" grid-list-lg >
            <v-layout row wrap>
              <v-flex xs12>
                <v-card style="background-color: rgba(0, 0, 0, .4);" class="white--text">

                     <v-container fluid grid-list-md>
       
                        <v-layout row>
                          <v-flex xs12>
                            <v-text-field
                              name="input-1"
                              label="Correo electronico"
                              type="email" 
                              v-model="credentials.email"
                              class="white--text"
                              dark
                              prepend-icon="person"
                            ></v-text-field>
                          </v-flex>
                        
                        </v-layout>
                        <v-layout row>
                          <v-flex xs12>
                            <v-text-field
                              name="input-1-3"
                              label="Contraseña"
                              type="password" 
                              v-model="credentials.password"
                              class="white--text"
                              dark
                              prepend-icon="lock"
                            ></v-text-field>
                          </v-flex>
                        
                        </v-layout>
                       
                      </v-container>
                    
                      <v-card-actions align-center>
                        <v-btn flat dark @click="iniciarSesion()" style="width:100%;" >Iniciar sesión</v-btn>
                      </v-card-actions>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>                
         </v-card-media>
        </v-card> 
          
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
