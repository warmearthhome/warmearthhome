<?php
/**
 * The template for displaying product content within loops
 * 
 * Based on PLP product card design
 * 
 * @package WarmEarthHome
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<div class="weh-product-card" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="weh-product-card-link">
        <?php
        // Product image
        echo $product->get_image('weh-product', array(
            'class' => 'weh-product-card-image',
            'loading' => 'lazy',
            'alt' => $product->get_name()
        ));
        ?>
    </a>
    
    <?php
    // Product badges
    if ($product->is_on_sale()) {
        echo '<span class="weh-product-card-badge">Sale</span>';
    }
    
    if ($product->is_featured()) {
        echo '<span class="weh-product-card-badge">Best Seller</span>';
    }
    
    // Check if product is new (custom field or date-based)
    $product_date = $product->get_date_created();
    $days_old = (time() - $product_date->getTimestamp()) / DAY_IN_SECONDS;
    if ($days_old < 30) {
        echo '<span class="weh-product-card-badge">New</span>';
    }
    ?>
    
    <div class="weh-product-card-content">
        <h3 class="weh-product-card-title">
            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </h3>
        
        <p class="weh-product-card-price">
            <?php echo $product->get_price_html(); ?>
        </p>
        
        <div class="weh-product-card-actions">
            <button class="weh-btn weh-btn-ghost weh-quick-view-btn" 
                    data-product-id="<?php echo esc_attr($product->get_id()); ?>"
                    aria-label="Quick view <?php echo esc_attr($product->get_name()); ?>">
                Quick View
            </button>
            
            <?php
            // Add to cart button
            echo apply_filters(
                'woocommerce_loop_add_to_cart_link',
                sprintf(
                    '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                    esc_url($product->add_to_cart_url()),
                    esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
                    esc_attr(isset($args['class']) ? $args['class'] : 'weh-btn weh-btn-primary'),
                    isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
                    esc_html($product->add_to_cart_text())
                ),
                $product,
                $args
            );
            ?>
        </div>
    </div>
</div>

