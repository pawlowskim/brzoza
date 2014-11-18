<?php
    class messageRepository{
       function __construct() {
              $conn = mysql_connect("localhost","root","") or die(mysql_error());
              mysql_select_db("bai4",$conn);
          }

      public function doQuery($query) {
        return mysql_query($query);
      }

      public function getAccountInfo($userId){
        return mysql_query("select * from users where id = '".$userId."'");
      }
      public function changeLoginMode($attempts, $new_mode, $userId) {
		mysql_query("update users set attempts = '".$attempts."', login_mode = '".$new_mode."' where id = '".$userId."'");			
      }
	  
      public function getMessages(){
        return mysql_query("select * from messages");
      }

      public function addMessage($message, $owner){
        mysql_query("insert into messages (message, owner) values ('".$message."','".$owner."')");
      }

	  public function canEdit($messageId, $username, $userId){
		$havePrivileges = 0;
		$isOwner = 0;
		if($userId != null) {
			$result = mysql_query("select id from privileges where messageId = '".$messageId."' and (userId = '".$userId."' or ownerId = '".$userId."')");
			if($result != false)
				$havePrivileges = mysql_num_rows($result);
		}
			
		if($username != null) {
			$result2 = mysql_query("select id from messages where owner = '".$username."' and id = '".$messageId."'");
			if($result2 != false)
				$isOwner = mysql_num_rows($result2);
		}
		return ($havePrivileges + $isOwner);
	  }
      public function getMessagesByOwner($owner){
        return mysql_query("select * from messages where owner = '".$owner."'");
      }

      public function deleteMessage($id, $owner) {
        mysql_query("delete from messages where id = '".$id."' and owner = '".$owner."'");
      }

      public function getMessagesById($messageId, $username, $userId) {
		if($this -> canEdit($messageId, $username, $userId))
			return mysql_fetch_assoc(mysql_query("select message from messages where id ='".$messageId."'"))["message"];
		else
			return "";
      }

      public function editMessage($messageId, $message, $userId, $username) {
		if($this -> canEdit($messageId, $username, $userId)) {
			mysql_query("update messages set message = '".$message."' where id = '".$messageId."'");
		}
			
      }

      public function getMessagesToEdit($owner, $ownerId) {
        $messages = array();
        $myMessages = mysql_query("select * from messages where owner = '".$owner."'");
        while($row = mysql_fetch_assoc($myMessages)){
            $messages[] = array("id" => $row["id"], "owner" => $row["owner"], "message" => $row["message"]);
        }

        $sharedMessagesIds = mysql_query("select messageId from privileges where userId = '".$ownerId."'");
        $ids = array();
        while($row = mysql_fetch_assoc($sharedMessagesIds))
            $ids[] = $row["messageId"];

        $sharedMessages = mysql_query("select * from messages where id in(".implode(',', array_map('intval', $ids)).")");
        if($sharedMessages != null){
            while($row = mysql_fetch_assoc($sharedMessages)){
                $messages[] = array("id" => $row["id"], "owner" => $row["owner"], "message" => $row["message"]);
            }
        }

        return $messages;
      }

    public function addPrivilege($messageId, $username, $owner){
        $userId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$username."'"))["id"];
        $ownerId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$owner."'"))["id"];
        $isOwner = mysql_fetch_assoc(mysql_query("select id from messages where owner = '".$owner."' and id = '".$messageId."'"))["id"];
        if($isOwner == null)
            return;
        mysql_query("insert into privileges (messageId, ownerId, userId) values ('".$messageId."', '".$ownerId."', '".$userId."')");
    }

      public function revokePrivilege($messageId, $username, $owner){
          $userId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$username."'"))["id"];
          $ownerId = mysql_fetch_assoc(mysql_query("select id from users where name = '".$owner."'"))["id"];
          $isOwner = mysql_fetch_assoc(mysql_query("select id from messages where owner = '".$owner."' and id = '".$messageId."'"))["id"];
          if($isOwner == null)
              return;
          mysql_query("delete from privileges where userId = '".$userId."' and messageId = '".$messageId."' and ownerId = '".$ownerId."'");
        }
    }
?>