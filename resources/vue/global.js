/**
 * Listig, vue global initiator
 */

window.Vue = require('vue');
window.axios = require('axios');

window.ListigPostPreview = require('./../../resources/vue/components/post-preview.vue');
window.ListigPostEdit = require('./../../resources/vue/components/post-edit.vue');
window.ListigPostSearch = require('./../../resources/vue/components/post-search.vue');
window.ListigListEdit = require('./../../resources/vue/components/list-edit.vue');
window.ListigListItem = require('./../../resources/vue/components/list-item.vue');
window.ListigListings = require('./../../resources/vue/components/listings.vue');

window.ListigTopMenu = require('./../../resources/vue/components/top-menu.vue');
window.ListigMainPage = require('./../../resources/vue/pages/main-page.vue');
window.ListigSettingsPage = require('./../../resources/vue/pages/settings-page.vue');
window.ListigHelpPage = require('./../../resources/vue/pages/help-page.vue');

window.draggable = require('vuedraggable');

window.eventBus = new Vue();

Vue.component('draggable', window.draggable);
Vue.component('post-edit', window.ListigPostEdit);
Vue.component('list-edit', window.ListigListEdit);
Vue.component('list-item', window.ListigListItem);
Vue.component('listings', window.ListigListings);
Vue.component('post-search', window.ListigPostSearch);
Vue.component('post-preview', window.ListigPostPreview);
Vue.component('main-page', window.ListigMainPage);
Vue.component('settings-page', window.ListigSettingsPage);
Vue.component('help-page', window.ListigHelpPage);
Vue.component('top-menu', window.ListigTopMenu);
