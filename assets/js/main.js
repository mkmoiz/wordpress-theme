/**
 * Main JS for MetaXChron
 */

(function($) {
    "use strict";

    // Initialize Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Sticky Navbar Effect
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.navbar').addClass('shadow-lg');
        } else {
            $('.navbar').removeClass('shadow-lg');
        }
    });

    // Dark/Light Mode Toggle
    var theme = localStorage.getItem('mxc_theme') || 'dark';
    // Body attribute is already set by inline script in header to prevent FOUC
    if (!$('body').attr('data-theme')) {
        $('body').attr('data-theme', theme);
    }
    updateIcon(theme);

    $('.mxc-theme-toggle').on('click', function() {
        var current = $('body').attr('data-theme') || 'dark';
        var newTheme = current === 'light' ? 'dark' : 'light';
        $('body').attr('data-theme', newTheme);
        localStorage.setItem('mxc_theme', newTheme);
        updateIcon(newTheme);
    });

    function updateIcon(theme) {
        $('.mxc-theme-toggle i').each(function() {
            var icon = $(this);
            if (theme === 'light') {
                icon.removeClass('fa-sun').addClass('fa-moon');
            } else {
                icon.removeClass('fa-moon').addClass('fa-sun');
            }
        });
    }

    // Reveal on scroll
    var revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length) {
        var revealObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        revealEls.forEach(function(el) {
            revealObserver.observe(el);
        });
    }

    // Reading Progress Bar
    if ($('body').hasClass('single')) {
        $('body').append('<div id="progress-bar" style="position:fixed;top:0;left:0;height:4px;background:var(--mxc-primary-color);width:0%;z-index:9999;transition:width 0.1s;"></div>');

        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();
            var docHeight = $(document).height();
            var winHeight = $(window).height();
            var scrollPercent = (scrollTop) / (docHeight - winHeight);
            var scrollPercentRounded = Math.round(scrollPercent * 100);
            $('#progress-bar').css('width', scrollPercentRounded + '%');
        });
    }

    // AJAX Load More
    $('#mxc-load-more').on('click', function() {
        var button = $(this);
        var originalText = button.text();

        button.text('Loading...').prop('disabled', true);

        var data = {
            'action': 'mxc_load_more',
            'query': mxc_ajax_params.posts, // We need to pass query vars from PHP to JS
            'page' : mxc_ajax_params.current_page,
            'layout': mxc_ajax_params.layout,
            'nonce': mxc_ajax.nonce
        };

        $.ajax({
            url : mxc_ajax.ajax_url,
            data : data,
            type : 'POST',
            success : function( response ) {
                if( response ) {
                    button.text(originalText).prop('disabled', false);
                    $('#mxc-posts-container').append( response ); // Append to the container ID
                    mxc_ajax_params.current_page++;

                    if ( mxc_ajax_params.current_page == mxc_ajax_params.max_page ) {
                        button.remove(); // No more posts
                    }
                } else {
                    button.remove(); // No more posts
                }
            }
        });
    });

})(jQuery);
