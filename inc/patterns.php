<?php
/**
 * Block Patterns Registration
 */

function mxc_register_block_patterns() {
    if ( ! function_exists( 'register_block_pattern_category' ) ) {
        return;
    }

    // Register Categories
    register_block_pattern_category( 'mxc-hero', array( 'label' => __( 'Hero', 'metaxchron' ) ) );
    register_block_pattern_category( 'mxc-magazine', array( 'label' => __( 'Magazine', 'metaxchron' ) ) );
    register_block_pattern_category( 'mxc-cta', array( 'label' => __( 'Call to Action', 'metaxchron' ) ) );

    // 1. Premium Hero Pattern
    register_block_pattern(
        'mxc/hero-futurism',
        array(
            'title'       => __( 'Futurism Hero', 'metaxchron' ),
            'categories'  => array( 'mxc-hero' ),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"8rem","bottom":"8rem"}},"color":{"background":"#121212"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="background-color:#121212;padding-top:8rem;padding-bottom:8rem"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"4.5rem","fontWeight":"800","lineHeight":"1.1"}},"textColor":"white"} -->
<h1 class="has-white-color has-text-color" style="font-size:4.5rem;font-weight:800;line-height:1.1">THE FUTURE IS<br>NOW LOADING.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"1.25rem"}},"textColor":"cyan-bluish-gray"} -->
<p class="has-cyan-bluish-gray-color has-text-color" style="font-size:1.25rem">Experience the next generation of digital storytelling with a theme built for speed, precision, and impact.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","style":{"border":{"radius":"2px"}},"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-primary-background-color has-background" style="border-radius:2px">Start Reading</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"border":{"radius":"2px"}},"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" style="border-radius:2px">Explore Features</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="" alt="Futuristic Placeholder"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
        )
    );

    // 2. Magazine Grid Pattern
    register_block_pattern(
        'mxc/magazine-grid',
        array(
            'title'       => __( 'Magazine Grid', 'metaxchron' ),
            'categories'  => array( 'mxc-magazine' ),
            'content'     => '<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"2px"}}} -->
<h2 class="has-text-align-center" style="text-transform:uppercase;letter-spacing:2px">Latest Stories</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/9","scale":"cover"} -->
<figure class="wp-block-image"><img alt="" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size"><a href="#">The Future of AI in 2024</a></h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">An in-depth look at how generative models are reshaping industries.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/9","scale":"cover"} -->
<figure class="wp-block-image"><img alt="" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size"><a href="#">Cyberpunk Aesthetics</a></h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Why neon and chrome are making a massive comeback in design.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"aspectRatio":"16/9","scale":"cover"} -->
<figure class="wp-block-image"><img alt="" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"level":3,"fontSize":"medium"} -->
<h3 class="has-medium-font-size"><a href="#">Quantum Computing</a></h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Unlocking the secrets of the universe one qubit at a time.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
        )
    );

    // 3. CTA Section
    register_block_pattern(
        'mxc/cta-neon',
        array(
            'title'       => __( 'Neon CTA', 'metaxchron' ),
            'categories'  => array( 'mxc-cta' ),
            'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"}},"border":{"width":"1px"}},"borderColor":"primary","backgroundColor":"dark-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-border-color has-dark-bg-background-color has-background has-border-color" style="border-width:1px;padding-top:6rem;padding-bottom:6rem"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontSize":"3rem","fontWeight":"800"}}} -->
<h2 class="has-text-align-center" style="font-size:3rem;font-weight:800">Ready to Upgrade?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size">Join thousands of readers getting the latest future-tech news delivered daily.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"width":50,"style":{"border":{"radius":"0px"}},"className":"is-style-fill"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-fill"><a class="wp-block-button__link" style="border-radius:0px">Subscribe Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
        )
    );
}
add_action( 'init', 'mxc_register_block_patterns' );
