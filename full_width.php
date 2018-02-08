<?php 
/*
Template Name: Full Width
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

	<?php get_template_part( 'title' ); ?>
	<?php get_template_part('slider'); ?>

	<div class="full_width" <?php qode_inline_style($background_color); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	        <div class="featured-image-holder">
	            <?php the_post_thumbnail(); ?>
	            <!-- <div class="header-title"> 
	            <?php echo get_field('header_title'); ?>     -->
	            </div>
	        </div>                  
	    <?php endif; ?>
	    
	<div class="full_width_inner" <?php qode_inline_style($content_style); ?>>

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

                    wp_link_pages($args_pages); ?>
					<?php
					if($enable_page_comments){
					?>
					<div class="container">
						<div class="container_inner">
					<?php
						comments_template('', true); 
					?>
						</div>
					</div>	
					<?php
					}
					?> 
					<?php endwhile; ?>
				<?php endif; ?>

				<!-- NEWS LOOP -->

				<?php if ( is_front_page() ) : ?>
					<div id="news-loop">
						<h2 class="heading news">NEWS</h2>
						<div class="wpb_text_column wpb_content_element ">
							<div class="wpb_wrapper">
							<p class="pt">
								Find the Latest News From Harvest Hill Beverage Company 
							</p>
							</div>
						</div>
						<?php $custom_query = new WP_Query('cat=85'); // include news category
						while($custom_query->have_posts()) : $custom_query->the_post(); ?>

							<div class="post-holder clearfix">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="thumbnail-holder">
										<?php the_post_thumbnail(); ?>		
									</div>					
								<?php endif; ?>

								<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									
								</div>
							</div>

						<?php endwhile; ?>
						<?php wp_reset_postdata(); // reset the query ?>
					</div>
				<?php endif; ?>

				<!-- END NEWS LOOP -->

		<?php elseif($sidebar == "1" || $sidebar == "2"): ?>		
			
			<?php if($sidebar == "1") : ?>	
				<div class="two_columns_66_33 clearfix grid2">
					<div class="column1 content_left_from_sidebar">
			<?php elseif($sidebar == "2") : ?>	
				<div class="two_columns_75_25 clearfix grid2">
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

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
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
					<div class="two_columns_33_66 clearfix grid2">
						<div class="column1"><?php get_sidebar();?></div>
						<div class="column2 content_right_from_sidebar">
				<?php elseif($sidebar == "4") : ?>	
					<div class="two_columns_25_75 clearfix grid2">
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

 wp_link_pages($args_pages); ?>
							<?php
							if($enable_page_comments){
							?>
							<div class="container">
								<div class="container_inner">
							<?php
								comments_template('', true); 
							?>
								</div>
							</div>	
							<?php
							}
							?> 
							</div>
					<?php endwhile; ?>
					<?php endif; ?>
				
								
						</div>
						
					</div>
			<?php endif; ?>
	</div>
	</div>	
	

	<?php get_footer(); ?>