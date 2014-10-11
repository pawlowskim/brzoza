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
    }
?>