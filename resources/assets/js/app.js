
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

Vue.component('tickets', require('./components/tickets/all.vue'));
Vue.component('comment', require('./components/comments/create.vue'));
Vue.component('comments', require('./components/comments/all.vue'));
Vue.component('create-ticket', require('./components/tickets/create.vue'));
Vue.component('status', require('./components/tickets/status.vue'));
Vue.component('priority', require('./components/tickets/priority.vue'));
Vue.component('assign', require('./components/tickets/assignee.vue'));

const app = new Vue({
    el: '#app'
});
