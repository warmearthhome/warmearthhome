<?php
/**
 * Plugin Name: Warm Earth Home Enhancements (MU)
 * Description: Shortcodes、全站信任条、Support 表单处理、初始化脚本与前端交互资源集成。MU插件版本，自动加载，无需启用。
 * Version: 1.0.0
 * Author: Warm Earth Home
 * 
 * MU Plugin - Must-Use Plugin
 * 将此文件上传到: wp-content/mu-plugins/warmearthhome-mu-plugin.php
 * 上传后自动生效，无需在后台启用
 */

// Prevent direct access
if (!defined('ABSPATH')) {
	exit;
}

// ============================================
// 0. 强制设置网站语言为英文（修复中文导航问题）
// ============================================

/**
 * Force site language to English (en_US)
 * This fixes Chinese navigation items like "商店", "我的帐户", "结账", "购物车"
 */
function weh_mu_force_english_locale() {
	// Set WPLANG to en_US
	if (get_option('WPLANG') !== 'en_US') {
		update_option('WPLANG', 'en_US');
	}
	
	// Force locale to English
	add_filter('locale', function($locale) {
		return 'en_US';
	}, 999);
	
	// Force WooCommerce locale to English
	add_filter('woocommerce_get_country_locale', function($locale) {
		return $locale;
	}, 999);
	
	// Load English text domain
	add_action('after_setup_theme', function() {
		load_theme_textdomain('default', get_template_directory() . '/languages');
		if (function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('woocommerce', false, dirname(plugin_basename(WC_PLUGIN_FILE)) . '/languages');
		}
	}, 1);
}
weh_mu_force_english_locale();

// ============================================
// 1. 加载 CSS/JS 资源（从主题或插件目录）
// ============================================

function weh_mu_enqueue_styles() {
	if (!function_exists('wp_enqueue_style')) {
		return;
	}
	$css_path = get_stylesheet_directory_uri() . '/assets/css/warm-earth-home.css';
	$css_file = get_stylesheet_directory() . '/assets/css/warm-earth-home.css';
	
	if (!file_exists($css_file)) {
		$css_path = get_template_directory_uri() . '/assets/css/warm-earth-home.css';
		$css_file = get_template_directory() . '/assets/css/warm-earth-home.css';
	}
	
	if (file_exists($css_file)) {
		wp_enqueue_style(
			'warm-earth-home-css',
			$css_path,
			array(),
			filemtime($css_file) ?: '1.0.1'
		);
	}
}
add_action('wp_enqueue_scripts', 'weh_mu_enqueue_styles');

function weh_mu_enqueue_scripts() {
	if (!function_exists('wp_enqueue_script')) {
		return;
	}
	$js_path = get_stylesheet_directory_uri() . '/assets/js/warm-earth-home.js';
	$js_file = get_stylesheet_directory() . '/assets/js/warm-earth-home.js';
	
	if (!file_exists($js_file)) {
		$js_path = get_template_directory_uri() . '/assets/js/warm-earth-home.js';
		$js_file = get_template_directory() . '/assets/js/warm-earth-home.js';
	}
	
	if (file_exists($js_file)) {
		wp_enqueue_script(
			'warm-earth-home-js',
			$js_path,
			array('jquery'),
			filemtime($js_file) ?: '1.0.1',
			true
		);
	}
}
add_action('wp_enqueue_scripts', 'weh_mu_enqueue_scripts');

