<table border="1">
    <tr>
        <th>ID</th>
        <th>Autor</th>
        <th>Treść</th>
    </tr>
    <?php
        include_once('backend/messageRepository.php');
        $msgRepo = new messageRepository();
        $rows = $msgRepo -> getMessages();
        while($row = mysql_fetch_assoc($rows)){
            echo "<tr><td>".$row["id"]."</td><td>".$row["owner"]."</td><td>".$row["message"]."</td></tr>";
        }
    ?>

</table>