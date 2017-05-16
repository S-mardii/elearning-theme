<?php
/**
* Template Name: Archive test
*
*/

get_header(); 

$left_sidebar   = onetone_option('left_sidebar_blog_archive','');
$right_sidebar  = onetone_option('right_sidebar_blog_archive','');
$aside          = 'no-aside';
if( $left_sidebar !='' )
$aside          = 'left-aside';
if( $right_sidebar !='' )
$aside          = 'right-aside';
if(  $left_sidebar !='' && $right_sidebar !='' )
$aside          = 'both-aside';

?>

<h1>Courses</h1>

<div class="post-wrap">
    <div class="container">
        <div class="post-inner row <?php echo $aside; ?>">
            <div class="col-main">
                <section class="post-main" role="main" id="content">                        
                    <article class="page type-page" id="">
                        <?php if (have_posts()) :?>
                        <!--blog list begin-->
                        <div class="tab-university">
                            <ul class="nav nav-tabs nav-justified" style="margin: 0">
                            <?php 
                                $tax = 'institution'; //Taxonomy Name
                                //get term of taxonomy
                                $terms = get_terms( $tax, [
                                        'hide_empty' => false, //do not hide empty terms
                                    ]);
                            ?>
                            <?php 
                                foreach ($terms as $term): 
                                    $name = $term->name;
                                    $slug = $term->slug;
                                        
                                    if ($name == 'Institute of Technology of Cambodia') {
                                        $isActive = 'active';
                                    }   
                                    else {
                                        $isActive = '';
                                    }
                            ?>
                                    <li role="presentation" class="<?php echo $isActive ?>">
                                        <a data-toggle="tab" href="#<?php echo $slug ?>">
                                            <h3> <?php echo $name ?> </h3>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <!-- End Tab Headers -->

                            <div class="tab-content">
                                
                                <div id="institute-of-technology-of-cambodia" class="tab-pane fade in active">
                                    <div class="row">
                                        <?php 
                                        $terms = get_terms( 'institution', array(
                                            'orderby'    => 'count',
                                            'hide_empty' => 0
                                        ) );
                                        foreach( $terms as $term ) {
 
                                            // Define the query
                                            $args = array(
                                                'post_type' => 'course',
                                                'institution' => $term->slug
                                            );
                                            $query = new WP_Query( $args );
                                                      
                                             
                                            // output the post titles in a list
                                            if ($term->name == 'Institute of Technology of Cambodia') {
                                                echo '<ul>';
                                                 
                                                    // Start the Loop
                                                    while ( $query->have_posts() ) : $query->the_post(); ?>
                                             
                                                        <li class="animal-listing" id="post-<?php the_ID(); ?>">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php the_title(); ?>    
                                                            </a>
                                                        </li>
                                                     
                                                    <?php endwhile;
                                                 
                                                echo '</ul>';
                                            }
                                             
                                            // use reset postdata to restore orginal query
                                            wp_reset_postdata();
                                         
                                        } ?>    
                                    </div>
                                </div>

                                <div id="num" class="tab-pane fade">
                                    <div class="row">
                                        <?php while ( have_posts() ) : the_post();?>
                                            <?php 
                                            if ($i <= 4) {
                                                if ( has_term( 'national-university-of-management','institution' )) {
                                                    get_template_part("content-course-num",get_post_format() );
                                                }
                                            }
                                            else {
                                                echo "
                                                       </div>
                                                    <div class='row'>
                                                ";
                                            }
                                            endwhile;
                                            ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!--blog list end-->

                        <!--list pagination begin-->
                        <nav class="post-list-pagination" role="navigation">
                            <?php 
                                if (function_exists("onetone_native_pagenavi")) {
                                    onetone_native_pagenavi("echo",$wp_query);
                                }
                            ?>
                        </nav>
                        <!--list pagination end-->
                    </article>
                    
                    
                    <div class="post-attributes"></div>
                </section>
            </div>

            <?php if( $left_sidebar !='' ):?>

            <div class="col-aside-left">
                <aside class="blog-side left text-left">
                    <div class="widget-area">
                        <?php get_sidebar('archiveleft');?> 
                    </div>
                </aside>
            </div>

            <?php endif; ?>
            <?php if( $right_sidebar !='' ):?>
            <div class="col-aside-right">
               <?php get_sidebar('archiveright');?>
            </div>
            <?php endif; ?>
            
        </div>
    </div>  
</div>
        
 <?php get_footer();?>