<?php


class DataBase {
	
	var $connection = ''; // подключение к базе
	var $hostname = ''; // хост
    var $username = ''; // пользователь
    var $password = ''; // пароль
    var $database = ''; // имя базы
	var $count = 0;
	
	// инициализация
	function DataBase($conf){		
		if ($conf['hostname'] != '') $this->hostname = $conf['hostname'];
        if ($conf['username'] != '') $this->username = $conf['username'];
        if ($conf['password'] != '') $this->password = $conf['password'];
        if ($conf['database'] != '') $this->database = $conf['database'];
		
		$this->connection = @mysql_connect($this->hostname, $this->username, $this->password);				
		mysql_select_db($this->database, $this->connection);
		$sql = "SET NAMES utf8";
		mysql_query($sql, $this->connection);
	}
	
	// выполнение запроса
	function query($sql){ 
		//echo $sql."<br><br>";	
		$this->count++;	
    	return mysql_query($sql, $this->connection);
    }
    
    // существует ли запись
    function isExist($sql) {
    	    
    	$result = $this->query($sql);      	  
    	if (mysql_num_rows($result)==0){
    		return false;
    	} else {
    		return true;
    	}
    }
	
	// получение массива с несколькими записями
	function fetch_array($sql){
		
		$result = array();
		$res = $this->query($sql);
		
		$fields = array();
		while ($meta = mysql_fetch_field($res)){
		$fields[$meta->name] = $meta->name;		
		}
			
		$i = 0;
		while ($rs = mysql_fetch_array($res)){
			$temp = array();
			foreach($fields as $key => $value) {
  				$temp[$value] = $rs[$value];  			
			}						
			$result[$i++] = $temp;
		}
		//return mysql_fetch_array($this->query($sql),MYSQL_BOTH);
		return $result;
	}
	
	function sql_fetch_array($sql){
		$res = $this->query($sql);
		return mysql_fetch_array($res);
	}
	
	// получение записей
	
	function fetch_simple_array($sql){
		
		$result = array();
		$res = $this->query($sql);
		
		$fields = array();
		while ($meta = mysql_fetch_field($res)){
		$fields[$meta->name] = $meta->name;		
		}
			
		$i = 0;
		while ($rs = mysql_fetch_array($res)){			
			foreach($fields as $key => $value) {
  				$result[$value] = $rs[$value];  			
			}									
		}
		return $result;
	}
	
	// получение записей
	
	function fetch_banners($sql){
		
		$result = array();
		$res = $this->query($sql);			
						
		while ($rs = mysql_fetch_array($res)){						
  				$result[$rs['name']] = $rs['code'];    																		
		}
		return $result;
	}
	
	function getQueriesCount(){
		return $this->count;
	}
	
}

?>
