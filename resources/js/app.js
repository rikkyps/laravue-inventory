require('./bootstrap');

import Vue from 'vue'
import router from './routes'

import App from './layouts/App.vue'

new Vue({
    router,
    el: '#app',
    render: h => h(App)
})
