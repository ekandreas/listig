<?php

add_action('admin_init', function () {
    load_plugin_textdomain('listig', false, dirname(LISTING_PLUGIN_FILE) . '/listig/languages');
});
