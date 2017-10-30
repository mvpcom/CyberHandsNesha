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
 // --> include_once '../includes/db_connect.php';
 include_once '../includes/CHN-config.php';
 include_once '../includes/functions.php';
  
 $error_msg="";

// create select box tag with mysql result

//----------------------------------------------------------------------------------------------


 if (isset($_POST['Selector'])) {
    // Sanitize and validate the data passed in
    $Selector = filter_input(INPUT_POST, 'Selector', FILTER_SANITIZE_NUMBER_INT);
	
		
    $Selector = filter_var($Selector, FILTER_VALIDATE_INT);
	
    if (!filter_var($Selector, FILTER_VALIDATE_INT)) {
        // Not a valid Integer
				$error_msg .='				
							<div class="alert alert-danger">
								<span class="glyphicon glyphicon-remove"></span><strong>متاسفانه ورودی غیر مجاز مشاهده شده است، لطفا دوباره از راه صحیح اقدام کنید!</strong>
							</div>';
    }
 
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
	
	$Conditions= $Selector;
	$prep_stmt = "SELECT * FROM session WHERE SID = ? LIMIT 1";
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
			// play with return result array 
			//$stmt->store_result();
			$result = $stmt->get_result();
		    if ($row = $result->fetch_assoc()) {
				$dateGeorgArray=explode("-",$row['Date']);
				$dateJalali= gregorian_to_jalali($dateGeorgArray[0], $dateGeorgArray[1], $dateGeorgArray[2],1);
				
				echo '
								<div class="form-group">
									<label for="SessionSubject">موضوع نشست/جلسه</label>
									<div class="input-group">
										<input type="text" class="form-control" name="SessionSubject" id="SessionSubjectID" placeholder="اهمیت خانواده" value="'. $row['Subject'] .'" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="SessionPlace">محل نشست/جلسه</label>
									<div class="input-group">
										<input type="text" class="form-control" name="SessionPlace" id="SessionPlaceID" placeholder="آمفی تئاتر دانشگاه صنعتی جندی شاپور دزفول" value="'. $row['Place'] .'" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="SessionDate">تاریخ نشست/جلسه</label>
									<div class="input-group">
										<input type="text" class="form-control" name="SessionDate" id="datepicker5" placeholder="1394/03/20" value="'. $dateJalali .'" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div> 
								<div class="form-group">
									<label for="SessionType">نوع نشست/جلسه</label>
									<div class="input-group">
										<select class="form-control" name="SessionType" size="1" id="SessionTypeID" required>
										  <option value="1"'.($row['Type']=="1"? ' selected' : '').'>دوره ی مهارتی</option>
										  <option value="2"'.($row['Type']=="2"? ' selected' : '').'>کارگاه</option>
										  <option value="3"'.($row['Type']=="3"? ' selected' : '').'>میز تخصصی</option>
										  <option value="4"'.($row['Type']=="4"? ' selected' : '').'>هم اندیشی</option>
										  <option value="5"'.($row['Type']=="5"? ' selected' : '').'>دوره ی معرفت افزایی</option>
										  <option value="6"'.($row['Type']=="6"? ' selected' : '').'>کرسی آزاد اندیشی</option>
										</select>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="SessionHours">مدت برگزاری</label>
									<div class="input-group">
										<input type="text" class="form-control" name="SessionHours" id="SessionHoursID" placeholder="2" value="'. $row['Hours'] .'" required>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div>
								<div class="form-group">
									<label for="SessionReport">صورت جلسه</label>
									<div class="input-group">
										<textarea name="SessionReport" id="SessionReportID" class="form-control" rows="10" required>'. $row['Report'] .'</textarea>
										<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk" style="color:red;"></span></span>
									</div>
								</div>				
				';
				
				
				
			}
			else {
					$error_msg .= '<p class="error">Database error Line 62</p>';
			}			
			// echo "
								// <div class='alert alert-success'>
									// <strong><span class='glyphicon glyphicon-ok'></span>اطلاعات مربوط به داده ی انتخابی با موفقیت در فیلدهای زیر درج شد. حال می توانید تغییرات لازم را اعمال نمایید.</strong>
								// </div>
			// ";		
		}			
		$stmt->close();
	}else {
        $error_msg .= '<p class="error">Database error Line 75</p>';
                $stmt->close();
    }	
}
