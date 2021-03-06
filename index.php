﻿<?php
session_start();
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style/styles.css" />
    </head>
    <body>
        <div id="header" class="header">
            <?php include('ui/login.php'); ?>
        </div>
        <div id="nav" class="nav">
			<ul>
			    <li><a href="?action=messages">Wiadomości</a></li>
			    <?php if(isset($_SESSION["name"])){ ?>
                    <li><a href="?action=newMessage">Nowa wiadomość</a></li>
                    <li><a href="?action=delete">Usuń wiadomość</a></li>
                    <li><a href="?action=edit">Edytuj wiadomość</a></li>
                    <li><a href="?action=privilege">Nadaj uprawnienia</a></li>
					<li><a href="?action=account">Ustawienia konta</a></li>
				<?php } ?>
			</ul>
		</div>
        <div id="section" class="section">
            <?php
                if(isset($_GET["action"])){
                    if($_GET["action"] == "newMessage")
                        include("ui/newMessage.php");
                    else if($_GET["action"] == "messages")
                        include("ui/messages.php");
                    else if($_GET["action"] == "delete")
                        include("ui/deleteMessage.php");
                    else if($_GET["action"] == "privilege")
                        include("ui/privileges.php");
                    else if($_GET["action"] == "edit")
                        include("ui/editMessage.php");
					else if($_GET["action"] == "account")
						include("ui/account.php");
                }
            ?>
        </div>
        <div id="footer" class="footer">footer</div>



    </body>
</html>