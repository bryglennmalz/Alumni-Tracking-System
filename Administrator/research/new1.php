<html>
	<head>
		   <!-- Custom CSS -->
    <link href="../../css/style.css" rel="stylesheet">
	</head>
	<body>
		<div id="ansNotOpinionYesNO" class="table-responsive">  
			<table class="table table-bordered" id="dynamic_field_Answer">  
				<th>Answer choices<th>
				<tr>  
					<td style=" width: 90%">
						<input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
					</td>  
					<td style=" width: 5%">
						<button type="button" name="addAnswer" id="addAnswer" class="btn btn-success">+</button>
					</td>  
				</tr> 
				<tr>  
					<td style=" width: 90%">
						<input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/>
					</td>  
						<td style=" width: 5%">
					</td>  
				</tr>  
			</table>
		</div>
		<div class="col-md-6">
                                                <table class="table table-bordered" id="dynamic_field_Lang">  
													<th>Languages<th>
													<tr>  
														<td style=" width: 90%">
															<input type="text" id="language[]" name="language[]" placeholder="Language" class="form-control name_list" oninput="this.className = ''" required/>
															<select class="form-control" id="langProf[]" name="langProf[]" oninput="this.className = ''"  required>
																<option value="">Select Proficiency</option>
																<option value="Limited proficiency">Limited proficiency</option>
																<option value="Native or biligual proficiency">Native or biligual proficiency</option>
																<option value="Professional proficiency">Professional proficiency</option>
															</select>
														</td>  
														<td style=" width: 5%"><button type="button" name="addLanguage" id="addLanguage" class="btn btn-success">+</button></td>  
													</tr>   
											   </table>
                                            </div>
		    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
		<script src="../../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
		<script>
			$(document).ready(function(){  
				var i=1;  
				$('#addAnswer').click(function(){  
					i++;  
					$('#dynamic_field_Answer').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" id="answer[]" name="answer[]" placeholder="Answer" class="form-control name_list" required/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_removes">X</button></td></tr>');  
				});  
				$(document).on('click', '.btn_removes', function(){  
					var button_id = $(this).attr("id");   
					$('#row'+button_id+'').remove();  
				});

				//$('').ready
				
				var i=1;  
				$('#addLanguage').click(function(){  
				   i++;  
				   $('#dynamic_field_Lang').append('<tr id="row'+i+'"><td style=" width: 90%"><input type="text" id="language[]" name="language[]" placeholder="Language" class="form-control name_list" required/><select class="form-control" id="langProf[]" name="langProf[]" required><option value="">Select Proficiency</option><option value="Limited proficiency">Limited proficiency</option><option value="Native or biligual proficiency">Native or biligual proficiency</option><option value="Professional proficiency">Professional proficiency</option></select></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
				});  
				$(document).on('click', '.btn_remove', function(){  
				   var button_id = $(this).attr("id");   
				   $('#row'+button_id+'').remove();  
				});
			});
		</script>
	</body>
</html>