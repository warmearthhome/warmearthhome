<?php
/**
 * Template Name: Support Center
 * 
 * Support Center page template with FAQ, Contact form, Shipping info
 * Based on docs/design/support.md
 * 
 * @package WarmEarthHome
 */

defined('ABSPATH') || exit;

get_header();
?>

<!-- Hero Area -->
<section class="weh-section weh-hero-section">
    <div class="weh-container">
        <div class="weh-hero-content">
            <h1 class="weh-hero-title">How can we help you light up with ease?</h1>
            <p class="weh-hero-subtitle">
                We're here to make warm lighting effortless. Our team responds within 24 hours on weekdays, 48 hours on weekends.
            </p>
            <a href="#contact-form" class="weh-btn weh-btn-primary">Contact us</a>
        </div>
    </div>
</section>

<!-- Quick Links Cards -->
<section class="weh-section">
    <div class="weh-container">
        <div class="weh-quick-links-grid">
            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="weh-quick-link-card">
                <div class="weh-quick-link-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3>Tracking My Order</h3>
                <p>Check your order status and delivery updates</p>
            </a>
            
            <a href="#shipping-returns" class="weh-quick-link-card">
                <div class="weh-quick-link-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                        <line x1="12" y1="22.08" x2="12" y2="12"/>
                    </svg>
                </div>
                <h3>Shipping & Returns</h3>
                <p>Free shipping over $199, 30-day returns</p>
            </a>
            
            <a href="#installation-guides" class="weh-quick-link-card">
                <div class="weh-quick-link-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <h3>Installation Guides</h3>
                <p>Step-by-step guides and PDF downloads</p>
            </a>
            
            <a href="#faq" class="weh-quick-link-card">
                <div class="weh-quick-link-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <h3>FAQ</h3>
                <p>Common questions and answers</p>
            </a>
            
            <a href="#contact-form" class="weh-quick-link-card">
                <div class="weh-quick-link-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                    </svg>
                </div>
                <h3>Contact / Styling Consultation</h3>
                <p>Get personalized lighting advice</p>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Accordion -->
<section class="weh-section" id="faq">
    <div class="weh-container">
        <h2 class="weh-section-title">Frequently Asked Questions</h2>
        
        <div class="weh-faq-accordion">
            <!-- Orders & Delivery -->
            <div class="weh-faq-category">
                <h3 class="weh-faq-category-title">Orders & Delivery</h3>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>How do I track my order?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>Once your order ships, you'll receive a tracking number via email. You can also track your order by logging into your account or visiting our <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">order tracking page</a>.</p>
                    </div>
                </div>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>How long does shipping take?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>We process orders within 1-2 business days. Standard shipping within Australia takes 5-10 business days. Express shipping (2-5 business days) is available at checkout.</p>
                    </div>
                </div>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>Do you ship internationally?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>Currently, we only ship within Australia. We're working on expanding our shipping options. Sign up for our newsletter to be notified when international shipping becomes available.</p>
                    </div>
                </div>
            </div>
            
            <!-- Returns & Exchanges -->
            <div class="weh-faq-category">
                <h3 class="weh-faq-category-title">Returns & Exchanges</h3>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>What is your return policy?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>We offer a 30-day return policy. Items must be in original packaging and unused condition. Please <a href="#contact-form">contact us</a> to initiate a return. Return shipping costs are the responsibility of the customer unless the item is defective or incorrect.</p>
                    </div>
                </div>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>How do I return an item?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>1. Contact our support team with your order number<br>
                        2. We'll provide a return authorization and shipping label<br>
                        3. Package the item in its original packaging<br>
                        4. Send it back to us<br>
                        5. Once received, we'll process your refund within 5-7 business days</p>
                    </div>
                </div>
            </div>
            
            <!-- Installation & Care -->
            <div class="weh-faq-category">
                <h3 class="weh-faq-category-title">Installation & Care</h3>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>Do I need an electrician to install?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>Hardwired fixtures require a licensed electrician. Plug-in options are perfect for renters and can be installed by anyone—just plug in and enjoy! Check the product specifications to see which installation type applies.</p>
                    </div>
                </div>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>How do I clean my lamp?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>For linen shades, use a soft brush or vacuum with a brush attachment. For metal and glass, a soft, damp cloth works best. Always unplug before cleaning and avoid harsh chemicals. See our <a href="#installation-guides">care guides</a> for detailed instructions.</p>
                    </div>
                </div>
            </div>
            
            <!-- Product Warranty -->
            <div class="weh-faq-category">
                <h3 class="weh-faq-category-title">Product Warranty</h3>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>What warranty do you offer?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>All products come with a 2-year warranty covering manufacturing defects. This includes issues with materials, workmanship, and electrical components. Normal wear and tear, damage from misuse, or modifications are not covered.</p>
                    </div>
                </div>
            </div>
            
            <!-- Payments & Invoices -->
            <div class="weh-faq-category">
                <h3 class="weh-faq-category-title">Payments & Invoices</h3>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>What payment methods do you accept?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>We accept all major credit cards, PayPal, and Afterpay (4 interest-free payments). All prices include GST and are in Australian Dollars (AUD).</p>
                    </div>
                </div>
                
                <div class="weh-faq-item">
                    <button class="weh-faq-question" aria-expanded="false">
                        <span>Can I get an invoice?</span>
                        <svg class="weh-faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>
                    <div class="weh-faq-answer">
                        <p>Yes! An invoice is automatically emailed to you after purchase. You can also download it from your account under "Orders".</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="weh-faq-cta">
            <p>Still need help? <a href="#contact-form">Reach our team ›</a></p>
        </div>
    </div>
