/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import axios from 'axios'
// import VueAxios from 'vue-axios'
require('./bootstrap');
window.Vue = require('vue');
import 'vue-loaders/dist/vue-loaders.css';
import VueLoaders from 'vue-loaders';
import 'sweetalert2/dist/sweetalert2.min.css';
import VueSweetalert2 from 'vue-sweetalert2';
import VueTailwindModal from 'vue-tailwind-modal'




Vue.use(VueTailwindModal);
Vue.use(require('vue-moment'));
Vue.use(VueLoaders);
Vue.use(require('vue-resource'));
Vue.use(VueSweetalert2);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/TwitterApp.vue -> <example-component></example-component>
 */



Vue.component('twitter-app', require('./components/TwitterApp.vue').default);
Vue.component('navbar-component', require('./components/Navbar.vue').default);
Vue.component('footer-component', require('./components/Footer.vue').default);
Vue.component('modal', require('./components/Modal.vue').default);
Vue.component('tweet', require('./components/Tweet.vue').default);
Vue.component('InfiniteLoading', require('vue-infinite-loading'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
