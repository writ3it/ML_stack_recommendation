import Vue from 'vue'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify);

import App from './App.vue'


Vue.config.productionTip = false;

new Vue({
  render: h => h(App),
}).$mount('#app');
