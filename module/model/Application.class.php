<?php
class Application {
	/*
	 * This class is to help users to sign up
	 * and do more options about the user
	 * */
	private $mysql;
	private $curTime;

	public function __construct($mysql) {
		$this -> mysql = $mysql;
		$this -> curTime = time() . substr(microtime(), 2, 3) + 0;
	}

	/*
	 * Create the basic users & password table
	 * [Single]
	 * */
	public function fnCreateUserTable() {
		// Create the users table
		$sql = "CREATE TABLE Users(
			mID varchar(35) NOT NULL
			, PRIMARY KEY( mID )
			, mPSW varchar(35) Not NULL
		)";
		return $this -> mysql -> query($sql);
	}

	/*
	 * Create the basic users info table
	 * [Single]
	 * */
	public function fnCreateUserInfoTable() {
		// Create the user info table
		$sql = "CREATE TABLE UsersInfo(
			mID varchar(35) NOT NULL
			, PRIMARY KEY( mID )
			, mInfo text Not NULL
		)";
		return $this -> mysql -> query($sql);
	}

	/*
	 * Create the user messages table to store the messages
	 * One table for one user
	 * [Multiple]
	 * */
	public function fnCreateUserMsgTable($id) {
		// Create the user-messages table
		$sql = "CREATE TABLE msg_{$id}(
			mID int NOT NULL AUTO_INCREMENT
			, PRIMARY KEY( mID )
			, mFrom varchar(35) Not NULL DEFAULT ''
			, mTime bigint Not NULL DEFAULT 0
			, mRead tinyint(1) Not NULL DEFAULT 1
			, mContent text Not NULL DEFAULT ''
		)";
		return $this -> mysql -> query($sql);
	}

	/*
	 * [Extention] If we need the group
	 * Create the group messages table to store the messages
	 * One table for one group
	 * [Multiple]
	 * */
	public function fnCreateGroupMsgTable($id) {
		// Create the group-messages table
		$sql = "CREATE TABLE msg_group_{$id}(
			mID int NOT NULL AUTO_INCREMENT
			, PRIMARY KEY( mID )
			, mFrom varchar(35) Not NULL DEFAULT ''
			, mTime bigint Not NULL DEFAULT 0
			, mContent text Not NULL DEFAULT ''
		)";
		return $this -> mysql -> query($sql);
	}

	public function fnIsUserExsits($id) {
		// Query if the user exsits
		$sql = "SELECT mID FROM Users WHERE `mID` = '{$id}'";
		$res = $this -> mysql -> query($sql);
		if ($this -> mysql -> fetchOneQuery($res))
			return 1;
		return 0;
	}

	public function fnCheckPSW($id, $psw) {
		// Check whether the password is correct
		$sql = "SELECT mID FROM Users WHERE `mID` = {$id} AND `mPSW` = {$psw}";
		$res = $this -> mysql -> query($sql);
		if ($this -> mysql -> fetchOneQuery($res))
			return 1;
		return 0;
	}

	/*
	 * Get user info
	 *
	 * @param $id // The user ID
	 *
	 * @return $info // The array of user detailed info
	 * */
	public function fnGetUserInfo($id) {
		// Query the detailed user info
		$sql = "SELECT `mInfo` FROM UsersInfo WHERE `mID` = '{$id}'";
		$query = $this -> mysql -> query($sql);
		$res = $this -> mysql -> fetchOneQuery($query);
		var_dump($res);
		var_dump($res['mInfo']);
		return json_decode($res['mInfo']);
	}

	/*
	 * Set user info
	 *
	 * @param $id // The user ID
	 * @param $info // The array of user detailed info
	 * */
	public function fnSetUserInfo($id, $info) {
		// Set the detailed user info
		$data = array('mInfo' => json_encode($info));
		return $this -> mysql -> update('UsersInfo', $data, "mID = '{$id}'");
	}

	public function fnCreateUser($id, $psw) {
		// Register in the table - `Users`
		$data = array('mID' => $id, 'mPSW' => $psw);
		$this -> mysql -> insert('Users', $data);

		// Register in the table - `UsersInfo`
		$defalutInfo = array('mSignUpTime' => $this -> curTime);
		$data = array('mID' => $id, 'mInfo' => json_encode($defalutInfo));
		$this -> mysql -> insert('UsersInfo', $data);

		// Create user message table
		$this -> fnCreateUserMsgTable($id);
	}

	public function fnChangePSW($id, $psw) {
		// Change the password
		$data = array('mPSW' => $psw);
		$this -> mysql -> update('Users', $data, 'mID = {$id}');
	}

	public function fnChangeID($id) {
		// Change the user id
	}

}
?>