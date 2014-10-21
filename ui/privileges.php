<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }
?>
<form action="backend/api.php" method="get">
	<input type="hidden" name="action" value="privilege" />
    <input type="text" name="messageId" placeholder="MessageId" />
    <input type="text" name="userName" placeholder="Username" /><br>
    <input type="submit" name="add" value="add"/>
    <input type="submit" name="revoke" value="revoke"/>
</form>