function weh_mu_add_google_fonts() {
	if (!function_exists('wp_enqueue_style')) {
		return;
	}
	wp_enqueue_style(
		'weh-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);
}
add_action('wp_enqueue_scripts', 'weh_mu_add_google_fonts');

// ============================================
// 2. 添加自定义图片尺寸
// ============================================

function weh_mu_add_image_sizes() {
	add_image_size('weh-product', 400, 500, true);
	add_image_size('weh-lifestyle', 1200, 675, true);
	add_image_size('weh-hero', 1920, 1080, true);
}
add_action('after_setup_theme', 'weh_mu_add_image_sizes');

// ============================================
// 3. 信任条短代码: [weh_trust_bar]
// ============================================

function weh_mu_trust_bar_shortcode($atts = array()) {
	$defaults = array(
		'free_shipping' => 'Free Shipping Over $150',
		'returns'       => '30-Day Returns',
		'rcm'           => 'RCM Certified',
		'au_plug'       => 'AU Plug Ready',
	);
	$args = shortcode_atts($defaults, $atts, 'weh_trust_bar');

	ob_start();
	?>
	<nav class="weh-trust-bar" aria-label="Service guarantees">
		<span class="weh-galaxy-chip" data-weh-tooltip="<?php esc_attr_e('Australia-wide shipping is free for orders over $150.', 'warmearthhome'); ?>" aria-label="Free shipping over $150"><?php echo esc_html($args['free_shipping']); ?></span>
		<span class="weh-galaxy-chip" data-weh-tooltip="<?php esc_attr_e('Change of mind? Return your lights within 30 days.', 'warmearthhome'); ?>" aria-label="30 day returns"><?php echo esc_html($args['returns']); ?></span>
		<span class="weh-galaxy-chip" data-weh-tooltip="<?php esc_attr_e('Electrical fittings meet Australian RCM safety requirements.', 'warmearthhome'); ?>" aria-label="RCM certified"><?php echo esc_html($args['rcm']); ?></span>
		<span class="weh-galaxy-chip" data-weh-tooltip="<?php esc_attr_e('All lights ship with AU plug + 220-240V wiring.', 'warmearthhome'); ?>" aria-label="AU plug ready"><?php echo esc_html($args['au_plug']); ?></span>
	</nav>
	<?php
	return ob_get_clean();
}
add_shortcode('weh_trust_bar', 'weh_mu_trust_bar_shortcode');

// ============================================
// 4. 全站自动显示信任条
// ============================================

function weh_mu_render_global_trust_bar() {
	if (is_admin()) {
		return;
	}
	$show = apply_filters('warmearthhome_show_trust_bar', true);
	if (!$show) {
		return;
	}
	static $rendered = false;
	if ($rendered) {
		return;
	}
	$rendered = true;
	echo do_shortcode('[weh_trust_bar]');
}
add_action('blocksy:header:after', 'weh_mu_render_global_trust_bar', 20);
add_action('wp_body_open', 'weh_mu_render_global_trust_bar', 20);

// ============================================
// 5. 联系表单处理
// ============================================

function weh_mu_handle_contact_submit() {
	if (!isset($_POST['weh_contact_nonce']) || !wp_verify_nonce($_POST['weh_contact_nonce'], 'weh_contact_form')) {
		wp_safe_redirect(add_query_arg('weh_contact', 'error', wp_get_referer() ?: home_url('/')));
		exit;
	}

	$name    = isset($_POST['contact_name']) ? sanitize_text_field(wp_unslash($_POST['contact_name'])) : '';
	$email   = isset($_POST['contact_email']) ? sanitize_email(wp_unslash($_POST['contact_email'])) : '';
	$phone   = isset($_POST['contact_phone']) ? sanitize_text_field(wp_unslash($_POST['contact_phone'])) : '';
	$order   = isset($_POST['contact_order']) ? sanitize_text_field(wp_unslash($_POST['contact_order'])) : '';
	$issue   = isset($_POST['contact_issue']) ? sanitize_text_field(wp_unslash($_POST['contact_issue'])) : '';
	$message = isset($_POST['contact_message']) ? wp_kses_post(wp_unslash($_POST['contact_message'])) : '';

	if (empty($name) || empty($email) || empty($message)) {
		wp_safe_redirect(add_query_arg('weh_contact', 'invalid', wp_get_referer() ?: home_url('/')));
		exit;
	}

	$admin_email = get_option('admin_email');
	$subject = sprintf('[Support] %s — %s', $name, $issue ?: 'General');
	$body  = "Name: {$name}\n";
	$body .= "Email: {$email}\n";
	if (!empty($phone)) {
		$body .= "Phone: {$phone}\n";
	}
	if (!empty($order)) {
		$body .= "Order: {$order}\n";
	}
	if (!empty($issue)) {
		$body .= "Issue: {$issue}\n";
	}
	$body .= "Message:\n{$message}\n";

	$headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>");
	wp_mail($admin_email, $subject, $body, $headers);

	wp_safe_redirect(add_query_arg('weh_contact', 'success', wp_get_referer() ?: home_url('/')));
	exit;
}
add_action('admin_post_nopriv_weh_contact_submit', 'weh_mu_handle_contact_submit');
add_action('admin_post_weh_contact_submit', 'weh_mu_handle_contact_submit');

// ============================================
// 6. Newsletter 短代码与处理
// ============================================

function weh_mu_newsletter_form_shortcode($atts = array()) {
	$defaults = array(
		'placeholder' => 'Enter your email',
		'button'      => 'Join',
	);
	$args = shortcode_atts($defaults, $atts, 'newsletter_form');

	ob_start();
	?>
	<form class="weh-newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
		<input type="hidden" name="action" value="weh_newsletter_signup">
		<?php wp_nonce_field('weh_newsletter_form', 'weh_newsletter_nonce'); ?>
		<label class="screen-reader-text" for="weh-newsletter-email">Email</label>
		<input type="email" id="weh-newsletter-email" name="newsletter_email" placeholder="<?php echo esc_attr($args['placeholder']); ?>" required>
		<button type="submit" class="weh-btn weh-btn-primary"><?php echo esc_html($args['button']); ?></button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode('newsletter_form', 'weh_mu_newsletter_form_shortcode');

function weh_mu_handle_newsletter_signup() {
	if (!isset($_POST['weh_newsletter_nonce']) || !wp_verify_nonce($_POST['weh_newsletter_nonce'], 'weh_newsletter_form')) {
		wp_safe_redirect(add_query_arg('weh_newsletter', 'error', wp_get_referer() ?: home_url('/')));
		exit;
	}
	$email = isset($_POST['newsletter_email']) ? sanitize_email(wp_unslash($_POST['newsletter_email'])) : '';
	if (empty($email) || !is_email($email)) {
		wp_safe_redirect(add_query_arg('weh_newsletter', 'invalid', wp_get_referer() ?: home_url('/')));
		exit;
	}

	$admin_email = get_option('admin_email');
	$subject = '[Newsletter] New signup';
	$body = "Email: {$email}\nSource: Support page newsletter form";
	$headers = array('Content-Type: text/plain; charset=UTF-8');
	wp_mail($admin_email, $subject, $body, $headers);

	wp_safe_redirect(add_query_arg('weh_newsletter', 'success', wp_get_referer() ?: home_url('/')));
	exit;
}
add_action('admin_post_nopriv_weh_newsletter_signup', 'weh_mu_handle_newsletter_signup');
add_action('admin_post_weh_newsletter_signup', 'weh_mu_handle_newsletter_signup');

// ============================================
// 6.5. 强制前台英文显示（后台保持中文）
// ============================================

/**
 * 强制前台使用英文，后台保持中文
 * 需求：前台英文，后台中文
 */
function weh_mu_force_frontend_english($locale) {
	// 如果是后台管理界面，强制使用中文
	if (is_admin()) {
		return 'zh_CN'; // 后台强制中文
	}
	
	// 前台强制使用英文
	return 'en_AU'; // 前台强制英文（澳洲英文）
}
add_filter('locale', 'weh_mu_force_frontend_english', 999);

/**
 * 强制 WooCommerce 前台使用英文，后台中文
 */
function weh_mu_force_woocommerce_english($locale) {
	// 后台强制中文
	if (is_admin()) {
		return 'zh_CN';
	}
	// 前台强制英文
	return 'en_AU';
}
add_filter('woocommerce_get_locale', 'weh_mu_force_woocommerce_english', 999);

/**
 * 强制加载中文语言包（仅后台）
 */
function weh_mu_load_admin_chinese() {
	if (is_admin()) {
		// 确保后台加载中文语言包
		load_textdomain('default', WP_LANG_DIR . '/zh_CN.po');
		load_textdomain('default', WP_LANG_DIR . '/admin-zh_CN.mo');
	}
}
add_action('admin_init', 'weh_mu_load_admin_chinese', 1);

/**
 * 确保菜单项使用英文（前台显示）
 * 修复可能的菜单项中文问题
 */
function weh_mu_fix_menu_item_titles($items) {
	if (is_admin() || empty($items)) {
		return $items;
	}
	
	// 定义中文到英文的映射
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
		'账户' => 'Account',
		'帐户' => 'Account',
		'登入' => 'Login',
		'登录' => 'Login',
		'登出' => 'Logout',
		'退出' => 'Logout',
	);
	
	foreach ($items as $item) {
		if (isset($item->title) && isset($translation_map[$item->title])) {
			$item->title = $translation_map[$item->title];
		}
		// 同时修复 post_title（菜单项的数据库字段）
		if (isset($item->post_title) && isset($translation_map[$item->post_title])) {
			$item->post_title = $translation_map[$item->post_title];
		}
	}
	
	return $items;
}
add_filter('wp_get_nav_menu_items', 'weh_mu_fix_menu_item_titles', 999, 1);

/**
 * 自动修复菜单项的中文标题（永久修复，修改数据库）
 * 通过访问前台或后台 URL 触发：?weh_fix_menu_chinese=1
 * 需要管理员权限
 */
function weh_mu_auto_fix_menu_items_permanent() {
	// 只在有权限且有参数时执行
	if (!isset($_GET['weh_fix_menu_chinese']) || !current_user_can('manage_options')) {
		return;
	}
	
	// 获取所有菜单
	$menus = wp_get_nav_menus();
	if (empty($menus)) {
		return;
	}
	
	// 翻译映射
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
		'账户' => 'Account',
		'帐户' => 'Account',
		'登入' => 'Login',
		'登录' => 'Login',
		'登出' => 'Logout',
		'退出' => 'Logout',
	);
	
	$fixed_count = 0;
	
	foreach ($menus as $menu) {
		$items = wp_get_nav_menu_items($menu->term_id);
		if (empty($items)) {
			continue;
		}
		
		foreach ($items as $item) {
			if (isset($translation_map[$item->title])) {
				wp_update_nav_menu_item($menu->term_id, $item->ID, array(
					'menu-item-title' => $translation_map[$item->title],
				));
				$fixed_count++;
			}
		}
	}
	
	// 显示成功消息
	if (is_admin()) {
		add_action('admin_notices', function() use ($fixed_count) {
			echo '<div class="notice notice-success is-dismissible"><p>✅ 已永久修复 ' . $fixed_count . ' 个菜单项的中文标题！现在菜单项已更新为英文。</p></div>';
		});
	} else {
		// 前台访问时显示消息并重定向
		wp_die('<h1>菜单修复完成</h1><p>已修复 ' . $fixed_count . ' 个菜单项的中文标题。</p><p><a href="' . home_url() . '">返回首页</a></p>', '修复完成', array('back_link' => true));
	}
}
add_action('admin_init', 'weh_mu_auto_fix_menu_items_permanent', 999);
add_action('template_redirect', 'weh_mu_auto_fix_menu_items_permanent', 999);

