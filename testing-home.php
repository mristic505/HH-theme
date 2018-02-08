<?php 
/*
Template Name: Testing Homepage
*/ 
?>

<?php 
global $wp_query, $qode_options;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

$enable_page_comments = false;
if(get_post_meta($id, "qode_enable-page-comments", true) == 'yes') {
	$enable_page_comments = true;
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = 'background-color: '.esc_attr(get_post_meta($id, "qode_page_background_color", true));
}else{
	$background_color = "";
}

$content_style = "";
if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	if(get_post_meta($id, "qode_content-top-padding-mobile", true) == 'yes'){
		$content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px !important";
	}else{
		$content_style = "padding-top:".esc_attr(get_post_meta($id, "qode_content-top-padding", true))."px";
	}
}

$pagination_classes = '';
if( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'standard' ) {
	if( isset($qode_options['pagination_standard_position']) && $qode_options['pagination_standard_position'] !== '' ) {
		$pagination_classes .= "standard_".esc_attr($qode_options['pagination_standard_position']);
	}
}
elseif ( isset($qode_options['pagination_type']) && $qode_options['pagination_type'] == 'arrows_on_sides' ) {
	$pagination_classes .= "arrows_on_sides";
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>

	<?php get_header(); ?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
			</script>
		<?php } ?>

	<!-- 	<?php get_template_part( 'title' ); ?>
		<?php get_template_part('slider'); ?> -->

    		<div id="hero-carousel" class="single-item">
				<a target="_blank" href="/brands/"><div><img src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/brands-slide4.png"></div></a>
				<a target="_blank" href="/news/"><div><img src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2017/10/news-slider.jpg"></div></a>
				<a target="_blank" href="http://www.sunnyd.com/"><div><img src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/sunnyd-slider.png"></div></a>
				<a target="_blank" href="http://juicyjuice.com/"><div><img src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/jj-slide3.png"></div></a>

			</div>
			<div class="hero-carousel-inner">
    <h3 style="text-align: center; color: #a00924; font-size: 16px; font-family: 'Open Sans'; margin-bottom: 23px; font-weight: 100;">EXPLORE OUR BRANDS</h3>
    <div id="logo-carousel" class="multiple-items">
        <div><a href="/product_category/juicy-juice/" rel="noopener"><img style="padding-top: 9px; padding-left: 10px;" class="alignnone size-full wp-image-51533" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/jj-logo-1.png" alt="" width="92" height="81" /></a></div>
        <div><a href="/product_category/sunnyd" rel="noopener"><img style="padding-top: 15px;" class="alignnone size-full wp-image-51536" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2017/09/sunnyd-1.png" alt="" width="115" height="86" /></a></div>
        <div><a href="/product_category/hug" rel="noopener"><img style="    padding-top: 16px;" class="alignnone size-full wp-image-51534" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/little-hug.png" alt="" width="91" height="68" /></a></div>
        <div><a href="/product_category/dailys" rel="noopener"><img style="       padding-top: 28px;
