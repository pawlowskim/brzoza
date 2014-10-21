<?php
    session_start();
    include_once("messageRepository.php");

    $repo = new messageRepository();
    if($_GET["action"] == "newMessage" && isset($_GET["message"]) && isset ($_SESSION["name"])){
        $repo -> addMessage($_GET["message"], $_SESSION["name"]);
        header("Location: ../index.php?action=messages");
    } else if($_GET["action"] == "delete"){
        $repo -> deleteMessage($_GET["id"], $_SESSION["name"]);
        header("Location: ../index.php?action=delete");
    } else if($_GET["action"] == "privilege") {
        if(isset($_GET["add"])) {
            $repo -> addPrivilege($_GET["messageId"], $_GET["userName"], $_SESSION["name"]);
        } else if(isset($_GET["revoke"])) {
            $repo -> revokePrivilege($_GET["messageId"], $_GET["userName"], $_SESSION["name"]);
        }
        header("Location: ../index.php?action=privilege");
    } else if($_GET["action"] == "edit") {
        if(!isset($_GET["message"])) {
            header("Location: ../index.php?action=edit&messageId=".$_GET["messageId"]);
        } else {
            $repo -> editMessage($_GET["messageId"], $_GET["message"], $_SESSION["id"], $_SESSION["name"]);
            header("Location: ../index.php?action=messages");
        }

    }

?>