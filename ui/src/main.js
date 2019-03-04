import Vue from 'vue'
import VueMaterial from "vue-material"
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default-dark.css'
import VueMaterialSlider from 'vue-material-slider'
Vue.use(VueMaterialSlider);
Vue.use(VueMaterial);

import App from './App.vue'


Vue.config.productionTip = false;

new Vue({
  render: h => h(App),
}).$mount('#app');