" class="alignnone size-full wp-image-51530" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/dailys-cocktail.png" alt="" width="115" height="34" /></a></div>
        <div><a href="/product_category/nutrament" rel="noopener"><img style="    padding-top: 19px; padding-left: 13px;" class="alignnone size-full wp-image-51535" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/nutrament.png" alt="" width="113" height="52" /></a></div>
        <div><a href="/product_category/fruit20" rel="noopener"><img style="padding-top: 10px;" class="alignnone size-full wp-image-51531" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/fruit-20.png" alt="" width="80" height="80" /></a></div>
        <div><a href="/product_category/big-hug/"><img style="padding-top: 11px;" class="alignnone size-full wp-image-51605" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/BigHug_Logo-1.png" alt="" width="113" height="54" /></a></div>
        <div><a href="/product_category/big-burst" rel="noopener"><img style="padding-top: 21px;" class="alignnone size-full wp-image-51529" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/big-burst.png" alt="" width="90" height="48" /></a></div>
        <div><a href="/product_category/guzzlers" rel="noopener"><img style="    padding-top: 26px;" class="alignnone size-full wp-image-51532" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/guzzler.png" alt="" width="106" height="43" /></a></div>
        <div><a href="/product_category/veryfine" rel="noopener"><img style="    padding-top: 15px;" class="alignnone size-full wp-image-51537" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2016/09/Veryfine_Carousel.png" alt="" width="110" height="59" /></a></div>
        <div><a href="/product_category/darty"><img style="    padding-top: 18px;" class="alignnone size-full wp-image-51605" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/darty.png" alt="" width="113" height="54" /></a></div>
        <div><a href="/product_category/green-beginnings"><img style="    padding-top: 15px;" class="alignnone size-full wp-image-51604" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/Carousel_Green-Beginnings_Rest.png" alt="" width="112" height="57" /></a></div>
    </div>
</div>
<img style="width: 100%;" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2015/10/bottom-shadow.png">
		<div class="container"<?php qode_inline_style($background_color); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
	        <div class="featured-image-holder">
	            <!-- <?php the_post_thumbnail(); ?> -->

	            <div class="header-title"> 
	            <?php echo get_field('header_title'); ?>    
	            </div>      
	        </div>                  
	    <?php endif; ?>
	    

	    

        <?php if($qode_options['overlapping_content'] == 'yes') {?>
            <div class="overlapping_content"><div class="overlapping_content_inner">
        <?php } ?>

                <div class="container_inner default_template_holder clearfix" <?php qode_inline_style($content_style); ?>>
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
					<?php if (have_posts()) : 
							while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<?php 
								$args_pages = array(
									'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
									'after'            => '</div></div>',
									'pagelink'         => '<span>%</span>'
								);
								wp_link_pages($args_pages);
							?>
							<?php
							if($enable_page_comments){
								comments_template('', true); 
							}
							?> 
							<?php endwhile; ?>
						<?php endif; ?>
				<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
					
					<?php if($sidebar == "1") : ?>	
						<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
							<div class="column1 content_left_from_sidebar">
					<?php elseif($sidebar == "2") : ?>	
						<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
							<div class="column1 content_left_from_sidebar">
					<?php endif; ?>
							<?php if (have_posts()) : 
								while (have_posts()) : the_post(); ?>
								<div class="column_inner">
								
								<?php the_content(); ?>
								<?php 
									$args_pages = array(
									'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
									'after'            => '</div></div>',
									'pagelink'         => '<span>%</span>'
									);

									wp_link_pages($args_pages);
								?>
								<?php
								if($enable_page_comments){
									comments_template('', true); 
								}
								?> 
								</div>
						<?php endwhile; ?>
						<?php endif; ?>
					
									
							</div>
							<div class="column2"><?php get_sidebar();?></div>
						</div>
					<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
						<?php if($sidebar == "3") : ?>	
							<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2 content_right_from_sidebar">
						<?php elseif($sidebar == "4") : ?>	
							<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2 content_right_from_sidebar">
						<?php endif; ?>
								<?php if (have_posts()) : 
									while (have_posts()) : the_post(); ?>
									<div class="column_inner">
										<?php the_content(); ?>
										<?php 
											$args_pages = array(
												'before'           => '<div class="single_links_pages ' .$pagination_classes. '"><div class="single_links_pages_inner">',
												'after'            => '</div></div>',
												'pagelink'         => '<span>%</span>'
											);
											wp_link_pages($args_pages);
										?>
										<?php
										if($enable_page_comments){
											comments_template('', true); 
										}
										?> 
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						
										
								</div>
								
							</div>
					<?php endif; ?>
		    </div>
            <?php if($qode_options['overlapping_content'] == 'yes') {?>
                </div></div>
            <?php } ?>
	    </div>

	<?php get_footer(); ?>