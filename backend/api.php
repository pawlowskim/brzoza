<?php
    session_start();
    include_once("messageRepository.php");

    $repo = new messageRepository();
    if(isset($_POST["message"]) && isset ($_SESSION["name"])){
        $repo -> addMessage($_POST["message"], $_SESSION["name"]);
        header("Location: ../index.php?action=messages");
    } else if($_GET["action"] == "delete"){
        $repo -> deleteMessage($_GET["id"], $_SESSION["name"]);
        header("Location: ../index.php?action=delete");
    }

?>