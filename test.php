<?php
error_reporting(E_ALL ^ E_DEPRECATED);
/* This is the test file; do any test here */
$curTime = time() . substr(microtime(), 2, 3) + 0;

require ('module/model/Mysql.class.php');
require ('api/Chat.class.php');

$config = array('db_host' => 'localhost', 'db_user' => 'root', 'db_psw' => '', 'db_name' => 'smart_chat_v1', 'db_charset' => 'utf8');

$mysql = new Mysql();
$mysql->connect($config);

$chat = new Chat($mysql);

//function check($key) {
//	if (isset($_POST[$key])) {
//		return $_POST[$key];
//	}
//	return '';
//}

//echo gettype($curTime);
//$data = array('mFrom' => check('from'), 'mContent' => check('content'), 'mTime' => $curTime, 'mIsRead'=>0);

//$mysql->insert('Table_v1', $data);

//echo $chat -> fnCreateUserMsg('pluto');
$chat -> fnSendMessage('pluto', 'fisher', 'Hello pluto, i am fisher');
echo json_encode($chat -> fnCheckMessage('pluto'));

$mysql->close();
?>