
require('./global.js');

jQuery(function( $ ) {
    if($('#listig-main-page').length) {
        new Vue({
            template: `<main-page></main-page>`,
            el: '#listig-main-page'
        });
    }

    if($('#listig-help-page').length) {
        new Vue({
            template: `<help-page></help-page>`,
            el: '#listig-help-page'
        });
    }

    if($('#listig-settings-page').length) {
        new Vue({
            template: `<settings-page></settings-page>`,
            el: '#listig-settings-page'
        });
    }
});
