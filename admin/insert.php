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
	<script type="text/javascript" src="../assets/js/jquery.ui.datepicker-cc.all.min.js"></script>
    <script type="text/JavaScript" src="../assets/js/forms.js"></script>  
    <script type="text/javascript">
		var selectedJalaliDate, date, dateGeorg; 
	    $(function() {
	        // استفاده از dropdown
	        // $('#datepicker5').datepicker({
	            // changeMonth: true,
	            // changeYear: true
	        // });
			$('#datepicker5').datepicker({
				changeMonth: true,
	             changeYear: true,
				 onSelect: function(dateStr, inst) {
					selectedJalaliDate = new JalaliDate(inst.selectedYear, inst.selectedMonth, inst.selectedDay);
					date = selectedJalaliDate.getGregorianDate();
					dateGeorg = date.getFullYear() + '-' + (date.getMonth()+1) + '-' + date.getDate();
					 //$(this).val(date.getFullYear() + '/' + (date.getMonth()+1) + '/' + date.getDate());
				}
			});
	    });	
    </script>
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
							<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk" style="color:red;"></span> فیلد ضروری </strong></div>				
						</div>
						<div id="Error_Response" class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
						</div>
				</div>
				<div class="row">
					<form role="form" method="post" name="Session_Faculty_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">							
							
							<div class="well well-sm"><strong> اتصال و ارتباط شرکت کننده و نشست</strong></div>

							<div class="form-group">
								<label for="SelectSession">شماره نشست</label>
								<div class="input-group">
									<div id="SessionSelector">
										<select name='session'></select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="SelectFaculty">شرکت کننده</label>
								<div class="input-group">
									<div id="FacultySelector" >
										<select name='faculty'></select>
									</div>								
								</div>
							</div> 

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت اطلاعات" 
							   onclick="return regformhash(this.form,
											   this.form.username,
											   this.form.email,
											   this.form.password,
											   this.form.confirmpwd);" /> 
							<input type="button" class="btn btn-info pull-right"
							   value="به روز رسانی" 
							   onclick="showSelelctSession();showSelelctFaculty();" /> 
							<br><br><br>

						</div>

					</form>
					<form role="form" method="post" name="Session_Mentor_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong>اتصال و ارتباط مربی و نشست</strong></div>

							<div class="form-group">
								<label for="SelectSession">شماره نشست</label>
								<div class="input-group">
									<div id="SessionSelector2">
										<select name='session'></select>
									</div>									
								</div>
							</div>
							<div class="form-group">
								<label for="SelectMentor">مربی نشست</label>
								<div class="input-group">
									<div id="MentorSelector">
										<select name='mentor'></select>
									</div>									
								</div>
							</div> 

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت اطلاعات" 
							   onclick="return regformhash(this.form,
											   this.form.username,
											   this.form.email,
											   this.form.password,
											   this.form.confirmpwd);" /> 
							<input type="button" class="btn btn-info pull-right"
							   value="به روز رسانی" 
							   onclick="showSelelctSession();showSelelctMentor();" /> 							
							<br><br><br>
						</div>
						
					</form>	
				</div>
				<div class="row">
					<form role="form" method="post" name="session_registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong> ثبت نشست جدید</strong></div>

							<div class="form-group">
								<label for="SessionSubject">موضوع نشست/جلسه</label>
								<div class="input-group">
									<input type="text" class="form-control" name="SessionSubject" id="SessionSubjectID" placeholder="اهمیت خانواده" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="SessionPlace">محل نشست/جلسه</label>
								<div class="input-group">
									<input type="text" class="form-control" name="SessionPlace" id="SessionPlaceID" placeholder="آمفی تئاتر دانشگاه صنعتی جندی شاپور دزفول" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="SessionDate">تاریخ نشست/جلسه</label>
								<div class="input-group">
									<input type="text" class="form-control" name="SessionDate" id="datepicker5" placeholder="1394/03/20" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div> 
							<div class="form-group">
								<label for="SessionType">نوع نشست/جلسه</label>
								<div class="input-group">
									<select class="form-control" name="SessionType" size="1" id="SessionTypeID" required>
									  <option value="1">دوره ی مهارتی</option>
									  <option value="2">کارگاه</option>
									  <option value="3">میز تخصصی</option>
									  <option value="4">هم اندیشی</option>
									  <option value="5">دوره ی معرفت افزایی</option>
									  <option value="6">کرسی آزاد اندیشی</option>
									</select>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="SessionHours">مدت برگزاری</label>
								<div class="input-group">
									<input type="text" class="form-control" name="SessionHours" id="SessionHoursID" placeholder="2" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="SessionReport">صورت جلسه</label>
								<div class="input-group">
									<textarea name="SessionReport" id="SessionReportID" class="form-control" rows="10" required></textarea>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت اطلاعات" 
							   onclick="return regformNewSession(this.form,
											   this.form.SessionSubject,
											   this.form.SessionPlace,
											   this.form.SessionDate,
											   this.form.SessionType,
											   this.form.SessionHours,
											   this.form.SessionReport);" /> 
						</div>
						
					</form>
										
					<form role="form" method="post" name="mentor_registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong> ثبت مربی جدید</strong></div>

							<div class="form-group">
								<label for="MentorName">نام مربی</label>
								<div class="input-group">
									<input type="text" class="form-control" name="MentorName" id="MentorNameID" placeholder="مجتبی" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="MentorFamily">نام خانوادگی مربی</label>
								<div class="input-group">
									<input type="text" class="form-control" name="MentorFamily" id="MentorFamilyID" placeholder="والی پور" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="MentorSex"> جنسیت</label>
								<div class="input-group">
									<select class="form-control" name="MentorSex" size="1" id="MentorSexID" required>
									  <option value="1">مرد</option>
									  <option value="2">زن</option>
									</select>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div> 
							<div class="form-group">
								<label for="MentorEmail">پست الکترونیکی</label>
								<div class="input-group">
									<input type="email" class="form-control" name="MentorEmail" id="MentorEmailID" placeholder="vpcom@cyberhands.org" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="MentorMobileNo">شماره موبایل</label>
								<div class="input-group">
									<input type="text" class="form-control" name="MentorMobileNo" id="MentorMobileNoID" placeholder="09160003400" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="MentorAddress">آدرس منزل</label>
								<div class="input-group">
									<textarea name="MentorAddress" id="MentorAddressID" class="form-control" rows="5" required></textarea>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت اطلاعات" 
							   onclick="return regformNewMentor(this.form,
											   this.form.MentorName,
											   this.form.MentorFamily,
											   this.form.MentorSex,
											   this.form.MentorEmail,
											   this.form.MentorMobileNo,
											   this.form.MentorAddress);" /> 
						</div>
						
					</form>
					

				</div>
				
				<div class="row">			
					<form role="form" method="post" name="faculty_registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6 col-sm-6 col-sm-push-2 col-lg-push-1 ">
							<br>
							<div class="well well-sm"><strong> ثبت مشخصات استاد جدید - شرکت کننده در نشست</strong></div>
							<div class="form-group">
								<label for="InputName">نام</label>
								<div class="input-group">
									<input type="text" class="form-control" name="FacultyName" id="FacultyNameID" placeholder="مجتبی" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">نام خانوادگی</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyFamilyID" name="FacultyFamily" placeholder="والی پور" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">گروه آموزشی</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyGroupID" name="FacultyGroup" placeholder="کامپیوتر" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div> 
							<div class="form-group">
								<label for="InputEmail">کد ملی</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyNSNID" name="FacultyNSN" placeholder="199000000" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">رشته تحصیلی</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyMajorID" name="FacultyMajor" placeholder="مهندسی کامپیوتر" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">تلفن همراه</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyMobileNoID" name="FacultyMobileNo" placeholder="09160003400" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">مرتبه علمی</label>
								<div class="input-group">
									<input type="text" class="form-control" id="FacultyGradeID" name="FacultyGrade" placeholder="استاد تمام" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">پست الکترونیکی</label>
								<div class="input-group">
									<input type="email" class="form-control" id="FacultyEmailID" name="FacultyEmail" placeholder="vpcom@cyberhands.org" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">آدرس سکونت</label>
								<div class="input-group">
									<textarea name="FacultyAddress" id="FacultyAddressID" class="form-control" rows="5" required></textarea>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت اطلاعات" 
							   onclick="return regformNewFaculty(this.form,
											   this.form.FacultyName,
											   this.form.FacultyFamily,
											   this.form.FacultyGroup,
											   this.form.FacultyNSN,
											   this.form.FacultyMajor,
											   this.form.FacultyMobileNo,
											   this.form.FacultyGrade,
											   this.form.FacultyEmail,
											   this.form.FacultyAddress);" /> 
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
	