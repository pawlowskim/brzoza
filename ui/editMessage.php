<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }

    if(!isset($_GET["messageId"])) { ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Autor</th>
                <th>Treść</th>
                <th>Akcja</th>
            </tr>
            <?php
                include_once('backend/messageRepository.php');
                $msgRepo = new messageRepository();
                $messages = $msgRepo -> getMessagesToEdit($_SESSION["name"], $_SESSION["id"]);
                foreach($messages as $row){
                    echo "<tr><td>".$row["id"]."</td><td>".$row["owner"]."</td><td>".$row["message"]."</td><td><a href='?action=edit&messageId=".$row["id"]."'>Edytuj</a></td></tr>";
                }
            ?>

        </table>
    <?php
    } else {
        include_once('backend/messageRepository.php');
        $msgRepo = new messageRepository();
        $message = $msgRepo -> getMessagesById($_GET["messageId"], $_SESSION["name"], $_SESSION["id"]); ?>

        <form action="backend/api.php" method="get">
			<input type="hidden" name="action" value="edit" />
            <textarea rows="10" cols="50" name="message" placeholder="Wpisz wiadomość"><?php echo $message ?></textarea>
            <input type="hidden" name="messageId" value="<?php echo $_GET["messageId"] ?>" />
            <input type="submit" name="submit"/>
        </form>
<?php
    }
?>
