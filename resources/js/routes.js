import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/auth/login.vue';
import Register from './components/auth/register.vue';

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', name: 'login', component: Login },
    { path: '/register', name: 'register', component: Register }
  ]

})

export default router