<?php 
/*
Template Name: Contract MFG
*/ 
?>


	<?php get_header(); ?>
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo esc_attr(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)); ?>;
			</script>
		<?php } ?>

	<?php get_template_part( 'title' ); ?>
	<?php get_template_part('slider'); ?>


        <?php if ( has_post_thumbnail() ) : ?>
            <div class="featured-image-holder">
                <?php the_post_thumbnail(); ?>
            </div>
            <div class="header-title" style="text-align: center; padding-bottom: 40px;"> 
                <?php echo get_field('header_title'); ?>   
            </div>                  
        <?php endif; ?>						
		
		<div class="content-container">
			
			<?php the_content(); ?>	

		</div>

		
		<div style="background-color: <?php echo get_field('color'); ?>">
			<?php echo get_field('colored_div'); ?>
		</div>

		<div>
			<?php echo get_field('third_section'); ?>
		</div>



	<?php get_footer(); ?>