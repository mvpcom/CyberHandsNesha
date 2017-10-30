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

					  	<div class="col-sm-6 col-md-10">

						  <h1 class="page-header">پیش گفتار</h1>
						  <h4 class="sub-header">سیستم نشا - سایبرهندس جهت افزایش رفاه اعضای هیئت علمی دانشگاه صنعتی جندی شاپور توسعه پیدا کرده است. این سیستم توانایی مدیریت اطلاعات 
						  ورودی و ذخیره ایمن اطلاعات مربوط به جلسات و نشست های اساتید را ممکن می سازد. مدیر اطلاعات را در سیستم ذخیره می کند و استاد و یا شرکت کننده به آسانی گواهی
						  خود را دریافت می کند.</h4>
						</div>	
			
<?php
	else : ?>
		<div class="alert alert-danger">
			<span class="glyphicon glyphicon-remove"></span><strong>شما مجوز دسترسی به این صفحه را ندارید. به درستی وارد شوید!</strong>
		</div>
		<div class="alert alert-success">
			<strong><span class="glyphicon glyphicon-ok"></span> شما به زودی به صفحه ی ورود منتقل می شوید!</strong>
		</div>
	<?php endif;?>
	