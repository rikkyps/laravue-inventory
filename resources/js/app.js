require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// import progress bar liblary
import VueProgressBar from 'vue-progressbar'
const options = {
    color: '#09e0d6',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed       : '2s',
      opacity     : '0.6s',
      termination : 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)

//import routes as globally
import {routes} from './routes'

//import User helpers as globally
import User from './helpers/User'
window.User = User

//import sweetalert2 as globally
import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast

import Notification from './helpers/Notification';
window.Notification = Notification

//Import vform as globally
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form

//Reload function to be a globally
window.Reload = new Vue()


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router
});
