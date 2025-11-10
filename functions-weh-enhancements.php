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
    wp_enqueue_style(
        'warm-earth-home-css',
        get_template_directory_uri() . '/assets/css/warm-earth-home.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'weh_enqueue_styles');

/**
 * Enqueue Custom Scripts
 */
function weh_enqueue_scripts() {
    wp_enqueue_script(
        'warm-earth-home-js',
        get_template_directory_uri() . '/assets/js/warm-earth-home.js',
        array('jquery'),
        '1.0.0',
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

