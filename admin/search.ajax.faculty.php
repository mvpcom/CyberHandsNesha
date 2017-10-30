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

//----------------------------------------------------------------------------------------------


 if (isset($_POST['searchbox'])) {
    // Sanitize and validate the data passed in
    $searchbox = filter_input(INPUT_POST, 'searchbox', FILTER_SANITIZE_STRING);	
    $searchbox = filter_var($searchbox, FILTER_VALIDATE_INT);
	
    // All input validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
	
	$searchKEY="%{$_POST['searchbox']}%";
	//$keyword= $searchbox;
	$prep_stmt = "SELECT * FROM faculty where FName like  ? OR LName like  ? OR FGroup like ? OR Major like ?";
	$stmt = $mysqli->prepare($prep_stmt);
	 if ($stmt && empty($error_msg)) {
		// play with return result array 
		$stmt->bind_param('ssss', $searchKEY,$searchKEY,$searchKEY,$searchKEY);
		if (! $stmt->execute()) {
			echo "				
				<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-remove'></span><strong> عملیات جستجو با خطا روبرو شد، لطفا دوباره اقدام کنید!</strong>
				</div>
			";
		}
		else{
			// play with return result array 
			$result = $stmt->get_result();

			
			echo "<table class='table table-striped'>
		<thead>
			<tr>
			<th style='text-align: center;'>نام</th>
			<th style='text-align: center;'>نام خانوادگی</th>
			<th style='text-align: center;'>کد ملی</th>
			<th style='text-align: center;'>گروه آموزشی</th>
			<th style='text-align: center;'>ایمیل</th>
			<th style='text-align: center;'>رشته</th>
			<th style='text-align: center;'>مرتبه ی آموزشی</th>
			<th style='text-align: center;'>شماره موبایل</th>
			</tr> 		
		</thead> 
		<tbody>";

			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td style='text-align: center;'>" . $row['FName'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['LName'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['NSN'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['FGroup'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['Email'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['Major'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['Grade'] . "</td>";
				echo "<td style='text-align: center;'>" . $row['Mobile_No'] . "</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";
			
			
			// echo "
								// <div class='alert alert-success'>
									// <strong><span class='glyphicon glyphicon-ok'></span>عملیات جستجو با موفقیت انجام شد، نشا یعنی این.</strong>
								// </div>
			// ";		
		}			
		$stmt->close();
	}else {
        $error_msg .= 
		" <div class='alert alert-success'>
								 <strong><span class='glyphicon glyphicon-ok'></span>وای جستجو با خطا روبرو شد!</strong>
								 </div>";
		echo  $error_msg;
    }	
}