</section>

<!-- Shipping & Returns Summary -->
<section class="weh-section" id="shipping-returns">
    <div class="weh-container">
        <h2 class="weh-section-title">Shipping & Returns</h2>
        
        <div class="weh-shipping-returns-grid">
            <div class="weh-shipping-info">
                <h3>Shipping</h3>
                <ul>
                    <li><strong>Free shipping</strong> on orders over $199 within Australia</li>
                    <li>Standard shipping: $12 (5-10 business days)</li>
                    <li>Express shipping: $25 (2-5 business days)</li>
                    <li>Orders processed within 1-2 business days</li>
                    <li>Tracking number provided via email</li>
                </ul>
            </div>
            
            <div class="weh-returns-info">
                <h3>Returns</h3>
                <ul>
                    <li><strong>30-day return policy</strong> on unused items in original packaging</li>
                    <li>Contact us to initiate a return</li>
                    <li>Return shipping costs are customer's responsibility (unless defective)</li>
                    <li>Refunds processed within 5-7 business days of receiving returned item</li>
                    <li>Exchanges available for different sizes or colors (subject to availability)</li>
                </ul>
                <p class="weh-returns-note"><strong>Important:</strong> Please keep original packaging for returns. Lamps must be returned in their original condition.</p>
            </div>
        </div>
        
        <div class="weh-shipping-cta">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('shipping-returns'))); ?>" class="weh-btn weh-btn-secondary">View Full Shipping & Returns Policy</a>
        </div>
    </div>
</section>

