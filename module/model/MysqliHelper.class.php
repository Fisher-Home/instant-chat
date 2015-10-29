<?php
class MysqliHelper {
	
	private $link;

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
		$con = mysqli_connect($db_host, $db_user, $db_psw, $db_name);
		if (!$con) {
			$this -> err(mysqli_error($this->link));
		}
		$this->link=$con;
		$charset=mysqli_query($this->link, "set names {$db_charset}");
		return;
	}
	
	/*
	 * Close database
	 * */
	function close(){
		return mysqli_close($this->link);
	}

	/*
	 * Excel the sql
	 *
	 * @param string $sql
	 *
	 * @return result
	 * */
	function query($sql) {
		$query = mysqli_query($this->link, $sql);
		if (!$query) {
			echo "ERROR AT:{$sql}<br />\n";
			$this -> err(mysqli_error($this->link));
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
	 	while($re=mysqli_fetch_array($query, MYSQL_ASSOC)){
	 		$res[]=$re;
	 	}
		return isset($res)?$res:'';
	 }

	/*
	 * 
	 * */
	 function fetchOneQuery($query){
	 	$re=mysqli_fetch_array($query, MYSQL_ASSOC);
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