<?php
/**
 * Warm Earth Home - WordPress Enhancements
 * Version: 1.0.0
 * 
 * This file contains custom functions to enhance the WordPress site
 * based on the design documentation.
 * 
 * @package WarmEarthHome
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue Custom Styles
 */
function weh_enqueue_styles() {
    // Use get_stylesheet_directory_uri() for child theme support
    $css_path = get_stylesheet_directory_uri() . '/assets/css/warm-earth-home.css';
    $css_file = get_stylesheet_directory() . '/assets/css/warm-earth-home.css';
    
    // Fallback to template directory if not in child theme
    if (!file_exists($css_file)) {
        $css_path = get_template_directory_uri() . '/assets/css/warm-earth-home.css';
    }
    
    wp_enqueue_style(
        'warm-earth-home-css',
        $css_path,
        array(),
        filemtime($css_file) ?: '1.0.1'
    );
}
add_action('wp_enqueue_scripts', 'weh_enqueue_styles');

/**
 * Enqueue Custom Scripts
 */
function weh_enqueue_scripts() {
    // Use get_stylesheet_directory_uri() for child theme support
    $js_path = get_stylesheet_directory_uri() . '/assets/js/warm-earth-home.js';
    $js_file = get_stylesheet_directory() . '/assets/js/warm-earth-home.js';
    
    // Fallback to template directory if not in child theme
    if (!file_exists($js_file)) {
        $js_path = get_template_directory_uri() . '/assets/js/warm-earth-home.js';
    }
    
    wp_enqueue_script(
        'warm-earth-home-js',
        $js_path,
        array('jquery'),
        filemtime($js_file) ?: '1.0.1',
        true
    );
}
add_action('wp_enqueue_scripts', 'weh_enqueue_scripts');

/**
 * Add Google Fonts (Playfair Display & Inter)
 */
