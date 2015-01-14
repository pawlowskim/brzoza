<?php
session_start();
$message="";
$created_date = date("Y-m-d H:i:s");

function checkTime($lastFailedTime, $failedAttempts){
$dateNow = strtotime(date("Y-m-d H:i:s"));
$dateLastFailed = strtotime($lastFailedTime);
$diff = abs($dateNow - $dateLastFailed);
$sleep = $failedAttempts * 4;
	if ($diff >= $sleep){
		return 0;
	} else {
		return $sleep - $diff;
	}
}

if(count($_GET)>0) {
	$conn = mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("bai4",$conn);
	$result = mysql_query("SELECT * FROM users WHERE name='" . $_GET["userName"] . "' and pass = '". $_GET["password"]."'");
	$row  = mysql_fetch_array($result);
	if(is_array($row) && $row["state"] == 1 && checkTime($row["last_failed"], $row["failed"]) == 0) {
		$_SESSION["id"] = $row[id];
		$_SESSION["name"] = $row[name];
		$_SESSION["id"] = $row[id];
		$_SESSION["loginDate"] = $created_date;
		//mysql_query("update users set last_success = '".$created_date."', failed = 0 where name='" . $_GET["userName"] . "'");
	} else if(is_array($row) && $row["state"] == 0){ 
		$message = "Twoje konto jest zablokowane. Skontaktuj się z administratorem.";
	} else if(is_array($row) && $row["state"] == 1 && checkTime($row["last_failed"], $row["failed"]) != 0) {
		$sec = checkTime($row["last_failed"], $row["failed"]);
		$message = "Twoje konto jest obecnie niedostępne. Spróbuj ponowić logowanie za "
		.$sec." sec";
	} else {
		$result2 = mysql_query("SELECT * FROM users WHERE name='".$_GET["userName"]."'");
		$row2  = mysql_fetch_array($result2);
		if(is_array($row2) && $row2["login_mode"] == 0 && checkTime($row2["last_failed"], $row2["failed"]) == 0) {
			$failedDate = $created_date;
			$sec = checkTime($failedDate, $row2["failed"]+1);
			mysql_query("update users set failed = failed + 1, last_failed = '".$failedDate."' WHERE name='".$_GET["userName"]."'");
			$message = "Podano nieprawidłowy login lub hasło!! Spróbuj ponownie za ".$sec." sec";
		} else if(is_array($row2) && $row2["login_mode"] == 0 && checkTime($row2["last_failed"], $row2["failed"]) != 0) {
			$sec = checkTime($row2["last_failed"], $row2["failed"]);
			$message = "Twoje konto jest obecnie niedostępne. Spróbuj ponowić logowanie za "
			.$sec." sec"; 
		} else if(is_array($row2) && $row2["login_mode"] == 1 && $row2["state"] == 1 && checkTime($row2["last_failed"], $row2["failed"]) == 0){
			$failedDate = $created_date;
			mysql_query("update users set failed = failed + 1, last_failed = '".$failedDate."' WHERE name='".$_GET["userName"]."'");
			$attempts_left = ($row2["attempts"] - $row2["failed"])-1;
				if($attempts_left !=0){
					$sec = checkTime($failedDate, $row2["failed"]+1);
					$message = "Podano nieprawidłowy login lub hasło!! pozostało Ci ".$attempts_left." logowan. Spróbuj ponownie za ".$sec." sec";
				} else {
					mysql_query("update users set state = 0, failed = failed where name ='".$_GET["userName"]."'");
					$message = "Twoje konto zostało zablokowane. Skontaktuj się z administratorem.";				
				}			
		} else if(is_array($row2) && $row2["login_mode"] == 1 && $row2["state"] == 1 && checkTime($row2["last_failed"], $row2["failed"]) !=0){
				$sec = checkTime($row2["last_failed"], $row2["failed"]);
				$message = "Twoje konto jest obecnie niedostępne. Spróbuj ponowić logowanie za ".$sec." sec";	
		} else if(is_array($row2) && $row2["login_mode"] == 1 && $row2["state"] == 0){
			$message = "Twoje konto jest zablokowane. Skontaktuj się z administratorem.";	
		} else if (!is_array($row2)){
			$result3 = mysql_query("SELECT * FROM false_users WHERE name='".$_GET["userName"]."'");
			$row3  = mysql_fetch_array($result3);
			
			if (is_array($row3)){
			$sec1 = checkTime($row3["last_failed"], $row3["failed"]);
				$message = "Twoje konto jest obecnie niedostępne. Spróbuj ponowić logowanie za ".$sec1." sec";
				mysql_query("update false_users set failed = failed+1 where name ='".$_GET["userName"]."'");
			} else if (!is_array($row3)){
				$salt = uniqid(mt_rand(), true);
				mysql_query("insert into false_users (`name`, `pass`, `login_mode`, `failed`, `last_failed`) 
				VALUES ('".$_GET["userName"]."','".$salt."',1 ,1 ,'".$created_date."')");
				$message = "Niepoprawny login lub hasło!!";
			}
		}
	}
}
header("Location: ../index.php?message=".$message);
?>