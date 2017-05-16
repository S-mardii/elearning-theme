<?php
    $format = get_post_format();
    $formats = get_theme_support( 'post-formats' );
?>

<div class="entry-box-wrap" id="post-<?php the_ID(); ?>">
    <article <?php post_class("entry-box"); ?> >
        <div class="col-xs-12 col-md-3 course">
            <?php if (  has_post_thumbnail() ): ?>

                    <div class="feature-img-box">
                        <div class="img-box figcaption-middle text-center from-top fade-in">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail();?>
                                <div class="img-overlay dark">
                                    <div class="img-overlay-container">
                                        <div class="img-overlay-content">
                                            <i class="fa fa-link"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>                                                 
                    </div>
            <?php endif;?>

            <div class="entry-main">
                <div class="entry-header">
                    <a href="<?php the_permalink();?>">
                        <h3 class="title"><?php the_title();?></h3>
                    </a>
                </div>

                <?php if ( is_search() ) : // Only display Excerpts for Search ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                <?php else : ?>
                    <div class="entry-content">
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="active-link">', 'link_after' => '</span>' ) ); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>
            </div>
        </div>
    </article>
</div>