<?php

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) 
{ 
die('Direct Access not permitted...'); 
}
	/*
	* Article Rewriter for Wordpress Users
	*/
	

?>





<form method="post" action="">
<table  class="pps-setting-table">
	<tr>
    	<td colspan="2" style="background:#EBEBEB; color:#000; font-size:16px; text-align:center;">
        	<span style="line-height:30px; text-shadow:1px 1px 1px #fff; margin-right:-70px;">- Plugin Setting -</span> 
            <a href="<?php echo PSSC_ACTION_SITE; ?>login" target="_blank" style="float:right;" class="button-secondary button-small">Create account</a>
        </td>
    </tr>
    
    <tr>
        <td colspan="2" style="color:#000; text-align:center;">
            Your Plugin in installed sucessfully, if you need any help regarding this plugin, 
            You are always welcome.
            <br><br>
            <a href="<?php echo PSSC_ACTION_SITE; ?>contact" class="button-secondary button-small" target="_blank">Contact us</a>
        	<br><br>
        </td>
    </tr>
</table>
</form>