function weh_add_google_fonts() {
    wp_enqueue_style(
        'weh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'weh_add_google_fonts');

/**
 * Register Custom Post Types (if needed)
 */
function weh_register_post_types() {
    // Register Inspiration post type
    register_post_type('inspiration', array(
        'labels' => array(
            'name' => 'Inspiration',
            'singular_name' => 'Inspiration Article',
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'inspiration'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-lightbulb',
    ));
}
// Uncomment if needed: add_action('init', 'weh_register_post_types');

/**
 * Add Custom Image Sizes
 */
function weh_add_image_sizes() {
    // Product images: 4:5 ratio
    add_image_size('weh-product', 400, 500, true);
    
    // Lifestyle images: 16:9 ratio
    add_image_size('weh-lifestyle', 1200, 675, true);
    
    // Hero images
    add_image_size('weh-hero', 1920, 1080, true);
}
add_action('after_setup_theme', 'weh_add_image_sizes');

/**
 * Add Product Size Guide PDF Field (for WooCommerce)
 */
function weh_add_product_size_guide_field() {
    global $woocommerce, $post;
    
    echo '<div class="form-field">';
    echo '<label for="product_size_guide">' . __('Size Guide PDF', 'warm-earth-home') . '</label>';
    echo '<input type="text" name="product_size_guide" id="product_size_guide" value="" />';
    echo '<p class="description">' . __('Upload or enter URL for product size guide PDF', 'warm-earth-home') . '</p>';
    echo '</div>';
}
// Uncomment if WooCommerce is active: add_action('product_cat_add_form_fields', 'weh_add_product_size_guide_field');

/**
 * Add Schema.org Markup for Products
 */
function weh_add_product_schema($product_id) {
    if (!function_exists('wc_get_product')) {
        return;
    }
    
    $product = wc_get_product($product_id);
    if (!$product) {
        return;
    }
    
    $schema = array(
        '@context' => 'https://schema.org/',
        '@type' => 'Product',
        'name' => $product->get_name(),
        'description' => $product->get_description(),
        'image' => wp_get_attachment_image_url($product->get_image_id(), 'full'),
        'brand' => array(
            '@type' => 'Brand',
            'name' => 'Warm Earth Home'
        ),
        'offers' => array(
            '@type' => 'Offer',
            'price' => $product->get_price(),
            'priceCurrency' => 'AUD',
            'availability' => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}
// Uncomment if WooCommerce is active: add_action('woocommerce_single_product_summary', 'weh_add_product_schema', 5);

/**
 * Add Analytics Events (GA4 & Meta Pixel)
 */
function weh_add_analytics_events() {
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
    
    // Track Add to Cart
    jQuery(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
        var productId = $button.data('product_id');
        wehTrackEvent('add_to_cart', {
            'product_id': productId
        });
        wehTrackMetaEvent('AddToCart', {
            'content_ids': [productId]
        });
    });
    
    // Track Product View
    jQuery(document).ready(function() {
        if (jQuery('body').hasClass('single-product')) {
            var productId = jQuery('.product').data('product-id');
            wehTrackEvent('view_item', {
                'product_id': productId
            });
            wehTrackMetaEvent('ViewContent', {
                'content_ids': [productId]
            });
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'weh_add_analytics_events');

/**
 * Add Mobile Sticky Cart Bar
 */
function weh_add_sticky_cart_bar() {
    if (!function_exists('wc_get_product')) {
        return;
    }
    
    if (!is_product()) {
        return;
    }
    
    global $product;
    ?>
    <div class="weh-sticky-cart" id="weh-sticky-cart">
        <div class="weh-sticky-cart-price">
            <?php echo $product->get_price_html(); ?>
        </div>
        <button class="weh-btn weh-btn-primary weh-sticky-cart-btn" onclick="document.querySelector('.single_add_to_cart_button').click();">
            Add to Cart
        </button>
    </div>
    <script>
    jQuery(document).ready(function() {
        var stickyCart = jQuery('#weh-sticky-cart');
        var addToCartBtn = jQuery('.single_add_to_cart_button');
        
        jQuery(window).scroll(function() {
            var scrollTop = jQuery(window).scrollTop();
            var addToCartOffset = addToCartBtn.offset().top;
            var windowHeight = jQuery(window).height();
            
            if (scrollTop + windowHeight > addToCartOffset + 100) {
                stickyCart.fadeIn();
            } else {
                stickyCart.fadeOut();
            }
        });
    });
    </script>
    <?php
}
// Uncomment if WooCommerce is active: add_action('wp_footer', 'weh_add_sticky_cart_bar');

/**
 * Add Custom Body Classes
 */
function weh_add_body_classes($classes) {
    if (is_shop() || is_product_category() || is_product_tag()) {
        $classes[] = 'weh-shop-page';
    }
    
    if (is_product()) {
        $classes[] = 'weh-product-page';
    }
    
    return $classes;
}
add_filter('body_class', 'weh_add_body_classes');

/**
 * Custom Excerpt Length
 */
function weh_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'weh_custom_excerpt_length');

/**
 * Custom Excerpt More
 */
function weh_custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'weh_custom_excerpt_more');

/**
 * Handle Support Contact Form Submission
 */
function weh_handle_contact_submit() {
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
add_action('admin_post_nopriv_weh_contact_submit', 'weh_handle_contact_submit');
add_action('admin_post_weh_contact_submit', 'weh_handle_contact_submit');

/**
 * Trust Bar Shortcode: [weh_trust_bar]
 */
function weh_trust_bar_shortcode($atts = array()) {
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
        <span aria-label="Free shipping over $150"><?php echo esc_html($args['free_shipping']); ?></span>
        <span aria-label="30 day returns"><?php echo esc_html($args['returns']); ?></span>
        <span aria-label="RCM certified"><?php echo esc_html($args['rcm']); ?></span>
        <span aria-label="AU plug ready"><?php echo esc_html($args['au_plug']); ?></span>
    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('weh_trust_bar', 'weh_trust_bar_shortcode');

/**
 * Newsletter Shortcode: [newsletter_form]
 * Attributes: placeholder, button
 */
function weh_newsletter_form_shortcode($atts = array()) {
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
        <p class="weh-form-note">We send only helpful lighting tips and new product updates.</p>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_form', 'weh_newsletter_form_shortcode');

/**
 * Handle Newsletter Signup
 */
function weh_handle_newsletter_signup() {
    if (!isset($_POST['weh_newsletter_nonce']) || !wp_verify_nonce($_POST['weh_newsletter_nonce'], 'weh_newsletter_form')) {
        wp_safe_redirect(add_query_arg('weh_newsletter', 'error', wp_get_referer() ?: home_url('/')));
        exit;
    }
    $email = isset($_POST['newsletter_email']) ? sanitize_email(wp_unslash($_POST['newsletter_email'])) : '';
    if (empty($email) || !is_email($email)) {
        wp_safe_redirect(add_query_arg('weh_newsletter', 'invalid', wp_get_referer() ?: home_url('/')));
        exit;
    }

    // For MVP: email admin. Later integrate with ESP (e.g., Mailchimp)
    $admin_email = get_option('admin_email');
    $subject = '[Newsletter] New signup';
    $body = "Email: {$email}\nSource: Support page newsletter form";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    wp_mail($admin_email, $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('weh_newsletter', 'success', wp_get_referer() ?: home_url('/')));
    exit;
}
add_action('admin_post_nopriv_weh_newsletter_signup', 'weh_handle_newsletter_signup');
add_action('admin_post_weh_newsletter_signup', 'weh_handle_newsletter_signup');

/**
 * Render Trust Bar Site-wide (Blocksy header after, fallback to body open)
 * Toggle via filter: add_filter('warmearthhome_show_trust_bar', '__return_false');
 */
function weh_render_global_trust_bar() {
	if (is_admin()) {
		return;
	}
	// Allow theme/plugins to disable
	$show = apply_filters('warmearthhome_show_trust_bar', true);
	if (!$show) {
		return;
	}
	// Avoid duplicate render if both hooks fire
	static $rendered = false;
	if ($rendered) {
		return;
	}
	$rendered = true;

	echo do_shortcode('[weh_trust_bar]');
}
// Prefer Blocksy header hook if available
add_action('blocksy:header:after', 'weh_render_global_trust_bar', 20);
// Fallback for themes without Blocksy hook
add_action('wp_body_open', 'weh_render_global_trust_bar', 20);

