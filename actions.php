<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}


if(!empty($_POST['pssc_check_broken']))
{
	if(!check_ajax_referer( 'pssc-nonce-security', 'nonce_security'))
	{
		wp_die();
	}
	include_once('lib/checkbroken.php');	
	if(!empty($_POST['url']))
	{
		if(pssc_validate_url($_POST['url']))
		{
			echo 'true'; exit;
		}
	}
	echo 'false'; exit;
}

if(!empty($_POST['pssc_check_status']))
{
	if(!check_ajax_referer( 'pssc-nonce-security', 'nonce_security'))
	{
		wp_die();
	}
	echo 'ok'; exit;
}

if(!empty($_POST['pssc_check_density']))
{
	if(!check_ajax_referer( 'pssc-nonce-security', 'nonce_security'))
	{
		wp_die();
	}
	include_once('lib/density.php');	
	pps_checkDensity();
}


if(!empty($_POST['pssc_check_links_array']))
{
	if(!check_ajax_referer( 'pssc-nonce-security', 'nonce_security'))
	{
		wp_die();
	}
	include('lib/checkBroken.php');	
	pssc_checkLinksStatusArray();
}


