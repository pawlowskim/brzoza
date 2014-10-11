<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }

    if(!isset($_GET["messageId"])) { ?>
        <form action="backend/api.php?action=edit" method="post">
            <input type="text" name="messageId" placeholder="MessageId" />
            <input type="submit" name="submit"/>
        </form>
    <?php
    } else {
        include_once('backend/messageRepository.php');
        $msgRepo = new messageRepository();
        $message = $msgRepo -> getMessagesById($_GET["messageId"]); ?>

        <form action="backend/api.php?action=edit" method="post">
            <textarea rows="10" cols="50" name="message" placeholder="Wpisz wiadomość"><?php echo $message ?></textarea>
            <input type="hidden" name="messageId" value="<?php echo $_GET["messageId"] ?>" />
            <input type="submit" name="submit"/>
        </form>
<?php
    }
?>
