<?php
    if(!isset($_SESSION["name"])){
        echo "NOPE!";
        exit;
    }
?>
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
        $rows = $msgRepo -> getMessagesByOwner($_SESSION["name"]);
        while($row = mysql_fetch_assoc($rows)){
            echo "<tr><td>".$row["id"]."</td><td>".$row["owner"]."</td><td>".$row["message"]."</td><td><a href='backend/api.php?action=delete&id=".$row["id"]."'>Usuń</a></td></tr>";
        }
    ?>

</table>