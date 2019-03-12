import Vue from 'vue'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import vSelect from 'vue-select'

Vue.use(Vuetify);
Vue.component('v-select2', vSelect)
import App from './App.vue'


Vue.config.productionTip = false;

new Vue({
  render: h => h(App),
}).$mount('#app');
