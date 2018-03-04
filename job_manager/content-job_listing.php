<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<a href="<?php the_job_permalink(); ?>">
		<?php the_company_logo(); ?>
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
			<?php if(is_user_logged_in()) :
				$job_post_id = get_the_ID();
				$number_of_applicants = 0;
				// the query
				$args = array(
					'post_type' => 'job_applications',
					'numberposts'	=> -1,
					'meta_key'		=> 'Job Post ID',
					'meta_value'	=> $job_post_id	
				);
				$the_query = new WP_Query( $args ); 
				if ( $the_query->have_posts() ) : 
					while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$number_of_applicants++; 						
					endwhile; 
					wp_reset_postdata(); 
				endif; 
			?>
			<p>Applications: <span><?php echo $number_of_applicants; ?></span></p>
			<?php endif;  ?>
		</div>
	</a>
</li>