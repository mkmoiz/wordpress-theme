<?php
/**
 * Template part for displaying share buttons.
 */

$url   = urlencode( get_permalink() );
$title = urlencode( get_the_title() );
?>

<div class="mxc-share-buttons card border-0 mb-5">
    <div class="card-body p-4 d-flex align-items-center flex-wrap gap-3 glass-panel">
        <span class="fw-bold text-uppercase small letter-spacing-1 me-2 text-muted">Share:</span>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" class="btn btn-share btn-facebook" aria-label="Share on Facebook">
            <i class="fab fa-facebook-f"></i> <span class="d-none d-sm-inline ms-1">Facebook</span>
        </a>

        <a href="https://x.com/intent/tweet?text=<?php echo $title; ?>&url=<?php echo $url; ?>" target="_blank" class="btn btn-share btn-twitter" aria-label="Share on X">
            <i class="fab fa-x-twitter"></i> <span class="d-none d-sm-inline ms-1">X</span>
        </a>

        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>&title=<?php echo $title; ?>" target="_blank" class="btn btn-share btn-linkedin" aria-label="Share on LinkedIn">
            <i class="fab fa-linkedin-in"></i> <span class="d-none d-sm-inline ms-1">LinkedIn</span>
        </a>

        <a href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $url; ?>" class="btn btn-share btn-email" aria-label="Share via Email">
            <i class="far fa-envelope"></i>
        </a>
    </div>
</div>
