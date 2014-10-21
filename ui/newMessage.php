<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }
?>
<form action="backend/api.php" method="get">
	<input type="hidden" name="action" value="newMessage" />
    <textarea rows="10" cols="50" name="message" placeholder="Wpisz wiadomość"></textarea>
    <input type="submit" name="submit"/>
</form>