/**
 * 自动修复菜单项（在插件加载时自动执行一次）
 * 不依赖 URL 参数，直接修复
 */
function weh_mu_auto_fix_menu_items_on_load() {
	// 只在首次加载时执行，使用 transient 避免重复执行
	$transient_key = 'weh_menu_fixed_v2';
	if (get_transient($transient_key)) {
		return;
	}
	
	// 获取所有菜单
	$menus = wp_get_nav_menus();
	if (empty($menus)) {
		set_transient($transient_key, true, DAY_IN_SECONDS);
		return;
	}
	
	// 翻译映射
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
		'账户' => 'Account',
		'帐户' => 'Account',
		'登入' => 'Login',
		'登录' => 'Login',
		'登出' => 'Logout',
		'退出' => 'Logout',
	);
	
	$fixed_count = 0;
	
	foreach ($menus as $menu) {
		$items = wp_get_nav_menu_items($menu->term_id);
		if (empty($items)) {
			continue;
		}
		
		foreach ($items as $item) {
			$original_title = $item->title;
			if (isset($translation_map[$original_title])) {
				// 直接更新数据库
				wp_update_nav_menu_item($menu->term_id, $item->ID, array(
					'menu-item-title' => $translation_map[$original_title],
				));
				$fixed_count++;
			}
		}
	}
	
	// 标记为已执行
	set_transient($transient_key, true, DAY_IN_SECONDS);
	
	// 如果有修复，记录日志
	if ($fixed_count > 0) {
		error_log("WEH: Fixed $fixed_count menu items from Chinese to English");
	}
}
// 在 WordPress 完全加载后执行
add_action('wp_loaded', 'weh_mu_auto_fix_menu_items_on_load', 999);
add_action('admin_init', 'weh_mu_auto_fix_menu_items_on_load', 999);

