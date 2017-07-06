<?php 
/*
	Template Name: Course Archive Page
*/

	get_header(); 

	$left_sidebar   = onetone_option( 'left_sidebar_blog_archive', '' );
	$right_sidebar  = onetone_option( 'right_sidebar_blog_archive', '' );
	$aside          = 'no-aside';

?>

<section class="page-title-bar title-left no-subtitle color_alternate" style="background-color: #5d9646; color: white !important; text-transform: uppercase;">
    <div class="container">
        <hgroup class="page-title">
            <h1> <?php the_title();?> </h1>
            <!-- <ul class="entry-meta">
                <li class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></li>
                <li class="entry-catagory"><i class="fa fa-file-o"></i><?php the_category(', '); ?></li>                  
            </ul> -->
        </hgroup>
        <?php 
        	onetone_get_breadcrumb(array("before"=>"<div class=''>","after"=>"</div>","show_browse"=>false,"separator"=>'','container'=>'div'));
        ?> 
        <div class="clearfix"></div>            
    </div>
</section>

<div class="post-wrap">
	<div class="container">
		<div class="post-inner <?php echo $aside; ?>">
			<div class="col-main">
				<section class="post-main" role="main" id="content">
					<article class="page type-page">

						<!-- BEGIN: Tab Header -->
						<div class="tab-institution">
							<ul class="nav nav-tabs nav-justified">
							<?php 
							if ( have_posts() ) { 
								//Taxonomy Name
								$tax = 'institution'; 
								$post_type = 'course';

								//Retrieve terms of Taxonomy
								$terms = get_terms( $tax, [
										'hide_empty' => false, //Do not hide empty terms
									]);

								//Declare variable of properties of each term
								foreach ($terms as $term) {
									$termName = $term->name;
									$termSlug = $term->slug;

									if ($termSlug == 'institute-of-technology-of-cambodia') {
										$tab_header_active = 'active';
									}
									else {
										$tab_header_active = 'inactive';
									}
							?>
									<li role="presentation" class="active-tab <?php echo $tab_header_active; ?>">
										<a data-toggle="tab" href="<?php echo '#'.$termSlug;?>">
											<?php echo '<h3>'.$termName.'</h3>';?>
										</a>
									</li>
							<?php	
								} //END foreach loop
							?>
							</ul>
							<!-- END Tab Header -->
						</div> 
						

						<!-- BEGIN: Tab Contents -->
						<div class="tab-content">
							<?php 
							foreach ($terms as $term) {
								$termName = $term->name;
								$termSlug = $term->slug;

								if ($termSlug == 'institute-of-technology-of-cambodia') {
									$tab_content_active = 'tab-pane fade in active';
								}
								else {
									$tab_content_active = 'tab-pane fade';
								}

								//Define the query
								$args = [
									'post_type' => $post_type,
									$tax => $termSlug
								];
								$query = new WP_Query($args);
							?>
								<div id="<?php echo $termSlug; ?>" class="<?php echo $tab_content_active; ?>" >
									<div class="course-list">
										<ul>
											<?php
											$count = 1;
											while ($query->have_posts()) : $query->the_post();
												if ( $count%4 == 1 ) {
													echo '<div class="row">';
												}?>

												<div class="post-list" id="post-<?php the_ID(); ?>" >
													<div class="col-xs-12 col-sm-6 col-md-3">
							                            <div class="feature-img-box">
							                                <div class="img-box figcaption-middle text-center from-top fade-in">
							                                    <a href="<?php the_permalink(); ?>" >
							                                        <?php the_post_thumbnail(); ?>
							                                        
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
							                                <h3><a href="<?php the_permalink();?>"> <?php the_title(); ?> </a></h3>
							                            </div>   
								                    </div>
												</div>

											<?php
												if ( $count%4 == 0 ) {
													echo "</div>";
												}
												$count++;
											endwhile;

											if ( $count%4 != 1) {
												echo "</div>";
											}
											?>
										</ul>
									</div>
								</div>
							<?php
							}
							?>
						</div>
						<!-- END: Tab Contents -->

						<?php
						}
						else {
							echo "There is no post availalbe.";
						}
						?>

						<!--BEGIN: Pagination-->
                        <nav class="post-list-pagination" role="navigation">
                            <?php 
                                if (function_exists("onetone_native_pagenavi")) {
                                    onetone_native_pagenavi("echo",$wp_query);
                                }
                            ?>
                        </nav>
                        <!-- END Pagination -->
					</article>
				</section>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>