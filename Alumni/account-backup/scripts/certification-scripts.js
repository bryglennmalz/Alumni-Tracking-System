$(document).on('submit', '#AddCertForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;          
    if($('#certName').val() == "")  
  	{  
        alert("Certificate name is required");  
    }  
    else if($('#mCert').val() == '')  
    {  
        alert("Month certified is required");  
   	}
   	else if($('#mExpire').val() == '')  
    {  
        alert("Certification month of expiration level is required");  
   	}  
    else if($('#yrCert').val() == '')  
    {  
        alert("Year certified is required");  
   	}
   	else if($('#yrExpire').val() == '')  
    {  
        alert("Certification year of expiration is required");  
   	}
    else if ($('#certName').val() != '' && $('#mCert').val() != '' && $('#mExpire').val() != '' &&$('#yrCert').val() != '' && $('#yrExpire').val() != '')    
    { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-cert-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddCertForm')[0].reset();  
                        $('#AddCertificationsModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});



$('#editCert').click(function(){
	var base_url = window.location.origin;
	var certid = $(this).data("certid");
			//alert (certid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/cert_fetch_identifier.php",
		method:"POST",  
              data:{certid:certid},  
              dataType:"json",  
		success:function(data){ 
                  $('#ecertName').val(data.cert_name);  
                    $('#ecertAuth').val(data.cert_authority);  
                    $('#emCert').val(data.from_month);  
                    $('#eyrCert').val(data.from_year);  
                    $('#eyrExpire').val(data.to_year);  
                    $('#emExpire').val(data.to_month);  
                    $('#eUrl').val(data.url);  
                    $('#eaalumniid').val(data.alumni_id);  
                    $('#ecertid').val(data.cert_id); 
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditCertForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#ecertName').val() == "")  
  	{  
        alert("Certificate name is required");  
    }  
    else if($('#emCert').val() == '')  
    {  
        alert("Month certified is required");  
   	}
   	else if($('#emExpire').val() == '')  
    {  
        alert("Certification month of expiration level is required");  
   	}  
    else if($('#eyrCert').val() == '')  
    {  
        alert("Year certified is required");  
   	}
   	else if($('#eyrExpire').val() == '')  
    {  
        alert("Certification year of expiration is required");  
   	}
    else if ($('#ecertName').val() != '' && $('#emCert').val() != '' && $('#emExpire').val() != '' &&$('#eyrCert').val() != '' && $('#eyrExpire').val() != '')    
    {  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-cert-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditCertForm')[0].reset();  
						$('#EditCertificationsModal').modal('hide'); 
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

        

		$(document).on('submit', '#EditEducForm', function(event){
			event.preventDefault();
			var base_url = window.location.origin;	

			if($('#eedSchName').val() == "")
			{
				alert("School name is required");  
			}	
			else if ($('#eedYrGrad').val() == "")
			{
				alert("Year grad is required");  
			}
			else if ($('#eedEducLevel').val() == "")
			{
				alert("ducational level is required");  
			}
			else if($('#eedSchName').val() != "" && $('#eedYrGrad').val() != "" && $('#eedEducLevel').val() != ""){	
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
		});
		
		$('#deletePoll').click(function(){
			var base_url = window.location.origin;
			var pollid = $(this).data("pollid");
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:base_url+"/alumni-e-network-4/Alumni/account/php/delete-educ-php.php", 
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