/**
 * 修复 WooCommerce 页面标题（如果显示为中文）
 */
function weh_mu_fix_woocommerce_page_titles($title, $id = null) {
	if (is_admin()) {
		return $title;
	}
	
	// 翻译映射
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
		'账户' => 'Account',
		'帐户' => 'Account',
	);
	
	if (isset($translation_map[$title])) {
		return $translation_map[$title];
	}
	
	return $title;
}
add_filter('the_title', 'weh_mu_fix_woocommerce_page_titles', 999, 2);
add_filter('wp_list_pages', 'weh_mu_fix_menu_output', 999, 2);

/**
 * 修复菜单 HTML 输出
 */
function weh_mu_fix_menu_output($output, $args) {
	if (is_admin()) {
		return $output;
	}
	
	// 直接在 HTML 中替换中文
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
	);
	
	foreach ($translation_map as $chinese => $english) {
		$output = str_replace('>' . $chinese . '<', '>' . $english . '<', $output);
		$output = str_replace('">' . $chinese . '</a>', '">' . $english . '</a>', $output);
	}
	
	return $output;
}
add_filter('wp_nav_menu_items', 'weh_mu_fix_menu_items_output', 999, 2);

/**
 * 修复导航菜单项输出
 */
function weh_mu_fix_menu_items_output($items, $args) {
	if (is_admin()) {
		return $items;
	}
	
	$translation_map = array(
		'商店' => 'Shop',
		'我的帐户' => 'My Account',
		'结账' => 'Checkout',
		'购物车' => 'Cart',
	);
	
	foreach ($translation_map as $chinese => $english) {
		$items = str_replace('>' . $chinese . '<', '>' . $english . '<', $items);
		$items = str_replace('">' . $chinese . '</a>', '">' . $english . '</a>', $items);
		$items = str_replace('title="' . $chinese . '"', 'title="' . $english . '"', $items);
	}
	
	return $items;
}

