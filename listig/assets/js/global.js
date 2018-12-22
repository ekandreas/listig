/**
 * Listig, vue global initiator
 */

import Vue from 'vue';
import axios from 'axios';

window.Vue = Vue;
window.axios = axios;

window.eventBus = new Vue();

Vue.component('post-edit', require('./components/post-edit.vue').default);
Vue.component('list-edit', require('./components/list-edit.vue').default);
Vue.component('list-item', require('./components/list-item.vue').default);
Vue.component('listings', require('./components/listings.vue').default);
Vue.component('post-search', require('./components/post-search.vue').default);
Vue.component('post-preview', require('./components/post-preview.vue').default);
Vue.component('main-page', require('./pages/main-page.vue').default);
Vue.component('settings-page', require('./pages/settings-page.vue').default);
Vue.component('help-page', require('./pages/help-page.vue').default);
Vue.component('top-menu', require('./components/top-menu.vue').default);
