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
		</div>
	</a>
</li>