// ============================================
// 7. 网站结构初始化脚本
// ============================================

function weh_mu_create_product_categories() {
	if (term_exists('lighting', 'product_cat')) {
		return;
	}
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
		$subcategories = array(
			array('name' => 'Wall Lights', 'slug' => 'wall-lights', 'description' => 'Wall mounted lighting fixtures'),
			array('name' => 'Pendant Lights', 'slug' => 'pendant-lights', 'description' => 'Pendant and hanging lights'),
			array('name' => 'Table Lamps', 'slug' => 'table-lamps', 'description' => 'Table and desk lamps'),
			array('name' => 'Floor Lamps', 'slug' => 'floor-lamps', 'description' => 'Floor standing lamps')
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

function weh_mu_create_room_tags() {
	// Shop by Room tags (5个空间)
	$room_tags = array(
		'Bedroom',
		'Living Room', 
		'Dining / Kitchen',
		'Entryway',
		'Bathroom' // 第5个空间
	);
	
	foreach ($room_tags as $tag) {
		if (!term_exists($tag, 'product_tag')) {
			wp_insert_term($tag, 'product_tag', array('slug' => sanitize_title($tag)));
		}
	}
}

function weh_mu_create_collection_tags() {
	$collections = array('Scandinavian Wood & Linen', 'Warm Brass & Opal Glass');
	foreach ($collections as $collection) {
		if (!term_exists($collection, 'product_tag')) {
			wp_insert_term($collection, 'product_tag', array('slug' => sanitize_title($collection)));
		}
	}
}

function weh_mu_create_support_pages() {
	$pages = array(
		array('title' => 'About Us', 'slug' => 'about-us', 'content' => 'Brand story and values will be added here.'),
		array('title' => 'Shipping & Returns', 'slug' => 'shipping-returns', 'content' => 'Shipping and returns policy will be added here.'),
		array('title' => 'Contact', 'slug' => 'contact', 'content' => 'Contact form and information will be added here.')
	);
	foreach ($pages as $page) {
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

function weh_mu_setup_navigation_menu() {
	$menu_name = 'Main Navigation';
	$menu_obj  = wp_get_nav_menu_object($menu_name);
	$menu_id   = $menu_obj ? (int) $menu_obj->term_id : 0;

	if (!$menu_id) {
		$menu_id = wp_create_nav_menu($menu_name);
		if (is_wp_error($menu_id)) {
			return;
		}
	}

	$existing_items = wp_get_nav_menu_items($menu_id);
	$existing_titles = array();
	if ($existing_items && !is_wp_error($existing_items)) {
		foreach ($existing_items as $item) {
			$existing_titles[] = $item->title;
		}
	}
	$has_item = function($title) use ($existing_titles) {
		return in_array($title, $existing_titles, true);
	};

	$shop_page_id = function_exists('wc_get_page_id') ? wc_get_page_id('shop') : 0;
	$shop_url     = $shop_page_id ? get_permalink($shop_page_id) : home_url('/shop/');

	$wall_term     = get_term_by('slug', 'wall-lights', 'product_cat');
	$pendant_term  = get_term_by('slug', 'pendant-lights', 'product_cat');
	$table_term    = get_term_by('slug', 'table-lamps', 'product_cat');
	$floor_term    = get_term_by('slug', 'floor-lamps', 'product_cat');

	$room_terms = array(
		get_term_by('slug', sanitize_title('Bedroom'), 'product_tag'),
		get_term_by('slug', sanitize_title('Living Room'), 'product_tag'),
		get_term_by('slug', sanitize_title('Dining / Kitchen'), 'product_tag'),
		get_term_by('slug', sanitize_title('Entryway'), 'product_tag'),
		get_term_by('slug', sanitize_title('Bathroom'), 'product_tag'), // 第5个空间
	);

	$collection_terms = array(
		get_term_by('slug', sanitize_title('Scandinavian Wood & Linen'), 'product_tag'),
		get_term_by('slug', sanitize_title('Warm Brass & Opal Glass'), 'product_tag'),
	);

	$about_page    = get_page_by_path('about-us');
	$shipping_page = get_page_by_path('shipping-returns');
	$contact_page  = get_page_by_path('contact');

	// Lighting 分类菜单项（包含4个子分类）
	if (!$has_item('Lighting')) {
		$lighting_parent = get_term_by('slug', 'lighting', 'product_cat');
		if ($lighting_parent && !is_wp_error($lighting_parent)) {
			$lighting_item_id = wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'   => 'Lighting',
				'menu-item-object'  => 'product_cat',
				'menu-item-object-id'=> (int) $lighting_parent->term_id,
				'menu-item-type'    => 'taxonomy',
				'menu-item-status'  => 'publish',
			));
			$parent_for_categories = is_wp_error($lighting_item_id) || !$lighting_item_id ? 0 : (int) $lighting_item_id;
		} else {
			// 如果 Lighting 主分类不存在，创建 Shop 作为父项
			$shop_item_id = wp_update_nav_menu_item($menu_id, 0, array(
				'menu-item-title'  => 'Shop',
				'menu-item-url'    => esc_url_raw($shop_url),
				'menu-item-status' => 'publish',
			));
			$parent_for_categories = is_wp_error($shop_item_id) || !$shop_item_id ? 0 : (int) $shop_item_id;
		}
		
		// 添加4个 Lighting 子分类到菜单
		$maybe_add_term_item = function($title, $term) use ($menu_id, &$parent_for_categories, $has_item) {
			if ($term && !is_wp_error($term) && !$has_item($title)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'   => $title,
					'menu-item-object'  => 'product_cat',
					'menu-item-object-id'=> (int) $term->term_id,
					'menu-item-type'    => 'taxonomy',
					'menu-item-parent-id'=> $parent_for_categories,
					'menu-item-status'  => 'publish',
				));
			}
		};
		$maybe_add_term_item('Wall Lights', $wall_term);
		$maybe_add_term_item('Pendant Lights', $pendant_term);
		$maybe_add_term_item('Table Lamps', $table_term);
		$maybe_add_term_item('Floor Lamps', $floor_term);
	}

	if (!$has_item('Shop by Space')) {
		$space_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Shop by Space',
			'menu-item-url'    => esc_url_raw(home_url('/shop/space/')),
			'menu-item-status' => 'publish',
		));
		$parent_for_space = is_wp_error($space_item_id) || !$space_item_id ? 0 : (int) $space_item_id;
		foreach ($room_terms as $term) {
			if ($term && !is_wp_error($term) && !$has_item($term->name)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'    => $term->name,
					'menu-item-object'   => 'product_tag',
					'menu-item-object-id'=> (int) $term->term_id,
					'menu-item-type'     => 'taxonomy',
					'menu-item-parent-id'=> $parent_for_space,
					'menu-item-status'   => 'publish',
				));
			}
		}
	}

	if (!$has_item('Collections')) {
		$collections_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Collections',
			'menu-item-url'    => esc_url_raw(home_url('/collections/')),
			'menu-item-status' => 'publish',
		));
		$parent_for_collections = is_wp_error($collections_item_id) || !$collections_item_id ? 0 : (int) $collections_item_id;
		foreach ($collection_terms as $term) {
			if ($term && !is_wp_error($term) && !$has_item($term->name)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'    => $term->name,
					'menu-item-object'   => 'product_tag',
					'menu-item-object-id'=> (int) $term->term_id,
					'menu-item-type'     => 'taxonomy',
					'menu-item-parent-id'=> $parent_for_collections,
					'menu-item-status'   => 'publish',
				));
			}
		}
	}

	if (!$has_item('Support')) {
		$support_item_id = wp_update_nav_menu_item($menu_id, 0, array(
			'menu-item-title'  => 'Support',
			'menu-item-url'    => esc_url_raw(home_url('/support/')),
			'menu-item-status' => 'publish',
		));
		$parent_for_support = is_wp_error($support_item_id) || !$support_item_id ? 0 : (int) $support_item_id;
		$maybe_add_page_item = function($title, $page) use ($menu_id, $parent_for_support, $has_item) {
			if ($page && !is_wp_error($page) && !$has_item($title)) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title'    => $title,
					'menu-item-object'   => 'page',
					'menu-item-object-id'=> (int) $page->ID,
					'menu-item-type'     => 'post_type',
					'menu-item-parent-id'=> $parent_for_support,
					'menu-item-status'   => 'publish',
				));
			}
		};
		$maybe_add_page_item('About Us', $about_page);
		$maybe_add_page_item('Shipping & Returns', $shipping_page);
		$maybe_add_page_item('Contact', $contact_page);
	}

	$locations = get_registered_nav_menus();
	$theme_locs = get_nav_menu_locations();
	if (!empty($locations)) {
		if (isset($locations['primary'])) {
			$theme_locs['primary'] = (int) $menu_id;
		} else {
			$first_slug = array_key_first($locations);
			if ($first_slug) {
				$theme_locs[$first_slug] = (int) $menu_id;
			}
		}
		set_theme_mod('nav_menu_locations', $theme_locs);
	}
}

