<?php
/**
 * Custom filters within this plugin application for modifications
 */

add_filter('listig/pluginData', function () {
    return get_plugin_data(dirname(LISTING_PLUGIN_FILE) . '/listig.php', $markup = true, $translate = true);
});
