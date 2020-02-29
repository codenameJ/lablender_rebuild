require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

import Vue from 'vue';
import Vuetify from 'vuetify';
import Vuex from 'vuex';
import router from './router';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);
Vue.use(Vuex);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('homelayout', require('./components/homelayout.vue').default);
Vue.component('applayout', require('./components/applayout.vue').default);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
});

Vue.use(Vuetify, {
    iconfont: 'mdi',
});

const store = new Vuex.Store({
    state: {
      count: 0
    },
    mutations: {
      increment (state) {
        state.count++
      }
    }
  });

