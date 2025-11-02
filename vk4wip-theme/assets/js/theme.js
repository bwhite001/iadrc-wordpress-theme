/**
 * VK4WIP Theme - Main Theme Script
 * General theme functionality and enhancements
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Back to Top Button
        var $backToTop = $('<button class="back-to-top" aria-label="Back to top">↑</button>');
        $('body').append($backToTop);
        
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $backToTop.addClass('show');
            } else {
                $backToTop.removeClass('show');
            }
        });
        
        $backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 600);
        });

        // Add loading class to images
        $('img').each(function() {
            if (!this.complete) {
                $(this).addClass('loading');
            }
        }).on('load', function() {
            $(this).removeClass('loading').addClass('loaded');
        });

        // Lazy load images (simple implementation)
        if ('IntersectionObserver' in window) {
            var imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        imageObserver.unobserve(img);
                    }
                });
            });

            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }

        // External links - open in new tab
        $('a[href^="http"]').not('a[href*="' + window.location.hostname + '"]').attr({
            target: '_blank',
            rel: 'noopener noreferrer'
        }).addClass('external-link');

        // Add icon to external links
        $('a.external-link').append(' <span aria-hidden="true">↗</span>');

        // Smooth reveal animations on scroll
        if ('IntersectionObserver' in window) {
            var revealObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            $('.card, .content-card, .explore-card, .repeater, .event').each(function() {
                $(this).addClass('reveal-on-scroll');
                revealObserver.observe(this);
            });
        }

        // Add CSS for reveal animation
        if (!$('#reveal-animation-style').length) {
            $('<style id="reveal-animation-style">')
                .text('.reveal-on-scroll { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease, transform 0.6s ease; } .reveal-on-scroll.revealed { opacity: 1; transform: translateY(0); }')
                .appendTo('head');
        }

        // Accessible skip link focus
        $('.skip-link').on('click', function(e) {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                target.attr('tabindex', '-1').focus();
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 300);
            }
        });

        // Form validation enhancement
        $('form').on('submit', function(e) {
            var $form = $(this);
            var isValid = true;

            // Check required fields
            $form.find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('error').attr('aria-invalid', 'true');
                } else {
                    $(this).removeClass('error').attr('aria-invalid', 'false');
                }
            });

            // Email validation
            $form.find('input[type="email"]').each(function() {
                var email = $(this).val();
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email && !emailRegex.test(email)) {
                    isValid = false;
                    $(this).addClass('error').attr('aria-invalid', 'true');
                }
            });

            if (!isValid) {
                e.preventDefault();
                // Focus on first error
                $form.find('.error').first().focus();
            }
        });

        // Clear error on input
        $('input, textarea, select').on('input change', function() {
            $(this).removeClass('error').attr('aria-invalid', 'false');
        });

        // Accessible tables
        $('table').each(function() {
            if (!$(this).find('thead').length && $(this).find('tr').first().find('th').length) {
                $(this).find('tr').first().wrap('<thead></thead>');
            }
            if (!$(this).attr('role')) {
                $(this).attr('role', 'table');
            }
        });

        // Print functionality
        $('.print-page').on('click', function(e) {
            e.preventDefault();
            window.print();
        });

        // Share functionality (if Web Share API is available)
        if (navigator.share) {
            $('.share-button').on('click', function(e) {
                e.preventDefault();
                navigator.share({
                    title: document.title,
                    text: $('meta[name="description"]').attr('content') || '',
                    url: window.location.href
                }).catch(function(error) {
                    console.log('Error sharing:', error);
                });
            });
        }

        // Cookie consent (simple implementation)
        if (!localStorage.getItem('cookieConsent')) {
            var $cookieBanner = $('<div class="cookie-consent" role="alert">')
                .html('<p>This website uses cookies to ensure you get the best experience. <a href="/privacy-policy">Learn more</a></p><button class="btn btn-gold accept-cookies">Accept</button>')
                .appendTo('body');

            $('.accept-cookies').on('click', function() {
                localStorage.setItem('cookieConsent', 'true');
                $cookieBanner.fadeOut(300, function() {
                    $(this).remove();
                });
            });
        }

        // Add CSS for cookie consent
        if (!$('#cookie-consent-style').length) {
            $('<style id="cookie-consent-style">')
                .text('.cookie-consent { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(11, 45, 83, 0.95); color: white; padding: 20px; text-align: center; z-index: 9999; box-shadow: 0 -2px 10px rgba(0,0,0,0.2); } .cookie-consent p { margin: 0 0 10px; } .cookie-consent a { color: #F4C542; }')
                .appendTo('head');
        }

        // Keyboard shortcuts
        $(document).on('keydown', function(e) {
            // Alt + H = Home
            if (e.altKey && e.key === 'h') {
                e.preventDefault();
                window.location.href = '/';
            }
            // Alt + S = Search
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                $('input[type="search"], .search-field').first().focus();
            }
        });

        // Detect reduced motion preference
        var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
            $('body').addClass('reduced-motion');
        }

        // Console message for developers
        console.log('%cVK4WIP Amateur Radio Club Theme', 'font-size: 20px; font-weight: bold; color: #1E5CB3;');
        console.log('%cVersion 1.0.0', 'font-size: 14px; color: #6B778C;');
        console.log('%cDeveloped for Ipswich & District Radio Club', 'font-size: 12px; color: #6B778C;');

    });

    // Window load event
    $(window).on('load', function() {
        // Remove loading class from body
        $('body').removeClass('loading').addClass('loaded');
        
        // Trigger custom event for other scripts
        $(document).trigger('vk4wip:loaded');
    });

})(jQuery);
