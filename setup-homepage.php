<?php
/**
 * Warm Earth Home - 首页设置脚本
 * 
 * 使用方法：
 * 1. 将此文件上传到 WordPress 根目录
 * 2. 访问：https://warmearthhome.com/setup-homepage.php?weh_setup_homepage=1&key=weh_import_2025_secure_key
 * 3. 需要管理员权限或正确的密钥
 * 4. 执行完成后删除此文件
 */

// 加载 WordPress
require_once(__DIR__ . '/wp-load.php');

// 安全检查
$secret_key = 'weh_import_2025_secure_key';
$has_key = isset($_GET['key']) && $_GET['key'] === $secret_key;
$has_permission = current_user_can('manage_options');

if (!$has_key && !$has_permission) {
    wp_die('权限不足。需要管理员权限或正确的密钥。');
}

// 检查参数
if (!isset($_GET['weh_setup_homepage']) || $_GET['weh_setup_homepage'] !== '1') {
    wp_die('请访问：?weh_setup_homepage=1&key=YOUR_SECRET_KEY');
}

echo '<h1>Warm Earth Home - 首页设置</h1>';
echo '<style>
    body { font-family: Arial, sans-serif; padding: 20px; max-width: 1200px; margin: 0 auto; }
    .success { color: green; padding: 10px; background: #f0f0f0; margin: 10px 0; }
    .error { color: red; padding: 10px; background: #ffe0e0; margin: 10px 0; }
    .info { color: blue; padding: 10px; background: #e0f0ff; margin: 10px 0; }
</style>';

$results = array();

// 1. 查找或创建首页
$homepage = get_page_by_path('home');
if (!$homepage) {
    // 尝试查找标题为 "Home" 的页面
    $homepage = get_page_by_title('Home');
}

if (!$homepage) {
    // 创建首页
    $homepage_id = wp_insert_post(array(
        'post_title'    => 'Home',
        'post_name'     => 'home',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => 1,
    ));
    
    if (is_wp_error($homepage_id)) {
        $results[] = array('type' => 'error', 'message' => '创建首页失败：' . $homepage_id->get_error_message());
    } else {
        $results[] = array('type' => 'success', 'message' => '✓ 创建首页成功（ID: ' . $homepage_id . '）');
        $homepage = get_post($homepage_id);
    }
} else {
    $results[] = array('type' => 'info', 'message' => '首页已存在（ID: ' . $homepage->ID . '）');
}

if ($homepage) {
    // 2. 设置首页使用 Homepage Template
    $template_set = update_post_meta($homepage->ID, '_wp_page_template', 'templates/wordpress/page-homepage.php');
    
    // 如果上面的路径不对，尝试其他路径
    if (!$template_set) {
        $template_set = update_post_meta($homepage->ID, '_wp_page_template', 'page-homepage.php');
    }
    
    if ($template_set) {
        $results[] = array('type' => 'success', 'message' => '✓ 已设置首页使用 Homepage Template');
    } else {
        $results[] = array('type' => 'info', 'message' => '首页模板设置（可能需要手动在后台设置）');
    }
    
    // 3. 设置首页为 WordPress 首页
    update_option('show_on_front', 'page');
    update_option('page_on_front', $homepage->ID);
    $results[] = array('type' => 'success', 'message' => '✓ 已设置首页为 WordPress 首页');
    
    // 4. 清空页面内容（移除测试内容）
    $current_content = $homepage->post_content;
    if (strpos($current_content, '[weh_css_test]') !== false || 
        strpos($current_content, '按钮样式测试') !== false ||
        strpos($current_content, '信任提示条测试') !== false) {
        wp_update_post(array(
            'ID' => $homepage->ID,
            'post_content' => '', // 清空内容，使用模板
        ));
        $results[] = array('type' => 'success', 'message' => '✓ 已清空首页测试内容');
    } else {
        $results[] = array('type' => 'info', 'message' => '首页内容无需清理');
    }
}

// 5. 检查模板文件是否存在
$template_paths = array(
    get_stylesheet_directory() . '/templates/wordpress/page-homepage.php',
    get_template_directory() . '/templates/wordpress/page-homepage.php',
    get_stylesheet_directory() . '/page-homepage.php',
    get_template_directory() . '/page-homepage.php',
);

$template_found = false;
foreach ($template_paths as $path) {
    if (file_exists($path)) {
        $results[] = array('type' => 'success', 'message' => '✓ 模板文件存在：' . $path);
        $template_found = true;
        break;
    }
}

if (!$template_found) {
    $results[] = array('type' => 'error', 'message' => '✗ 模板文件未找到，请确保 page-homepage.php 已上传到主题目录');
}

// 6. 检查产品数量
if (function_exists('wc_get_products')) {
    $product_count = count(wc_get_products(array('limit' => -1, 'status' => 'publish')));
    $results[] = array('type' => 'info', 'message' => '当前已发布产品数量：' . $product_count);
    
    if ($product_count > 0) {
        $results[] = array('type' => 'success', 'message' => '✓ 产品数据已就绪，Best Sellers 模块将显示产品');
    } else {
        $results[] = array('type' => 'error', 'message' => '✗ 没有已发布的产品，请先导入产品');
    }
}

// 显示结果
echo '<h2>设置结果</h2>';
foreach ($results as $result) {
    $class = $result['type'];
    echo '<div class="' . $class . '">' . esc_html($result['message']) . '</div>';
}

echo '<hr>';
echo '<p><strong>注意：</strong>设置完成后，请删除此文件（setup-homepage.php）以确保安全。</p>';
echo '<p><a href="' . home_url() . '">查看首页</a> | <a href="' . admin_url('post.php?post=' . $homepage->ID . '&action=edit') . '">编辑首页</a></p>';

