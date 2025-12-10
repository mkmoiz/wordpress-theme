<?php
/**
 * Block pattern registrations
 */

function mxc_register_patterns() {
    if ( ! function_exists( 'register_block_pattern_category' ) ) {
        return;
    }

    register_block_pattern_category(
        'metaxchron',
        array( 'label' => __( 'Metaxchron Layouts', 'metaxchron' ) )
    );

    // Hero Cover (Video BG Style)
    register_block_pattern(
        'metaxchron/hero-video',
        array(
            'title'       => __( 'Hero: Video Background', 'metaxchron' ),
            'categories'  => array( 'metaxchron' ),
            'content'     => '<!-- wp:cover {"overlayColor":"black","minHeight":600,"minHeightUnit":"px","isDark":true} -->
<div class="wp-block-cover is-dark" style="min-height:600px"><span aria-hidden="true" class="wp-block-cover__gradient-background has-black-background-color has-background-dim-100"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"4rem"}}} -->
<h1 class="has-text-align-center" style="font-size:4rem">The Future is Now</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size">Explore the latest in tech, science, and culture.</p>
<!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button">Start Reading</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
        )
    );

    // Feature Grid (3 Cols)
    register_block_pattern(
        'metaxchron/feature-grid',
        array(
            'title'       => __( 'Content: Feature Grid', 'metaxchron' ),
            'categories'  => array( 'metaxchron' ),
            'content'     => '<!-- wp:columns {"className":"mxc-section my-5"} -->
<div class="wp-block-columns mxc-section my-5"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"mb-3 rounded"} /-->
<figure class="wp-block-image size-large mb-3 rounded"><img src="" alt=""/></figure>
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size">Feature One</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"mb-3 rounded"} /-->
<figure class="wp-block-image size-large mb-3 rounded"><img src="" alt=""/></figure>
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size">Feature Two</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"mb-3 rounded"} /-->
<figure class="wp-block-image size-large mb-3 rounded"><img src="" alt=""/></figure>
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size">Feature Three</h3>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
        )
    );

    // Pricing Table
    register_block_pattern(
        'metaxchron/pricing-table',
        array(
            'title'       => __( 'Content: Pricing Table', 'metaxchron' ),
            'categories'  => array( 'metaxchron' ),
            'content'     => '<!-- wp:columns {"align":"wide","className":"my-5"} -->
<div class="wp-block-columns alignwide my-5"><!-- wp:column {"style":{"border":{"width":"1px","radius":"10px"}},"borderColor":"secondary"} -->
<div class="wp-block-column has-border-color has-secondary-border-color" style="border-width:1px;border-radius:10px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
<div class="wp-block-group" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="has-text-align-center">Basic</h3>
<!-- /wp:heading -->
<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xx-large"} -->
<h2 class="has-text-align-center has-xx-large-font-size">$9/mo</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul><li>Access to all articles</li><li>Weekly newsletter</li><li>No ads</li></ul>
<!-- /wp:list -->
<!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button">Choose Basic</a></div>
<!-- /wp:button --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<!-- wp:column {"style":{"border":{"width":"1px","radius":"10px"},"color":{"background":"#1e1e1e"}},"borderColor":"primary"} -->
<div class="wp-block-column has-border-color has-primary-border-color has-background" style="background-color:#1e1e1e;border-width:1px;border-radius:10px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
<div class="wp-block-group" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"primary"} -->
<h3 class="has-text-align-center has-primary-color has-text-color">Pro</h3>
<!-- /wp:heading -->
<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xx-large"} -->
<h2 class="has-text-align-center has-xx-large-font-size">$19/mo</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul><li>Everything in Basic</li><li><strong>Early access</strong></li><li>Exclusive community</li></ul>
<!-- /wp:list -->
<!-- wp:button {"width":100,"className":"is-style-fill"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-fill"><a class="wp-block-button__link wp-element-button">Choose Pro</a></div>
<!-- /wp:button --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->
<!-- wp:column {"style":{"border":{"width":"1px","radius":"10px"}},"borderColor":"secondary"} -->
<div class="wp-block-column has-border-color has-secondary-border-color" style="border-width:1px;border-radius:10px"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}}}} -->
<div class="wp-block-group" style="padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="has-text-align-center">Team</h3>
<!-- /wp:heading -->
<!-- wp:heading {"textAlign":"center","level":2,"fontSize":"xx-large"} -->
<h2 class="has-text-align-center has-xx-large-font-size">$49/mo</h2>
<!-- /wp:heading -->
<!-- wp:list -->
<ul><li>Up to 5 members</li><li>Team dashboard</li><li>Priority support</li></ul>
<!-- /wp:list -->
<!-- wp:button {"width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link wp-element-button">Choose Team</a></div>
<!-- /wp:button --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
        )
    );

    // FAQ Accordion (Simulated with Details block)
    register_block_pattern(
        'metaxchron/faq-accordion',
        array(
            'title'       => __( 'Content: FAQ', 'metaxchron' ),
            'categories'  => array( 'metaxchron' ),
            'content'     => '<!-- wp:group {"className":"my-5"} -->
<div class="wp-block-group my-5"><!-- wp:heading {"textAlign":"center","className":"mb-4"} -->
<h2 class="has-text-align-center mb-4">Frequently Asked Questions</h2>
<!-- /wp:heading -->
<!-- wp:details {"className":"mb-3 p-3 border rounded"} -->
<details class="wp-block-details mb-3 p-3 border rounded"><summary>How do I customize the theme?</summary><!-- wp:paragraph -->
<p>You can use the WordPress Customizer to change colors, fonts, and layouts instantly.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details {"className":"mb-3 p-3 border rounded"} -->
<details class="wp-block-details mb-3 p-3 border rounded"><summary>Is it mobile friendly?</summary><!-- wp:paragraph -->
<p>Yes, Metaxchron is fully responsive and looks great on all devices.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->
<!-- wp:details {"className":"mb-3 p-3 border rounded"} -->
<details class="wp-block-details mb-3 p-3 border rounded"><summary>Can I use it for a portfolio?</summary><!-- wp:paragraph -->
<p>Absolutely. The grid layouts and gallery support make it perfect for portfolios.</p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->',
        )
    );

    // Newsletter CTA
    register_block_pattern(
        'metaxchron/newsletter-cta',
        array(
            'title'       => __( 'Marketing: Newsletter CTA', 'metaxchron' ),
            'categories'  => array( 'metaxchron' ),
            'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"48px","right":"48px","bottom":"48px","left":"48px"}},"border":{"radius":"16px"}},"backgroundColor":"primary","textColor":"white","className":"mxc-section my-5"} -->
<div class="wp-block-group mxc-section my-5 has-white-color has-primary-background-color has-text-color has-background" style="border-radius:16px;padding-top:48px;padding-right:48px;padding-bottom:48px;padding-left:48px"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="has-text-align-center">Subscribe to our Newsletter</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Get the latest updates directly to your inbox.</p>
<!-- /wp:paragraph -->
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"70%"} -->
<div class="wp-block-column" style="flex-basis:70%"><!-- wp:paragraph {"placeholder":"Enter your email...","backgroundColor":"white","textColor":"black","className":"p-3 rounded"} -->
<p class="has-black-color has-white-background-color has-text-color has-background p-3 rounded">Enter your email...</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:button {"width":100,"className":"is-style-fill"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-fill"><a class="wp-block-button__link wp-element-button has-black-background-color has-background">Subscribe</a></div>
<!-- /wp:button --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
        )
    );
}
add_action( 'init', 'mxc_register_patterns' );
