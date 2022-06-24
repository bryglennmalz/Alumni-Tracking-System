$(document).on('submit', '#AddHonorAwardsForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;          
    if($('#haName').val() == "")  
  	{  
        alert("Honor or award name is required");  
    }  
    else if($('#haIssuer').val() == '')  
    {  
        alert("Honor or award issuer is required");  
   	}
   	else if($('#haMonth').val() == '')  
    {  
        alert("Month is required");  
   	}  
    else if($('#haYear').val() == '')  
    {  
        alert("Year is required");  
   	}
    else if ($('#haName').val() != '' && $('#haIssuer').val() != '' && $('#haMonth').val() != '' &&$('#haYear').val() != '')    
    { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-honor-award-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddCertForm')[0].reset();  
                        $('#AddHonorAwardsModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});



$('#editHonorAward').click(function(){
	var base_url = window.location.origin;
	var haid = $(this).data("haid");
			//alert (haid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/honor_award_fetch_identifier.php",
		method:"POST",  
              data:{haid:haid},  
              dataType:"json",  
		success:function(data){ 
                  $('#ehaName').val(data.ha_name);  
                    $('#ehaAssoc').val(data.associated);  
                    $('#ehaMonth').val(data.issuer);  
                    $('#ehaYear').val(data.month);  
                    $('#ehaComment').val(data.year);  
                    $('#ehaalumniid').val(data.alumniid);  
                    $('#ehaid').val(data.ha_id);  
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditHonorAwardsForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#ehaName').val() == "")  
  	{  
        alert("Honor or award name is required");  
    }  
    else if($('#ehaIssuer').val() == '')  
    {  
        alert("Honor or award issuer is required");  
   	}
   	else if($('#ehaMonth').val() == '')  
    {  
        alert("Month is required");  
   	}  
    else if($('#ehaYear').val() == '')  
    {  
        alert("Year is required");  
   	}
    else if ($('#ehaName').val() != '' && $('#ehaIssuer').val() != '' && $('#ehaMonth').val() != '' &&$('#ehaYear').val() != '')    
    {  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-honor-award-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditHonorAwardsForm')[0].reset();  
						$('#EditHonorAwardsModal').modal('hide'); 
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