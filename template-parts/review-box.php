<?php
/**
 * Template Part: Review Box
 */
$score = get_post_meta( get_the_ID(), '_mxc_review_score', true );
$summary = get_post_meta( get_the_ID(), '_mxc_review_summary', true );
$pros = get_post_meta( get_the_ID(), '_mxc_review_pros', true );
$cons = get_post_meta( get_the_ID(), '_mxc_review_cons', true );

if ( ! $score ) return;

// Calculate color based on score
$color_class = 'bg-primary';
if ( $score >= 8 ) $color_class = 'bg-success';
elseif ( $score >= 5 ) $color_class = 'bg-warning';
else $color_class = 'bg-danger';
?>

<div class="mxc-review-box card mb-5 border-0 shadow">
    <div class="card-header bg-dark text-white p-3">
        <h3 class="h5 m-0 text-white"><i class="fas fa-gavel me-2"></i> <?php _e( 'The Verdict', 'metaxchron' ); ?></h3>
    </div>
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="review-score-circle d-inline-flex align-items-center justify-content-center rounded-circle text-white fw-bold <?php echo esc_attr( $color_class ); ?>" style="width: 80px; height: 80px; font-size: 2rem;">
                    <?php echo esc_html( $score ); ?>
                </div>
                <div class="small text-muted mt-2 text-uppercase fw-bold"><?php _e( 'Score', 'metaxchron' ); ?></div>
            </div>
            <div class="col-md-9">
                <h4 class="h6 fw-bold"><?php _e( 'Summary', 'metaxchron' ); ?></h4>
                <p class="mb-0"><?php echo esc_html( $summary ); ?></p>
            </div>
        </div>

        <div class="row mt-4 pt-4 border-top">
            <?php if ( $pros ) : ?>
                <div class="col-md-6 mb-3">
                    <h5 class="text-success h6"><i class="fas fa-thumbs-up me-2"></i> <?php _e( 'Pros', 'metaxchron' ); ?></h5>
                    <ul class="list-unstyled mb-0 small">
                        <?php
                        $pros_list = explode( "\n", $pros );
                        foreach ( $pros_list as $pro ) {
                            if ( trim( $pro ) ) echo '<li class="mb-1"><i class="fas fa-check text-success me-2"></i> ' . esc_html( trim( $pro ) ) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( $cons ) : ?>
                <div class="col-md-6 mb-3">
                    <h5 class="text-danger h6"><i class="fas fa-thumbs-down me-2"></i> <?php _e( 'Cons', 'metaxchron' ); ?></h5>
                    <ul class="list-unstyled mb-0 small">
                        <?php
                        $cons_list = explode( "\n", $cons );
                        foreach ( $cons_list as $con ) {
                            if ( trim( $con ) ) echo '<li class="mb-1"><i class="fas fa-times text-danger me-2"></i> ' . esc_html( trim( $con ) ) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
