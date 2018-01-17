
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

Vue.component('departments', require('./components/departments.vue'));
Vue.component('password', require('./components/password.vue'));
Vue.component('account', require('./components/account.vue'));
Vue.component('users', require('./components/users.vue'));
Vue.component('invite', require('./components/invite.vue'));
Vue.component('authenticate', require('./components/auth.vue'));
Vue.component('ticket-meta', require('./components/tickets/meta.vue'));
Vue.component('actions', require('./components/tickets/actions.vue'));
Vue.component('comment', require('./components/comments/create.vue'));
Vue.component('comments', require('./components/comments/all.vue'));
Vue.component('create-ticket', require('./components/tickets/create.vue'));
Vue.component('assign', require('./components/tickets/assignee.vue'));
Vue.component('attachments', require('./components/tickets/attachments.vue'));

Vue.component('metrics-ticket', require('./components/metrics/tickets.vue'));
Vue.component('metrics-department', require('./components/metrics/department.vue'));

const app = new Vue({
    el: '#app'
});
