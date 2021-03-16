require('./bootstrap');

import Vue from 'vue'

Vue.component('navigate', require('./components/navigate.vue').default);

const app = new Vue({
  el: '#app',
});
