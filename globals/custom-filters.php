<?php
/**
 * Custom filters within this plugin application for modifications
 */

add_filter('listig/pluginData', function () {
    return get_plugin_data(dirname(__DIR__) . '/listig.php', $markup = true, $translate = true);
});
