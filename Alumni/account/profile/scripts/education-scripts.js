$(document).on('submit', '#AddEducForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;          
    if($('#mSchName').val() == "")  
  	{  
        alert("School name is required");  
    }  
    else if($('#mYrGrad').val() == '')  
    {  
        alert("Year graduated is required");  
   	}
   	else if($('#mEducLevel').val() == '')  
    {  
        alert("Educational level is required");  
   	}
    else if ($('#mSchName').val() != '' && $('#mYrGrad').val() != '' && $('#mEducLevel').val() != '')    
    { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-educ-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddEducForm')[0].reset();  
                        $('#AddEducModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});


$('#updateCMUEduc').click(function(){
	var base_url = window.location.origin;
	var  = $(this).data("cmuedid");
			alert (cmuedid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/educ_fetch_identifier.php",
		method:"POST",  
              data:{cmuedid:cmuedid},  
              dataType:"json",  
		success:function(data){ 
			$('#cmueducid').val(data.educ_id); 
            $('#cmuSchName').val(data.sch_name); 
            $('#cmuEducLevel').val(data.educ_level);  
            $('#cmuDegLevel').val(data.deg_level);  
            $('#cmuStudied').val(data.prog_studied);  
            $('#cmuMajor').val(data.prog_major);
            $('#cmuYrGrad').val(data.year_grad);  
            $('#cmuComment').val(data.comments);  
            $('#cmualumniid').val(data.alumni_id);
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	

$(document).on('submit', '#EditCMUEducForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#eedSchName').val() == "")  
  	{  
        alert("School name is required");  
    }  
    else if($('#eedYrGrad').val() == '')  
    {  
        alert("Year graduated is required");  
   	}
   	else if($('#eedEducLevel').val() == '')  
    {  
        alert("Educational level type is required");  
   	}
    else if ($('#eedSchName').val() != '' && $('#eedYrGrad').val() != '' && $('#eedEducLevel').val() != '')   
	{  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-educ-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditCMUEducForm')[0].reset();  
						$('#EditCMUEducModal').modal('hide'); 
						$('#Educload').load();
					}  
				});  
	}
	else{
		alert("Both Fields are Required");
	}		
});



$('#updateEduc').click(function(){
	var base_url = window.location.origin;
	var edid = $(this).data("edid");
			alert (edid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/educ_fetch_identifier.php",
		method:"POST",  
              data:{edid:edid},  
              dataType:"json",  
		success:function(data){ 
			$('#eededucid').val(data.educ_id); 
            $('#eedSchName').val(data.sch_name); 
            $('#eedEducLevel').val(data.educ_level);  
            $('#eedDegLevel').val(data.deg_level);  
            $('#eedStudied').val(data.prog_studied);  
            $('#eedMajor').val(data.prog_major);
            $('#eedYrGrad').val(data.year_grad);  
            $('#eedComment').val(data.comments);  
            $('#eedalumniid').val(data.alumni_id);
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditEducForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#eedSchName').val() == "")  
  	{  
        alert("School name is required");  
    }  
    else if($('#eedYrGrad').val() == '')  
    {  
        alert("Year graduated is required");  
   	}
   	else if($('#eedEducLevel').val() == '')  
    {  
        alert("Educational level type is required");  
   	}
    else if ($('#eedSchName').val() != '' && $('#eedYrGrad').val() != '' && $('#eedEducLevel').val() != '')   
	{  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-educ-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditEducForm')[0].reset();  
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