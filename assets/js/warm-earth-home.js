/**
 * Warm Earth Home - Custom JavaScript
 * Version: 1.0.0
 * 
 * Handles interactive features based on design documentation
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        /**
         * Hero Banner Slider
         */
        function initHeroSlider() {
            var $slider = $('.weh-hero-slider');
            if ($slider.length === 0) return;
            
            var $slides = $slider.find('.weh-hero-slide');
            if ($slides.length <= 1) return;
            
            var currentSlide = 0;
            var slideInterval = 5000; // 5 seconds
            
            // Auto-advance slides
            var autoSlide = setInterval(function() {
                nextSlide();
            }, slideInterval);
            
            // Pause on hover
            $slider.on('mouseenter', function() {
                clearInterval(autoSlide);
            }).on('mouseleave', function() {
                autoSlide = setInterval(function() {
                    nextSlide();
                }, slideInterval);
            });
            
            function nextSlide() {
                $slides.eq(currentSlide).removeClass('weh-hero-slide-active');
                currentSlide = (currentSlide + 1) % $slides.length;
                $slides.eq(currentSlide).addClass('weh-hero-slide-active');
            }
            
            // Navigation arrows (if present)
            $('.weh-hero-nav-prev').on('click', function() {
                clearInterval(autoSlide);
                $slides.eq(currentSlide).removeClass('weh-hero-slide-active');
                currentSlide = (currentSlide - 1 + $slides.length) % $slides.length;
                $slides.eq(currentSlide).addClass('weh-hero-slide-active');
                autoSlide = setInterval(function() {
                    nextSlide();
                }, slideInterval);
            });
            
            $('.weh-hero-nav-next').on('click', function() {
                clearInterval(autoSlide);
                nextSlide();
                autoSlide = setInterval(function() {
                    nextSlide();
                }, slideInterval);
            });
        }
        
        /**
         * Product Gallery Thumbnail Switching
         */
        function initProductGallery() {
            $('.weh-product-gallery-thumbnail').on('click', function() {
                var $thumbnail = $(this);
                var imageUrl = $thumbnail.data('image');
                
                if (imageUrl) {
                    // Update main image
                    var $mainImage = $('#weh-main-image');
                    if ($mainImage.length) {
                        $mainImage.attr('src', imageUrl);
                    }
                    
                    // Update active thumbnail
                    $('.weh-product-gallery-thumbnail').removeClass('weh-product-gallery-thumbnail-active');
                    $thumbnail.addClass('weh-product-gallery-thumbnail-active');
                }
            });
        }
        
        /**
         * Product Tabs
         */
        function initProductTabs() {
            $('.weh-product-tab').on('click', function() {
                var tabName = $(this).data('tab');
                
                // Update active tab
                $('.weh-product-tab').removeClass('weh-product-tab-active');
                $(this).addClass('weh-product-tab-active');
                
                // Update active panel
                $('.weh-product-tab-panel').removeClass('weh-product-tab-panel-active');
                $('#' + tabName).addClass('weh-product-tab-panel-active');
            });
        }
        
        /**
         * Mobile Sticky Cart Bar
         */
        function initStickyCart() {
            if ($('body').hasClass('single-product')) {
                var $stickyCart = $('#weh-sticky-cart');
                var $addToCartBtn = $('.single_add_to_cart_button');
                
                if ($addToCartBtn.length === 0) return;
                
                $(window).scroll(function() {
                    var scrollTop = $(window).scrollTop();
                    var addToCartOffset = $addToCartBtn.offset().top;
                    var windowHeight = $(window).height();
                    
                    if (scrollTop + windowHeight > addToCartOffset + 100) {
                        $stickyCart.fadeIn();
                    } else {
                        $stickyCart.fadeOut();
                    }
                });
            }
        }
        
        /**
         * Product Quick View
         */
        function initQuickView() {
            $('.weh-quick-view-btn').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                
                // Track event
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'quick_view_open', {
                        'product_id': productId
                    });
                }
                
                // Load product data via AJAX
                // Implementation depends on your setup
            });
        }
        
        /**
         * Filter Toggle (Mobile)
         */
        function initFilterToggle() {
            $('.weh-filter-toggle').on('click', function() {
                $(this).closest('.weh-filter-bar').find('.weh-filter-drawer').slideToggle();
            });
        }
        
        /**
         * Empty State Handling
         */
        function initEmptyState() {
            var $productGrid = $('.weh-product-grid');
            
            if ($productGrid.length > 0 && $productGrid.children().length === 0) {
                $productGrid.html(
                    '<div class="weh-empty-state">' +
                    '<p class="weh-empty-state-message">' +
                    'We don\'t have a perfect glow yet — try removing a filter or browse Urban Glow favourites.' +
                    '</p>' +
                    '</div>'
                );
                
                // Track empty state
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'empty_state_view', {
                        'filter_combination': window.location.search
                    });
                }
            }
        }
        
        /**
         * Lazy Load Images
         */
        function initLazyLoad() {
            if ('loading' in HTMLImageElement.prototype) {
                var images = document.querySelectorAll('img[data-src]');
                images.forEach(function(img) {
                    img.src = img.dataset.src;
                });
            } else {
                // Fallback for older browsers
                var script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
                document.body.appendChild(script);
            }
        }
        
        /**
         * Scroll to Top Button
         */
        function initScrollToTop() {
            var $scrollBtn = $('<button class="weh-scroll-to-top" aria-label="Scroll to top">↑</button>');
            $('body').append($scrollBtn);
            
            $(window).scroll(function() {
                if ($(window).scrollTop() > 600) {
                    $scrollBtn.fadeIn();
                } else {
                    $scrollBtn.fadeOut();
                }
            });
            
            $scrollBtn.on('click', function() {
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        }
        
        /**
         * FAQ Accordion
         */
        function initFAQAccordion() {
            $('.weh-faq-question').on('click', function() {
                var $question = $(this);
                var $answer = $question.next('.weh-faq-answer');
                var isExpanded = $question.attr('aria-expanded') === 'true';
                
                // Toggle aria-expanded
                $question.attr('aria-expanded', !isExpanded);
                
                // Toggle active class
                if (isExpanded) {
                    $answer.removeClass('active');
                } else {
                    $answer.addClass('active');
                    
                    // Track FAQ open event
                    var category = $question.closest('.weh-faq-category').find('.weh-faq-category-title').text();
                    var question = $question.find('span').text();
                    
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'faq_open', {
                            'category': category,
                            'question': question
                        });
                    }
                }
            });
        }
        
        /**
         * Installation Tabs
         */
        function initInstallationTabs() {
            $('.weh-installation-tab').on('click', function() {
                var tabName = $(this).data('tab');
                
                // Update active tab
                $('.weh-installation-tab').removeClass('weh-installation-tab-active');
                $(this).addClass('weh-installation-tab-active');
                
                // Update active panel
                $('.weh-installation-panel').removeClass('weh-installation-panel-active');
                $('#' + tabName).addClass('weh-installation-panel-active');
            });
        }
        
        /**
         * Download Guide Tracking
         */
        function initDownloadTracking() {
            $('.weh-download-link').on('click', function() {
                var fileName = $(this).find('span').text();
                var fileSize = fileName.match(/·\s*([\d.]+)\s*MB/);
                
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'download_guide', {
                        'file_name': fileName,
                        'file_size': fileSize ? fileSize[1] + ' MB' : 'unknown'
                    });
                }
            });
        }
        
        /**
         * Contact Form Validation & Submission
         */
        function initContactForm() {
            $('.weh-contact-form').on('submit', function(e) {
                var $form = $(this);
                var isValid = true;
                
                // Basic validation
                $form.find('input[required], select[required], textarea[required]').each(function() {
                    var $field = $(this);
                    if (!$field.val().trim()) {
                        isValid = false;
                        $field.addClass('error');
                    } else {
                        $field.removeClass('error');
                    }
                });
                
                // Email validation
                var $email = $form.find('input[type="email"]');
                if ($email.length && $email.val()) {
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test($email.val())) {
                        isValid = false;
                        $email.addClass('error');
                    }
                }
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields correctly.');
                    return false;
                }
                
                // Track form submission
                var issueType = $form.find('#contact-issue').val();
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'contact_submit', {
                        'issue_type': issueType || 'other'
                    });
                }
            });
            
            // Remove error class on input
            $('.weh-contact-form input, .weh-contact-form select, .weh-contact-form textarea').on('input change', function() {
                $(this).removeClass('error');
            });
        }
        
        /**
         * Schedule Call Tracking
         */
        function initScheduleCallTracking() {
            $('a[href*="Styling Consultation"]').on('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'schedule_call', {
                        'source': 'support_page'
                    });
                }
            });
        }
        
        /**
         * Order Tracking Click Tracking
         */
        function initOrderTracking() {
            $('a[href*="myaccount"]').on('click', function() {
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'order_track_click', {
                        'order_status': 'unknown'
                    });
                }
            });
        }
        
        /**
         * Smooth Scroll for Anchor Links
         */
        function initSmoothScroll() {
            $('a[href^="#"]').on('click', function(e) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 600);
                }
            });
        }
        
        /**
         * Initialize all features
         */
        initHeroSlider();
        initProductGallery();
        initProductTabs();
        initStickyCart();
        initQuickView();
        initFilterToggle();
        initEmptyState();
        initLazyLoad();
        initScrollToTop();
        initFAQAccordion();
        initInstallationTabs();
        initDownloadTracking();
        initContactForm();
        initScheduleCallTracking();
        initOrderTracking();
        initSmoothScroll();
        
    });

})(jQuery);

