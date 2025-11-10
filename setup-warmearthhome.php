<?php
/**
 * Warm Earth Home - 网站结构初始化脚本
 * 
 * 使用方法：
 * 1. 可以通过 WordPress 后台的 "代码片段" 插件运行
 * 2. 或者添加到主题的 functions.php（临时使用后删除）
 * 3. 或者通过 WP-CLI 运行
 * 
 * 注意：运行后请删除或禁用此脚本
 */

// 防止直接访问
if (!defined('ABSPATH')) {
    exit;
}

/**
 * 创建产品分类
 */
function weh_create_product_categories() {
    // 检查分类是否已存在
    if (term_exists('lighting', 'product_cat')) {
        return; // 如果已存在，跳过
    }
    
    // 创建主分类 Lighting
    $lighting_id = wp_insert_term(
        'Lighting',
        'product_cat',
        array(
            'slug' => 'lighting',
            'description' => 'All lighting products'
        )
    );
    
    if (!is_wp_error($lighting_id)) {
        $parent_id = $lighting_id['term_id'];
        
        // 创建子分类
        $subcategories = array(
            array(
                'name' => 'Wall Lights',
                'slug' => 'wall-lights',
                'description' => 'Wall mounted lighting fixtures'
            ),
            array(
                'name' => 'Pendant Lights',
                'slug' => 'pendant-lights',
                'description' => 'Pendant and hanging lights'
            ),
            array(
                'name' => 'Table Lamps',
                'slug' => 'table-lamps',
                'description' => 'Table and desk lamps'
            ),
            array(
                'name' => 'Floor Lamps',
                'slug' => 'floor-lamps',
                'description' => 'Floor standing lamps'
            )
        );
        
        foreach ($subcategories as $subcat) {
            wp_insert_term(
                $subcat['name'],
                'product_cat',
                array(
                    'slug' => $subcat['slug'],
                    'parent' => $parent_id,
                    'description' => $subcat['description']
                )
            );
        }
    }
}

/**
 * 创建产品标签（房间分类）
 */
function weh_create_room_tags() {
    $room_tags = array(
        'Bedroom',
        'Living Room',
        'Dining / Kitchen',
        'Entryway'
    );
    
    foreach ($room_tags as $tag) {
        if (!term_exists($tag, 'product_tag')) {
            wp_insert_term(
                $tag,
                'product_tag',
                array(
                    'slug' => sanitize_title($tag)
                )
            );
        }
    }
}

/**
 * 创建产品系列标签
 */
function weh_create_collection_tags() {
    $collections = array(
        'Scandinavian Wood & Linen',
        'Warm Brass & Opal Glass'
    );
    
    foreach ($collections as $collection) {
        if (!term_exists($collection, 'product_tag')) {
            wp_insert_term(
                $collection,
                'product_tag',
                array(
                    'slug' => sanitize_title($collection)
                )
            );
        }
    }
}

/**
 * 创建 Support 页面
 */
function weh_create_support_pages() {
    $pages = array(
        array(
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => 'Brand story and values will be added here.'
        ),
        array(
            'title' => 'Shipping & Returns',
            'slug' => 'shipping-returns',
            'content' => 'Shipping and returns policy will be added here.'
        ),
        array(
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => 'Contact form and information will be added here.'
        )
    );
    
    foreach ($pages as $page) {
        // 检查页面是否已存在
        $existing_page = get_page_by_path($page['slug']);
        
        if (!$existing_page) {
            wp_insert_post(array(
                'post_title' => $page['title'],
                'post_name' => $page['slug'],
                'post_content' => $page['content'],
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
        }
    }
}

/**
 * 设置导航菜单
 */
function weh_setup_navigation_menu() {
    // 检查菜单是否已存在
    $menu_name = 'Main Navigation';
    $menu_exists = wp_get_nav_menu_object($menu_name);
    
    if (!$menu_exists) {
        // 创建菜单
        $menu_id = wp_create_nav_menu($menu_name);
        
        if (!is_wp_error($menu_id)) {
            // 获取分类和页面ID
            $lighting_id = get_term_by('slug', 'lighting', 'product_cat');
            $wall_lights_id = get_term_by('slug', 'wall-lights', 'product_cat');
            $pendant_lights_id = get_term_by('slug', 'pendant-lights', 'product_cat');
            $table_lamps_id = get_term_by('slug', 'table-lamps', 'product_cat');
            $floor_lamps_id = get_term_by('slug', 'floor-lamps', 'product_cat');
            
            $about_page = get_page_by_path('about-us');
            $shipping_page = get_page_by_path('shipping-returns');
            $contact_page = get_page_by_path('contact');
            
            // 添加菜单项（这里需要根据实际主题的菜单位置调整）
            // 注意：菜单结构需要手动在 WordPress 后台设置
        }
    }
}

/**
 * 初始化函数 - 运行所有设置
 */
function weh_initialize_site_structure() {
    // 只在管理员访问时运行
    if (!current_user_can('manage_options')) {
        return;
    }
    
    weh_create_product_categories();
    weh_create_room_tags();
    weh_create_collection_tags();
    weh_create_support_pages();
    weh_setup_navigation_menu();
}

// 如果通过 URL 参数触发（用于测试）
if (isset($_GET['weh_setup']) && current_user_can('manage_options')) {
    weh_initialize_site_structure();
    echo '<div class="notice notice-success"><p>网站结构初始化完成！</p></div>';
}

// 取消注释下面的行来在插件激活时自动运行
// add_action('admin_init', 'weh_initialize_site_structure');







