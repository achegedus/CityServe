
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var VueRouter = require('vue-router');
var VueResource = require('vue-resource');

Vue.use(VueRouter);
Vue.use(VueResource);


import App from './Application.vue'
Vue.component('app', App)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import LoginPage from './pages/admin/LoginPage.vue';
import DashboardPage from './pages/admin/DashboardPage.vue';
import ChurchesPage from './pages/admin/ChurchesPage.vue';
import store from './store';


const routes = [
    {path: '/admin', component: LoginPage, name: 'admin-login'},
    {path: '/admin/dashboard', component: DashboardPage, name: 'admin-dashboard', meta: {requiresAuth: true }},
    {path: '/admin/churches', component: ChurchesPage, name: 'admin-churches-page', meta: {requiresAuth: true }}
];


const router = new VueRouter({
    mode: 'history',
    routes
});


router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        const authUser = JSON.parse(window.localStorage.getItem('authUser'))
        if (authUser && authUser.access_token) {
            next()
        }
        else {
            next({name: 'home'})
        }
    }
    next()
})


new Vue({
    router, store
}).$mount('#app');