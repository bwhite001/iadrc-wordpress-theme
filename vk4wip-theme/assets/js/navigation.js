/**
 * VK4WIP Theme - Navigation Script
 * Handles mobile menu toggle and keyboard navigation
 *
 * @package VK4WIP_Theme
 * @since 1.0.0
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Mobile Menu Toggle
        $('.menu-toggle').on('click', function() {
            var $menu = $('#site-navigation .menu');
            var expanded = $(this).attr('aria-expanded') === 'true' || false;
            
            $(this).attr('aria-expanded', !expanded);
            $menu.toggleClass('toggled');
            
            // Update button text for accessibility
            if (!expanded) {
                $(this).attr('aria-label', 'Close menu');
            } else {
                $(this).attr('aria-label', 'Open menu');
            }
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            var $menu = $('#site-navigation .menu');
            var $toggle = $('.menu-toggle');
            
            if (!$toggle.is(e.target) && 
                !$menu.is(e.target) && 
                $menu.has(e.target).length === 0 &&
                $menu.hasClass('toggled')) {
                $toggle.trigger('click');
            }
        });

        // Close mobile menu on escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                var $menu = $('#site-navigation .menu');
                if ($menu.hasClass('toggled')) {
                    $('.menu-toggle').trigger('click');
                }
            }
        });

        // Submenu keyboard navigation
        $('#site-navigation .menu-item-has-children > a').on('focus', function() {
            $(this).parent().addClass('focus');
        });

        $('#site-navigation .menu-item-has-children > a').on('blur', function() {
            $(this).parent().removeClass('focus');
        });

        // Handle submenu toggle on mobile
        if (window.innerWidth <= 720) {
            $('#site-navigation .menu-item-has-children > a').on('click', function(e) {
                var $parent = $(this).parent();
                var $submenu = $parent.find('> .sub-menu');
                
                if ($submenu.length) {
                    e.preventDefault();
                    $parent.toggleClass('open');
                    $submenu.slideToggle(200);
                }
            });
        }

        // Update submenu behavior on window resize
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth > 720) {
                    // Desktop: remove mobile menu classes
                    $('#site-navigation .menu').removeClass('toggled');
                    $('.menu-toggle').attr('aria-expanded', 'false');
                    $('#site-navigation .menu-item-has-children').removeClass('open');
                    $('#site-navigation .sub-menu').removeAttr('style');
                }
            }, 250);
        });

        // Add active class to current menu item
        var currentUrl = window.location.href;
        $('#site-navigation .menu a').each(function() {
            if (this.href === currentUrl) {
                $(this).parent().addClass('current-menu-item');
            }
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function(e) {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 800);
                    
                    // Update URL without jumping
                    if (history.pushState) {
                        history.pushState(null, null, this.hash);
                    }
                    
                    // Focus on target for accessibility
                    target.focus();
                    if (!target.is(':focus')) {
                        target.attr('tabindex', '-1');
                        target.focus();
                    }
                }
            }
        });

        // Sticky header on scroll (optional)
        var lastScrollTop = 0;
        var $header = $('.site-header');
        var headerHeight = $header.outerHeight();
        
        $(window).on('scroll', function() {
            var scrollTop = $(this).scrollTop();
            
            if (scrollTop > headerHeight) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
            
            lastScrollTop = scrollTop;
        });

        // Add focus class for keyboard navigation
        $('#site-navigation a').on('focus blur', function() {
            $(this).parents('li').toggleClass('focus');
        });

        // Trap focus in mobile menu when open
        var $menu = $('#site-navigation .menu');
        var $toggle = $('.menu-toggle');
        
        $menu.on('keydown', function(e) {
            if (!$menu.hasClass('toggled')) return;
            
            var $focusable = $menu.find('a, button').filter(':visible');
            var $first = $focusable.first();
            var $last = $focusable.last();
            
            if (e.key === 'Tab' || e.keyCode === 9) {
                if (e.shiftKey) {
                    // Shift + Tab
                    if (document.activeElement === $first[0]) {
                        e.preventDefault();
                        $toggle.focus();
                    }
                } else {
                    // Tab
                    if (document.activeElement === $last[0]) {
                        e.preventDefault();
                        $toggle.focus();
                    }
                }
            }
        });

    });

})(jQuery);
