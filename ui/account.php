<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }

?>

<table border="1" width="750px">
    <tr>
        <th>Data ost. nieudanego logowania</th>
        <th>Data ost. udanego logowania</th>
		<th>Ilość możliwych prób logowania</th>
		<th>Tryb logowania</th>
    </tr>
    <?php
        include_once('backend/messageRepository.php');
        $msgRepo = new messageRepository();
        $rows = $msgRepo -> getAccountInfo($_SESSION["id"]);
		$login_mode = ' nieograniczony ';
        while($row = mysql_fetch_assoc($rows)){
		$attempts = $row["attempts"];
		$mode = $row["login_mode"];
			if ($row["login_mode"] == 1){
				$login_mode = ' Logowanie z ograniczoną ilością prób ';
			}
            echo "<tr><td align='center'>".$row["last_failed"]."</td><td align='center'>".$row["last_success"]."</td>
			<td align='center'>".$row["attempts"]."</td><td  align='center'>".$login_mode."</td></tr>";
        }
    ?>
</table>

<br/><br/>

<form action="backend/api.php" method="get">
	<input type="hidden" name="action" value="logintype" />
    Ilość możliwych prób: <input type="number" name="attempts" value="<?php echo $attempts ?>" />
    <input type="radio" name="new_mode"<?php if ($mode == 1) echo "checked";?> value="1"/>Tryb z ograniczoną ilością prób logowania
	<input type="radio" name="new_mode"<?php if ($mode == 0) echo "checked";?> value="0"/>Tryb bez ograniczeń prób logowania<br/>
    <input type="submit" name="login_mode_change" value="Zapisz"/>
</form>
