<?php 
/*
Template Name: Archived Jobs
*/ 
$id = get_the_ID();

$chosen_sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
$default_array = array('default', '');

if(!in_array($chosen_sidebar, $default_array)){
	$sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
}else{
	$sidebar = $qode_options['blog_single_sidebar'];
}

$blog_single_show_comments = "";
if (isset($qode_options['blog_single_show_comments']))
	$blog_single_show_comments = $qode_options['blog_single_show_comments'];

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
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
			</script>
		<?php } ?>

		<?php get_template_part( 'title' ); ?>
		<?php get_template_part('slider'); ?>

		<div class="container"<?php qode_inline_style($background_color); ?>>
		<?php if($qode_options['overlapping_content'] == 'yes') {?>
			<div class="overlapping_content"><div class="overlapping_content_inner">
		<?php } ?>
			<div class="container_inner default_template_holder" <?php qode_inline_style($content_style); ?>>

			<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<div class="blog_holder blog_single blog_standard_type">
				<?php
					get_template_part('templates/blog/blog_single', 'loop');
				?>
				<?php
					if($blog_single_show_comments == "yes"){
						comments_template('', true);
					}else{
						echo "<br/><br/>";
					}
				?>

			<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
				<?php if($sidebar == "1") : ?>
					<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
					<div class="column1 content_left_from_sidebar">
				<?php elseif($sidebar == "2") : ?>
					<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
						<div class="column1 content_left_from_sidebar">
				<?php endif; ?>

							<div class="column_inner">
								<div class="blog_holder blog_single blog_standard_type">
									<?php the_content(); ?>
									<div class="job_listings">	
										<?php 								
										// the query
										$args = array(
											'post_type' => 'job_listing',
											'numberposts'	=> -1,
											'meta_key'		=> '_filled',
											'meta_value'	=> 1
										);
										$the_query = new WP_Query( $args ); ?>

										<?php if ( $the_query->have_posts() ) : ?>
											
											<ul class="job_listings">
												<!-- the loop -->
												<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
													
												<li <?php job_listing_class(); ?> data-longitude="" data-latitude="">
													<a href="<?php the_job_permalink(); ?>">
														
														<div class="position">
															<p><?php wpjm_the_job_title(); ?></p>			
														</div>
														<div class="location">
															<div class="location_label_job">Location</div>
															<?php the_job_location( false ); ?>
														</div>
														<div class="company_name">
															<div class="company_name_label">Company</div>
															<?php the_company_name(); ?>			
														</div>
														<div class="job_details_btn_holder">
															<div class="job_details_btn">JOB DETAILS</div>
															<?php
																$job_post_id = get_the_ID();
																$number_of_applicants = 0;
																// the query
																$args_2 = array(
																	'post_type' => 'job_applications',
																	'numberposts'	=> -1,
																	'meta_key'		=> 'Job Post ID',
																	'meta_value'	=> $job_post_id	
																);
																$the_query_2 = new WP_Query( $args_2 ); 
																if ( $the_query_2->have_posts() ) : 
																	while ( $the_query_2->have_posts() ) : $the_query_2->the_post(); 
																		$number_of_applicants++; 						
																	endwhile; 
																	wp_reset_postdata(); 
																endif; 
															?>
															<p>Applications: <span><?php echo $number_of_applicants; ?></span></p>
														</div>
													</a>
												</li>

												<?php endwhile; ?>
												<!-- end of the loop -->

											</ul>										

											<?php wp_reset_postdata(); ?>

										<?php else : ?>
											<h3 style="margin-top: 30px;"><?php esc_html_e( 'No job applications found for this job posting' ); ?></h3>
										<?php endif; ?>
									</div>	
								</div>						
							</div>
						</div>
						<div class="column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php if($qode_options['overlapping_content'] == 'yes') {?>
			</div></div>
		<?php } ?>
	</div>
<?php endwhile; ?>
<?php endif; ?>	


<?php get_footer(); ?>	