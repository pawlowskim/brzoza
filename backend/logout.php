<?php
session_start();
$conn = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("bai4",$conn);
mysql_query("update users set last_success = '".$_SESSION["loginDate"]."', failed = 0 where name='" . $_SESSION["name"] . "'");
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["loginDate"]);
header("Location: ../index.php");
?>