<?php //Courseware
 $i                   = 9 ;
 $section_title       = onetone_option( 'section_title_'.$i );
 $section_menu        = onetone_option( 'menu_title_4');//.$i );
 $parallax_scrolling  = onetone_option( 'parallax_scrolling_'.$i );
 $section_css_class   = onetone_option( 'section_css_class_'.$i );
 $section_content     = onetone_option( 'section_content_'.$i );
 $full_width          = onetone_option( 'full_width_'.$i );
 $section_subtitle    = onetone_option( 'section_subtitle_'.$i );	
  if( !isset($section_content) || $section_content=="" ) 
  $section_content = onetone_option( 'sction_content_'.$i );
  
  $section_id      = sanitize_title( onetone_option( 'menu_slug_'.$i ,'section-'.($i+1) ) );
  if( $section_id == '' )
   $section_id = 'section-'.($i+1);
  
  $container_class = "container";
  if( $full_width == "yes" ){
  $container_class = "";
  }
  
  if( $parallax_scrolling == "yes" || $parallax_scrolling == "1" ){
	 $section_css_class  .= ' onetone-parallax';
  }
  
?>
<section id="<?php echo $section_id; ?>" class="home-section-<?php echo ($i+1); ?> <?php echo $section_css_class;?>">
    	<div class="home-container <?php echo $container_class; ?> page_container">
		<?php if($section_title){ ?>
        	<h1 class="section-title"><?php echo $section_title;?></h1>
            <?php } ?>
            <?php if( $section_subtitle != '' ):?>
            <div class="section-subtitle"><?php echo do_shortcode($section_subtitle);?></div>
             <?php endif;?>

            <?php 
            $moodle_img      =  esc_url(onetone_option('moodle_img'));
            $moodle_link    = esc_url(onetone_option('moodle_link'));
            $moodle_name    = onetone_option('moodle_name');
            $moodle_desc    = onetone_option('moodle_desc');
            $acu_img = esc_url(onetone_option('acu_img'));
            $acu_link    = esc_url(onetone_option('acu_link'));
            $acu_name    = onetone_option('acu_name');
            $acu_desc    = onetone_option('acu_desc');
            $img1 = '<a href="'.$moodle_link.'" target="_blank"><img src="'.$moodle_img.'" alt="'.$name.'" style="border-radius: 0; display: inline-block;border-style: solid;" /></a>';
            $img2 = '<a href="'.$acu_link.'" target="_blank"><img src="'.$acu_img.'" alt="'.$name.'" style="border-radius: 0; display: inline-block;border-style: solid;" /></a>';
                                  
	  ?>
                                  

            
            <div class="col-md-6">
                <div class="magee-animated" data-animationduration="0.9" data-animationtype="zoomIn" data-imageanimation="no">
                    <div class="magee-person-box" id="">
                      <div class="person-img-box">
                            <div class="img-box figcaption-middle text-center fade-in"><?php echo $img1; ?></div>
                      </div>
                      <div class="person-vcard text-center">
                          <h3 class="person-name" style="text-transform: uppercase;"><b><?php echo '<a href="'.$moodle_link.'" target="_blank">'.$moodle_name.'</a>';?></b></h3>
                            <p class="person-desc"><?php echo $moodle_desc;?></p>

                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="magee-animated" data-animationduration="0.9" data-animationtype="zoomIn" data-imageanimation="no">
                    <div class="magee-person-box" id="">
                      <div class="person-img-box">
                            <div class="img-box figcaption-middle text-center fade-in"><?php echo $img2; ?></div>
                      </div>
                      <div class="person-vcard text-center">
                          <h3 class="person-name" style="text-transform: uppercase;"><b><?php echo '<a href="'.$acu_link.'" target="_blank">'.$acu_name.'</a>';?></b></h3>
                            <p class="person-desc"><?php echo $acu_desc;?></p>

                      </div>
                    </div>
                </div>
            </div>
              </div>
    
            <div class="home-section-content">
            <?php 
			if(function_exists('Form_maker_fornt_end_main'))
             {
                 $section_content = Form_maker_fornt_end_main($section_content);
              }
			 echo do_shortcode($section_content);
                         
			?>
                
                
            </div>
        </div>
  <div class="clear"></div>
</section>