<?php

class Chat {
	/*
	 * This is the class to help process logical task for every user
	 * */
	private $curTime;
	private $mysql;

	public function __construct($mysql) {
		$this -> mysql = $mysql;
		$this -> curTime = time() . substr(microtime(), 2, 3) + 0;
	}


	public function fnSendMessage($to, $from, $content) {
		// All datas should be checked
		$data = array('mFrom' => $from, 'mTime' => $this -> curTime, 'mRead' => 1, 'mContent' => $content);
		return $this -> mysql -> insert('msg_' . $to, $data);
	}

	public function fnCheckMessage($id) {
		// Check new messages
		$sql = "SELECT `mFrom`, `mContent`, `mTime` FROM msg_{$id} WHERE mRead=1";
		$query = $this -> mysql -> query($sql);
		$result = $this -> mysql -> fetchQuery($query);
		return $result;
	}


	public function fnCheckHistory($id, $who) {
		// Check history messages
//		$sql = "SELECT `mFrom`, `mContent`, `mTime` FROM msg_{$id} WHERE mRead=0 AND mFrom={$who}";
		$sql = "SELECT `mFrom`, `mContent`, `mTime` FROM msg_{$id} WHERE mFrom={$who}";
		$query = $this -> mysql -> query($sql);
		$result = $this -> mysql -> fetchQuery($query);
		return $result;
	}
	
	public function fnGetUserRelations(){
		
	}
	public function fnGetUserInfo(){
		
	}
	public function fn(){
		
	}


}

/*

 API List

 A. Quest for new messages
 // Will be quested for many times;

 path:
 api/

 method:
 post

 body:{
 from:[my id]
 }

 return
 [
 {
 id:"",
 alias:"Fisher",
 content:"Good Evening",
 time:2323232,
 img:""
 },{...}
 ]

 B. Quest for history message

 path: api/
 method: post

 body:{
 from:[my id],
 id=[Chat ID]
 }

 return
 [
 {
 id:"",
 alias:"Fisher",
 content:"Good Evening",
 time:2323232,
 img:""
 },{...}
 ]

 C. Send new Message

 path: api/
 method: post
 body:
 {
 from:[my id],
 id=[Chat ID],
 content=[string]
 }

 return
 {
 errCode:0,
 msg:[succeeded|failed]
 }

 The default url of user's head photo is "module/pic/[User ID].png"

 */
?>