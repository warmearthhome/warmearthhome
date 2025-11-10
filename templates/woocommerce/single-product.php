<?php
/**
 * The Template for displaying all single products
 * 
 * Based on PDP design documentation
 * 
 * @package WarmEarthHome
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<?php
while (have_posts()) {
    the_post();
    global $product;
    ?>
    
    <!-- Breadcrumb -->
    <nav class="weh-breadcrumb" aria-label="Breadcrumb">
        <div class="weh-container">
            <?php woocommerce_breadcrumb(); ?>
        </div>
    </nav>

    <!-- Main Product Section -->
    <section class="weh-section">
        <div class="weh-container">
            <div class="weh-product-layout">
                
                <!-- Gallery Module -->
                <div class="weh-product-gallery">
                    <?php
                    // Main product image
                    $main_image_id = $product->get_image_id();
                    if ($main_image_id) {
                        $main_image = wp_get_attachment_image($main_image_id, 'large', false, array(
                            'class' => 'weh-product-gallery-main-image',
                            'id' => 'weh-main-image',
                            'loading' => 'eager',
                        ));
                        echo '<div class="weh-product-gallery-main">';
                        echo $main_image;
                        echo '<button class="weh-product-gallery-zoom" aria-label="Zoom image">🔍</button>';
                        echo '</div>';
                    }
                    
                    // Product gallery thumbnails
                    $gallery_image_ids = $product->get_gallery_image_ids();
                    if ($gallery_image_ids) {
                        echo '<div class="weh-product-gallery-thumbnails">';
                        foreach ($gallery_image_ids as $index => $image_id) {
                            $image = wp_get_attachment_image($image_id, 'thumbnail', false, array(
                                'class' => 'weh-product-gallery-thumbnail-img',
                                'loading' => 'lazy',
                            ));
                            $full_image = wp_get_attachment_image_url($image_id, 'large');
                            $is_active = $index === 0 ? 'weh-product-gallery-thumbnail-active' : '';
                            echo '<button class="weh-product-gallery-thumbnail ' . $is_active . '" data-image="' . esc_url($full_image) . '">';
                            echo $image;
                            echo '</button>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Primary Info Panel -->
                <div class="weh-product-info">
                    <?php
                    // Series badge
                    $product_categories = wp_get_post_terms($product->get_id(), 'product_cat');
                    if ($product_categories) {
                        $main_category = $product_categories[0];
                        echo '<div class="weh-product-badge">' . esc_html($main_category->name) . '</div>';
                    }
                    ?>
                    
                    <h1 class="weh-product-title"><?php the_title(); ?></h1>
                    
                    <?php
                    // Energy Efficiency Tag (custom field)
                    $energy_tag = get_post_meta($product->get_id(), '_energy_efficiency_tag', true);
                    if ($energy_tag) {
                        echo '<div class="weh-product-energy-tag"><span>' . esc_html($energy_tag) . '</span></div>';
                    }
                    ?>
                    
                    <div class="weh-product-description">
                        <?php echo wp_kses_post($product->get_short_description()); ?>
                    </div>
                    
                    <div class="weh-product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>
                    
                    <?php
                    // Afterpay option
                    if (class_exists('WC_Afterpay_Plugin')) {
                        echo '<div class="weh-product-afterpay">';
                        echo '<span>or 4 interest-free payments with <a href="#">Afterpay</a></span>';
                        echo '</div>';
                    }
                    ?>
                    
                    <!-- Variants -->
                    <?php
                    if ($product->is_type('variable')) {
                        woocommerce_variable_add_to_cart();
                    } else {
                        ?>
                        <div class="weh-product-actions">
                            <div class="weh-product-quantity">
                                <button class="weh-product-quantity-btn" aria-label="Decrease quantity">−</button>
                                <?php
                                woocommerce_quantity_input(array(
                                    'min_value' => 1,
                                    'max_value' => $product->get_max_purchase_quantity(),
                                    'input_value' => 1,
                                ), $product);
                                ?>
                                <button class="weh-product-quantity-btn" aria-label="Increase quantity">+</button>
                            </div>
                            <?php woocommerce_template_single_add_to_cart(); ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <!-- Secondary Actions -->
                    <div class="weh-product-secondary-actions">
                        <?php if ($product->is_purchasable()) : ?>
                            <button class="weh-btn weh-btn-secondary" onclick="document.querySelector('.single_add_to_cart_button').click();">Buy Now</button>
                        <?php endif; ?>
                        <button class="weh-btn weh-btn-ghost" aria-label="Add to wishlist">♡</button>
                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('support/contact'))); ?>" class="weh-btn weh-btn-ghost">Ask a Question</a>
                    </div>
                    
                    <!-- Trust & Shipping Badges -->
                    <div class="weh-trust-badge">
                        <div class="weh-trust-badge-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                            </svg>
                            <span>Free shipping in Australia over $199</span>
                        </div>
                        <div class="weh-trust-badge-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span>30-day returns</span>
                        </div>
                        <?php
                        // Check if product is plug-in type
                        $installation_type = get_post_meta($product->get_id(), '_installation_type', true);
                        if ($installation_type === 'plug-in') {
                            ?>
                            <div class="weh-trust-badge-item">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <span>Easy install – renter friendly</span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <!-- Share Button -->
                    <div class="weh-product-share">
                        <button class="weh-btn weh-btn-ghost" onclick="shareProduct()">Share</button>
                        <div class="weh-product-share-options" id="weh-share-options" style="display: none;">
                            <button onclick="copyLink()">Copy Link</button>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">Pinterest</a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Highlights Tabs -->
    <section class="weh-section">
        <div class="weh-container">
            <div class="weh-product-tabs">
                <button class="weh-product-tab weh-product-tab-active" data-tab="overview">Overview</button>
                <button class="weh-product-tab" data-tab="specifications">Specifications</button>
                <button class="weh-product-tab" data-tab="installation">Installation & Care</button>
                <button class="weh-product-tab" data-tab="shipping">Shipping & Returns</button>
            </div>
            
            <div class="weh-product-tab-content">
                <!-- Overview Tab -->
                <div class="weh-product-tab-panel weh-product-tab-panel-active" id="overview">
                    <?php
                    $overview = get_post_meta($product->get_id(), '_product_overview', true);
                    if ($overview) {
                        echo wp_kses_post($overview);
                    } else {
                        // Fallback to product description
                        the_content();
                    }
                    ?>
                </div>
                
                <!-- Specifications Tab -->
                <div class="weh-product-tab-panel" id="specifications">
                    <table class="weh-spec-table">
                        <?php
                        $specs = array(
                            'Dimensions' => get_post_meta($product->get_id(), '_dimensions', true),
                            'Material' => get_post_meta($product->get_id(), '_material', true),
                            'Bulb Type' => get_post_meta($product->get_id(), '_bulb_type', true),
                            'Weight' => $product->get_weight() ? $product->get_weight() . ' kg' : '',
                            'Installation' => get_post_meta($product->get_id(), '_installation_type', true),
                            'Warranty' => get_post_meta($product->get_id(), '_warranty', true) ?: '2 years',
                        );
                        
                        foreach ($specs as $label => $value) {
                            if ($value) {
                                echo '<tr>';
                                echo '<th>' . esc_html($label) . '</th>';
                                echo '<td>' . esc_html($value) . '</td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </table>
                    
                    <!-- Size Guide PDF -->
                    <?php
                    $size_guide_pdf = get_post_meta($product->get_id(), '_size_guide_pdf', true);
                    if ($size_guide_pdf) {
                        $file_size = get_post_meta($product->get_id(), '_size_guide_pdf_size', true);
                        ?>
                        <div class="weh-size-guide">
                            <h3>Size Guide</h3>
                            <p>Download detailed size guide with 3-view drawings and key dimensions.</p>
                            <a href="<?php echo esc_url($size_guide_pdf); ?>" class="weh-btn weh-btn-secondary" download>
                                Size Guide – PDF<?php echo $file_size ? ' · ' . esc_html($file_size) : ''; ?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Installation & Care Tab -->
                <div class="weh-product-tab-panel" id="installation">
                    <?php
                    $installation_guide = get_post_meta($product->get_id(), '_installation_guide', true);
                    $care_guide = get_post_meta($product->get_id(), '_care_guide', true);
                    
                    if ($installation_guide) {
                        echo '<div class="weh-installation-guide">';
                        echo '<h3>Installation</h3>';
                        echo wp_kses_post($installation_guide);
                        
                        $installation_pdf = get_post_meta($product->get_id(), '_installation_pdf', true);
                        if ($installation_pdf) {
                            $pdf_size = get_post_meta($product->get_id(), '_installation_pdf_size', true);
                            echo '<a href="' . esc_url($installation_pdf) . '" class="weh-btn weh-btn-secondary" download>';
                            echo 'Installation Guide – PDF';
                            if ($pdf_size) {
                                echo ' · ' . esc_html($pdf_size);
                            }
                            echo '</a>';
                        }
                        echo '</div>';
                    }
                    
                    if ($care_guide) {
                        echo '<div class="weh-care-guide">';
                        echo '<h3>Care</h3>';
                        echo wp_kses_post($care_guide);
                        echo '</div>';
                    }
                    ?>
                </div>
                
                <!-- Shipping & Returns Tab -->
                <div class="weh-product-tab-panel" id="shipping">
                    <p>For detailed shipping and returns information, please visit our <a href="<?php echo esc_url(get_permalink(get_page_by_path('support/shipping-returns'))); ?>">Support page</a>.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Styled Shots / Inspiration -->
    <?php
    $styled_shots = get_post_meta($product->get_id(), '_styled_shots', true);
    if ($styled_shots) {
        ?>
        <section class="weh-section weh-section-sm">
            <div class="weh-container">
                <div class="weh-styled-shots">
                    <h2>Style it with...</h2>
                    <?php echo wp_kses_post($styled_shots); ?>
                </div>
            </div>
        </section>
        <?php
    }
    ?>

    <!-- Related Products -->
    <section class="weh-section">
        <div class="weh-container">
            <h2>You might also like</h2>
            <?php
            woocommerce_output_related_products();
            ?>
        </div>
    </section>

    <!-- Mobile Sticky Add-to-Cart Bar -->
    <div class="weh-sticky-cart" id="weh-sticky-cart">
        <div class="weh-sticky-cart-price"><?php echo $product->get_price_html(); ?></div>
        <button class="weh-btn weh-btn-primary weh-sticky-cart-btn" onclick="document.querySelector('.single_add_to_cart_button').click();">
            Add to Cart
        </button>
    </div>

    <?php
    // Schema.org Markup
    $schema = array(
        '@context' => 'https://schema.org/',
        '@type' => 'Product',
        'name' => $product->get_name(),
        'description' => $product->get_short_description(),
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
    
    if ($product->get_average_rating()) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $product->get_average_rating(),
            'reviewCount' => $product->get_review_count()
        );
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    ?>
    
    <?php
}
?>

<?php
get_footer('shop');
?>

