<?php
/**
 * Plugin Name: Warm Earth Home Enhancements
 * Description: Shortcodes、全站信任条、Support 表单处理、初始化脚本与前端交互资源集成。
 * Version: 1.0.0
 * Author: Warm Earth Home
 * License: Proprietary
 */

if (!defined('ABSPATH')) {
	exit;
}

define('WEH_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WEH_PLUGIN_URL', plugin_dir_url(__FILE__));

// Includes
require_once WEH_PLUGIN_DIR . 'includes/functions-weh-enhancements.php';
require_once WEH_PLUGIN_DIR . 'includes/setup-warmearthhome.php';

// Optional: Activation hook placeholder
function weh_plugin_activate() {
	// No-op
}
register_activation_hook(__FILE__, 'weh_plugin_activate');


