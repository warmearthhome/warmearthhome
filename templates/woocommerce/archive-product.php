<?php
/**
 * The Template for displaying product archives, including the main shop page
 * 
 * Based on PLP design documentation
 * 
 * @package WarmEarthHome
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<!-- Breadcrumb -->
<nav class="weh-breadcrumb" aria-label="Breadcrumb">
    <div class="weh-container">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</nav>

<!-- Page Header -->
<header class="weh-page-header">
    <div class="weh-container">
        <?php if (is_product_category()) : ?>
            <?php
            $category = get_queried_object();
            $category_image = get_term_meta($category->term_id, 'thumbnail_id', true);
            ?>
            <h1><?php woocommerce_page_title(); ?></h1>
            <?php if ($category->description) : ?>
                <p class="weh-page-description"><?php echo esc_html($category->description); ?></p>
            <?php endif; ?>
        <?php else : ?>
            <h1><?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>
    </div>
</header>

<!-- Top Intro Paragraph -->
<section class="weh-section weh-section-sm">
    <div class="weh-container">
        <p class="weh-intro-paragraph">
            Discover warm, natural lighting crafted for Australian homes. Our Modern Earth and Urban Glow collections bring calm, simple beauty to bedrooms, living rooms, and small spaces. Each piece is designed for easy installation and everyday comfort.
        </p>
    </div>
</section>

<!-- Filter & Sort Bar -->
<section class="weh-filter-section">
    <div class="weh-container">
        <div class="weh-filter-bar">
            <button class="weh-filter-toggle" aria-label="Toggle filters">
                <span>Filters</span>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="2"/>
                </svg>
            </button>
            
            <div class="weh-filter-drawer" id="weh-filter-drawer" style="display: none;">
                <?php
                // Display WooCommerce product filters
                if (is_active_sidebar('shop-filters')) {
                    dynamic_sidebar('shop-filters');
                } else {
                    // Fallback: Display category filter
                    $product_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                    ));
                    
                    if ($product_categories) {
                        echo '<div class="weh-filter-group">';
                        echo '<h3>Category</h3>';
                        foreach ($product_categories as $category) {
                            echo '<label>';
                            echo '<input type="checkbox" name="category" value="' . esc_attr($category->slug) . '"> ';
                            echo esc_html($category->name);
                            echo '</label>';
                        }
                        echo '</div>';
                    }
                }
                ?>
                
                <button class="weh-btn weh-btn-secondary" onclick="clearAllFilters()">Clear All</button>
            </div>
            
            <div class="weh-sort-bar">
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>
    </div>
</section>

<!-- Product Grid -->
<section class="weh-section">
    <div class="weh-container">
        <?php
        if (woocommerce_product_loop()) {
            ?>
            <div class="weh-product-grid" id="weh-product-grid">
                <?php
                if (wc_get_loop_prop('is_shortcode')) {
                    $columns = absint(wc_get_loop_prop('columns'));
                    wc_set_loop_prop('columns', $columns);
                }
                
                woocommerce_product_loop_start();
                
                if (wc_get_loop_prop('is_paginated')) {
                    while (have_posts()) {
                        the_post();
                        wc_get_template_part('content', 'product');
                    }
                }
                
                woocommerce_product_loop_end();
                ?>
            </div>
            
            <!-- Empty State (hidden by default) -->
            <div class="weh-empty-state" id="weh-empty-state" style="display: none;">
                <p class="weh-empty-state-message">
                    We don't have a perfect glow yet — try removing a filter or browse Urban Glow favourites.
                </p>
                <div class="weh-empty-state-products">
                    <?php
                    // Show recommended products
                    $recommended = wc_get_products(array(
                        'limit' => 4,
                        'orderby' => 'popularity',
                    ));
                    
                    if ($recommended) {
                        foreach ($recommended as $product) {
                            wc_get_template('content-product.php', array('product' => $product));
                        }
                    }
                    ?>
                </div>
            </div>
            
            <?php
            // Pagination
            woocommerce_pagination();
        } else {
            // Empty state
            ?>
            <div class="weh-empty-state">
                <p class="weh-empty-state-message">
                    We don't have a perfect glow yet — try removing a filter or browse Urban Glow favourites.
                </p>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<!-- Lifestyle Row (Optional) -->
<?php
$lifestyle_row = get_field('lifestyle_row', 'option');
if ($lifestyle_row) :
    ?>
    <section class="weh-section weh-section-sm">
        <div class="weh-container">
            <div class="weh-lifestyle-row">
                <?php if ($lifestyle_row['image']) : ?>
                    <img src="<?php echo esc_url($lifestyle_row['image']['url']); ?>" 
                         alt="<?php echo esc_attr($lifestyle_row['image']['alt']); ?>" 
                         class="weh-lifestyle-image" 
                         loading="lazy">
                <?php endif; ?>
                <div class="weh-lifestyle-content">
                    <h3><?php echo esc_html($lifestyle_row['title']); ?></h3>
                    <a href="<?php echo esc_url($lifestyle_row['link']); ?>" class="weh-btn weh-btn-primary">
                        <?php echo esc_html($lifestyle_row['cta']); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;
?>

<!-- Footer CTA -->
<section class="weh-section">
    <div class="weh-container">
        <div class="weh-footer-cta">
            <p>Need help choosing? <a href="<?php echo esc_url(get_permalink(get_page_by_path('support/contact'))); ?>" class="weh-btn weh-btn-ghost">Book a lighting call</a></p>
        </div>
    </div>
</section>

<?php
get_footer('shop');
?>

