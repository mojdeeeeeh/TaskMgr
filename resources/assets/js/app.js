import Axios from 'axios'
import Vue from 'vue'
import JQuery from 'jquery'
import VeeValidate from 'vee-validate'

window.Vue = Vue;
window.VeeValidate = VeeValidate;
window.Axios = Axios;
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


try {
    window.$ = window.jQuery = JQuery;

    require('bootstrap');
}
catch (e) {
}
