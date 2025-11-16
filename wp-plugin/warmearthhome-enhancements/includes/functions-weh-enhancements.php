<?php
/**
 * Shared enhancements loaded by the Warm Earth Home Enhancements plugin.
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Enqueue Custom Styles
 * Prefer theme assets; fallback to plugin-bundled assets.
 */
function wehp_enqueue_styles() {
	// Theme path
	$theme_css_uri  = get_stylesheet_directory_uri() . '/assets/css/warm-earth-home.css';
	$theme_css_file = get_stylesheet_directory() . '/assets/css/warm-earth-home.css';
	$template_css_uri  = get_template_directory_uri() . '/assets/css/warm-earth-home.css';
	$template_css_file = get_template_directory() . '/assets/css/warm-earth-home.css';

	// Plugin fallback
	$plugin_css_uri  = trailingslashit(WEH_PLUGIN_URL) . 'assets/css/warm-earth-home.css';
	$plugin_css_file = trailingslashit(WEH_PLUGIN_DIR) . 'assets/css/warm-earth-home.css';

	$css_uri  = '';
	$version  = '1.0.1';

	if (file_exists($theme_css_file)) {
		$css_uri = $theme_css_uri;
		$version = filemtime($theme_css_file) ?: $version;
	} elseif (file_exists($template_css_file)) {
		$css_uri = $template_css_uri;
		$version = filemtime($template_css_file) ?: $version;
	} elseif (file_exists($plugin_css_file)) {
		$css_uri = $plugin_css_uri;
		$version = filemtime($plugin_css_file) ?: $version;
	}

	if ($css_uri) {
		wp_enqueue_style('warm-earth-home-css', $css_uri, array(), $version);
	}
}
add_action('wp_enqueue_scripts', 'wehp_enqueue_styles');

/**
 * Enqueue Custom Scripts
 * Prefer theme assets; fallback to plugin-bundled assets.
 */
function wehp_enqueue_scripts() {
	$theme_js_uri  = get_stylesheet_directory_uri() . '/assets/js/warm-earth-home.js';
	$theme_js_file = get_stylesheet_directory() . '/assets/js/warm-earth-home.js';
	$template_js_uri  = get_template_directory_uri() . '/assets/js/warm-earth-home.js';
	$template_js_file = get_template_directory() . '/assets/js/warm-earth-home.js';

	$plugin_js_uri  = trailingslashit(WEH_PLUGIN_URL) . 'assets/js/warm-earth-home.js';
	$plugin_js_file = trailingslashit(WEH_PLUGIN_DIR) . 'assets/js/warm-earth-home.js';

	$js_uri = '';
	$version = '1.0.1';

	if (file_exists($theme_js_file)) {
		$js_uri  = $theme_js_uri;
		$version = filemtime($theme_js_file) ?: $version;
	} elseif (file_exists($template_js_file)) {
		$js_uri  = $template_js_uri;
		$version = filemtime($template_js_file) ?: $version;
	} elseif (file_exists($plugin_js_file)) {
		$js_uri  = $plugin_js_uri;
		$version = filemtime($plugin_js_file) ?: $version;
	}

	if ($js_uri) {
		wp_enqueue_script('warm-earth-home-js', $js_uri, array('jquery'), $version, true);
	}
}
add_action('wp_enqueue_scripts', 'wehp_enqueue_scripts');

/**
 * Add Google Fonts (Playfair Display & Inter)
 */
function wehp_add_google_fonts() {
	wp_enqueue_style(
		'weh-google-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap',
		array(),
		null
	);
}
add_action('wp_enqueue_scripts', 'wehp_add_google_fonts');

/**
 * Add Custom Image Sizes
 */
function wehp_add_image_sizes() {
	add_image_size('weh-product', 400, 500, true);    // 4:5
	add_image_size('weh-lifestyle', 1200, 675, true); // 16:9
	add_image_size('weh-hero', 1920, 1080, true);     // Hero
}
add_action('after_setup_theme', 'wehp_add_image_sizes');

/**
 * Analytics Helpers + PDP Sticky Cart (as in theme version)
 */
function wehp_add_analytics_events() {
	?>
	<script>
	// GA4 Event Tracking
	function wehTrackEvent(eventName, eventParams) {
		if (typeof gtag !== 'undefined') {
			gtag('event', eventName, eventParams);
		}
	}
	// Meta Pixel Event Tracking
	function wehTrackMetaEvent(eventName, eventParams) {
		if (typeof fbq !== 'undefined') {
			fbq('track', eventName, eventParams);
		}
	}
	jQuery(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
		var productId = $button.data('product_id');
		wehTrackEvent('add_to_cart', {'product_id': productId});
		wehTrackMetaEvent('AddToCart', {'content_ids': [productId]});
	});
	jQuery(document).ready(function() {
		if (jQuery('body').hasClass('single-product')) {
			var productId = jQuery('.product').data('product-id');
			wehTrackEvent('view_item', {'product_id': productId});
			wehTrackMetaEvent('ViewContent', {'content_ids': [productId]});
		}
	});
	</script>
	<?php
}
add_action('wp_footer', 'wehp_add_analytics_events');

