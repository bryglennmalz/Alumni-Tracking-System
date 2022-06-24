$(document).on('submit', '#AddSemTrainWorkshopsForm', function(event){
    event.preventDefault();
    var base_url = window.location.origin;          
    if($('#stwName').val() == "")  
  	{  
        alert("Seminar, training, or workshop name is required");  
    }  
    else if($('#stwVenue').val() == '')  
    {  
        alert("Seminar, training, or workshop venue is required");  
   	}
   	else if($('#stwMonth').val() == '')  
    {  
        alert("Month is required");  
   	}  
    else if($('#stwYear').val() == '')  
    {  
        alert("Year is required");  
   	}
   	else if($('#stwType').val() == '')  
    {  
        alert("Seminar, training, or workshop type is required");  
   	}  
    else if($('#stwLevel').val() == '')  
    {  
        alert("Seminar, training, or workshop level is required");  
   	}
    else if ($('#stwName').val() != '' && $('#stwVenue').val() != '' && $('#stwMonth').val() != '' &&$('#stwYear').val() != '' && $('#stwType').val() != '' &&$('#stwLevel').val() != '')    
    { 
                $.ajax({  
                    url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-sem-train-work-php.php", 
                    method:"POST",  
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){ 
                        alert(data);
                        $('#AddSemTrainWorkshopsForm')[0].reset();  
                        $('#AddSemTrainWorkshopsModal').modal('hide'); 
                        //this.
                    }  
                });  
    }       
});



$('#editSemTrainWork').click(function(){
	var base_url = window.location.origin;
	var stwid = $(this).data("stwid");
			//alert (orgid);
	$.ajax({
		url:base_url+"/alumni-e-network-4/Alumni/account/php/sem_train_work_fetch_identifier.php",
		method:"POST",  
              data:{stwid:stwid},  
              dataType:"json",  
		success:function(data){ 
                  $('#estwName').val(data.stw_name);  
                    $('#estwVenue').val(data.venue);  
                    $('#estwMonth').val(data.month);  
                    $('#estwYear').val(data.year);  
                    $('#estwType').val(data.type);  
                    $('#estwLevel').val(data.level);  
                    $('#eorgComment').val(data.comments);  
                    $('#estwalumniid').val(data.alumni_id);  
                    $('#stwid').val(data.stw_id);  
		},
		error:function(data)
		{
			console.log(data);
		}
	});
});	
$(document).on('submit', '#EditSemTrainWorkshopsForm', function(event){
	event.preventDefault();
	var base_url = window.location.origin;			
	if($('#estwName').val() == "")  
  	{  
        alert("Seminar, training, or workshop name is required");  
    }  
    else if($('#estwVenue').val() == '')  
    {  
        alert("Seminar, training, or workshop venue is required");  
   	}
   	else if($('#estwMonth').val() == '')  
    {  
        alert("Month is required");  
   	}  
    else if($('#estwYear').val() == '')  
    {  
        alert("Year is required");  
   	}
   	else if($('#estwType').val() == '')  
    {  
        alert("Seminar, training, or workshop type is required");  
   	}  
    else if($('#estwLevel').val() == '')  
    {  
        alert("Seminar, training, or workshop level is required");  
   	}
    else if ($('#estwName').val() != '' && $('#estwVenue').val() != '' && $('#estwMonth').val() != '' &&$('#estwYear').val() != '' && $('#estwType').val() != '' &&$('#estwLevel').val() != '')    
    {  
				$.ajax({  
					url:base_url+"/alumni-e-network-4/Alumni/account/php/add-update-sem-train-work-php.php", 
					method:"POST",  
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){ 
						alert(data);
						$('#EditSemTrainWorkshopsForm')[0].reset();  
						$('#EditSemTrainWorkshopsModal').modal('hide'); 
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