<?php
error_reporting(E_ALL ^ E_DEPRECATED);
//header("Content-Type:text/json");
$curTime = time() . substr(microtime(), 2, 3) + 0;

require ('module/model/Mysql.class.php');
require ('api/Chat.class.php');

//$config = array('db_host' => 'localhost', 'db_user' => 'root', 'db_psw' => '', 'db_name' => 'smart_chat_v1', 'db_charset' => 'utf8');
$config = array('db_host' => 'localhost', 'db_user' => 'root', 'db_psw' => '', 'db_name' => 'smart_chat_v1', 'db_charset' => 'utf8');

$mysql = new Mysql();
$mysql -> connect($config);

$chat = new Chat($mysql);

/* ------ Main Code Here -------*/
$result['errcode'] = 0;
$result['msg'] = 'Your option succeeded!';

function check($key) {
	if (isset($_GET[$key])) {
		return $_GET[$key];
	}
	if (isset($_POST[$key])) {
		return $_POST[$key];
	}
	return '';
}

$target = check('target');

if ($target == 'check') {
	// Check for new msgs;
	$result['data'] = $chat -> fnCheckMessage(check('from'));

} else if ($target == 'send') {
	// Send new msg;
	$chat -> fnSendMessage(check('to'), check('from'), check('content'));
	$result['data'] = $result;

} else if ($target == 'check_history') {
	// Check for history msgs;

} else if ($target == 'user_info') {
	// Get user info;

} else if ($target == 'send') {

} else if ($target == 'send') {

} else {
	$result['errcode'] = 11;
	$result['msg'] = 'Your option failed!';

}

echo json_encode($result);
$mysql -> close();
?>