/**
 * Body Classes
 */
function wehp_add_body_classes($classes) {
	if (function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag())) {
		$classes[] = 'weh-shop-page';
	}
	if (function_exists('is_product') && is_product()) {
		$classes[] = 'weh-product-page';
	}
	return $classes;
}
add_filter('body_class', 'wehp_add_body_classes');

/**
 * Excerpt tweaks
 */
add_filter('excerpt_length', function($l){ return 20; });
add_filter('excerpt_more', function(){ return '...'; });

/**
 * Handle Support Contact Form Submission
 */
function wehp_handle_contact_submit() {
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
	if (!empty($phone)) { $body .= "Phone: {$phone}\n"; }
	if (!empty($order)) { $body .= "Order: {$order}\n"; }
	if (!empty($issue)) { $body .= "Issue: {$issue}\n"; }
	$body .= "Message:\n{$message}\n";
	$headers = array('Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>");
	wp_mail($admin_email, $subject, $body, $headers);
	wp_safe_redirect(add_query_arg('weh_contact', 'success', wp_get_referer() ?: home_url('/')));
	exit;
}
// 仅在未注册其他处理器时再注册，避免重复处理
if (!has_action('admin_post_nopriv_weh_contact_submit')) {
	add_action('admin_post_nopriv_weh_contact_submit', 'wehp_handle_contact_submit');
}
if (!has_action('admin_post_weh_contact_submit')) {
	add_action('admin_post_weh_contact_submit', 'wehp_handle_contact_submit');
}

/**
 * Trust Bar Shortcode: [weh_trust_bar]
 */
function wehp_trust_bar_shortcode($atts = array()) {
	$args = shortcode_atts(array(
		'free_shipping' => 'Free Shipping Over $150',
		'returns'       => '30-Day Returns',
		'rcm'           => 'RCM Certified',
		'au_plug'       => 'AU Plug Ready',
	), $atts, 'weh_trust_bar');
	ob_start();
	?>
	<nav class="weh-trust-bar" aria-label="Service guarantees">
		<span aria-label="Free shipping over $150"><?php echo esc_html($args['free_shipping']); ?></span>
		<span aria-label="30 day returns"><?php echo esc_html($args['returns']); ?></span>
		<span aria-label="RCM certified"><?php echo esc_html($args['rcm']); ?></span>
		<span aria-label="AU plug ready"><?php echo esc_html($args['au_plug']); ?></span>
	</nav>
	<?php
	return ob_get_clean();
}
if (!shortcode_exists('weh_trust_bar')) {
	add_shortcode('weh_trust_bar', 'wehp_trust_bar_shortcode');
}

/**
 * Newsletter Shortcode + Handler
 */
function wehp_newsletter_form_shortcode($atts = array()) {
	$args = shortcode_atts(array(
		'placeholder' => 'Enter your email',
		'button'      => 'Join',
	), $atts, 'newsletter_form');
	ob_start();
	?>
	<form class="weh-newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
		<input type="hidden" name="action" value="weh_newsletter_signup">
		<?php wp_nonce_field('weh_newsletter_form', 'weh_newsletter_nonce'); ?>
		<label class="screen-reader-text" for="weh-newsletter-email">Email</label>
		<input type="email" id="weh-newsletter-email" name="newsletter_email" placeholder="<?php echo esc_attr($args['placeholder']); ?>" required>
		<button type="submit" class="weh-btn weh-btn-primary"><?php echo esc_html($args['button']); ?></button>
		<p class="weh-form-note">We send only helpful lighting tips and new product updates.</p>
	</form>
	<?php
	return ob_get_clean();
}
if (!shortcode_exists('newsletter_form')) {
	add_shortcode('newsletter_form', 'wehp_newsletter_form_shortcode');
}

function wehp_handle_newsletter_signup() {
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
	$body = "Email: {$email}\nSource: Newsletter form";
	$headers = array('Content-Type: text/plain; charset=UTF-8');
	wp_mail($admin_email, $subject, $body, $headers);
	wp_safe_redirect(add_query_arg('weh_newsletter', 'success', wp_get_referer() ?: home_url('/')));
	exit;
}
if (!has_action('admin_post_nopriv_weh_newsletter_signup')) {
	add_action('admin_post_nopriv_weh_newsletter_signup', 'wehp_handle_newsletter_signup');
}
if (!has_action('admin_post_weh_newsletter_signup')) {
	add_action('admin_post_weh_newsletter_signup', 'wehp_handle_newsletter_signup');
}

/**
 * Render Trust Bar Site-wide (Blocksy header after, fallback to body open)
 */
function wehp_render_global_trust_bar() {
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
add_action('blocksy:header:after', 'wehp_render_global_trust_bar', 20);
add_action('wp_body_open', 'wehp_render_global_trust_bar', 20);


