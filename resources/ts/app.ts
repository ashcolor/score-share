window.Vue = require('vue').default;

import Vue from 'vue'
import router from './router';
import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueAxios from 'vue-axios'
import axios from 'axios'

axios.defaults.withCredentials = true;

Vue.use(BootstrapVue);
Vue.use(BootstrapVueIcons)
Vue.use(VueAxios, axios);

new Vue({
    el: '#app',
    router: router,
});
