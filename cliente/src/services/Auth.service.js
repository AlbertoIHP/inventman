import ApiService from './ApiDefault.service.js'
import Vue from 'vue'
import VueResource from 'vue-resource'
import {address} from '@/constants/address.js'

Vue.use(VueResource)

class LoginService extends ApiService {
  constructor (endpoint) {
    super(endpoint)
    this.name = endpoint
  }
  authenticate (credentials) {
    return Vue.http.post(address.api + this.name, credentials)
  }
}

export const loginService = new LoginService('login')
