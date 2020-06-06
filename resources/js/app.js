/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'


import routess from './routes/routes.js'
import homeroutes from './routes/homeRoutes.js'

import {Form, HasError, AlertError} from 'vform'
import moment from 'moment'

import VueProgressBar from 'vue-progressbar'

import CKEditor from '@ckeditor/ckeditor5-vue';

Vue.use(CKEditor);

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '10px'
});

window.Fire = new Vue();


window.Form = Form;

Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


Vue.use(VueRouter);

// Sweet alert 2
import Swal from 'sweetalert2'

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});

window.Toast = Toast;

Vue.filter('capitilize', function (value) {
    if (!value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter('cleanTime', function (created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});

Vue.filter('notificationTime', function (time) {
    // return moment(time).startOf('hour').fromNow();
    return moment(time).calendar();
});

const router = new VueRouter({
    routes: [
        ...homeroutes,
        ...routess,
    ],
    mode: 'history'
});

// const homeRoutes = new VueRouter({
//     homerouter,
//     mode: 'history'
// });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notification', require('./components/NotificationMarkup/notification.vue').default);
Vue.component('userDetails', require('./components/Backend/User/masterUserDetail.vue').default);
Vue.component('frontendRegister', require('./components/FrontEnd/SignUpMarkup/register.vue').default);
Vue.component('homeIndex', require('./components/FrontEnd/index.vue').default);

/*New Vue Instance for data transmission*/

export const userEvent = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