<!-- Installation Guides -->
<section class="weh-section" id="installation-guides">
    <div class="weh-container">
        <h2 class="weh-section-title">Installation Guides</h2>
        
        <div class="weh-installation-tabs">
            <button class="weh-installation-tab weh-installation-tab-active" data-tab="hardwired">Hardwired</button>
            <button class="weh-installation-tab" data-tab="plug-in">Plug-in</button>
        </div>
        
        <div class="weh-installation-content">
            <div class="weh-installation-panel weh-installation-panel-active" id="hardwired">
                <h3>Hardwired Installation</h3>
                <p>Hardwired fixtures must be installed by a licensed electrician. This ensures safety and compliance with Australian electrical standards.</p>
                <ul>
                    <li>Turn off power at the circuit breaker</li>
                    <li>Follow local electrical codes</li>
                    <li>Use appropriate mounting hardware</li>
                    <li>Test before final installation</li>
                </ul>
                <p><strong>Safety Note:</strong> Always hire a qualified electrician for hardwired installations. DIY electrical work can be dangerous and may void your warranty.</p>
            </div>
            
            <div class="weh-installation-panel" id="plug-in">
                <h3>Plug-in Installation</h3>
                <p>Perfect for renters! Our plug-in options require no electrical work—just plug in and enjoy.</p>
                <ul>
                    <li>No drilling or wiring required</li>
                    <li>Easy to move or relocate</li>
                    <li>Renter-friendly</li>
                    <li>Compatible with standard AU power outlets</li>
                </ul>
                <p><strong>Tip:</strong> Use cable management clips to keep cords tidy and safe.</p>
            </div>
        </div>
        
        <div class="weh-installation-downloads">
            <h3>Download Installation Guides</h3>
            <div class="weh-download-list">
                <?php
                // This would typically come from ACF or custom fields
                $installation_guides = array(
                    array('name' => 'Modern Earth Pendant – Installation Guide', 'size' => '2.3 MB', 'url' => '#'),
                    array('name' => 'Urban Glow Wall Lamp – Installation Guide', 'size' => '1.8 MB', 'url' => '#'),
                    array('name' => 'General Hardwired Installation Guide', 'size' => '3.1 MB', 'url' => '#'),
                    array('name' => 'Plug-in Installation Tips', 'size' => '0.9 MB', 'url' => '#'),
                );
                
                foreach ($installation_guides as $guide) {
                    echo '<div class="weh-download-item">';
                    echo '<a href="' . esc_url($guide['url']) . '" class="weh-download-link" download>';
                    echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">';
                    echo '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>';
                    echo '<polyline points="7 10 12 15 17 10"/>';
                    echo '<line x1="12" y1="15" x2="12" y2="3"/>';
                    echo '</svg>';
                    echo '<span>' . esc_html($guide['name']) . ' – PDF · ' . esc_html($guide['size']) . '</span>';
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Contact / Styling Help Form -->
<section class="weh-section weh-section-alt" id="contact-form">
    <div class="weh-container">
        <h2 class="weh-section-title">Contact Us</h2>
        <p class="weh-section-subtitle">We're here to help! Get in touch for product questions, styling advice, or support.</p>
        
		<?php
		$contact_status = isset($_GET['weh_contact']) ? sanitize_text_field(wp_unslash($_GET['weh_contact'])) : '';
		if ($contact_status === 'success') : ?>
			<div class="weh-notice weh-notice-success" role="status" aria-live="polite">
				<p>Thanks for reaching out — your message has been sent. We’ll reply within 24 hours (weekdays).</p>
			</div>
		<?php elseif ($contact_status === 'invalid' || $contact_status === 'error') : ?>
			<div class="weh-notice weh-notice-error" role="alert">
				<p>Sorry, we couldn’t submit your message. Please check required fields and try again.</p>
			</div>
		<?php endif; ?>
		
        <div class="weh-contact-grid">
            <div class="weh-contact-form-wrapper">
                <?php
                // Check if Contact Form 7 or similar is available
                if (function_exists('wpcf7_contact_form')) {
                    echo do_shortcode('[contact-form-7 id="support-contact"]');
                } else {
                    // Fallback form
                    ?>
                    <form class="weh-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="weh_contact_submit">
                        <?php wp_nonce_field('weh_contact_form', 'weh_contact_nonce'); ?>
                        
                        <div class="weh-form-group">
                            <label for="contact-name">Name <span class="weh-required">*</span></label>
                            <input type="text" id="contact-name" name="contact_name" required>
                        </div>
                        
                        <div class="weh-form-group">
                            <label for="contact-email">Email <span class="weh-required">*</span></label>
                            <input type="email" id="contact-email" name="contact_email" required>
                        </div>
                        
                        <div class="weh-form-group">
                            <label for="contact-phone">Phone</label>
                            <input type="tel" id="contact-phone" name="contact_phone">
                        </div>
                        
                        <div class="weh-form-group">
                            <label for="contact-order">Order Number (if applicable)</label>
                            <input type="text" id="contact-order" name="contact_order">
                        </div>
                        
                        <div class="weh-form-group">
                            <label for="contact-issue">How can we help? <span class="weh-required">*</span></label>
                            <select id="contact-issue" name="contact_issue" required>
                                <option value="">Select an option</option>
                                <option value="product-question">Product Question</option>
                                <option value="order-inquiry">Order Inquiry</option>
                                <option value="return-exchange">Return or Exchange</option>
                                <option value="installation-help">Installation Help</option>
                                <option value="styling-consultation">Styling Consultation</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="weh-form-group">
                            <label for="contact-message">Message <span class="weh-required">*</span></label>
                            <textarea id="contact-message" name="contact_message" rows="6" required></textarea>
                        </div>
                        
                        <button type="submit" class="weh-btn weh-btn-primary">Send Message</button>
                        
                        <p class="weh-form-note">We typically respond within 24 hours on weekdays, 48 hours on weekends.</p>
                    </form>
                    <?php
                }
                ?>
            </div>
            
            <div class="weh-contact-info">
                <div class="weh-contact-card">
                    <h3>Book a Styling Call</h3>
                    <p>Get personalized lighting advice for your space. Schedule a free 15-minute consultation with our styling team.</p>
                    <a href="mailto:hello@warmearthhome.com?subject=Styling Consultation Request" class="weh-btn weh-btn-secondary">Schedule a Call</a>
                </div>
                
                <div class="weh-contact-card">
                    <h3>Email Us</h3>
                    <p><a href="mailto:hello@warmearthhome.com">hello@warmearthhome.com</a></p>
                    <p>We respond within 24 hours on weekdays.</p>
                </div>
                
                <div class="weh-contact-card">
                    <h3>Follow Us</h3>
                    <p>Get lighting inspiration and tips:</p>
                    <div class="weh-social-links">
                        <a href="https://instagram.com/warmearthhome" target="_blank" rel="noopener" aria-label="Instagram">Instagram</a>
                        <a href="https://pinterest.com/warmearthhome" target="_blank" rel="noopener" aria-label="Pinterest">Pinterest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter CTA -->
<section class="weh-section weh-newsletter-section">
    <div class="weh-container">
        <div class="weh-newsletter-cta">
            <h2>Stay in our warm circle</h2>
            <p>Join our newsletter for installation tips, new product launches, and lighting inspiration.</p>
			<?php
			$newsletter_status = isset($_GET['weh_newsletter']) ? sanitize_text_field(wp_unslash($_GET['weh_newsletter'])) : '';
			if ($newsletter_status === 'success') : ?>
				<div class="weh-notice weh-notice-success" role="status" aria-live="polite">
					<p>Thanks for joining! Please check your inbox to confirm your subscription.</p>
				</div>
			<?php elseif ($newsletter_status === 'invalid' || $newsletter_status === 'error') : ?>
				<div class="weh-notice weh-notice-error" role="alert">
					<p>Please enter a valid email address and try again.</p>
				</div>
			<?php endif; ?>
            <?php
            // Newsletter shortcode (can be customized via filter)
            $newsletter_shortcode = apply_filters('warmearthhome_newsletter_shortcode', '[newsletter_form]');
            echo do_shortcode($newsletter_shortcode);
            ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>

