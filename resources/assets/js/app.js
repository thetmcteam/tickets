
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

Vue.use(require('vue-timeago'), {
    name: 'timeago',
    locale: 'en-US',
    locales: {
    'en-US': require('vue-timeago/locales/en-US.json')
    }
});

require('chart.js');
require('hchs-vue-charts');
Vue.use(VueCharts);

Vue.component('users', require('./components/users.vue'));
Vue.component('authenticate', require('./components/auth.vue'));
Vue.component('ticket-meta', require('./components/tickets/meta.vue'));
Vue.component('actions', require('./components/tickets/actions.vue'));
Vue.component('comment', require('./components/comments/create.vue'));
Vue.component('comments', require('./components/comments/all.vue'));
Vue.component('create-ticket', require('./components/tickets/create.vue'));
Vue.component('type', require('./components/tickets/type.vue'));
Vue.component('status', require('./components/tickets/status.vue'));
Vue.component('priority', require('./components/tickets/priority.vue'));
Vue.component('assign', require('./components/tickets/assignee.vue'));

Vue.component('metrics-ticket', require('./components/metrics/tickets.vue'));
Vue.component('metrics-department', require('./components/metrics/department.vue'));

const app = new Vue({
    el: '#app'
});
