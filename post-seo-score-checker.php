<?php
/*
  Plugin Name: Post SEO Score Checker
  Description: Best plugin to check post seo before its published. This plugin will help you to check your post seo before you make it live for your web users.
  Version: 1.0
  Author: Prepost SEO
  Author URI: http://www.prepostseo.com/
  License: GPLv3+
*/

/*
Copyright (C) 2015 Ahmad Sattar, prepostseo.com (support AT prepostseo.com) 

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if ( ! defined( 'PPS_ACTION_SITE' ) )
	define("PSSC_ACTION_SITE", "https://www.prepostseo.com/");



	
class PSSC_WP_Seo{
	
	function __construct() {
		 add_action( 'admin_menu', array( $this, 'pssc_wpa_add_menus' ) );
	}
	
	function  pssc_wpa_add_menus()
	{
		 add_menu_page( 'SEO Score Checker', 'Post SEO Score', 'manage_options', 'post-seo-score-checker', array(
                          __CLASS__,
                         'pssc_wpa_files_path'
                        ), plugins_url('imgs/logo.png', __FILE__),'14.6');
		
		
		
	}
	
	
	
	function pssc_wpa_files_path()
	{
		include('settingPage.php');
	}
	
	
	
	
	
	 /*
     * Actions perform on activation of plugin
     */
    function pssc_wpa_install() {
	
    	
		
	}
	
	

	
}
new PSSC_WP_Seo();








add_action( 'admin_menu', 'pssc_create_metabox_seo' );
register_activation_hook( __FILE__, array( 'PSSC_WP_Seo', 'pssc_wpa_install' ) );

function pssc_create_metabox_seo()
{
	$post_types = get_post_types();
	foreach($post_types as $type){
		add_meta_box( 'pssc-meta-box', '<b>Post Seo Score Checker</b>', 'pssc_seobox_design', $type, 'normal', 'high' );
	}
}

function pssc_main_actions()
{
	include_once("actions.php");
}
add_action( 'admin_init', 'pssc_main_actions' );

add_action('admin_head', 'pssc_pre_post_seo_top');

function pssc_wp_admin_style() {
		wp_register_style( 'pssc_main_css', plugin_dir_url(__FILE__) . 'pps_style.css', false, '1.5' );
		wp_enqueue_style( 'pssc_main_css' );
		wp_register_style( 'pssc_tabs_css', plugin_dir_url(__FILE__) . 'css/tabstyles.css', false, '1.5' );
        wp_enqueue_style( 'pssc_tabs_css' );
		wp_register_style( 'pssc_setting_css', plugin_dir_url(__FILE__) . 'css/settings.css', false, '1.5' );
        wp_enqueue_style( 'pssc_setting_css' );
		
	}
add_action( 'admin_enqueue_scripts', 'pssc_wp_admin_style' );

function pssc_pre_post_seo_top() {
		wp_enqueue_script('jquery');
		//wp_enqueue_script( 'pps_jquery_latest', plugin_dir_url(__FILE__) . 'js/jquery.js');
		wp_enqueue_script( 'pssc_stopwords', plugin_dir_url(__FILE__) . 'js/stopwords.js', array('jquery'));
		wp_enqueue_script( 'pssc_main_fn', plugin_dir_url(__FILE__) . 'js/fn.new.js?v=1.5', array('jquery'));
		wp_enqueue_script( 'pssc_modernizr', plugin_dir_url(__FILE__) . 'js/modernizr.custom.js', array('jquery'));
		wp_enqueue_script( 'pssc_cbpFWTabs', plugin_dir_url(__FILE__) . 'js/cbpFWTabs.js', array('jquery'));
		
}






function pssc_seobox_design()
{
	$pssc_nonce_security = wp_create_nonce('pssc-nonce-security');
	
?><span id="sba_results" style="display:none;">
    	<span id="pluginDir" style="display:none;"><?php echo plugin_dir_url(__FILE__); ?></span>
        <span id="ppsAdminURL" style="display:none;"><?php echo get_admin_url(); ?></span>
        <span id="psscNonceSecurity" style="display:none;"><?php echo $pssc_nonce_security; ?></span>
    	<span id="contentDetails" style="display:block;">
        	
            
            <span class="sec_heading">SEO Score</span>
            
            <span class="row">
            	<table>
                	<tr>
                    	<td width="800" valign="top">
                        	
                            <span style="margin-top:30px; float:left;">
                                <span class="bar_btn">Passed:</span>
                                <span class="outer_bar">
                                    <span class="inner_green" id="greenBar" start="0" style="width:0%;"></span>
                                </span>
                            </span>
                            <br><br>
                            <span style="margin-top:17px; float:left;">
                                <span class="bar_btn">To Improve:</span>
                                <span class="outer_bar">
                                    <span class="inner_yellow" id="yellowBar" start="0" style="width:0%;"></span>
                                </span>
                            </span>
                            <br><br>
                            <span style="margin-top:17px; float:left;">
                                <span class="bar_btn">Error:</span>
                                <span class="outer_bar">
                                    <span class="inner_red"  id="redBar" start="0" style="width:0%;"></span>
                                </span>
                            </span>
                        </td>
                        <td width="200">
                        	 <div id="pbar" class="progress-pie-chart" data-percent="0">
                                <div class="ppc-progress">
                                    <div class="ppc-progress-fill" style="transform: rotate(0deg);"></div>
                                </div>
                                <div class="ppc-percents">
                                    <div class="pcc-percents-wrapper">
                                        <span class="score">0</span>
                    
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </span>
            <span class="currentStatus">
            	<img src="<?php echo plugin_dir_url(__FILE__); ?>imgs/loading3.gif" id="statusImg" />
                <span id="cStats"></span>
            </span>
            <span id="suggestions">
            	<span class="improvements" style="display:none;">
                   
                </span>
                <span class="imp_dd">
                	<span class="show_btn down" id="ddImpBtn">SEO improvement suggestions</span>
                </span>
            </span>
            
            
            <span id="alerts">
            		
            </span>
            <span id="pluginStatus">
            		
            </span>
            
            <div class="container maintabsSec">
                
                <section>
                    <div class="tabs tabs-style-bar" id="tabs">
                        <nav>
                            <ul>
                                <li><a class="" name="contentStatus"><span>Status</span></a></li>
                                <li><a class="" name="linksStatus"><span>Links</span></a></li>
                                <li><a class="" name="densityStatus"><span>Density</span></a></li>
                                
                            </ul>
                        </nav>
                       
                    </div><!-- /tabs -->
                </section>
            </div><!-- /container -->
            
            <span class="content_staus_box tabsContent" id="contentStatus" style="display:none; width:100%;">
            	
            </span>
           
            <span class="content_staus_box tabsContent" id="linksStatus" style="display:none;  width:100%;"></span>
            <span class="content_staus_box tabsContent" id="densityStatus" style="display:none;  width:100%;"></span>
             
        </span>
    	
        
        <span id="linksResult" style="display:none;">
        	<span class="sec_heading">Links Status</span>
        </span>
        
        
        
        
    </span>
	
<span style="width:100%;  text-align:center; display:block;">
	<span class="button button-primary button-large sba_btnCheck" id="AnalyzePost" style="margin-top:30px;">Check Post SEO</span>
</span>
    
<?php	
}