<?php
//header("Content-Type:text/json");

class Message {
	private $json;

	public function __construct($id, $alias, $content, $time, $img) {
		$this -> json['id'] = $id;
		$this -> json['alias'] = $alias;
		$this -> json['content'] = $content;
		$this -> json['time'] = $time;
		$this -> json['img'] = 'module/pic/'.$img.'.png';

	}

	public function toJson() {
		return json_encode($this -> json);
	}

}

$curTime = time() . substr(microtime(), 2, 3);

$msg = new Message("c496811916", "Butterfly", "Hello, i am butterfly", $curTime, "c496811916");

echo '['.$msg -> toJson().']';
?>