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
         * Initialize all features
         */
        initStickyCart();
        initQuickView();
        initFilterToggle();
        initEmptyState();
        initLazyLoad();
        initScrollToTop();
        
    });

})(jQuery);

