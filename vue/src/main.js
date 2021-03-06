// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import VueCookie from 'vue-cookie'
import VueResource from 'vue-resource'
import App from './App'
import router from './router'
import auth from '@/auth/auth'
import 'skeleton-css/css/normalize.css'
import 'skeleton-css/css/skeleton.css'
import './styles/main.scss'

Vue.config.productionTip = false
Vue.use(VueCookie)
Vue.use(VueResource)

auth.refresh()
/* eslint-disable no-new */
var vm = new Vue({
  el: '#app',
  router,
  template: '<App/>',
  data () {
    return {
      auth: auth
    }
  },
  components: { App }
})

vm.test = 'test'

Vue.http.interceptors.push((req, next) => {
  next((res) => {
    /*
    if (res.status === 403) {
      auth.logoutFront()
    }
    vm.user = auth.user
    */
  })
})
