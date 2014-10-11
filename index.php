<?php
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
        width:100px;
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
        <div id="nav" class="nav">nav</div>
        <div id="section" class="section">section</div>
        <div id="footer" class="footer">footer</div>



    </body>
</html>