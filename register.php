<!-- 
Design & Programming by Mojtaba Valipour @ CyberHands.org 
E-mail: vpcom_(at)_cyberhands_(.)_org  (Delete Underline & Parenthesis )
Dezful Jundi Shapur University of Technology (www.jsu.ac.ir)
Acknowledgement:
  -Bootstrap
  -@mdo
  -w3schools
  -peredur.net
  -Ajax
  -Roozbeh Baabakaan gregorian_jalali 1 2012
  -CyberHands
  -Jundi Shapur University of Technology
-->
<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="Jundi Shapur University of Technology Mentors Session Organization and Reporting System">
    <meta name="author" content="Mojtaba Valipour @ CyberHands.org">
    <link rel="icon" href="assets/favicon.ico">

    <title>ثبت نام در سامانه نشا - سایبرهندس</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="assets/js/ie-emulation-modes-warning.js"></script>

	<!-- Persian Fonts - Online CSS Provider B Araz id=1723 | P Nazanin Bold 1806 -->
	<link rel='stylesheet' type='text/css' href='http://awebfont.ir/css?id=1723|1806'>
	<style>
      .CyberHands_Header_Font_Style {
        font-family: 'B Araz', Tahoma, Arial;
      }
	  body {
        font-family: 'B Nazanin', Tahoma, Arial;
      }
	</style>
	<script type="text/JavaScript" src="assets/js/sha512.js"></script> 
    <script type="text/JavaScript" src="assets/js/forms.js"></script>  
	  

    <!-- HTML5 sh
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
		<div class="container">

			<div class="page-header">
				<h1>فرم ثبت نام <small>سیستم گزارش گیری و ساماندهی جلسات و نشست اساتید (نشا) سایبرهندس</small></h1>
				<h5>        
					<ul>
						<li>نام کاربری فقط می تواند شامل  اعداد، حروف بزرگ و کوچک و به زبان انگلیسی باشد.</li>
						<li>ایمیل باید داری ساختار مناسب باشد.</li>
						<li>رمز عبور باید حداقل 6 کاراکتر باشد.</li>
						<li>رمز عبور باید شامل
							<ul>
								<li>حداقل یک حرف بزرگ (A..Z)</li>
								<li>حداقل یک حرف کوچک (a..z)</li>
								<li>و حداقل یک عدد باشد. (0..9)</li>
							</ul>
						</li>
						<li>رمز عبور و تاییدیه رمز عبور باید دقیقا یکسان باشند.</li>
					</ul>
				</h5>
			</div>
			<!-- Registration form - START -->
			<div class="container">
				<div class="row">
					<div id="MessagePlace" class="col-lg-5">

					</div>
					<form role="form" method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
						<div class="col-lg-6  col-md-push-1">
							<div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk" style="color:red;"></span> فیلد ضروری </strong></div>
							<div class="form-group">
								<label for="InputName">نام کاربری خود را انتخاب کنید:</label>
								<div class="input-group">
									<input type="text" class="form-control" name="username" id="InputName" placeholder="Example" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">ایمیل تان را در اینجا وارد کنید:</label>
								<div class="input-group">
									<input type="email" class="form-control" id="InputEmail" name="email" placeholder="Example@cyberhands.org" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>
							<div class="form-group">
								<label for="InputEmail">رمز عبور خود را انتخاب کنید:</label>
								<div class="input-group">
									<input type="password" class="form-control" id="inputPassword" name="password" placeholder="رمز عبور" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div> 
							<div class="form-group">
								<label for="InputEmail">رمز عبور خود را جهت اطمینان دوباره وارد کنید:</label>
								<div class="input-group">
									<input type="password" class="form-control" id="inputPasswordConfirm" name="confirmpwd" placeholder="تایید رمز عبور" required>
									<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
								</div>
							</div>

							<input type="button" class="btn btn-info pull-right"
							   value="ثبت نام" 
							   onclick="return regformhash(this.form,
											   this.form.username,
											   this.form.email,
											   this.form.password,
											   this.form.confirmpwd);" /> 
						</div>
						
					</form>

				</div>
				<br><br>
				<p>بازگشت به صفحه ی  <a href="login.php">ورود </a>به سیستم نشا.</p>
			</div>
			<!-- Registration form - END -->

		</div>



    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
