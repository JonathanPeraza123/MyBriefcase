/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

window.EventBus = new Vue();



Vue.component('project-form', require('./components/ProjectForm.vue').default);
Vue.component('project-list', require('./components/ProjectList.vue').default);
Vue.component('my-project', require('./components/MyProjectList.vue').default);
Vue.component('profile-component', require('./components/MyProfile.vue').default);
Vue.component('profile', require('./components/ShowProfile.vue').default);
Vue.component('project-component', require('./components/Projects.vue').default);
Vue.component('project-show', require('./components/ShowProject.vue').default);
Vue.component('search-component', require('./components/Search.vue').default);

// Vue.component('pagination', require('laravel-vue-pagination'));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import auth from './mixins/auth';


Vue.mixin(auth);





const app = new Vue({
    el: '#app',
});
