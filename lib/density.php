<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}

function pps_checkDensity()
{
	$actionSite = PSSC_ACTION_SITE;
	$data = array(
		"data" => sanitize_text_field($_POST['data'])
	);
	$target = $actionSite.'frontend/checkDensityWP';
	
	
	$response = wp_remote_post( $target, array(
		'method'      => 'POST',
		'timeout'     => 45,
		'redirection' => 5,
		'httpversion' => '1.0',
		'blocking'    => true,
		'headers'     => array(),
		'body'        => $data,
		'cookies'     => array()
		)
	);
	
	
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		echo "Something went wrong: $error_message";
	} else {
		echo $response['body'];
	}

exit;
}