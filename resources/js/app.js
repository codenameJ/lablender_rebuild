require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');

import Vue from 'vue';
import Vuetify from 'vuetify';
import Vuex from 'vuex';
import router from './router';
import StoreData from './store';

import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);
Vue.use(Vuex);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('homelayout', require('./components/homelayout.vue').default);
Vue.component('applayout', require('./components/applayout.vue').default);
Vue.component('welcome-card', require('./components/welcomecard.vue').default);
Vue.component('lendingcart', require('./components/lendingcart.vue').default);

const store = new Vuex.Store(
    StoreData);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    store,
});

Vue.use(Vuetify, {
    iconfont: 'mdi',
});