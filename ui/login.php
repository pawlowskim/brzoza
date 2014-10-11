<?php
if(!isset($_SESSION["name"])){ ?>
<form method="post" action="backend/login.php">
	<div class="message"><?php if(isset($_GET["message"])) { echo $_GET["message"]; } ?></div>
	<table border="0" cellpadding="10" cellspacing="1" width="500">
		<tr class="tableheader">
			<td align="center" colspan="2">Enter Login Details</td>
		</tr>
		<tr class="tablerow">
			<td align="right">Username</td>
			<td><input type="text" name="userName"></td>
		</tr>
		<tr class="tablerow">
			<td align="right">Password</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
		</tr>
	</table>
</form>
<?php } else { ?>
	<table border="0" cellpadding="10" cellspacing="1" width="500">
		<tr class="tableheader">
			<td align="center">User Dashboard</td>
		</tr>
		<tr class="tablerow">
			<td>
				Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="backend/logout.php" tite="Logout">Logout.
			</td>
		</tr>
	</table>
<?php }  ?>