function weh_mu_setup_homepage() {
	$show_on_front = get_option('show_on_front');
	$front_id      = (int) get_option('page_on_front');
	if ($show_on_front === 'page' && $front_id > 0) {
		return;
	}

	$home_page = get_page_by_path('home');
	if (!$home_page) {
		$page_id = wp_insert_post(array(
			'post_title'   => 'Home',
			'post_name'    => 'home',
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		));
		if (is_wp_error($page_id)) {
			return;
		}
		$home_page = get_post($page_id);
	}

	// 尝试设置模板路径（根据主题而定）
	// 如果主题支持子目录模板，使用 templates/wordpress/page-homepage.php
	// 否则使用 page-homepage.php（需要模板文件在主题根目录）
	$template_path = 'templates/wordpress/page-homepage.php';
	
	// 检查模板文件是否存在，如果不存在则使用默认模板名
	$theme_dir = get_template_directory();
	if (!file_exists($theme_dir . '/' . $template_path)) {
		// 尝试查找 page-homepage.php 在主题根目录
		if (file_exists($theme_dir . '/page-homepage.php')) {
			$template_path = 'page-homepage.php';
		} else {
			// 使用默认模板，让用户在后台手动选择
			$template_path = 'default';
		}
	}
	
	update_post_meta($home_page->ID, '_wp_page_template', $template_path);
	update_option('show_on_front', 'page');
	update_option('page_on_front', (int) $home_page->ID);
}

