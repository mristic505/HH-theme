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
			<div class="full_width">
		        <div class="featured-image-holder">
	            <img width="1366" height="452" src="http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1.png 1366w, http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1-300x99.png 300w, http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1-768x254.png 768w, http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1-1024x339.png 1024w, http://harvesthill.staging.wpengine.com/wp-content/uploads/2018/01/find-your-future-with-us-1-700x232.png 700w" sizes="(max-width: 1366px) 100vw, 1366px">	            <!-- <div class="header-title"> 
	            <h1>FIND YOUR FUTURE WITH US</h1>
<p>At Harvest Hill, we’re always expanding our team. If you are highly motivated, hardworking and an innovative thinker, we’d love to hear from you.</p>
     -->
	            </div>
</div>
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
									<?php
										get_template_part('templates/blog/blog_single', 'loop');
									?>
								</div>

								<?php
									if($blog_single_show_comments == "yes"){
										comments_template('', true);
									}else{
										echo "<br/><br/>";
									}
								?>								
							</div>
						</div>
						<div class="column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
					<?php if($sidebar == "3") : ?>
						<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
						<div class="column1">
							<?php get_sidebar(); ?>
						</div>
						<div class="column2 content_right_from_sidebar">
					<?php elseif($sidebar == "4") : ?>
						<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
							<div class="column1">
								<?php get_sidebar(); ?>
							</div>
							<div class="column2 content_right_from_sidebar">
					<?php endif; ?>

								<div class="column_inner">
									<div class="blog_holder blog_single blog_standard_type">
										<?php
											get_template_part('templates/blog/blog_single', 'loop');
										?>
									</div>
									<?php
										if($blog_single_show_comments == "yes"){
											comments_template('', true);
										}else{
											echo "<br/><br/>";
										}
									?>
								</div>
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