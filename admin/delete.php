<?php 
 // <!-- 
 // Design & Programming by Mojtaba Valipour @ CyberHands.org 
 // E-mail: vpcom_(at)_cyberhands_(.)_org  (Delete Underline & Parenthesis )
 // Dezful Jundi Shapur University of Technology (www.jsu.ac.ir)
 // Acknowledgement:
 // -Bootstrap
 // -@mdo
 // -w3schools
 // -peredur.net
 // -Ajax
 // -Roozbeh Baabakaan gregorian_jalali 1 2012
 // -CyberHands
 // -Jundi Shapur University of Technology
 // -->
	iconv_set_encoding("internal_encoding", "UTF-8"); 
	include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
	include_once 'insert.inc.php';
	sec_session_start(); // Our custom secure way of starting a PHP session.


	if (login_check($mysqli) == true) : 
?>

	<link type="text/css" href="../assets/css/jquery-ui-1.8.14.css" rel="stylesheet" />
	<script type="text/javascript" src="../assets/js/jquery-1.6.2.min.js"></script>
    <script type="text/JavaScript" src="../assets/js/forms.js"></script>  
	<script type="text/javascript">
			function showSelelctSession() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else if (window.ActiveXObject){
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				else {
					throw new Error("Ajax is not supported by this browser");
				}		
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("SessionSelector").innerHTML = xmlhttp.responseText;
						document.getElementById("SessionSelector2").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","insert.ajax.select.session.php",false);
				xmlhttp.send();
			}
	</script>	
	
	<script type="text/javascript">
			function showSelelctMentor() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else if (window.ActiveXObject){
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				else {
					throw new Error("Ajax is not supported by this browser");
				}		
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("MentorSelector").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","insert.ajax.select.mentor.php",false);
				xmlhttp.send();
			}
	</script>	
	<script type="text/javascript">
		
			function showSelelctFaculty() {
				var xmlhttp;
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else if (window.ActiveXObject){
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
				else {
					throw new Error("Ajax is not supported by this browser");
				}		
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("FacultySelector").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","insert.ajax.select.faculty.php",false);
				xmlhttp.send();
			}
	</script>
	
	

			

			<!-- Registration form - START -->
			<div class="container">
				<div class="row">
						<div class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong> حذف داده های موجود از پایگاه داده </strong></div>				
						</div>
						<div id="Error_Response" class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
						</div>
				</div>
				<div class="row">
					<form role="form" method="post" name="Session_Faculty_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">							
							
							<div class="well well-sm"><strong>حذف نشست/جلسه</strong></div>

							<div class="form-group">
								<label for="SelectSession">شماره نشست</label>
								<div class="input-group">
									<div id="SessionSelector" >
										<select name='session'></select>
									</div>
								</div>
							</div>


							<input type="button" class="btn btn-info pull-right"
							   value="حذف اطلاعات" 
							   onclick="return delSession(this.form,
											   this.form.session);" /> 
							<input type="button" class="btn btn-info pull-right"
							   value="به روز رسانی" 
							   onclick="showSelelctSession();" /> 
							<br><br><br>

						</div>

					</form>
					<form role="form" method="post" name="Session_Mentor_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong>حذف شرکت کننده</strong></div>

							<div class="form-group">
								<label for="SelectFaculty">شرکت کننده</label>
								<div class="input-group">
									<div id="FacultySelector" >
										<select name='faculty'></select>
									</div>								
								</div>
							</div> 
							
							<input type="button" class="btn btn-info pull-right"
							   value="حذف اطلاعات" 
							   onclick="return delFaculty(this.form,
											   this.form.faculty);" /> 
							<input type="button" class="btn btn-info pull-right"
							   value="به روز رسانی" 
							   onclick="showSelelctFaculty();" /> 											   
							<br><br><br>
						</div>
						
					</form>	
				</div>
				
				<div class="row">
					<form role="form" method="post" name="Session_Mentor_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong>حذف مربی</strong></div>
							<div class="form-group">
								<label for="SelectMentor">مربی نشست</label>
								<div class="input-group">
									<div id="MentorSelector">
										<select name='mentor'></select>
									</div>									
								</div>
							</div> 

							<input type="button" class="btn btn-info pull-right"
							   value="حذف اطلاعات" 
							   onclick="return delMentor(this.form,
											   this.form.mentor);" /> 
							<input type="button" class="btn btn-info pull-right"
							   value="به روز رسانی" 
							   onclick="showSelelctMentor();" /> 									
							<br><br><br>
						</div>
						
					</form>	
				</div>
				

			</div>
			<!-- Registration form - END -->
		
		
		
		
<?php
	else : ?>
		<div class="alert alert-danger">
			<span class="glyphicon glyphicon-remove"></span><strong>شما مجوز دسترسی به این صفحه را ندارید. به درستی وارد شوید!</strong>
		</div>
		<div class="alert alert-success">
			<strong><span class="glyphicon glyphicon-ok"></span> شما به زودی به صفحه ی ورود منتقل می شوید!</strong>
		</div>
	<?php endif;?>
	