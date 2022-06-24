$(document).on('submit', '#AddOrganizationForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;          
    if($('#orgName').val() == "")  
  	{  
        alert("Organization name is required");  
    }  
    else if($('#orgPos').val() == '')  
    {  
        alert("Organiization position is required");  
   	}
   	else if($('#orgMStatred').val() == '')  
    {  
        alert("Month started is required");  
   	}  
    else if($('#orgMEnded').val() == '')  
    {  
        alert("Month ends is required");  
   	}
   	else if($('#orgYrStarted').val() == '')  
    {  
        alert("Year started is required");  
   	}  
    else if($('#orgYrEnded').val() == '')  
    {  
        alert("Year ends is required");  
   	}
    else if ($('#orgName').val() != '' && $('#orgPos').val() != '' && $('#orgMStatred').val() != '' &&$('#orgMEnded').val() != '' && $('#orgYrStarted').val() != '' &&$('#orgYrEnded').val() != '')    
    { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-org-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddOrganizationForm')[0].reset();  
                        $('#AddOrganizationModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});



$('#editOrg').click(function(){
	var base_url = window.location.origin;
	var orgid = $(this).data("orgid");
			//alert (orgid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/org_fetch_identifier.php",
		method:"POST",  
              data:{orgid:orgid},  
              dataType:"json",  
		success:function(data){ 
                  $('#eorgName').val(data.org_name);  
                    $('#eorgPos').val(data.position);  
                    $('#eorgMStatred').val(data.from_month);  
                    $('#eorgMEnded').val(data.to_month);  
                    $('#eorgYrStarted').val(data.from_year);  
                    $('#eorgYrEnded').val(data.toyear);  
                    $('#eorgComment').val(data.comments);  
                    $('#eorgComment').val(data.alumni_id);  
                    $('#eorgid').val(data.org_id);  
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditOrganizationForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#eorgName').val() == "")  
  	{  
        alert("Organization name is required");  
    }  
    else if($('#eorgPos').val() == '')  
    {  
        alert("Organiization position is required");  
   	}
   	else if($('#eorgMStatred').val() == '')  
    {  
        alert("Month started is required");  
   	}  
    else if($('#eorgMEnded').val() == '')  
    {  
        alert("Month ends is required");  
   	}
   	else if($('#eorgYrStarted').val() == '')  
    {  
        alert("Year started is required");  
   	}  
    else if($('#eorgYrEnded').val() == '')  
    {  
        alert("Year ends is required");  
   	}
    else if ($('#eorgName').val() != '' && $('#eorgPos').val() != '' && $('#eorgMStatred').val() != '' &&$('#eorgMEnded').val() != '' && $('#eorgYrStarted').val() != '' &&$('#eorgYrEnded').val() != '')    
    { 
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-org-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditOrganizationForm')[0].reset();  
						$('#EditOrganizationModal').modal('hide'); 
						$('#Educload').load();
					}  
				});  
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