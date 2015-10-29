<?php
// Disable the 'deprecated' warning
error_reporting(E_ALL ^ E_DEPRECATED);
/* Do some test, and all code is temporary here */

require('module/model/MysqlHelper.class.php');
require('module/model/Application.class.php');

$mysql=new MysqlHelper();
$config = array('db_host' => 'localhost', 'db_user' => 'root', 'db_psw' => '', 'db_name' => 'smart_chat_v1', 'db_charset' => 'utf8');
$mysql -> connect($config);
$app=new Application($mysql);

//$app->fnCreateUserTable();
//$app->fnCreateUserInfoTable();

//$app->fnCreateUser('Fisher', 'free');
//$app->fnCreateUser('Pluto', 'free');

//$info=$app->fnGetUserInfo('Pluto');
//var_dump($info);
//$info->mGender='Boy';
//$info->mAlias='Pluto';
//$app->fnSetUserInfo('Pluto', $info);

//echo $app->fnIsUserExsits('Pluto');


$mysql->close();
?>