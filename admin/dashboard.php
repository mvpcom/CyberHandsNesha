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
//Session_start();
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
sec_session_start();
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
    <link rel="icon" href="../assets/favicon.ico">

    <title>پیشخوان مدیریت سیستم نشا-سایبرهندس</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.Edit.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>
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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	<?php if (login_check($mysqli) == true) : ?>
		<div >			
			<a href="#menu-toggle" id="menu-toggle" >&nbsp &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspنمایش/مخفی کردن منو</a>
		</div>

		<nav class="navbar navbar-inverse navbar-fixed-top">
		
		  <div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">نمایش منو</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  


			  <a class="navbar-brand" href="#">سامانه نشست اساتید (نشا) - سایبرهندس</a>
			</div>
			
			<div id="navbar" class="navbar-collapse collapse">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="#">پیشخوان</a></li>
				<li><a href="#">تنظیمات</a></li>
				<li><a href="#">صفحه ی کاربری</a></li>
				<li><a href="#">کمک می خوای؟</a></li>

			  </ul>

			</div>
		  </div>
		</nav>
	
		<div class="container-fluid">
		    <div class="row">
				<div id="wrapper">
					  <div id="sidebar-wrapper">
						<div class="navbar-collapse">
							<div class="col-sm-3 col-md-2 sidebar">
							  <ul class="nav nav-sidebar">
								<li id="nav1" class="active"><a href="#Preface" onclick="$('#page-content-wrapper').html('<img src=Images/loading.gif>').load('preface.php').hide().fadeIn('slow');$('#nav1').addClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">پیش گفتار <span class="sr-only">(current)</span></a></li>
								<li id="nav2"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').addClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">گزارش</a></li>
								<li id="nav3"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').addClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">اطلاعات آماری</a></li>
								<li id="nav4"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').addClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">چاپ گواهی</a></li>
							  </ul>
							  <ul class="nav nav-sidebar">
								<li id="nav5"><a href="#Insert" onclick="$('#page-content-wrapper').html('<img src=Images/loading.gif>').load('insert.php').hide().fadeIn('slow');$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').addClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">درج</a></li>
								<li id="nav6"><a href="#" onclick="$('#page-content-wrapper').html('<img src=Images/loading.gif>').load('delete.php').hide().fadeIn('slow');$('#nav1').removeClass('active');$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').addClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">حذف</a></li>
								<li id="nav7"><a href="#" onclick="$('#page-content-wrapper').html('<img src=Images/loading.gif>').load('update.php').hide().fadeIn('slow');$('#nav1').removeClass('active');$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').addClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">به روز رسانی</a></li>
								<li id="nav8"><a href="#" onclick="$('#page-content-wrapper').html('<img src=Images/loading.gif>').load('search.php').hide().fadeIn('slow');$('#nav1').removeClass('active');$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').addClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">جستجو</a></li>
					
							  </ul>
							  <ul class="nav nav-sidebar">
								<li id="nav9"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').addClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">تنظیمات</a></li>
								<li id="nav10"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').addClass('active');$('#nav11').removeClass('active');$('#nav12').removeClass('active');">تغییر رمز کاربری</a></li>
								<li id="nav11"><a href="#" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').addClass('active');$('#nav12').removeClass('active');">درباره ما</a></li>
								<li id="Exitnav12"><a href="../includes/logout.php" onclick="$('#nav1').removeClass('active');$('#nav2').removeClass('active');$('#nav3').removeClass('active');$('#nav4').removeClass('active');$('#nav5').removeClass('active');$('#nav6').removeClass('active');$('#nav7').removeClass('active');$('#nav8').removeClass('active');$('#nav9').removeClass('active');$('#nav10').removeClass('active');$('#nav11').removeClass('active');$('#nav12').addClass('active');">خروج</a></li>
							  </ul>
							</div>
						</div>
					  </div>
				 
					<div id="page-content-wrapper">
					  	<div class="col-sm-6 col-md-10  ">

						  <h1 class="page-header">پیش گفتار</h1>
						  <h4 class="sub-header">سیستم نشا - سایبرهندس جهت افزایش رفاه اعضای هیئت علمی دانشگاه صنعتی جندی شاپور توسعه پیدا کرده است. این سیستم توانایی مدیریت اطلاعات 
						  ورودی و ذخیره ایمن اطلاعات مربوط به جلسات و نشست های اساتید را ممکن می سازد. مدیر اطلاعات را در سیستم ذخیره می کند و استاد و یا شرکت کننده به آسانی گواهی
						  خود را دریافت می کند.</h4>
						</div>	
			
					</div> 

				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script-->
		<script src="../assets/js/jquery.min.js"></script>
		
		<script src="../assets/js/bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<script src="../assets/js/holder.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
		
			<!-- Menu Toggle Script -->
		<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
		</script>
	<?php else : ?>
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>شما مجوز دسترسی به این صفحه را ندارید. به درستی وارد شوید!</strong>
							</div>
							<div class='alert alert-success'>
								<strong><span class='glyphicon glyphicon-ok'></span> شما به زودی به صفحه ی ورود منتقل می شوید!</strong>
							</div>
		<?php
			header('Refresh: 4; URL=../login.php');
		?>
    <?php endif; ?>
    
  </body>
  
</html>
