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
 
 // select box open tag
$selectBoxOpen =  "<select name='session'>"; 
// select box close tag
$selectBoxClose =  "</select>";
// select box option tag
$selectBoxOption = ''; 
$prep_stmt = "SELECT * FROM session";
$stmt = $mysqli->prepare($prep_stmt);
if ($stmt) {
	// fire mysql query
	$stmt->execute();
	// play with return result array 
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
        // use your $myrow array as you would with any other fetch
		$dateGeorgArray=explode("-",$row['Date']);
		$dateJalali= gregorian_to_jalali($dateGeorgArray[0], $dateGeorgArray[1], $dateGeorgArray[2],1);
		$selectBoxOption .="<option value = '".$row['SID']."'>".$row['Subject']." - ".$row['Place']."-".$dateJalali."</option>";
    }
	$stmt->close();
}		
// create select box tag with mysql result
$selectBox_session =  $selectBoxOpen.$selectBoxOption.$selectBoxClose;   
echo $selectBox_session;
//----------------------------------------------------------------------------------------------