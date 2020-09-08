/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//
// require('vue-image-lightbox/dist/vue-image-lightbox.min.css')
// import "../../public/css/jquery.lightbox.css";

require('./bootstrap');
import {store} from "./components/store/store";
window.Vue = require('vue');
import Vuetify from 'vuetify';

//Номер телефона
import VuePhoneNumberInput from 'vue-phone-number-input';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';
Vue.component('vue-phone-number-input', VuePhoneNumberInput);

import VCalendar from 'v-calendar';
Vue.use(VCalendar, {
    componentPrefix: 'vc',
});
//
import Lightbox from 'vue-easy-lightbox';
Vue.use(Lightbox);


// import VueLazyLoad from 'vue-lazyload'
// Vue.use(VueLazyLoad)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('news-component', require('./components/NewsComponent.vue').default);
Vue.component('tab-all', require('./components/TabAllNews.vue').default);
Vue.component('tab-news', require('./components/TabNews.vue').default);
Vue.component('tab-stocks', require('./components/TabStocks.vue').default);
//media
Vue.component('media-component', require('./components/MediaComponent.vue').default);
Vue.component('tab-media', require('./components/TabAllMedia.vue').default);
Vue.component('tab-foto', require('./components/TabFotos.vue').default);
Vue.component('tab-video', require('./components/TabVideos.vue').default);
Vue.component('booking-component', require('./components/BookingComponent.vue').default);
Vue.component('cart-widget-component', require('./components/CartWidgetComponent.vue').default);
Vue.component('cart-component', require('./components/CartComponent.vue').default);
//account
Vue.component('create-account-component', require('./components/account/CreateAccountComponent.vue').default);
Vue.component('login-account-component', require('./components/account/LoginAccountComponent.vue').default);
Vue.component('customer-account-component', require('./components/account/CustomerAccountComponent.vue').default);
Vue.component('edit-customer-component', require('./components/account/EditAccountComponent.vue').default);
Vue.component('booking-voucher-component', require('./components/account/BookingVoucherComponent.vue').default);
Vue.use(Vuetify);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    vuetify: new Vuetify()
});

const cartWidget = new Vue({
    el: '#appCartWidget',
    store,
    vuetify: new Vuetify()
});
