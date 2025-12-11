<?php
/**
 * Contact Form 7 Integration
 */

function mxc_cf7_styles() {
    ?>
    <style>
        /* CF7 Input Styles matching Theme */
        .wpcf7 input[type="text"],
        .wpcf7 input[type="email"],
        .wpcf7 input[type="url"],
        .wpcf7 input[type="tel"],
        .wpcf7 textarea,
        .wpcf7 select {
            background-color: rgba(255,255,255,0.05);
            border: 1px solid var(--mxc-border-color);
            color: var(--mxc-text-main);
            padding: 0.8rem;
            border-radius: 2px; /* Sharp corners */
            width: 100%;
            transition: all 0.3s ease;
        }

        .wpcf7 input:focus,
        .wpcf7 textarea:focus {
            border-color: var(--mxc-primary-color);
            background-color: rgba(255,255,255,0.08);
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.2);
            outline: none;
        }

        /* Submit Button */
        .wpcf7 input[type="submit"] {
            background-color: var(--mxc-primary-color);
            color: #fff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 2px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .wpcf7 input[type="submit"]:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Validation Messages */
        .wpcf7-not-valid-tip {
            color: #ea4335;
            font-size: 0.85rem;
            margin-top: 0.3rem;
        }

        .wpcf7-response-output {
            border-radius: 2px;
            border-width: 1px;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'mxc_cf7_styles' );
