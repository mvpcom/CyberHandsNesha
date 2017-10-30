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
 include_once '../includes/db_connect.php';
 include_once '../includes/CHN-config.php';

 $error_msg="";
 echo "BAD THINGS";
 if (isset($_POST['SessionSubject'], $_POST['SessionPlace'], $_POST['GD'], $_POST['SessionType'], $_POST['SessionHours'], $_POST['SessionReport'], $_POST['SessionSID'])) {
    // Sanitize and validate the data passed in
    $SessionSubject = filter_input(INPUT_POST, 'SessionSubject', FILTER_SANITIZE_STRING);
    $SessionPlace = filter_input(INPUT_POST, 'SessionPlace', FILTER_SANITIZE_STRING);
    $SessionDate = filter_input(INPUT_POST, 'GD', FILTER_SANITIZE_MAGIC_QUOTES);
    $SessionType = filter_input(INPUT_POST, 'SessionType', FILTER_SANITIZE_NUMBER_INT);
    $SessionHours = filter_input(INPUT_POST, 'SessionHours', FILTER_SANITIZE_NUMBER_INT);
    $SessionReport = filter_input(INPUT_POST, 'SessionReport', FILTER_SANITIZE_STRING);
	$SessionSID = filter_input(INPUT_POST, 'SessionSID', FILTER_SANITIZE_NUMBER_INT);

		
    $SessionType = filter_var($SessionType, FILTER_VALIDATE_INT);
    $SessionHours = filter_var($SessionHours, FILTER_VALIDATE_INT);
    $SessionSID = filter_var($SessionSID, FILTER_VALIDATE_INT);
	
    if (!filter_var($SessionType, FILTER_VALIDATE_INT)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>در نوع نشست ورودی غیرمجاز مشاهده شده است، لطفا به درستی اقدام کنید!</strong>
							</div>';
    }
     if (!filter_var($SessionHours, FILTER_VALIDATE_INT)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>در مدت برگزاری ورودی غیر مجاز مشاهده شده است. لطفا از راه صحیح اقدام کنید!</strong>
							</div>';
    }     
	if (!filter_var($SessionSID, FILTER_VALIDATE_INT)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>متاسفانه به درستی عمل نکرده اید، لطفا دوباره اقدام کنید!</strong>
							</div>';
    }
 
 
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
			if ($update_stmt = $mysqli->prepare("UPDATE `session` SET `Date`=?,`Subject`=?,`Hours`=?,`Place`=?,`Type`=?,`Report`=? WHERE SID=?")) {
				$update_stmt->bind_param('sssssss', $SessionDate, $SessionSubject, $SessionHours, $SessionPlace, $SessionType, $SessionReport,$SessionSID);
				// Execute the prepared query.
				if (! $update_stmt->execute()) {
					//header('Location: ../error.php?err=Registration failure: INSERT');
					echo "				
								<div class='alert alert-danger'>
									<span class='glyphicon glyphicon-remove'></span><strong> خطا! لطفا همه ی ورودی ها را چک کنید.</strong>
								</div>

					";
				}
				else{
					echo "
										<div class='alert alert-success'>
											<strong><span class='glyphicon glyphicon-ok'></span>نشست/جلسه با موفقیت به روز رسانی شد!</strong>
										</div>
					";	
				}
				$update_stmt->close();	
			}	
}

