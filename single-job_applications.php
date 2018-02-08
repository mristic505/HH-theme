<?php

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
									<table id="single_job_app_details">
										<tr>
											<td class="jad_label">Job Name</td>
											<td><?php the_title(); ?></td>
										</tr>
										<tr>
											<td class="jad_label">Full Name</td>
											<td><?php echo get_post_meta( get_the_ID(), 'Full Name', true ); ?></td>
										</tr>
										<tr>
											<td class="jad_label">Email</td>
											<td><?php echo get_post_meta( get_the_ID(), 'Email', true ); ?></td>
										</tr>
										<tr>
											<td class="jad_label">Location</td>
											<td><?php echo get_post_meta( get_the_ID(), 'Location', true ); ?></td>
										</tr>
										<tr>
											<td class="jad_label">Cover Letter</td>
											<td><?php the_content(); ?></td>
										</tr>
										<tr>
											<td class="jad_label">Resume</td>
											<?php
											$resume_url = wp_get_attachment_url( 51848 );
											 ?>
											<td><a target="_blank" href="<?php echo $resume_url; ?>">CLICK TO OPEN/DOWNLOAD</a></td>
										</tr>
									</table>
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