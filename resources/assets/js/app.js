
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

// require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/pt-br'
Vue.use(ElementUI, { locale })

import Places from 'vue-places'
Vue.use(Places)

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)


/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('students', require('./components/Students.vue'));
Vue.component('disciplines', require('./components/Disciplines.vue'));
Vue.component('notes', require('./components/Notes.vue'));

const app = new Vue({
  el: '#app'
});
