<?php
require_once( explode( "wp-content" , __FILE__ )[0] . "wp-load.php" );

$application_id = $_POST['application_id']; 
$application_status = $_POST['application_status'];

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

$data['success'] = true;        
$data['message'] = 'success';

update_post_meta($application_id, 'Application Status', $application_status); 

// return all our data to an AJAX call
echo json_encode($data);

?>