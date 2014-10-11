<?php
    class messageRepository{
       function __construct() {
              $conn = mysql_connect("localhost","root","") or die(mysql_error());
              mysql_select_db("bai",$conn);
          }

      public function doQuery($query) {
        return mysql_query($query);
      }

      public function getMessages(){
        return mysql_query("select * from messages");
      }

      public function addMessage($message, $owner){
        mysql_query("insert into messages (message, owner) values ('".$message."','".$owner."')");
      }

      public function getMessagesByOwner($owner){
        return mysql_query("select * from messages where owner = '".$owner."'");
      }

      public function deleteMessage($id, $owner) {
        mysql_query("delete from messages where id = '".$id."' and owner = '".$owner."'");
      }

      public function getMessagesById($id) {
        return mysql_fetch_assoc(mysql_query("select message from messages where id ='".$id."'"))["message"];
      }

      public function editMessage($id, $message) {
        mysql_query("update messages set message = '".$message."' where id = '".$id."'");
      }

      public function addPrivilege($messageId, $username, $owner){
        $userId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$username."'"))["id"];
        $ownerId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$owner."'"))["id"];
        $isOwner = mysql_fetch_assoc(mysql_query("select id from messages where owner = '".$owner."' and id = '".$messageId."'"))["id"];
        if($isOwner == null)
            return;
        mysql_query("insert into privileges (messageId, ownerId, userId) values ('".$messageId."', '".$ownerId."', '".$userId."')");
      }
    }
?>