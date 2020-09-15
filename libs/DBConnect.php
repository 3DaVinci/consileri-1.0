<?php

/**
 * Singleton DBConnect Class
 *  
 * @date	29 June 2010
 * @author  Valera Kogut
 * @version 1.0.0
 */

class DBConnect
{
    /**
     * DataBaseConnection
     *
     * Marked only as protected to allow extension of the class. To extend,
     * simply override {@link db()}.
     *
     * @var Resource (MySQL link identifier)
     */
    protected $_db = NULL;

    /**
     * Singleton instance
     *
     * Marked only as protected to allow extension of the class. To extend,
     * simply override {@link getInstance()}.
     *
     * @var DBConnect
     */
    protected static $_instance = null;
	
	protected $_is_demo = null;
    
    /**
     * Whether or not exceptions encountered in {@link throwExceptions()}
     * 
     * @var Boolean
     */
    protected static $_throwExceptions = false;

    /**
     * Constructor
     *
     * Instantiate using {@link getInstance()}
     *
     * @return void
     */
    protected function __construct($db_config)
    {  
	    global $is_demo;
        $this->_is_demo = $is_demo;


        try {
		$this->_db = mysql_connect($db_config['host'], $db_config['username'], $db_config['password']);
		mysql_query("use `".$db_config['dbname']."`");      
            mysql_query("set names 'utf8'");
        } catch (Exception $e) {
            if (self::throwExceptions()) {
                throw $e;
            }
        }        
        $this->init();
    }
    
    public function init()
    {
        
    }
	
    /**
     * Enforce singleton; disallow cloning 
     * 
     * @return void
     */
    private function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    /**
     * Singleton instance
     *
     * @return DBConnect instance
     */
    public static function getInstance()
    {           
        if (null === self::$_instance) {
			global $dbconfig;
            self::$_instance = new self($dbconfig);
        }
        
        return self::$_instance;
    }

    /**
     * Resets all object properties of the singleton instance
     *
     * @return void
     */
    public function resetInstance()
    {
        $reflection = new ReflectionObject($this);
        
        foreach ($reflection->getProperties() as $property) {
            
            $name = $property->getName();
            
            switch ($name) {
                case '_instance':
                    self::${$name} = null;
                    break;
                
                case '_throwExceptions':
                    self::${$name} = false;
                    break;
                
                default:
                    $this->{$name} = null;
                    break;
            }
        }
    }

    /**
     * DataBaseConnection
     *
     * Passing no value will return the current value of the $_db; passing a 
     * $db value will set the $_db and return the current 
     * object instance.
     *
     * @param boolean $flag Defaults to null (return flag state)
     * @return Resource (MySQL link identifier)
     */
    public function db()
    {
        return $this->_db;
    }

    /**
     * Singleton throwExceptions
     * 
     * Set the throwExceptions flag and retrieve current status
     *
     * Default behaviour is to trap them; call this
     * method to have them thrown.
     *
     * Passing no value will return the current value of the flag; passing a 
     * boolean true or false value will set the flag and return the current 
     * object instance.
     *
     * @param boolean $flag Defaults to null (return flag state)
     * @return boolean|DBConnect Used as a setter, returns boolean; as a getter, returns boolean
     */
    public static function throwExceptions($flag = NULL)
    {
        if ($flag !== NULL) {
            self::$_throwExceptions = (bool) $flag;
        }
        return self::$_throwExceptions;
    }
	
	public function query($query)
    {
		if ($this->_is_demo) {
			$query_type = strtolower(substr($query, 0, 6));
			$denied_types = array('update', 'insert', 'delete');
			if (in_array($query_type, $denied_types)) return;
		}

		if (empty($query)) return;
		
		$this->_res = mysql_query($query);
		if ($msg = mysql_error($this->_db) != '') {
			die("<br>error in query: <br>$query<br><br>$msg");
		}
		
		return $this->_res;
    }

    public function fetchRow($query)
    {
		if (!is_resource($query)) $this->query($query);
		return mysql_fetch_assoc($this->_res);
    }

    public function fetchObject($query)
    {
		if (!is_resource($query)) $this->query($query);
		return mysql_fetch_object($this->_res);
    }

    public function fetchAll($query)
    {
		$ret_arr = array();
		if (!is_resource($query)) $this->query($query);
		while($row = mysql_fetch_assoc($this->_res)) {
			$ret_arr[] = $row;
		}
		return $ret_arr;
    }

    public function quote($str)
    {
		return mysql_real_escape_string($str);
    }

    public function fetchCol($query) 
    {
		$arr = $this->fetchAll($query);	
		$ret_arr = array();
		  if (count($arr) < 1) return $ret_arr;
		$keys = array_keys($arr[0]);
		$key = $keys[0];
		foreach ($arr as $row) {
			$ret_arr[] = $row[$key];
		}
		return $ret_arr;
    }
	
    public function fetchOne($query) 
    {
		$arr = $this->fetchRow($query);
		$ret_arr = array();
		if (count($arr) < 1) return null;
		$keys = array_keys($arr);
		return $arr[$keys[0]];
    }
	
	public function insert($table, $values)
    {
		if ($this->_is_demo) return 0;
		$keys_arr = array_keys($values);
		foreach ($keys_arr as &$key) {
			$key = "`$key`";
		}
		$keys = join(', ', $keys_arr);
		$values_arr = array_values($values);
		foreach ($values_arr as &$value) 
		{
			if (get_magic_quotes_gpc()) 
			{ 
				$value = stripslashes($value); 
			}
				$value = '"'.$this->quote($value).'"';
		}
		$values = join (', ', $values_arr);
		$query = "insert into $table($keys) values($values)";
		$this->query($query);
		return mysql_insert_id();
	}
	
	public function delete($table, $where)
    {
		if ($this->_is_demo) return 0;
		$query = "delete from  $table  ";
		$query .= " where $where";
		$this->query($query);
    }
	
	public function update($table, $values, $where)
    {
		if ($this->_is_demo) return 0;
		$query = "update $table set ";
		$set_arr = array ();
		
		foreach ($values as $key => $value) {
			if (get_magic_quotes_gpc()) { 
				$value = stripslashes($value); 
			}
			$set_arr[] = " $key = '".$this->quote($value)."' ";
		}
		$query .= join(', ', $set_arr);
		
		$query .= " where $where";
		$this->query($query);
    }
}
