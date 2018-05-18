
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var numeral = require('numeral');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
    computed: {
        siteCurrency(value) {
            return site_currency;
        },
    },
    methods: {
        formatPrice(price)
        {
            var number = parseFloat(price);
            return numeral(number).format('0,0.00');
        }
    }
});

const app = new Vue({
    el: '#app',
    components: {
        ProductAddComponent: () => import('./components/ProductAddComponent'),
        PrintButton: () => import('./components/PrintButton'),
        PrintOrderButton: () => import('./components/PrintOrderButton'),
    },
});
