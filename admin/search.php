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

	sec_session_start(); // Our custom secure way of starting a PHP session.


	if (login_check($mysqli) == true) : 
?>

	<link type="text/css" href="../assets/css/jquery-ui-1.8.14.css" rel="stylesheet" />
    <script type="text/javascript" src="../assets/js/jquery-1.6.2.min.js"></script>
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
	
	

			

			<!-- Search form - START -->
			<div class="container">
				<div class="row">			
					<form role="form" method="post" name="search_form">
						<div class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
							<br>
							<div class="well well-sm"><strong> متن مورد نظر را جستجو کنید! به همین آسانی </strong></div>
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" name="searchbox" id="searchboxID" onkeyup="CyberHandsSearch(this.form,this.form.searchbox);" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>

							</div>
							<!--input type="button" class="btn btn-info pull-right"
							   value="جستجو کنید" 
							   onclick="return CyberHandsSearch(this.form,
											   this.form.searchbox);" /--> 
						</div>
					</form>
				</div>
				<br>
				<div class="row">
						<div class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong> نشست ها و جلسات مرتبط  با کلمات جستجو شده</strong></div>				
						</div>
						<div id="Session_Search" class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
						</div>
				</div>

				<div class="row">
						<div class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong> شرکت کننده های مرتبط با کلمه ی جستجو شده</strong></div>				
						</div>
						<div id="Faculty_Search" class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
						</div>
				</div>

				<div class="row">
						<div class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
							<div class="well well-sm"><strong>مربی های مرتبط با کلمه ی جستجو شده</strong></div>				
						</div>
						<div id="Mentor_Search" class="col-lg-12 col-sm-12 col-sm-push-1 col-lg-push-1 ">
						</div>
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
	