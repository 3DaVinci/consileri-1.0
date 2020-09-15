<?php

/*
 * Создан: 31.01.2008 10:13:38
 * Автор: Александр Перов
 */

class Scheduler {
    
    protected $session = null;
    
    public function __construct(Zend_Session_Namespace $session) {    	
        $this->session = $session;
        if ($this->checkRequred()) {
            $this->go();
        }    	
    }

    /**
     * проверка нужно ли выполнять запланированные действия
     */
	private function checkRequred() {
		$nextShedule = $this->session->snt;
		if ($nextShedule == "") {
			return true;
		}		
		$now = date("U");
		if ($now >= $nextShedule) {
			return true;
		}
		return false;
	}

    /**
     * выполнение запланированого действия
     */
	private function go() {		
		//require_once 'application/models/History.php';
		//$history = new History();
		global $dbconfig;
		$db = new MySQLDriver($dbconfig);
		$start = date("Y-m-d H:i:s", mktime(0 + $this->session->GMT, 0, 0, date("m"), date("d"), date("Y")));
        $user_id = $this->session->id;        
		$db->query (" delete from dacons_history where updated <= '".$start."' AND user_id='$user_id' AND locked = '0'");
		//echo "schedule complite";
		$this->session->snt = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
	}

}
?>
