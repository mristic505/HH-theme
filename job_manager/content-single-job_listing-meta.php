<?php
/**
 * Single view job meta box.
 *
 * Hooked into single_job_listing_start priority 20
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing-meta.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.14.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

do_action( 'single_job_listing_meta_before' ); ?>

<table cellpadding="0" cellspacing="0" border="0" align="left" class="job-listing-meta meta">
	<?php do_action( 'single_job_listing_meta_start' ); ?>

	<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
		<?php $types = wpjm_get_the_job_types(); ?>
		<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>

			<tr class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><td class="ls1">Type</td><td class="ls2"><?php echo esc_html( $type->name ); ?></td></tr>

		<?php endforeach; endif; ?>
	<?php } ?>

	<tr class="location"><td class="ls1">Location</td><td class="ls2"><?php the_job_location(); ?></td></tr>
	<tr class="company_name"><td class="ls1">Company</td><td class="ls2"><?php the_company_name(); ?></td></tr>

	<!-- <li class="date-posted"><?php // the_job_publish_date(); ?></li> -->


	<?php do_action( 'single_job_listing_meta_end' ); ?>
</table>

<?php do_action( 'single_job_listing_meta_after' ); ?>
