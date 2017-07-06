<?php
/*
    Template Name: Course Single Page Template
*/

get_header(); 
$left_sidebar   = onetone_option( 'left_sidebar_blog_posts', '' );
$right_sidebar  = onetone_option( 'right_sidebar_blog_posts', '' );

$aside = 'no-aside';

?>

<style type="">
.color_alternate a {
    color: white !important;
}
</style>

<?php 
    $course_link        = get_field('course_link');
    $instructor_name    = get_field('instructor_name');
    $instructor_image   = get_field('instructor_image');
    $instructor_info    = get_field('instructor_info');
    $language           = get_field('language');
    $duration           = get_field('duration');
    $youtube_link       = get_field('youtube_link');
    $description        = get_field('description');
    $objectives         = get_field('objectives');
    $curriculum         = get_field('curriculum');
?> 

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> > 

<!--    edited styles by leng-->
<section class="page-title-bar title-left no-subtitle color_alternate" style="background-color: #5d9646; color: white !important; text-transform: uppercase;">
    <div class="container">
        <hgroup class="page-title">
            <h1><?php the_title();?></h1>
            <!-- <ul class="entry-meta">
                <li class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></li>
                <li class="entry-catagory"><i class="fa fa-file-o"></i><?php the_category(', '); ?></li>                  
            </ul> -->
        </hgroup>
        <?php onetone_get_breadcrumb(array("before"=>"<div class=''>","after"=>"</div>","show_browse"=>false,"separator"=>'','container'=>'div'));?> 
        <div class="clearfix"></div>            
    </div>
</section>

<div class="post-wrap">
    <div class="container">
        <div class="post-inner row <?php echo $aside; ?>">
            <div class="col-main-course">
                <section class="post-main" role="main" id="content">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="post type-post">
                            <div class="youtube-row">
                                <div class="col-xs-12 col-md-6 embed-responsive embed-responsive-16by9" style="padding-bottom: 43%;">
                                    <!-- Insert Embeded Youtube Link Field Here -->
                                    <?php echo $youtube_link; ?>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="col-xs-5 col-sm-3 col-md-4 course-details" >
                                        <ul class="course-details">    
                                            <h4> Instructor : </h4>
                                            <h4> Languages  : </h4>
                                            <h4> Duration   : </h4>
                                        </ul>
                                    </div>
                                    <div class="col-xs-7 col-sm-9 col-md-8">
                                        <ul class="course-details">    
                                            <h4><?php echo $instructor_name; ?></h4>
                                            <h4>
                                                <?php   
                                                    foreach ($language as $lang) {
                                                        echo $lang.'&nbsp'; 
                                                    }   
                                                ?>        
                                            </h4>
                                            <h4><?php echo $duration; ?></h4>
                                        </ul>
                                    </div>

                                    <div class="description">
                                        <h3>Description</h3>
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                    </div>
                                    <a href="<?php echo $course_link ?>">
                                        <button class="btn btn-lg btn-block btn-primary" style="float: right;">
                                            <h4>Go to Course</h4>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <div class="col-md-12 objectives">
                            <h3>Objectives</h3>
                            <p> 
                                <?php echo $objectives; ?>
                            </p>
                        </div>

                        <div class="col-md-12 instructor-row">
                            <h3>Instructor Background</h3>
                            <div class="col-xs-3 col-md-2 instructor-image">
                                <img src="<?php echo $instructor_image['url'] ?>" class="img-thumbnail img-responsive" alt="<?php echo $instructor_image['alt']; ?>" width="100%" height="100%"> 
                            </div>

                            <div class="col-xs-9 col-md-10 instructor-bio">
                                <p>
                                    <?php echo $instructor_info;?>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 curriculum-row">
                            <h3>Curriculum</h3>
                            <?php echo "$curriculum"; ?>
                        </div>
                    <?php endwhile; // end of the loop. ?>
                </section>
            

            <!-- BEGIN: Related Posts -->
            <?php 
                // Get the custom post type's taxonomy terms
                $custom_taxterms = wp_get_object_terms( $post->ID, 'institution', array('fields' => 'ids') );
                // arguments
                $args = array(
                    'post_type' => 'course',
                    'post_status' => 'publish',
                    'posts_per_page' => 4, // you may edit this number
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'institution',
                            'field' => 'id',
                            'terms' => $custom_taxterms
                        )
                    ),
                    'post__not_in' => array ($post->ID),
                );
                
                $related_items = new WP_Query( $args );
                // loop over query
                if ($related_items->have_posts()) :
                    echo '
                        <div class="col-md-12 related_post">
                            <h3>Related Post</h3>
                    ';
                    while ( $related_items->have_posts() ) : $related_items->the_post();
                    ?>
                        <div class="col-xs-12 col-sm-6 col-md-3">
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
                                 
                            <div class="caption">
                                <h4><a href="<?php the_permalink();?>"> <?php the_title(); ?> </a></h4>
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                // Reset Post Data
                wp_reset_postdata();
                ?>
                <!-- end custom related loop, isa -->
            </div>
        </div>
    </div>  
</div>

</article>
<?php get_footer(); ?>