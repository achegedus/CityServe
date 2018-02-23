
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var VueRouter = require('vue-router');
var VueAxios = require('vue-axios');
var VueCookie = require('vue-cookie');
import VueSweetAlert from 'vue-sweetalert';
import {VueMasonryPlugin} from 'vue-masonry';
import VeeValidate from 'vee-validate';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate);
Vue.use(VueCookie);
Vue.use(VueSweetAlert);
Vue.use(VueMasonryPlugin);

import App from './Application.vue'
Vue.component('app', App)
Vue.component('Multiselect', VueMultiselect.default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import HomePage from './pages/HomePage.vue';

import ServePage from './pages/ServePage.vue';
import RequestProjectPage from './pages/RequestProjectPage.vue';
import DashboardPage from './pages/admin/DashboardPage.vue';

import ChurchesPage from './pages/admin/churches/ChurchesPage.vue';
import ChurchEditPage from './pages/admin/churches/EditChurchPage.vue';
import ChurchNewPage from './pages/admin/churches/NewChurchPage.vue';

import ProjectsPage from './pages/admin/projects/ProjectsPage.vue';
import ProjectEditPage from './pages/admin/projects/EditProjectPage.vue';
import ProjectNewPage from './pages/admin/projects/NewProjectPage.vue';

import PeoplePage from './pages/admin/people/PeoplePage.vue';
import PersonEditPage from './pages/admin/people/EditPersonPage.vue';
import PersonNewPage from './pages/admin/people/NewPersonPage.vue';

import UsersPage from './pages/admin/users/UsersPage.vue';
import UserEditPage from './pages/admin/users/EditUserPage.vue';
import UserNewPage from './pages/admin/users/NewUserPage.vue';

import GroupsPage from './pages/admin/groups/GroupsPage.vue';
import GroupEditPage from './pages/admin/groups/EditGroupPage.vue';
import GroupNewPage from './pages/admin/groups/NewGroupPage.vue';

import ProjectSubmitSuccess from './pages/ProjectSubmitSuccess.vue';

import VolunteerIndividualPage from './pages/volunteerIndividualPage.vue';
import VolunteerGroupPage from './pages/volunteerGroupPage.vue';

import store from './store/store';


const routes = [
    {path: '/', component: HomePage, name: 'home-page'},
    {path: '/serve', component: ServePage, name: 'serve'},
    {path: '/request', component: RequestProjectPage, name: 'request-project'},
    {path: '/project-submit-success', component: ProjectSubmitSuccess, name: 'project-submit-success'},
    {path: '/project/:projectID/volunteer/individual', component: VolunteerIndividualPage, name: 'volunteer-individual', meta: {requiresAuth: true }},
    {path: '/project/:projectID/volunteer/group', component: VolunteerGroupPage, name: 'volunteer-group', meta: {requiresAuth: true }},
    {path: '/admin/dashboard', component: DashboardPage, name: 'admin-dashboard', meta: {requiresAuth: true }},
    {path: '/admin/users', component: UsersPage, name: 'admin-users-page', meta: {requiresAuth: true }},
    {path: '/admin/user/new', component: UserNewPage, name: 'admin-user-new-page', meta: {requiresAuth: true }},
    {path: '/admin/user/:userID/edit', component: UserEditPage, name: 'admin-user-edit-page', meta: {requiresAuth: true }},
    {path: '/admin/churches', component: ChurchesPage, name: 'admin-churches-page', meta: {requiresAuth: true }},
    {path: '/admin/church/new', component: ChurchNewPage, name: 'admin-church-new-page', meta: {requiresAuth: true }},
    {path: '/admin/church/:churchID/edit', component: ChurchEditPage, name: 'admin-church-edit-page', meta: {requiresAuth: true }},
    {path: '/admin/people', component: PeoplePage, name: 'admin-people-page', meta: {requiresAuth: true }},
    {path: '/admin/person/new', component: PersonNewPage, name: 'admin-person-new-page', meta: {requiresAuth: true }},
    {path: '/admin/person/:personID/edit', component: PersonEditPage, name: 'admin-person-edit-page', meta: {requiresAuth: true }},
    {path: '/admin/projects', component: ProjectsPage, name: 'admin-projects-page', meta: {requiresAuth: true }},
    {path: '/admin/project/new', component: ProjectNewPage, name: 'admin-project-new-page', meta: {requiresAuth: true }},
    {path: '/admin/project/:projectID/edit', component: ProjectEditPage, name: 'admin-project-edit-page', meta: {requiresAuth: true }},
    {path: '/admin/groups', component: GroupsPage, name: 'admin-groups-page', meta: {requiresAuth: true }},
    {path: '/admin/group/new', component: GroupNewPage, name: 'admin-group-new-page', meta: {requiresAuth: true }},
    {path: '/admin/group/:groupID/edit', component: GroupEditPage, name: 'admin-group-edit-page', meta: {requiresAuth: true }}
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        const authUser = JSON.parse(window.localStorage.getItem('authUser'));
        console.log(authUser);

        if (authUser && authUser.access_token) {
            // const tokenData = JSON.parse(window.localStorage.getItem('authUser'));
            // Vue.axios.defaults.headers.common['Authorization'] = 'Bearer ' + tokenData.access_token;
            next()
        }
        else {
            next({name: 'home-page'})
        }
    }
    next()
});


new Vue({
    router, store
}).$mount('#app');