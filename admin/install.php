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
include_once '../includes/CHN-config.php';

// Create connection
$conn = mysqli_connect(HOST, USER, PASSWORD);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE . " DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);


echo "<br>";
//////////////////////////////////////////////////////

// Create connection
$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE  IF NOT EXISTS `login_attempts` (
    `user_id` INT(11) NOT NULL,
    `time` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "Table contribute created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `contribute` (
  `CSID` int(11) NOT NULL,
  `CFID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "Table contribute created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";


// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `faculty` (
  `FID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FName` varchar(25) NOT NULL,
  `LName` varchar(25) NOT NULL,
  `NSN` varchar(25) NOT NULL,
  `FGroup` varchar(25) DEFAULT NULL,
  `Address` longtext,
  `Email` varchar(30) NOT NULL,
  `Major` varchar(25) DEFAULT NULL,
  `Mobile_No` varchar(25) DEFAULT NULL,
  `Grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Faculty Table keeps Faculty Data';";

if (mysqli_query($conn, $sql)) {
    echo "Table faculty created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `mentor` (
  `MID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `FName` varchar(25) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `Sex` varchar(1) NOT NULL,
  `Email` varchar(28) NOT NULL,
  `Mobile_No` varchar(11) DEFAULT NULL,
  `Address` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "Table mentor created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `session` (
  `SID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Date` date NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Hours` int(3) NOT NULL,
  `Place` varchar(100) NOT NULL,
  `Type` varchar(1) NOT NULL,
  `Report` longtext NOT NULL,
  `Teach` int(11) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "Table session created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `UID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(30) NOT NULL,
   email VARCHAR(50) NOT NULL,
   isAdmin VARCHAR(1)  DEFAULT '0',   
   password CHAR(128) NOT NULL,
   salt CHAR(128) NOT NULL,
   reg_date TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if (mysqli_query($conn, $sql)) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// Indexes for table `contribute`
echo "<br>";
$sql = "ALTER TABLE `contribute`
 ADD KEY `CSID` (`CSID`,`CFID`), ADD KEY `CFID` (`CFID`);";

if (mysqli_query($conn, $sql)) {
    echo "Indexes for table `contribute` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Indexes for table `users`
echo "<br>";
$sql = "ALTER TABLE `users`
 ADD UNIQUE KEY `username` (`username`);";

if (mysqli_query($conn, $sql)) {
    echo "Indexes for table `users` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Constraints for table `contribute`
echo "<br>";
$sql = "ALTER TABLE `contribute`
ADD CONSTRAINT `contribute_ibfk_1` FOREIGN KEY (`CSID`) REFERENCES `session` (`SID`),
ADD CONSTRAINT `contribute_ibfk_2` FOREIGN KEY (`CFID`) REFERENCES `faculty` (`FID`);";

if (mysqli_query($conn, $sql)) {
    echo "Constraints for table `contribute` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Constraints for table `session`
echo "<br>";
$sql = "ALTER TABLE `session`
ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`Teach`) REFERENCES `mentor` (`MID`);";

if (mysqli_query($conn, $sql)) {
    echo "Constraints for table `session` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `mentor`
echo "<br>";
$sql = "ALTER TABLE `mentor` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `mentor` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `session`
echo "<br>";
$sql = "ALTER TABLE `session` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `session` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `contribute`
echo "<br>";
$sql = "ALTER TABLE `contribute` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `contribute` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `faculty`
echo "<br>";
$sql = "ALTER TABLE `faculty` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `faculty` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `login_attempts`
echo "<br>";
$sql = "ALTER TABLE `login_attempts` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `login_attempts` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// DEFAULT CHARSET for table `users`
echo "<br>";
$sql = "ALTER TABLE `users` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;";

if (mysqli_query($conn, $sql)) {
    echo "COLLATE utf8 for table `users` successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

echo "<br>";
$sql = "insert into users(username,email,isAdmin,password,salt) values('vpcom','vpcom@cyberhands.org','1','c36d1b755282428e4fe0d56a94d7546a6b5b77ff70e8c95335c31ff096724ae1bd2d8f27eaecb447082998c5b6f3073d834bd20faf72389b33a22ca474e61147','1f18baad4bd43fc0a0711825f6c8b2976fc942491354f8c036e942bdc74bbf37bef6500985b47e6ec546850afc66a427e18397e4177087235ae4cace3d64d027')";

if (mysqli_query($conn, $sql)) {
   echo "Insert admin user successfully - email:vpcom@cyberhands.org pass:123Aa456";
} else {
   echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
echo "<br>";

?>