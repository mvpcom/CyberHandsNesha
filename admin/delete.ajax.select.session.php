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
 include_once '../includes/functions.php';
  
 $error_msg="";

// create select box tag with mysql result

//----------------------------------------------------------------------------------------------


 if (isset($_POST['SessionSelector'])) {
    // Sanitize and validate the data passed in
    $SessionSelector = filter_input(INPUT_POST, 'SessionSelector', FILTER_SANITIZE_NUMBER_INT);
	
		
    $SessionSelector = filter_var($SessionSelector, FILTER_VALIDATE_INT);
	
    if (!filter_var($SessionSelector, FILTER_VALIDATE_INT)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>در نوع نشست ورودی غیرمجاز مشاهده شده است، لطفا به درستی اقدام کنید!</strong>
							</div>';
    }
 
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
	
	$Conditions= $SessionSelector;
	$prep_stmt = "DELETE FROM session WHERE SID = ?";
	$stmt = $mysqli->prepare($prep_stmt);
	 if ($stmt && empty($error_msg)) {
		// fire mysql query
		//$stmt->execute();
		// play with return result array 
		$stmt->bind_param('s', $Conditions);

		if (! $stmt->execute()) {
			echo "				
				<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-remove'></span><strong> عملیات حذف با مشکل روبرو شد، لطفا دوباره تلاش کنید کنید!</strong>
				</div>
			";
		}
		else{
			echo "
								<div class='alert alert-success'>
									<strong><span class='glyphicon glyphicon-ok'></span>داده ی مورد نظر با موفقیت حذف شد.</strong>
								</div>
			";		
		}			
		$stmt->close();
	}else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }	
}
