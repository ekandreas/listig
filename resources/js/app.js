
require('../vue/global');

jQuery(function( $ ) {
    if($('#listig-main-page').length) {
        new Vue({
            template: `<main-page></main-page>`,
            component: ListigMainPage,
            el: '#listig-main-page'
        });
    }

    if($('#listig-help-page').length) {
        new Vue({
            template: `<help-page></help-page>`,
            component: ListigHelpPage,
            el: '#listig-help-page'
        });
    }

    if($('#listig-settings-page').length) {
        new Vue({
            template: `<settings-page></settings-page>`,
            component: ListigSettingsPage,
            el: '#listig-settings-page'
        });
    }
});
