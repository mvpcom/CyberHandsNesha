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
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'شما الان به سیستم وارد شده اید';
} else {
    $logged = 'شما هنوز به سیستم وارد نشده اید';
}
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

    <title>ورود به سامانه نشا - سایبرهندس</title>

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
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?> 
    <div class="container">
      <form class="form-signin" method="post" action="includes/process_login.php">
        <h2 class="form-signin-heading">لطفا اطلاعات زیر را وارد کنید </h2>
        <label for="inputEmail" class="sr-only">ایمیل</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="ایمیل" required autofocus>
        <label for="inputPassword" class="sr-only">رمز عبور</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="رمز عبور" required>
        <div class="checkbox">
          <label>
            <input name="Check" type="checkbox" value="remember-me"> &nbsp&nbsp&nbsp&nbsp مرا به خاطر بسپار&nbsp&nbsp
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="button" 
                   onclick="formhash(this.form, this.form.password);">وارد شوید</button>
				   <br>
				   نکات ضروری:
				   						   <br>
         <?php echo $logged ?>.
				   				   <br>
		اگر قبلا ثبت نام نکردید، پس  <a href="register.php">ثبت نام</a>کنید. 
						   <br>
        پس از انجام کار، لطفا از سیستم <a href="includes/logout.php">خارج</a>شوید.

      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
