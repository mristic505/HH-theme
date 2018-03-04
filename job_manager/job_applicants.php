<?php 
if(is_user_logged_in()) :
$job_post_id = get_the_ID();
$job_title = get_the_title();
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

	$full_name = get_post_meta(get_the_ID(), "Full Name", true);
	$email = get_post_meta(get_the_ID(), "Email", true);
	$location = get_post_meta(get_the_ID(), "Location", true);
	$cover_letter = get_the_content();
	$file_id = get_post_meta(get_the_ID(), "Resume", true);
	$application_status = get_post_meta(get_the_ID(), "Application Status", true);
	$attachment_url = wp_get_attachment_url( $file_id );
	$attachment_path = get_attached_file($file_id);

	?>
		
		<tr>

			<td><?php echo $full_name; ?></td>	

			<td><?php echo $email; ?></td>	

			<td><?php echo $location; ?></td>	

			<td>
				<a href="javascript:void(0);" class="" data-toggle="modal" data-target="#cl_<?php echo get_the_ID(); ?>">Click to Read</a>						
			</td>
			
			<td><a href="<?php echo $attachment_url; ?> ">Click to Download</a></td>	
			
			<td>

				<div class="btn-group">
				  <button type="button" class="app_status_btn btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    <span class="status_label"><?php echo $application_status; ?><span> <span class="caret"></span>
				  </button>
				  <ul data-job-id="<?php echo get_the_ID(); ?>" class="dropdown-menu app_statuses">
				    <!-- <li><a data-status="Approved" href="javascript:void(0);">Approved</a></li>
				    <li><a data-status="Rejected" href="javascript:void(0);">Rejected</a></li>
				    <li><a data-status="Pending" href="javascript:void(0);">Pending</a></li> -->
				  </ul>
				</div>

			</td>

			<td>
				<form class="forward_application"><input type="hidden" name="job_title" value="<?php echo $job_title; ?>"><input type="hidden" name="full_name" value="<?php echo $full_name; ?>"><input type="hidden" name="email" value="<?php echo $email; ?>"><input type="hidden" name="location" value="<?php echo $location; ?>"><input type="hidden" name="cover_letter" value="<?php echo $cover_letter; ?>"><input type="hidden" name="resume" value="<?php echo $attachment_path; ?>"><input id="forward_application" type="text" name="forward_to"><button id="forward_application_btn">Submit</button></form>
			</td>

		</tr>
		<!-- Modal -->
		  <div class="modal fade" id="cl_<?php echo get_the_ID(); ?>" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>	<h4><?php echo $full_name; ?> - Cover Letter</h4>		          
		        </div>
		        <div class="modal-body">
		          <?php echo $cover_letter; ?>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>

	<?php endwhile; ?>
	<!-- end of the loop -->

	</tbody>
</table>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<h3 class="njf" style="margin-top: 30px;"><?php esc_html_e( 'No job applications found for this job posting' ); ?></h3>
<?php endif; ?>

<?php endif; ?>