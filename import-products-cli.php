<?php
/**
 * Warm Earth Home - 产品 CSV 导入脚本（命令行版本）
 * 
 * 使用方法：
 * 通过 WordPress 后台访问：https://warmearthhome.com/import-products.php?weh_import=1&key=YOUR_SECRET_KEY
 * 或者通过 WP-CLI：wp eval-file import-products-cli.php
 * 
 * 注意：此脚本会读取 woo-products-sample.csv 文件
 */

// 加载 WordPress
require_once(__DIR__ . '/wp-load.php');

// 安全检查：如果是通过 URL 访问，需要密钥
if (php_sapi_name() !== 'cli') {
    $secret_key = 'weh_import_2025_secure';
    if (!isset($_GET['key']) || $_GET['key'] !== $secret_key) {
        wp_die('Access denied. Invalid key.');
    }
}

// 检查权限（命令行模式跳过）
if (php_sapi_name() !== 'cli' && !current_user_can('manage_options')) {
    wp_die('权限不足。需要管理员权限。');
}

// 检查 WooCommerce 是否激活
if (!class_exists('WooCommerce')) {
    die('WooCommerce 未激活。请先安装并激活 WooCommerce。');
}

// CSV 文件路径
$csv_file = __DIR__ . '/woo-products-sample.csv';

if (!file_exists($csv_file)) {
    die('CSV 文件不存在：' . $csv_file);
}

// 输出函数
function weh_import_output($message, $type = 'info') {
    if (php_sapi_name() === 'cli') {
        $colors = [
            'success' => "\033[32m",
            'error' => "\033[31m",
            'info' => "\033[34m",
        ];
        $reset = "\033[0m";
        $color = $colors[$type] ?? '';
        echo $color . $message . $reset . "\n";
    } else {
        $classes = [
            'success' => 'success',
            'error' => 'error',
            'info' => 'info',
        ];
        $class = $classes[$type] ?? 'info';
        echo "<div class=\"$class\">$message</div>";
    }
}

if (php_sapi_name() !== 'cli') {
    echo '<h1>Warm Earth Home - 产品导入</h1>';
    echo '<style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 1200px; margin: 0 auto; }
        .success { color: green; padding: 10px; background: #f0f0f0; margin: 10px 0; }
        .error { color: red; padding: 10px; background: #ffe0e0; margin: 10px 0; }
        .info { color: blue; padding: 10px; background: #e0f0ff; margin: 10px 0; }
    </style>';
}

weh_import_output('开始导入产品...', 'info');

// 读取 CSV
$handle = fopen($csv_file, 'r');
if ($handle === false) {
    die('无法打开 CSV 文件。');
}

// 读取表头
$headers = fgetcsv($handle);
if ($headers === false) {
    die('CSV 文件格式错误。');
}

$imported = 0;
$skipped = 0;
$errors = array();

// 读取数据行
while (($data = fgetcsv($handle)) !== false) {
    if (count($data) < count($headers)) {
        continue; // 跳过不完整的行
    }
    
    // 组合数据
    $row = array_combine($headers, $data);
    
    // 检查必填字段
    if (empty($row['name']) || empty($row['sku'])) {
        $skipped++;
        continue;
    }
    
    // 检查产品是否已存在
    $existing_id = wc_get_product_id_by_sku($row['sku']);
    if ($existing_id) {
        weh_import_output('产品已存在（SKU: ' . $row['sku'] . '），跳过：' . $row['name'], 'info');
        $skipped++;
        continue;
    }
    
    // 创建产品
    $product = new WC_Product_Simple();
    $product->set_name($row['name']);
    $product->set_slug($row['slug']);
    $product->set_sku($row['sku']);
    $product->set_regular_price($row['regular_price']);
    $product->set_stock_status($row['stock_status']);
    $product->set_short_description($row['short_description']);
    $product->set_description($row['description']);
    
    // 设置重量和尺寸
    if (!empty($row['weight'])) {
        $product->set_weight($row['weight']);
    }
    if (!empty($row['length'])) {
        $product->set_length($row['length']);
    }
    if (!empty($row['width'])) {
        $product->set_width($row['width']);
    }
    if (!empty($row['height'])) {
        $product->set_height($row['height']);
    }
    
    // 保存产品
    $product_id = $product->save();
    
    if (is_wp_error($product_id) || !$product_id) {
        $errors[] = '创建产品失败：' . $row['name'] . ' - ' . ($product_id->get_error_message() ?? '未知错误');
        continue;
    }
    
    // 设置分类
    if (!empty($row['categories'])) {
        $categories = explode('>', $row['categories']);
        $category_ids = array();
        
        foreach ($categories as $category_name) {
            $category_name = trim($category_name);
            if (empty($category_name)) {
                continue;
            }
            
            // 查找分类
            $term = get_term_by('name', $category_name, 'product_cat');
            if ($term) {
                $category_ids[] = $term->term_id;
            } else {
                // 创建分类（如果需要）
                $parent_id = !empty($category_ids) ? end($category_ids) : 0;
                $new_term = wp_insert_term($category_name, 'product_cat', array('parent' => $parent_id));
                if (!is_wp_error($new_term)) {
                    $category_ids[] = $new_term['term_id'];
                }
            }
        }
        
        if (!empty($category_ids)) {
            wp_set_object_terms($product_id, $category_ids, 'product_cat');
        }
    }
    
    // 设置标签
    if (!empty($row['tags'])) {
        $tags = explode('|', $row['tags']);
        $tag_names = array();
        
        foreach ($tags as $tag_name) {
            $tag_name = trim($tag_name);
            if (!empty($tag_name)) {
                $tag_names[] = $tag_name;
            }
        }
        
        if (!empty($tag_names)) {
            wp_set_object_terms($product_id, $tag_names, 'product_tag');
        }
    }
    
    // 设置图片（跳过，因为图片 URL 可能不存在）
    // 如果需要，可以后续手动上传图片
    
    // 设置属性
    if (!empty($row['attribute 1 name']) && !empty($row['attribute 1 value(s)'])) {
        $attribute = new WC_Product_Attribute();
        $attribute->set_name($row['attribute 1 name']);
        $attribute->set_options(explode('|', $row['attribute 1 value(s)']));
        $attribute->set_visible(true);
        $attribute->set_variation(false);
        
        $product->set_attributes(array($attribute));
        $product->save();
    }
    
    weh_import_output('✓ 导入成功：' . $row['name'] . ' (SKU: ' . $row['sku'] . ')', 'success');
    $imported++;
}

fclose($handle);

// 显示结果
weh_import_output('导入完成', 'info');
weh_import_output('成功导入：' . $imported . ' 个产品', 'success');
if ($skipped > 0) {
    weh_import_output('跳过：' . $skipped . ' 个产品（已存在或数据不完整）', 'info');
}
if (!empty($errors)) {
    weh_import_output('错误：' . count($errors) . ' 个', 'error');
    foreach ($errors as $error) {
        weh_import_output('- ' . $error, 'error');
    }
}

if (php_sapi_name() !== 'cli') {
    echo '<hr>';
    echo '<p><strong>注意：</strong>导入完成后，请删除此文件（import-products.php）以确保安全。</p>';
    echo '<p><a href="' . admin_url('edit.php?post_type=product') . '">查看产品列表</a></p>';
}

