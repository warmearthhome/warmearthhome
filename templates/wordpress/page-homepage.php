<?php
/**
 * Template Name: Homepage Template
 * 
 * Custom homepage template based on design documentation
 * 
 * @package WarmEarthHome
 */

get_header();
?>

<?php
/**
 * Provide graceful fallbacks so the page can still render without ACF data.
 */
$hero_slides = get_field('hero_slides');
if (empty($hero_slides)) {
    $hero_slides = array(
        array(
            'title'       => __('Warm light for everyday homes', 'warmearthhome'),
            'subtitle'    => __('Modern Earth · Urban Glow — crafted for calm Australian living.', 'warmearthhome'),
            'cta_1_text'  => __('Explore Modern Earth', 'warmearthhome'),
            'cta_1_link'  => home_url('/shop/?collection=modern-earth'),
            'cta_2_text'  => __('Shop Urban Glow', 'warmearthhome'),
            'cta_2_link'  => home_url('/shop/?collection=urban-glow'),
            'image'       => false,
        ),
    );
}
?>

<!-- 1. Hero Banner -->
<section class="weh-hero-banner">
    <div class="weh-hero-slider">
        <?php
        if ($hero_slides) {
            foreach ($hero_slides as $index => $slide) {
                $is_active = $index === 0 ? 'weh-hero-slide-active' : '';
                ?>
                <div class="weh-hero-slide <?php echo $is_active; ?>">
                    <div class="weh-hero-content">
                        <h1><?php echo esc_html($slide['title']); ?></h1>
                        <p class="weh-hero-subtitle"><?php echo esc_html($slide['subtitle']); ?></p>
                        <div class="weh-hero-cta">
                            <a href="<?php echo esc_url($slide['cta_1_link']); ?>" class="weh-btn weh-btn-primary weh-galaxy-btn">
                                <?php echo esc_html($slide['cta_1_text']); ?>
                            </a>
                            <a href="<?php echo esc_url($slide['cta_2_link']); ?>" class="weh-btn weh-btn-secondary weh-galaxy-btn weh-galaxy-btn-outline">
                                <?php echo esc_html($slide['cta_2_text']); ?>
                            </a>
                        </div>
                    </div>
                    <?php if ($slide['image']) : ?>
                        <img src="<?php echo esc_url($slide['image']['url']); ?>" 
                             alt="<?php echo esc_attr($slide['image']['alt']); ?>" 
                             class="weh-hero-image" 
                             loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                    <?php endif; ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="weh-hero-dots">
        <?php if ($hero_slides) : ?>
            <?php foreach ($hero_slides as $index => $slide) : ?>
                <button class="weh-hero-dot <?php echo $index === 0 ? 'weh-hero-dot-active' : ''; ?>" 
                        aria-label="Slide <?php echo $index + 1; ?>"></button>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- 2. Dual Series Highlights -->
<section class="weh-section">
    <div class="weh-container">
        <div class="weh-series-grid">
            <?php
            // Modern Earth Series Card
            $modern_earth = get_field('modern_earth_series');
            if (empty($modern_earth)) {
                $modern_earth = array(
                    'title'       => __('Modern Earth Series', 'warmearthhome'),
                    'description' => __('Soft natural textures and linen shades that bring calm to family homes.', 'warmearthhome'),
                    'cta'         => __('Shop the series', 'warmearthhome'),
                    'link'        => home_url('/collection/modern-earth'),
                    'image'       => false,
                );
            }
            if ($modern_earth) :
                ?>
                <div class="weh-series-card weh-series-card-modern-earth weh-galaxy-surface">
                    <?php if ($modern_earth['image']) : ?>
                        <img src="<?php echo esc_url($modern_earth['image']['url']); ?>" 
                             alt="<?php echo esc_attr($modern_earth['image']['alt']); ?>" 
                             class="weh-series-card-image" 
                             loading="lazy">
                    <?php endif; ?>
                    <h2 class="weh-series-card-title"><?php echo esc_html($modern_earth['title']); ?></h2>
                    <p class="weh-series-card-description"><?php echo esc_html($modern_earth['description']); ?></p>
                    <a href="<?php echo esc_url($modern_earth['link']); ?>" class="weh-btn weh-btn-primary weh-galaxy-btn">
                        <?php echo esc_html($modern_earth['cta']); ?>
                    </a>
                </div>
                <?php
            endif;
            
            // Urban Glow Series Card
            $urban_glow = get_field('urban_glow_series');
            if (empty($urban_glow)) {
                $urban_glow = array(
                    'title'       => __('Urban Glow Series', 'warmearthhome'),
                    'description' => __('Minimal metallic glow, renter-friendly fittings for compact apartments.', 'warmearthhome'),
                    'cta'         => __('Discover Urban Glow', 'warmearthhome'),
                    'link'        => home_url('/collection/urban-glow'),
                    'image'       => false,
                );
            }
            if ($urban_glow) :
                ?>
                <div class="weh-series-card weh-series-card-urban-glow weh-galaxy-surface">
                    <?php if ($urban_glow['image']) : ?>
                        <img src="<?php echo esc_url($urban_glow['image']['url']); ?>" 
                             alt="<?php echo esc_attr($urban_glow['image']['alt']); ?>" 
                             class="weh-series-card-image" 
                             loading="lazy">
                    <?php endif; ?>
                    <h2 class="weh-series-card-title"><?php echo esc_html($urban_glow['title']); ?></h2>
                    <p class="weh-series-card-description"><?php echo esc_html($urban_glow['description']); ?></p>
                    <a href="<?php echo esc_url($urban_glow['link']); ?>" class="weh-btn weh-btn-primary weh-galaxy-btn">
                        <?php echo esc_html($urban_glow['cta']); ?>
                    </a>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<!-- 3. Shop by Space -->
<section class="weh-section weh-section-sm">
    <div class="weh-container">
        <h2 class="weh-text-center weh-mb-lg">Shop by Space</h2>
        <div class="weh-space-grid">
            <?php
            $spaces = get_field('shop_by_space');
            if ($spaces) {
                foreach ($spaces as $space) {
                    ?>
                    <a href="<?php echo esc_url($space['link']); ?>" class="weh-space-card weh-galaxy-surface">
                        <?php if (! empty($space['image'])) : ?>
                            <img src="<?php echo esc_url($space['image']['url']); ?>" 
                                 alt="<?php echo esc_attr($space['image']['alt']); ?>" 
                                 class="weh-space-card-image" 
                                 loading="lazy">
                        <?php endif; ?>
                        <div class="weh-space-card-content">
                            <h3><?php echo esc_html($space['title']); ?></h3>
                            <span class="weh-btn weh-btn-ghost"><?php echo esc_html($space['cta']); ?></span>
                        </div>
                    </a>
                    <?php
                }
            } else {
                $default_spaces = array(
                    array(
                        'title' => __('Bedroom', 'warmearthhome'),
                        'cta'   => __('View bedroom lighting', 'warmearthhome'),
                        'link'  => home_url('/shop-by-space/bedroom'),
                    ),
                    array(
                        'title' => __('Living Room', 'warmearthhome'),
                        'cta'   => __('Create a calm living zone', 'warmearthhome'),
                        'link'  => home_url('/shop-by-space/living-room'),
                    ),
                    array(
                        'title' => __('Dining', 'warmearthhome'),
                        'cta'   => __('Style the dining table', 'warmearthhome'),
                        'link'  => home_url('/shop-by-space/dining'),
                    ),
                    array(
                        'title' => __('Entryway', 'warmearthhome'),
                        'cta'   => __('Make a warm welcome', 'warmearthhome'),
                        'link'  => home_url('/shop-by-space/entryway'),
                    ),
                );
                foreach ($default_spaces as $space) :
                    ?>
                    <a href="<?php echo esc_url($space['link']); ?>" class="weh-space-card weh-galaxy-surface">
                        <div class="weh-space-card-placeholder">
                            <h3><?php echo esc_html($space['title']); ?></h3>
                            <span class="weh-btn weh-btn-ghost"><?php echo esc_html($space['cta']); ?></span>
                        </div>
                    </a>
                    <?php
                endforeach;
            }
            ?>
        </div>
    </div>
</section>

<!-- 4. Best Sellers -->
<section class="weh-section">
    <div class="weh-container">
        <h2 class="weh-text-center weh-mb-lg">Best Sellers</h2>
        <?php
        if (function_exists('wc_get_products')) {
            // Try to get featured products first, then fallback to all products
            $best_sellers = wc_get_products(array(
                'limit' => 8,
                'featured' => true,
                'status' => 'publish',
            ));
            
            // If no featured products, get all products
            if (empty($best_sellers)) {
                $best_sellers = wc_get_products(array(
                    'limit' => 8,
                    'status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));
            }
            
            if ($best_sellers) {
                echo '<div class="weh-product-slider">';
                foreach ($best_sellers as $product) {
                    ?>
                    <div class="weh-product-card">
                        <a href="<?php echo esc_url($product->get_permalink()); ?>">
                            <?php echo $product->get_image('weh-product', array('class' => 'weh-product-card-image', 'loading' => 'lazy')); ?>
                        </a>
                        <?php if ($product->is_on_sale()) : ?>
                            <span class="weh-product-card-badge"><?php esc_html_e('Best Seller', 'warmearthhome'); ?></span>
                        <?php endif; ?>
                        <div class="weh-product-card-content">
                            <h3 class="weh-product-card-title">
                                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                    <?php echo esc_html($product->get_name()); ?>
                                </a>
                            </h3>
                            <p class="weh-product-card-price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
                            <?php
                            woocommerce_template_loop_add_to_cart();
                            ?>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            } else {
                ?>
                <div class="weh-product-placeholder">
                    <p><?php esc_html_e('Add featured products in WooCommerce to highlight them here.', 'warmearthhome'); ?></p>
                    <a class="weh-btn weh-btn-primary" href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>">
                        <?php esc_html_e('Manage products', 'warmearthhome'); ?>
                    </a>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="weh-product-placeholder">
                <p><?php esc_html_e('WooCommerce is not active. Install WooCommerce to display best sellers.', 'warmearthhome'); ?></p>
            </div>
            <?php
        }
        ?>
    </div>
</section>

<!-- 5. Inspiration Stories -->
<section class="weh-section weh-section-sm">
    <div class="weh-container">
        <h2 class="weh-text-center weh-mb-lg">Lighting Ideas</h2>
        <div class="weh-inspiration-grid">
            <?php
$inspiration_posts = get_posts(array(
                'post_type' => 'post',
                'category_name' => 'inspiration',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
            ));
            
            if ($inspiration_posts) {
                foreach ($inspiration_posts as $post) {
                    setup_postdata($post);
                    ?>
                    <article class="weh-inspiration-card">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('weh-lifestyle', array('class' => 'weh-inspiration-card-image', 'loading' => 'lazy')); ?>
                            <?php endif; ?>
                        </a>
                        <div class="weh-inspiration-card-content">
                            <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="weh-btn weh-btn-ghost">Read more</a>
                        </div>
                    </article>
                    <?php
                }
                wp_reset_postdata();
} else {
    $fallback_posts = array(
        array(
            'title'   => __('Lighting Ideas for Cozy Bedrooms', 'warmearthhome'),
            'excerpt' => __('Layer warm pendants and wall lamps to create a calm bedroom retreat in any rental.', 'warmearthhome'),
            'link'    => home_url('/inspiration/lighting-ideas-for-cozy-bedrooms'),
        ),
        array(
            'title'   => __('How to Choose Pendant Heights', 'warmearthhome'),
            'excerpt' => __('Simple rules for dining tables, kitchen islands, and entryway pendants.', 'warmearthhome'),
            'link'    => home_url('/inspiration/how-to-choose-pendant-heights'),
        ),
        array(
            'title'   => __('Renter-Friendly Lighting Upgrades', 'warmearthhome'),
            'excerpt' => __('Stick-on hooks, plug-in fittings, and smart bulbs that require zero hardwiring.', 'warmearthhome'),
            'link'    => home_url('/inspiration/renter-friendly-lighting-upgrades'),
        ),
    );
    foreach ($fallback_posts as $fallback_post) :
        ?>
        <article class="weh-inspiration-card">
            <div class="weh-inspiration-card-placeholder"></div>
            <div class="weh-inspiration-card-content">
                <h3><a href="<?php echo esc_url($fallback_post['link']); ?>"><?php echo esc_html($fallback_post['title']); ?></a></h3>
                <p><?php echo esc_html($fallback_post['excerpt']); ?></p>
                <a href="<?php echo esc_url($fallback_post['link']); ?>" class="weh-btn weh-btn-ghost"><?php esc_html_e('Read more', 'warmearthhome'); ?></a>
            </div>
        </article>
        <?php
    endforeach;
}
            ?>
        </div>
    </div>
</section>

<!-- 6. Brand Philosophy -->
<section class="weh-section">
    <div class="weh-container">
        <div class="weh-philosophy-grid">
            <div class="weh-philosophy-content">
                <?php
                $philosophy = get_field('brand_philosophy');
                if ($philosophy) :
                    ?>
                    <blockquote><?php echo esc_html($philosophy['quote']); ?></blockquote>
                    <ul>
                        <?php foreach ($philosophy['values'] as $value) : ?>
                            <li><strong><?php echo esc_html($value['title']); ?></strong> – <?php echo esc_html($value['description']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?php echo esc_url($philosophy['cta_link']); ?>" class="weh-btn weh-btn-primary weh-galaxy-btn">
                        <?php echo esc_html($philosophy['cta_text']); ?>
                    </a>
                    <?php
                else :
                    ?>
                    <blockquote><?php esc_html_e('Warm Earth Home brings light that feels alive — crafted for calm, modern living.', 'warmearthhome'); ?></blockquote>
                    <ul>
                        <li><strong><?php esc_html_e('Warm', 'warmearthhome'); ?></strong> – <?php esc_html_e('Soft, diffused light that creates a gentle glow.', 'warmearthhome'); ?></li>
                        <li><strong><?php esc_html_e('Calm', 'warmearthhome'); ?></strong> – <?php esc_html_e('Muted palettes and natural materials that steady the senses.', 'warmearthhome'); ?></li>
                        <li><strong><?php esc_html_e('Simple', 'warmearthhome'); ?></strong> – <?php esc_html_e('Renter-friendly fittings tailored to Australian homes.', 'warmearthhome'); ?></li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/about')); ?>" class="weh-btn weh-btn-primary weh-galaxy-btn">
                        <?php esc_html_e('Discover our story', 'warmearthhome'); ?>
                    </a>
                    <?php
                endif;
                ?>
            </div>
            <div class="weh-philosophy-image">
                <?php
                $philosophy_image = get_field('philosophy_image');
                if ($philosophy_image) :
                    ?>
                    <img src="<?php echo esc_url($philosophy_image['url']); ?>" 
                         alt="<?php echo esc_attr($philosophy_image['alt']); ?>" 
                         loading="lazy">
                    <?php
                else :
                    ?>
                    <div class="weh-philosophy-placeholder"></div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- 7. Testimonials (Optional) -->
<?php
$testimonials = get_field('testimonials');
if ($testimonials) :
    ?>
    <section class="weh-section weh-section-sm">
        <div class="weh-container">
            <h2 class="weh-text-center weh-mb-lg">What Our Customers Say</h2>
            <div class="weh-testimonials-grid">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <div class="weh-testimonial-card">
                        <div class="weh-testimonial-rating">
                            <?php
                            $rating = $testimonial['rating'];
                            for ($i = 0; $i < 5; $i++) {
                                echo $i < $rating ? '★' : '☆';
                            }
                            ?>
                        </div>
                        <p class="weh-testimonial-text"><?php echo esc_html($testimonial['text']); ?></p>
                        <p class="weh-testimonial-author"><?php echo esc_html($testimonial['author']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
else :
    ?>
    <section class="weh-section weh-section-sm">
        <div class="weh-container">
            <h2 class="weh-text-center weh-mb-lg"><?php esc_html_e('Why customers love us', 'warmearthhome'); ?></h2>
            <div class="weh-testimonials-grid">
                <div class="weh-testimonial-card">
                    <div class="weh-testimonial-rating">★★★★★</div>
                    <p class="weh-testimonial-text"><?php esc_html_e('“Fixtures arrived quickly and were so easy to install in our rental apartment.”', 'warmearthhome'); ?></p>
                    <p class="weh-testimonial-author">— <?php esc_html_e('Sydney renter', 'warmearthhome'); ?></p>
                </div>
                <div class="weh-testimonial-card">
                    <div class="weh-testimonial-rating">★★★★★</div>
                    <p class="weh-testimonial-text"><?php esc_html_e('“Love the warm glow and natural materials — exactly as described.”', 'warmearthhome'); ?></p>
                    <p class="weh-testimonial-author">— <?php esc_html_e('Melbourne homeowner', 'warmearthhome'); ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;
?>

<!-- 8. Newsletter & CTA -->
<section class="weh-section">
    <div class="weh-container">
        <div class="weh-newsletter">
            <h2>Join our warm circle</h2>
            <p>Get lighting tips & new arrivals first.</p>
            <?php
            // Use Mailchimp or Fluent Forms shortcode
            $newsletter_shortcode = apply_filters('warmearthhome_newsletter_shortcode', '[fluentform id="1"]');
            $newsletter_output    = do_shortcode($newsletter_shortcode);

            if (! empty($newsletter_output)) {
                echo $newsletter_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            } else {
                ?>
                <form class="weh-newsletter-fallback" action="<?php echo esc_url(home_url('/subscribe')); ?>" method="post">
                    <label class="screen-reader-text" for="weh-newsletter-email"><?php esc_html_e('Email address', 'warmearthhome'); ?></label>
                    <input type="email" id="weh-newsletter-email" name="email" placeholder="<?php esc_attr_e('you@example.com', 'warmearthhome'); ?>" required>
                    <button type="submit" class="weh-btn weh-btn-primary weh-galaxy-btn"><?php esc_html_e('Subscribe', 'warmearthhome'); ?></button>
                </form>
                <?php
            }
            ?>
            <p class="weh-newsletter-secondary">
                <a href="<?php echo esc_url(get_permalink(get_page_by_path('support/contact'))); ?>" class="weh-btn weh-btn-ghost">
                    Need help choosing? Contact us
                </a>
            </p>
        </div>
    </div>
</section>

<?php
get_footer();
?>

