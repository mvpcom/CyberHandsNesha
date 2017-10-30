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
 
//mentor Select Options 
//----------------------------------------------------------------------------------------------
// select box open tag
$selectBoxOpen =  "<select name='mentor'>"; 
// select box close tag
$selectBoxClose =  "</select>";
// select box option tag
$selectBoxOption = ''; 
$prep_stmt = "SELECT * FROM mentor";
$stmt = $mysqli->prepare($prep_stmt);
if ($stmt) {
	// fire mysql query
	$stmt->execute();
	// play with return result array 
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
        // use your $myrow array as you would with any other fetch
        //printf("%s is in district %s\n", $city, $myrow['district']);
		//$dateJalali= dateGeorg.getJalaliDate();
		$selectBoxOption .="<option value = '".$row['MID']."'>".$row['FName']." ".$row['LName']."-".$row['Email']."</option>";
    }
	$stmt->close();
}		
// create select box tag with mysql result
$selectBox_mentor =  $selectBoxOpen.$selectBoxOption.$selectBoxClose;   
//----------------------------------------------------------------------------------------------
echo $selectBox_mentor;
//----------------------------------------------------------------------------------------------