function weh_mu_force_english_settings() {
	if (!function_exists('current_user_can') || !current_user_can('manage_options')) {
		return;
	}
	
	// Force WordPress language to English
	update_option('WPLANG', 'en_US');
	
	// Force WooCommerce language if WooCommerce is active
	if (function_exists('WC')) {
		update_option('woocommerce_default_country', 'AU:NSW');
		update_option('woocommerce_currency', 'AUD');
	}
	
	// Clear language cache
	if (function_exists('wp_cache_flush')) {
		wp_cache_flush();
	}
}

function weh_mu_initialize_site_structure() {
	if (!function_exists('current_user_can') || !current_user_can('manage_options')) {
		return;
	}
	if (!function_exists('wp_insert_term')) {
		return;
	}
	
	// First, force English language settings
	weh_mu_force_english_settings();
	
	weh_mu_create_product_categories();
	weh_mu_create_room_tags();
	weh_mu_create_collection_tags();
	weh_mu_create_support_pages();
	weh_mu_setup_navigation_menu();
	weh_mu_setup_homepage();
}

// 通过 URL 参数触发初始化: ?weh_setup=1
// 只在 WordPress 完全加载后执行
add_action('admin_init', function() {
	if (isset($_GET['weh_setup']) && current_user_can('manage_options')) {
		weh_mu_initialize_site_structure();
		// 使用更明显的通知
		add_action('admin_notices', function() {
			?>
			<div class="notice notice-success is-dismissible" style="border-left-color: #46b450; padding: 12px;">
				<h2 style="margin: 0 0 8px 0;">✅ 网站结构初始化完成！</h2>
				<p style="margin: 0;">已创建：产品分类（Lighting + 4个子分类）、房间/系列标签、Support页面（About Us/Shipping & Returns/Contact）、导航菜单（Main Navigation）、首页设置</p>
				<p style="margin: 8px 0 0 0;"><strong>请检查：</strong></p>
				<ul style="margin: 4px 0;">
					<li>产品 > 分类：应看到 Lighting 及子分类</li>
					<li>产品 > 标签：应看到房间和系列标签</li>
					<li>页面：应看到 About Us、Shipping & Returns、Contact</li>
					<li>外观 > 菜单：应看到 Main Navigation 菜单</li>
					<li>设置 > 阅读：首页应设置为静态页面（Home）</li>
				</ul>
			</div>
			<?php
		});
	}
}, 999);

