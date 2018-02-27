<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
if(is_user_logged_in()) :?>
<div class="job_status">
	<?php 
	$job_status = get_post_meta(get_the_ID(), "_filled", true);
	$job_status_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
	if ($job_status > 0) { ?>
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
		  <div class="btn-group" role="group">
		    <button data-job-status="0" data-job-id="<?php echo get_the_ID(); ?>" type="button" class="btn btn-default">Active <?php echo $job_status_icon; ?></button>
		  </div>
		  <div class="btn-group" role="group">
		    <button data-job-status="1" data-job-id="<?php echo get_the_ID(); ?>" type="button" class="btn btn-default pressed">Archived <?php echo $job_status_icon; ?></button>
		  </div>
		</div>
	<?php } else { ?>
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
		  <div class="btn-group" role="group">
		    <button data-job-status="0" data-job-id="<?php echo get_the_ID(); ?>" type="button" class="btn btn-default pressed">Active <?php echo $job_status_icon; ?></button>
		  </div>
		  <div class="btn-group" role="group">
		    <button data-job-status="1" data-job-id="<?php echo get_the_ID(); ?>" type="button" class="btn btn-default">Archived <?php echo $job_status_icon; ?></button>
		  </div>
		</div>
	<?php } ?>
</div>
<?php endif; ?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
	<?php else : ?>
		<?php
			/**
			 * single_job_listing_start hook
			 *
			 * @hooked job_listing_meta_display - 20
			 * @hooked job_listing_company_display - 30
			 */
			do_action( 'single_job_listing_start' );
		?>

		<div class="job_description">
			<div class="job_overview_label">OVERVIEW</div>
			<?php wpjm_the_job_description(); ?>
		</div>

		<?php if ( candidates_can_apply() ) : ?>
			<?php get_job_manager_template( 'job-application.php' ); ?>
		<?php endif; ?>
		<!-- <hr> -->
		<!-- <a style="color: #636363;" href="/jobs">< Back to Search</a> -->
		<?php
			/**
			 * single_job_listing_end hook
			 */
			do_action( 'single_job_listing_end' );
		?>
	<?php endif; ?>
</div>
<?php get_job_manager_template( 'job_applicants.php' ); ?>
