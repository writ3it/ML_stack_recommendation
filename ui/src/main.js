import Vue from 'vue'
import VueAnalytics from 'vue-analytics'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import vSelect from 'vue-select'
import VueResources from 'vue-resource'
import VueCookies from 'vue-cookies'
import { VueReCaptcha } from 'vue-recaptcha-v3'
import VueWebPush from './extend/vue-web-push'

import GA_ID from './analytic'
import config from './configuration'



Vue.use(Vuetify);
Vue.use(VueResources);
Vue.use(VueCookies);
Vue.use(VueReCaptcha, { siteKey: config.recaptcha_key });
Vue.use(VueAnalytics, {    id: GA_ID });
Vue.use(VueWebPush);
Vue.component('v-select2', vSelect);
VueCookies.config('7d');
import App from './App.vue'

Vue.config.productionTip = false;

new Vue({
  render: h => h(App)
}).$mount('#app');