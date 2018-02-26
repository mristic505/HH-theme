<?php
require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );

$job_id = $_POST['job_id']; 
$job_status = $_POST['job_status'];

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$data['success'] = true;        
$data['message'] = 'success';

update_post_meta($job_id, '_filled', $job_status); 

// return all our data to an AJAX call
echo json_encode($data);

?>