﻿<?php
session_start();
?>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style/styles.css" />
    <style>
    #header {
        color:white;
        text-align:center;
        padding:5px;
    }
    #nav {
        line-height:30px;
        background-color:#eeeeee;
        height:300px;
        width:200px;
        float:left;
        padding:5px;
    }
    #section {
        width:350px;
        float:left;
        padding:10px;
    }
    #footer {
        background-color:black;
        color:white;
        clear:both;
        text-align:center;
       padding:5px;
    }
    </style>
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
                    <li>Usuń wiadomość</li>
                    <li>Edytuj wiadomość</li>
                    <li>Nadaj uprawnienia</li>
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
                }
            ?>
        </div>
        <div id="footer" class="footer">footer</div>



    </body>
</html>