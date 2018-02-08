<?php 
/*
Template Name: Job applications template
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
	     

		<div style="width: 100%;" class="container"<?php qode_inline_style($background_color); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
	        <div class="featured-image-holder">
				       <?php the_post_thumbnail(); ?>

	            <div class="header-title"> 
	            <?php echo get_field('header_title'); ?>    
	            </div>      
	        </div>                  
	    <?php endif; ?>
	    

	    <div class="job_list_header_title"><?php echo get_field('job_list_header_title'); ?></div>

        <?php if($qode_options['overlapping_content'] == 'yes') {?>
            <div class="overlapping_content"><div class="overlapping_content_inner">
        <?php } ?>

                <div class="container_inner default_template_holder clearfix" <?php qode_inline_style($content_style); ?>>
				<?php if(($sidebar == "default")||($sidebar == "")) : ?>
					<?php if (have_posts()) : 
							while (have_posts()) : the_post(); ?>

							<?php 
							// args 
							$args = array('post_type' => 'job_applications');
							// the query
							$the_query = new WP_Query( $args ); ?>

							<?php if ( $the_query->have_posts() ) : ?>

							<table class="table-sort table-sort-search">
							    <thead>
							        <tr>
							        	<th class="table-sort">Job Title</th>
							            <th class="table-sort">Full Name</th>
							            <th class="table-sort">Email</th>
							            <th class="table-sort">Location</th>
							            <th>Cover Letter</th>
							            <th>Resume</th>
							        </tr>
							    </thead>
							    <tbody>


								<!-- the loop -->
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									
									<tr>
										<td><?php echo get_the_title(); ?></td>

										<td><?php echo get_post_meta($post->ID, "Full Name", true); ?></td>	

										<td><?php echo get_post_meta($post->ID, "Email", true); ?></td>	

										<td><?php echo get_post_meta($post->ID, "Location", true); ?></td>	

										<td><?php echo get_the_content(); ?></td>

										<?php $file_id = get_post_meta($post->ID, "Resume", true); ?>
										<td><a href="<?php echo wp_get_attachment_url( $file_id ); ?> ">Click to Download</a></td>	
									</tr>
								    
								<?php endwhile; ?>
								<!-- end of the loop -->

								<!-- pagination here -->

								<?php wp_reset_postdata(); ?>

								</tbody>
							</table>

							<?php else : ?>
								<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
							<?php endif; ?>

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