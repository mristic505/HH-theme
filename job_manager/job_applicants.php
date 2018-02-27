<?php 
if(is_user_logged_in()) :
$job_post_id = get_the_ID();
// the query
$args = array(
	'post_type' => 'job_applications',
	'numberposts'	=> -1,
	'meta_key'		=> 'Job Post ID',
	'meta_value'	=> $job_post_id
);
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

<table class="table-sort table-sort-search applications_table">
	<thead>
	    <tr>
	        <th class="table-sort">Full Name</th>
	        <th class="table-sort">Email</th>
	        <th class="table-sort">Location</th>
	        <th>Cover Letter</th>
	        <th>Resume</th>
	        <th class="table-sort">Status</th>
	        <th>Forward to</th>
	    </tr>
	</thead>
	<tbody>

	<!-- the loop -->
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
	$file_id = get_post_meta(get_the_ID(), "Resume", true);
	?>
		
		<tr>

			<td><?php echo get_post_meta(get_the_ID(), "Full Name", true); ?></td>	

			<td><?php echo get_post_meta(get_the_ID(), "Email", true); ?></td>	

			<td><?php echo get_post_meta(get_the_ID(), "Location", true); ?></td>	

			<td><?php echo 'Cover Letter'; //get_the_content(); ?></td>
			
			<td><a href="<?php echo wp_get_attachment_url( $file_id ); ?> ">Click to Download</a></td>	
			
			<td>

				<div class="btn-group">
				  <button type="button" class="app_status_btn btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <span class="status_label"><?php echo get_post_meta(get_the_ID(), "Application Status", true); ?><span> <span class="caret"></span>
				  </button>
				  <ul data-job-id="<?php echo get_the_ID(); ?>" class="dropdown-menu app_statuses">
				    <li><a data-status="Approved" href="javascript:void(0);">Approved</a></li>
				    <li><a data-status="Rejected" href="javascript:void(0);">Rejected</a></li>
				    <li><a data-status="Pending" href="javascript:void(0);">Pending</a></li>
				  </ul>
				</div>

			</td>

			<td>
				<input id="forward_application" type="text" name="forward_to"><button id="forward_application_btn">Submit</button>
			</td>

		</tr>

	<?php endwhile; ?>
	<!-- end of the loop -->

	</tbody>
</table>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<h3 style="margin-top: 30px;"><?php esc_html_e( 'No job applications found for this job posting' ); ?></h3>
<?php endif; ?>

<?php endif; ?>