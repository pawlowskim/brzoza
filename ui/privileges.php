<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }
?>
<form action="backend/api.php?action=privilege" method="post">
    <input type="text" name="messageId" placeholder="MessageId" />
    <input type="text" name="userName" placeholder="Username" /><br>
    <input type="submit" name="add" value="Nadaj uprawnienie"/>
    <input type="submit" name="revoke" value="Usuń uprawnienie"/>
</form>