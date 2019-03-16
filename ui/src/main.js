import Vue from 'vue'
import VueAnalytics from 'vue-analytics'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import vSelect from 'vue-select'
import VueResources from 'vue-resource'
import VueCookies from 'vue-cookies'

import GA_ID from './analytic'

Vue.use(Vuetify);
Vue.use(VueResources);
Vue.use(VueCookies);
Vue.use(VueAnalytics, {
    id: GA_ID
});
Vue.component('v-select2', vSelect);
VueCookies.config('7d');
import App from './App.vue'

Vue.config.productionTip = false;

new Vue({
  render: h => h(App),
}).$mount('#app');