//Register into Mentor 
if (isset($_POST['MentorName'], $_POST['MentorFamily'], $_POST['MentorSex'], $_POST['MentorEmail'], $_POST['MentorMobileNo'], $_POST['MentorAddressID'])) {
    // Sanitize and validate the data passed in
    $MentorName = filter_input(INPUT_POST, 'MentorName', FILTER_SANITIZE_STRING);
    $MentorFamily = filter_input(INPUT_POST, 'MentorFamily', FILTER_SANITIZE_STRING);
    $MentorSex = filter_input(INPUT_POST, 'MentorSex', FILTER_SANITIZE_MAGIC_QUOTES);
    $MentorEmail = filter_input(INPUT_POST, 'MentorEmail', FILTER_SANITIZE_EMAIL);
    $MentorMobileNo = filter_input(INPUT_POST, 'MentorMobileNo', FILTER_SANITIZE_STRING);
    $MentorAddressID = filter_input(INPUT_POST, 'MentorAddressID', FILTER_SANITIZE_STRING);
		
		
    $MentorEmail = filter_var($MentorEmail, FILTER_VALIDATE_EMAIL);
	
    if (!filter_var($MentorEmail, FILTER_VALIDATE_EMAIL)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>در ایمیل ورودی غیر مجاز وجود دارد، لطفا دوباره تلاش کنید!</strong>
							</div>';
    }
 
  
 
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT MID FROM mentor WHERE FName = ? AND LName= ? AND Sex= ?  LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing mentor   
    if ($stmt) {
        $stmt->bind_param('sss', $MentorName, $MentorFamily, $MentorSex);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this Session Parameters already exists
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>شما قبلا این مربی را ثبت کرده اید!</strong>
							</div>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
  
    if (empty($error_msg)) {
        // Insert the new user into the database 
		//$SessionDate=;
		
		
        if ($insert_stmt = $mysqli->prepare("INSERT INTO mentor (FName, LName, Sex, Email, Mobile_No, Address) VALUES (?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssss', $MentorName, $MentorFamily, $MentorSex, $MentorEmail, $MentorMobileNo, $MentorAddressID);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
				echo "				
							<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-remove'></span><strong> خطا! لطفا همه ی ورودی ها را چک کنید.</strong>
							</div>

				";
            }
        }
		echo "
							<div class='alert alert-success'>
								<strong><span class='glyphicon glyphicon-ok'></span>مربی جدید با موفقی ثبت شد!</strong>
							</div>
		";
/* 		echo "
							<div class='alert alert-success'>
								<strong><span class='glyphicon glyphicon-ok'></span> شما به زودی به صفحه ی ورود منتقل می شوید!</strong>
							</div>
		"; */
		//header('Refresh: 3; URL=login.php');
    }
	else{
		echo $error_msg;
	}
}

//Register into Faculty 
if (isset($_POST['FacultyName'], $_POST['FacultyFamily'], $_POST['FacultyGroup'], $_POST['FacultyNSN'], $_POST['FacultyMajor'], $_POST['FacultyMobileNo'], $_POST['FacultyGrade'], $_POST['FacultyEmail'], $_POST['FacultyAddress'])) {
    // Sanitize and validate the data passed in
    $FacultyName = filter_input(INPUT_POST, 'FacultyName', FILTER_SANITIZE_STRING);
    $FacultyFamily = filter_input(INPUT_POST, 'FacultyFamily', FILTER_SANITIZE_STRING);
    $FacultyGroup = filter_input(INPUT_POST, 'FacultyGroup', FILTER_SANITIZE_STRING);
    $FacultyNSN = filter_input(INPUT_POST, 'FacultyNSN', FILTER_SANITIZE_NUMBER_INT);
    $FacultyMajor = filter_input(INPUT_POST, 'FacultyMajor', FILTER_SANITIZE_STRING);
    $FacultyMobileNo = filter_input(INPUT_POST, 'FacultyMobileNo', FILTER_SANITIZE_MAGIC_QUOTES);
    $FacultyGrade = filter_input(INPUT_POST, 'FacultyGrade', FILTER_SANITIZE_STRING);
    $FacultyEmail = filter_input(INPUT_POST, 'FacultyEmail', FILTER_SANITIZE_EMAIL);
    $FacultyAddress = filter_input(INPUT_POST, 'FacultyAddress', FILTER_SANITIZE_STRING);
		
		
    $FacultyEmail = filter_var($FacultyEmail, FILTER_VALIDATE_EMAIL);
	
    if (!filter_var($FacultyEmail, FILTER_VALIDATE_EMAIL)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>در ایمیل ورودی غیر مجاز وجود دارد، لطفا دوباره تلاش کنید!</strong>
							</div>';
    }
 
  
 
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT FID FROM faculty WHERE FName = ? AND LName= ? AND NSN= ?  LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing mentor   
    if ($stmt) {
        $stmt->bind_param('sss', $FacultyName, $FacultyFamily, $FacultyNSN);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this Session Parameters already exists
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>شما قبلا این شرکت کنند را ثبت کرده اید!</strong>
							</div>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
  
    if (empty($error_msg)) {
        // Insert the new user into the database 
		//$SessionDate=;
        if ($insert_stmt = $mysqli->prepare("INSERT INTO faculty (FName, LName, NSN, FGroup, Address, Email, Major, Mobile_No, Grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssssssss', $FacultyName, $FacultyFamily, $FacultyNSN, $FacultyGroup, $FacultyAddress, $FacultyEmail, $FacultyMajor, $FacultyMobileNo, $FacultyGrade);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
				echo "				
							<div class='alert alert-danger'>
								<span class='glyphicon glyphicon-remove'></span><strong> خطا! لطفا همه ی ورودی ها را چک کنید.</strong>
							</div>

				";
            }
        }
		echo "
							<div class='alert alert-success'>
								<strong><span class='glyphicon glyphicon-ok'></span>شرکت کننده جدید با موفقیت ثبت شد!</strong>
							</div>
		";
/* 		echo "
							<div class='alert alert-success'>
								<strong><span class='glyphicon glyphicon-ok'></span> شما به زودی به صفحه ی ورود منتقل می شوید!</strong>
							</div>
		"; */
		//header('Refresh: 3; URL=login.php');
    }
	else{
		echo $error_msg;
	}
}