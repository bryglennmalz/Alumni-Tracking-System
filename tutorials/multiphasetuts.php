<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		
		<style>
		form#multiphase{ border:#000 1px solid; padding:24px; width:100%; }
		form#multiphase > #phase2, #phase3, #phase4, #show_all_data{ display:none; }
		</style>
		
		<script>
		var fname, lname, gender, country;
		function _(x){
			return document.getElementById(x);
		}
		function processPhase1(){
			fname = _("firstname").value;
			lname = _("lastname").value;
			if(fname.length > 2 && lname.length > 2){
				_("phase1").style.display = "none";
				_("phase2").style.display = "block";
				_("progressBar").value = 25;
				_("status").innerHTML = "Phase 2 of 4";
			} else {
				alert("Please fill in the fields");	
			}
		}
		function processPhaseBack1(){
				_("phase2").style.display = "none";
				_("phase1").style.display = "block";
				_("progressBar").value = 0;
				_("status").innerHTML = "Phase 1 of 4";
		}
		function processPhase2(){
			gender = _("gender").value;
			if(gender.length > 0){
				_("phase2").style.display = "none";
				_("phase3").style.display = "block";
				_("progressBar").value = 50;
				_("status").innerHTML = "Phase 3 of 4";
			} else {
				alert("Please choose your gender");	
			}
		}
		function processPhaseBack2(){
				_("phase3").style.display = "none";
				_("phase2").style.display = "block";
				_("progressBar").value = 25;
				_("status").innerHTML = "Phase 2 of 3";
		}
		function processPhase3(){
			gender = _("gender").value;
			if(gender.length > 0){
				_("phase3").style.display = "none";
				_("phase4").style.display = "block";
				_("progressBar").value = 75;
				_("status").innerHTML = "Phase 3 of 4";
			} else {
				alert("Please choose your gender");	
			}
		}
		function processPhaseBack3(){
				_("phase4").style.display = "none";
				_("phase3").style.display = "block";
				_("progressBar").value = 50;
				_("status").innerHTML = "Phase 2 of 4";
		}
		function processPhase4(){
			country = _("country").value;
			if(country.length > 0){
				_("phase3").style.display = "none";
				_("show_all_data").style.display = "block";
				_("display_fname").innerHTML = fname;
				_("display_lname").innerHTML = lname;
				_("display_gender").innerHTML = gender;
				_("display_country").innerHTML = country;
				_("progressBar").value = 100;
				_("status").innerHTML = "Data Overview";
			} else {
				alert("Please choose your country");	
			}
		}
		function submitForm(){
			_("multiphase").method = "post";
			_("multiphase").action = "my_parser.php";
			_("multiphase").submit();
		}
		</script>
	</head>
	
	<body>
		<progress id="progressBar" value="0" max="100" style="width:250px;"></progress>
		
		<h3 id="status">Phase 1 of 4</h3>
		
		<form id="multiphase" onsubmit="return false">
			<div id="phase1">
				First Name: <input id="firstname" name="firstname"><br>
				Last Name: <input id="lastname" name="lastname"><br>
				<button onclick="processPhase1()">Continue</button>
			</div>
			<div id="phase2">
				Gender: <select id="gender" name="gender">
				  <option value=""></option>
				  <option value="m">Male</option>
				  <option value="f">Female</option>
				</select><br>
				<button onclick="processPhaseBack1()">Back</button>
				<button onclick="processPhase2()">Continue</button>
			</div>
			<div id="phase3">
				Country: <select id="country" name="country">
				  <option value="United States">United States</option>
				  <option value="India">India</option>
				  <option value="United Kingdom">United Kingdom</option>
				</select><br>
				<button onclick="processPhaseBack2()">Back</button>
				<button onclick="processPhase3()">Continue</button>
			</div>
			<div id="phase4">
				Gender: <select id="gender" name="gender">
				  <option value=""></option>
				  <option value="m">Male</option>
				  <option value="f">Female</option>
				</select><br>
				<button onclick="processPhaseBack3()">Back</button>
				<button onclick="processPhase4()">Continue</button>
			</div>
			<div id="show_all_data">
				First Name: <span id="display_fname"></span> <br>
				Last Name: <span id="display_lname"></span> <br>
				Gender: <span id="display_gender"></span> <br>
				Country: <span id="display_country"></span> <br>
				<button onclick="submitForm()">Submit Data</button>
			</div>
		</form>
	</body>
</html>