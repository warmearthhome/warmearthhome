<?php
/**
 * MU Plugin: Warm Earth Home MU Loader
 * Description: 必载版本（无需启用）。提供短代码、Support 表单处理、全站信任条与初始化脚本。
 * Version: 1.0.0
 */
if (!defined('ABSPATH')) { exit; }

define('WEH_MU_DIR', plugin_dir_path(__FILE__));
define('WEH_MU_URL', plugin_dir_url(__FILE__));

// Include enhancements
require_once WEH_MU_DIR . 'includes/functions-weh-enhancements-mu.php';
require_once WEH_MU_DIR . 'includes/setup-warmearthhome-mu.php';


