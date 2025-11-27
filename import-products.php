<?php
/**
 * Warm Earth Home - 产品 CSV 导入脚本
 * 
 * 使用方法：
 * 1. 将此文件上传到 WordPress 根目录
 * 2. 访问：https://warmearthhome.com/import-products.php?weh_import=1
 * 3. 需要管理员权限
 * 4. 导入完成后删除此文件
 * 
 * 注意：此脚本会读取 woo-products-sample.csv 文件
 */

// 错误报告（仅用于调试）
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 加载 WordPress
if (!file_exists(__DIR__ . '/wp-load.php')) {
    die('WordPress 未找到。请确保此文件在 WordPress 根目录。');
}
require_once(__DIR__ . '/wp-load.php');

// 加载 WordPress 媒体函数
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

// 安全检查：使用密钥或管理员权限
$secret_key = 'weh_import_2025_secure_key';
$has_key = isset($_GET['key']) && $_GET['key'] === $secret_key;
$has_permission = current_user_can('manage_options');

if (!$has_key && !$has_permission) {
    wp_die('权限不足。需要管理员权限或正确的密钥。');
}

// 检查参数
if (!isset($_GET['weh_import']) || $_GET['weh_import'] !== '1') {
    wp_die('请访问：?weh_import=1&key=YOUR_SECRET_KEY');
}

// 检查 WooCommerce 是否激活
if (!class_exists('WooCommerce')) {
    wp_die('WooCommerce 未激活。请先安装并激活 WooCommerce。');
}

// CSV 文件路径
$csv_file = __DIR__ . '/woo-products-sample.csv';

if (!file_exists($csv_file)) {
    wp_die('CSV 文件不存在：' . $csv_file);
}

echo '<h1>Warm Earth Home - 产品导入</h1>';
echo '<style>
    body { font-family: Arial, sans-serif; padding: 20px; max-width: 1200px; margin: 0 auto; }
    .success { color: green; padding: 10px; background: #f0f0f0; margin: 10px 0; }
    .error { color: red; padding: 10px; background: #ffe0e0; margin: 10px 0; }
    .info { color: blue; padding: 10px; background: #e0f0ff; margin: 10px 0; }
    table { width: 100%; border-collapse: collapse; margin: 20px 0; }
    th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    th { background: #f5f5f5; }
</style>';

// 读取 CSV
$handle = @fopen($csv_file, 'r');
if ($handle === false) {
    wp_die('无法打开 CSV 文件：' . $csv_file . '<br>当前目录：' . __DIR__);
}

// 读取表头
$headers = fgetcsv($handle);
if ($headers === false) {
    wp_die('CSV 文件格式错误。');
}

echo '<div class="info">开始导入产品...</div>';

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
        echo '<div class="info">产品已存在（SKU: ' . esc_html($row['sku']) . '），跳过：' . esc_html($row['name']) . '</div>';
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
    try {
        $product_id = $product->save();
        
        if (is_wp_error($product_id) || !$product_id) {
            $error_msg = is_wp_error($product_id) ? $product_id->get_error_message() : '未知错误';
            $errors[] = '创建产品失败：' . $row['name'] . ' - ' . $error_msg;
            continue;
        }
    } catch (Exception $e) {
        $errors[] = '创建产品异常：' . $row['name'] . ' - ' . $e->getMessage();
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
    
    // 设置图片
    if (!empty($row['images'])) {
        $image_urls = explode('|', $row['images']);
        $image_ids = array();
        
        foreach ($image_urls as $image_url) {
            $image_url = trim($image_url);
            if (empty($image_url)) {
                continue;
            }
            
            // 检查图片是否已存在
            $attachment_id = attachment_url_to_postid($image_url);
            
            if (!$attachment_id) {
                // 尝试从 URL 下载图片（如果可能）
                // 注意：这需要图片 URL 可访问
                $attachment_id = media_sideload_image($image_url, $product_id, $row['name'], 'id');
            }
            
            if ($attachment_id && !is_wp_error($attachment_id)) {
                $image_ids[] = $attachment_id;
            }
        }
        
        if (!empty($image_ids)) {
            // 设置主图
            $product->set_image_id($image_ids[0]);
            
            // 设置图库
            if (count($image_ids) > 1) {
                $product->set_gallery_image_ids(array_slice($image_ids, 1));
            }
            
            $product->save();
        }
    }
    
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
    
    echo '<div class="success">✓ 导入成功：' . esc_html($row['name']) . ' (SKU: ' . esc_html($row['sku']) . ')</div>';
    $imported++;
}

fclose($handle);

// 显示结果
echo '<h2>导入完成</h2>';
echo '<div class="success">成功导入：' . $imported . ' 个产品</div>';
if ($skipped > 0) {
    echo '<div class="info">跳过：' . $skipped . ' 个产品（已存在或数据不完整）</div>';
}
if (!empty($errors)) {
    echo '<div class="error">错误：' . count($errors) . ' 个</div>';
    foreach ($errors as $error) {
        echo '<div class="error">- ' . esc_html($error) . '</div>';
    }
}

echo '<hr>';
echo '<p><strong>注意：</strong>导入完成后，请删除此文件（import-products.php）以确保安全。</p>';
echo '<p><a href="' . admin_url('edit.php?post_type=product') . '">查看产品列表</a></p>';

