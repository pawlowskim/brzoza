<?php
session_start();
$message="";
if(count($_POST)>0) {
	$conn = mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("bai",$conn);
	$result = mysql_query("SELECT * FROM users WHERE name='" . $_POST["userName"] . "' and pass = '". $_POST["password"]."'");
	$row  = mysql_fetch_array($result);
	if(is_array($row)) {
		$_SESSION["id"] = $row[id];
		$_SESSION["name"] = $row[name];
	} else {
	 $message = "Invalid Username or Password!";
	}
}
header("Location: ../index.php?message=".$message);
?>