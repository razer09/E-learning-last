//vue
import Vue from 'vue';

import VueRouter from 'vue-router';

window.Vue = Vue;

Vue.use(VueRouter);

import Vuex from "vuex";

Vue.use(Vuex);

//Player video
import VuePlyr from 'vue-plyr';
Vue.use(VuePlyr, {
  plyr: {
    fullscreen: { enabled: true }
  },
  emit: ['ended']
})


window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;

    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

} catch (e) {}

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

//axios
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;


//Sweet Alert
import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

// Chart.js
import Chart from 'chart.js';
