

$(document).ready(function(){
            $('#locCountry').on('change',function(){
                var countryID = $(this).val();
                if(countryID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'country_id='+countryID,
                        success:function(html){
                            $('#locProv').html(html);
                            $('#locCityMun').html('<option value="">Select province first</option>'); 
                        }
                    }); 
                }else{
                    $('#locProv').html('<option value="">Select country first</option>');
                    $('#locCityMun').html('<option value="">Select province first</option>'); 
                }
            });
            
            $('#locProv').on('change',function(){
                var stateID = $(this).val();
                if(stateID){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'state_id='+stateID,
                        success:function(html){
                            $('#locCityMun').html(html);
                        }
                    }); 
                }else{
                    $('#locCityMun').html('<option value="">Select province first</option>'); 
                }
            });

           	$('#jheCountry').on('change',function(){
                var jheCountry = $(this).val();
                if(jheCountry){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'jheCountry='+jheCountry,
                        success:function(html){
                            $('#jheProv').html(html);
                            $('#jheCityMun').html('<option value="">Select province first</option>'); 
                        }
                    }); 
                }else{
                    $('#jheProv').html('<option value="">Select country first</option>');
                    $('#jheCityMun').html('<option value="">Select province first</option>'); 
                }
            });
            
            $('#jheProv').on('change',function(){
                var jheProv = $(this).val();
                if(jheProv){
                    $.ajax({
                        type:'POST',
                        url:'ajaxData.php',
                        data:'jheProv='+jheProv,
                        success:function(html){
                            $('#jheCityMun').html(html);
                        }
                    }); 
                }else{
                    $('#jheCityMun').html('<option value="">Select province first</option>'); 
                }
			});
});


$(document).on('submit', '#AddJobHistForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;         
    if($('#jobPos').val() == "")  
  	{  
        alert("Job position is required");  
    }  
    else if($('#compName').val() == '')  
    {  
        alert("Company name is required");  
   	}
   	else if($('#empType').val() == '')  
    {  
        alert("Employment type is required");  
   	} 
   	else if($('#senLevel').val() == '')  
    {  
        alert("Senior level is required");  
   	} 
   	else if($('#mStatred').val() == '')  
    {  
        alert("Month started is required");  
   	} 
   	else if($('#mEnded').val() == '')  
    {  
        alert("Month ended is required");  
   	} 
   	else if($('#yrStarted').val() == '')  
    {  
        alert("Year started is required");  
   	} 
   	else if($('#yrEnded').val() == '')  
    {  
        alert("Year ended is required");  
   	} 
   	else if($('#locCountry').val() == '')  
    {  
        alert("Country is required");  
   	} 
   	else if($('#locProv').val() == '')  
    {  
        alert("Province is required");  
   	} 
   	else if($('#locCityMun').val() == '')  
    {  
        alert("City/Nunicipality is required");  
   	} 
    else if ($('#jobPos').val() != '' && $('#compName').val() != '' && $('#empType').val() != '' && $('#senLevel').val() != '' && $('#mStatred').val() != '' && $('#mEnded').val() != '' && $('#yrStarted').val() != '' && $('#yrEnded').val() != '' && $('#locCountry').val() != '' && $('#locProv').val() != '' && $('#locCityMun').val() != '')    
    {  alert(base_url);
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-job-history-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddJobHistForm')[0].reset();  
                        $('#AddJobHistoryModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});



$('#editJobHist').click(function(){
	var base_url = window.location.origin;
	var jobhistid = $(this).data("jobhistid");
			//alert (forumid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/job_hist_fetch_identifier.php",
		method:"POST",  
              data:{jobhistid:jobhistid},  
              dataType:"json",  
		success:function(data){ 
			$('#jhejobPos').val(data.position);  
                  $('#jhecompName').val(data.company);  
                  $('#jhesalRange').val(data.sal_range_id);  
                  $('#jheempType').val(data.emp_type_id);  
                  $('#jhesenLevel').val(data.senior_level_id);  
                  $('#jhemStatred').val(data.mo_start);  
                  $('#jhemEnded').val(data.mo_end);  
                 $('#jheyrStarted').val(data.yr_start);  
                  $('#jheyrEnded').val(data.yr_end);  
                  $('#jheCountry').val(data.cm_id);  
                  $('#jheProv').val(data.ps_id);  
                  $('#jheCityMun').val(data.c_id);  
                  $('#jheComment').val(data.comments);  
                  $('#jhealumniid').val(data.alumni_id);  
                  $('#jhejobid').val(data.job_hist_id);  
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditJobHistForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#jhejobPos').val() == "")  
  	{  
        alert("Job Position is required");  
    }  
    else if($('#jhecompName').val() == '')  
    {  
        alert("Company name is required");  
   	}
   	else if($('#jheempType').val() == '')  
    {  
        alert("Employment type is required");  
   	} 
   	else if($('#jhesenLevel').val() == '')  
    {  
        alert("Senior level is required");  
   	} 
   	else if($('#jhemStatred').val() == '')  
    {  
        alert("Month started is required");  
   	} 
   	else if($('#jhemEnded').val() == '')  
    {  
        alert("Month ended is required");  
   	} 
   	else if($('#jheyrStarted').val() == '')  
    {  
        alert("Year startes is required");  
   	} 
   	else if($('#jheyrEnded').val() == '')  
    {  
        alert("Year end is required");  
   	} 
   	else if($('#jhelocCountry').val() == '')  
    {  
        alert("Country is required");  
   	} 
   	else if($('#jhelocProv').val() == '')  
    {  
        alert("Province is required");  
   	} 
   	else if($('#jhelocCityMun').val() == '')  
    {  
        alert("City/Nunicipality is required");  
   	} 
    else if ($('#jhejobPos').val() != '' && $('#jhecompName').val() != '' && $('#jheempType').val() != '' && $('#jhesenLevel').val() != '' && $('#jhemStatred').val() != '' && $('#jhemEnded').val() != '' && $('#jheyrStarted').val() != '' && $('#jheyrEnded').val() != '' && $('#jhelocCountry').val() != '' && $('#jhelocProv').val() != '' && $('#jhelocCityMun').val() != '')   
	{  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-job-history-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditJobHistForm')[0].reset();  
						$('#EditEducModal').modal('hide'); 
						$('#Educload').load();
					}  
				});  
	}
	else{
		alert("Both Fields are Required");
	}		
});
		
		$('#deleteForum').click(function(){
			var base_url = window.location.origin;
			var forumid = $(this).data("forumid");
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:base_url+"/alumni-e-network-4/Alumni/account/php/delete-job-history-php.php", 
					method:"POST",
					data:{forumid:forumid},
					success:function(data)
					{
						alert(data);
					}
				});
			}
			else
			{
				return false;	
			}
		});

		$('#deleteJobHist').click(function(){
			var base_url = window.location.origin;
			var pollid = $(this).data("pollid");
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:base_url+"/alumni-e-network-4/Alumni/account/php/delete-job-history-php.php", 
					method:"POST",
					data:{pollid:pollid},
					success:function(data)
					{
						alert(data);
                		$('#Educload').load();
					}
				});
			}
			else
			{
				return false;	
			}
		});