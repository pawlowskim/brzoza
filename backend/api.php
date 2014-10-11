<?php
    session_start();
    include_once("messageRepository.php");

    $repo = new messageRepository();
    if($_GET["action"] == "newMessage" && isset($_POST["message"]) && isset ($_SESSION["name"])){
        $repo -> addMessage($_POST["message"], $_SESSION["name"]);
        header("Location: ../index.php?action=messages");
    } else if($_GET["action"] == "delete"){
        $repo -> deleteMessage($_GET["id"], $_SESSION["name"]);
        header("Location: ../index.php?action=delete");
    } else if($_GET["action"] == "privilege") {
        if(isset($_POST["add"])) {
            $repo -> addPrivilege($_POST["messageId"], $_POST["userName"], $_SESSION["name"]);
        } else if(isset($_POST["revoke"])) {
            $repo -> revokePrivilege($_POST["messageId"], $_POST["userName"], $_SESSION["name"]);
        }
        header("Location: ../index.php?action=privilege");
    } else if($_GET["action"] == "edit") {
        if(!isset($_POST["message"])) {
            header("Location: ../index.php?action=edit&messageId=".$_POST["messageId"]);
        } else {
            $repo -> editMessage($_POST["messageId"], $_POST["message"]);
            header("Location: ../index.php?action=messages");
        }

    }

?>