<?php
class MysqlHelper {

	function err($error) {
		die("Error happened --&gt;&gt: {$error}");
	}

	/*
	 * Connect the database;
	 *
	 * @param string $db_host
	 * @param string $db_user
	 * @param string $db_psw
	 * @param string $db_name
	 * @param string $db_charset
	 *
	 * @Return TRUE
	 * */
	function connect($config) {
		extract($config);
		$con = mysql_connect($db_host, $db_user, $db_psw);
		if (!$con) {
			$this -> err(mysql_error());
		}
		$db=mysql_select_db($db_name, $con);
		if (!$db) {
			$this -> err(mysql_error());
		}
		$charset=mysql_query("set names {$db_charset}");
		return "Connect: ".$con.'-'.$db.'-'.$charset;
	}
	
	/*
	 * Close database
	 * */
	function close(){
		return mysql_close();
	}

	/*
	 * Excel the sql
	 *
	 * @param string $sql
	 *
	 * @return result
	 * */
	function query($sql) {
		$query = mysql_query($sql);
		if (!$query) {
			echo "ERROR AT:{$sql}<br />\n";
			$this -> err(mysql_error());
		} else {
//			echo "{$sql}<br />\n";
			return $query;
		}
	}

	/*
	 * Insert data into database
	 *
	 * @param string $table
	 * @param array $data  ( contains several key=>value )
	 * */
	function insert($table, $data) {
		foreach ($data as $key => $value) {
			$key_arr[] = "`{$key}`";
			if( gettype($value)=='double'|| gettype($value)=='integer'){
				$value_arr[] = "{$value}";
			}else{
				$value_arr[] = "'{$value}'";
			}
		}
		$keys = implode(",", $key_arr);
		$values = implode(",", $value_arr);
		$sql = "insert into {$table} ({$keys}) values ({$values})";
		return $this -> query($sql);
	}

	/*
	 * Update the database
	 *
	 * @param string $table
	 * @param array $data
	 * @param string $where
	 * */
	function update($table, $data, $where) {
		foreach ($data as $key => $value) {
			$data_arr[] = "`{$key}` = '{$value}'";
		}
		$data_str = implode(",", $data_arr);
		$sql = "update {$table} set $data_str where $where";
		return $this -> query($sql);
	}
	
	
	/*
	 * 
	 * */
	 function fetchQuery($query){
	 	while($re=mysql_fetch_array($query, MYSQL_ASSOC)){
	 		$res[]=$re;
	 	}
		return isset($res)?$res:'';
	 }
	 /*
	 * 
	 * */
	 function fetchOneQuery($query){
	 	$res=mysql_fetch_array($query, MYSQL_ASSOC);
		return isset($res)?$res:'';
	 }
	 
	 

	/*
	 * Delete datas from table
	 *
	 * @param string $table
	 * $param string $where
	 * */
	function delete($table, $where) {
		$sql = "delete from {$table} where {$where}";
		return $this -> query($sql);
	}

}
?>