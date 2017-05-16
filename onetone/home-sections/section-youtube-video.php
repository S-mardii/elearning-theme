<?php
 $video_background_section  = onetone_option( 'video_background_section' );
 $i                         = $video_background_section-1 ;
 $video_controls            = onetone_option( 'video_controls' );
 $section_background_video  = onetone_option( 'section_background_video_0' );
 $video_full_screen         = onetone_option("video_full_screen");
 $video_full_screen         = is_numeric($video_full_screen)?$video_full_screen:"1";
 $display_video_mobile      = onetone_option("display_video_mobile","no");

  
  $background_video  = array("videoId"=>$section_background_video, "start"=>3 ,"mute"=>false,"container" =>"section.onetone-youtube-section","playerid"=>"onetone-youtube-section",'video_full_screen' => $video_full_screen);
  $video_section_item = "section.onetone-youtube-section";
  $video_array[]  =  array("options"=> $background_video,  "video_section_item"=> $video_section_item );
	
?>
<section class="home-section-<?php echo $video_background_section;?> onetone-youtube-section video-section">
    <?php get_template_part('home-sections/section',$video_background_section);?>
  <div class="clear"></div>
  <?php 
	  if(  $video_controls == 1  ){
		  $detect = new Mobile_Detect;
		  if(  !$detect->isMobile() && !$detect->isTablet() ){
	  echo '<p class="black-65" id="video-controls">
		  <a class="tubular-play" href="#"><i class="fa fa-play "></i></a>&nbsp; &nbsp;&nbsp;&nbsp;
		  <a class="tubular-pause" href="#"><i class="fa fa-pause "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-up" href="#"><i class="fa fa-volume-up "></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		  <a class="tubular-volume-down" href="#"><i class="fa fa-volume-off "></i></a> 
	  </p>';
	 }
	  }
	 
	  if($video_array !="" && $video_array != NULL ){
        wp_localize_script( 'onetone-bigvideo', 'onetone_bigvideo',$video_array);
		}
	 ?>
</section>