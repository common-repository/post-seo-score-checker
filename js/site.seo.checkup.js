jQuery(function($){
	// Configrations
	var activeBtn = 1;
	var remoteUrl = 'http://www.prepostseo.com/';
	var adminURL = $("#ppsAdminURL").html();
	var siteURL = $("#ppsSiteURL").html();
	function pss_check_seoDetail()
	{
		$.ajax({
			url : adminURL + "post.php",
			type: "post",
			data: {pps_check_siteDetails : 1},
			dataType:"json",
			async: true, 
			success: function(resp)
			{
				if(typeof resp.error != 'undefined' && resp.error != 'false')
				{
					alert(resp.error);
					return false;
				}
				$("#loadingSec").hide();
				$("#reportDetails").show();
				
				jQuery.each(resp.d.commonseo, function(index, value){
					 var trStatus;
					 if(value.status == 'passed')
					 {
						 trStatus = '<i class="fa fa-check fa-2x green"></i>';
					 } else if (value.status == 'warning')
					 {
						 trStatus = '<i class="fa fa-warning fa-2x icon_cross_light"></i>';
					 } else if (value.status == 'error')
					 {
						 trStatus = '<i class="fa fa-remove fa-2x icon_cross"></i>';
					 } else {
						 trStatus = '<i class="fa fa-info-circle fa-2x icon_info"></i>';
					 }
					  var rowHTML = '<tr id="pps-'+index+'">'
						 + '<td>' + value.mainTitle + '</td>'
						 + '<td class="status">' + trStatus + '</td>';
					 
					 var details = '';
					 var arr = '<i class="arrow_r fa fa-arrow-right"></i>';
					 
					 if(typeof value.data === 'string')
						{ 
							if(value.data.length > 5)
							{
								details += '<div class="more_info">'+arr+value.data+'</div>';
							}
						} else {
							if(value.data.length > 0)
							{
								details += '<div class="more_info">';
								jQuery.each(value.data, function(n, v){
									if(typeof v === 'string')
									{
										details += arr + v + "<br />";
									} else {
										details += arr + v.url + "<br />";
									}
								});
								details += '</div>';
							}
						}
						
					rowHTML += '<td><span class="main-msg">' + value.mainMsg + '</span>' + details + '</td></tr>';
					$("#pps-site-seo").append(rowHTML);
				});
				
				checkLinksStatus();
			}
		});
	}
	$("#checkSiteSEO").click(function(){
		$("#loadingSec").show();
		$("#infoSec").hide();
		activeBtn = 0;
		pss_check_seoDetail();
	});


	function checkLinksStatus()
	{
		var links = $("#linksArray").html();
		$("#pps-aTags .status").html('<i class="fa fa-refresh fa-spin fa-2x"></i>');
		$("#pps-aTags .main-msg").html("Checking Links Status...");
		//alert(links);
		
		$.ajax({
			url : adminURL + "post.php",
			type: "post",
			data: {pps_check_links_array : 1 ,"links" : links},
			dataType:"json",
			async: true, 
			success: function(resp)
			{
				if(resp.error == '0')
				{
					$("#pps-aTags .status").html(resp.status);
					$("#pps-aTags .main-msg").html(resp.msg);
				}
				
				activeBtn = 1;
			}
		});
		
	}

});