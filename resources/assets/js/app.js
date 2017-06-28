
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('comment', require('./components/comments/create.vue'));
Vue.component('comments', require('./components/comments/all.vue'));
Vue.component('create-ticket', require('./components/tickets/create.vue'));
Vue.component('ticket-status', require('./components/tickets/status.vue'));
Vue.component('ticket-priority', require('./components/tickets/priority.vue'));
Vue.component('ticket-assignee', require('./components/tickets/assignee.vue'));

const app = new Vue({
    el: '#app'
});
