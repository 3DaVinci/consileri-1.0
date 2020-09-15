<?php
/*
 * Создан: 11.06.2008 16:23:57
 * Автор: Александр Перов
 */ 
	

class Help {
    
    private $data = array();
    private $db;
    private $session;    
    private $resetQueue = array();
    
    public function __construct(&$db,&$session) {     
        $this->db = $db;
        $this->session = $session;  
              
        // load         
        /*for ($index = 0; $index < 50; $index++) {
            $this->data[] = true;
        }
        //$this->data[14] = false;
        */
        
        
        
        $temp = $this->db->fetchRow("SELECT `help` FROM dacons_users WHERE id = '".$this->session->id."'");
        
        if ($temp['help']!="") {
           $this->data = unserialize($temp['help']);
        } else {
           //def
            $this->data[1] = false;   // добавить и редактировать
            $this->data[2] = false;   // добавить и редактировать
            $this->data[3] = false; // напоминания без даты
            $this->data[4] = true; // нет клиентов главная
            $this->data[5] = true; // нет клиентов журнал
            $this->data[6] = true; // нет клиентов напоминания
            $this->data[7] = true; // нет клиентов список
            $this->data[8] = false; // метки на главной
            $this->data[9] = false; // в журнале нет событий
            $this->data[10] = false; // напоминания на главной
            $this->data[11] = false; // первое напоминание
            $this->data[12] = false; // добавлен первый клиент
            $this->data[13] = true; // добавление
            $this->data[14] = false; // вкладка управление
            $this->data[15] = false; // напоминания
        }
        
        if ($this->data[4]) $this->checkClients();
        if ($this->data[15]) {             
            $this->data[3] = false;
        } else {            
           $this->checkDatedReminders();
        }
        if ($this->data[8]) {
           $this->checkLabels();
        }
        if ($this->data[9]) {
            $this->checkEvents();
        }
        if ($this->data[10]) {
            $this->checkReminders();
        }
    }        
    
    public function resetAll() {
        $this->data[1] = false;   // добавить и редактировать
        $this->data[2] = false;   // добавить и редактировать
        $this->data[3] = false; // напоминания без даты
        $this->data[4] = true; // нет клиентов главная
        $this->data[5] = true; // нет клиентов журнал
        $this->data[6] = true; // нет клиентов напоминания
        $this->data[7] = true; // нет клиентов список
        $this->data[8] = false; // метки на главной
        $this->data[9] = false; // в журнале нет событий
        $this->data[10] = false; // напоминания на главной
        $this->data[11] = false; // первое напоминание
        $this->data[12] = false; // добавлен первый клиент
        $this->data[13] = true; // добавление
        $this->data[14] = false; // вкладка управление
        $this->data[15] = false; // напоминания
    }
    
    public function checkReminders() {
        if ($this->db->fetchRow("SELECT id FROM dacons_reminderspool WHERE manager_id = '".$this->session->id."' LIMIT 1")) {
           $this->data[10] = false;
           //$this->data[11] = false;
           $this->data[15] = false;
       }
    }
    
    public function checkEvents() {
       if ($this->db->fetchRow("SELECT e.id FROM dacons_events as e WHERE e.company_id in (SELECT id FROM dacons_companies WHERE manager = '".$this->session->id."') LIMIT 1")) {
           $this->data[9] = false;
       }
    }
    
    public function checkLabels() {       
       if ($this->db->fetchRow("SELECT l.label_id FROM dacons_companies_labels as l " .
                               "LEFT JOIN dacons_companies as c ON c.id = l.company_id WHERE c.manager = '".$this->session->id."'")) {
           $this->data[8] = false;
       }       
    }
    
    public function checkDatedReminders() {               
        if ($this->db->fetchRow("SELECT r.id FROM dacons_reminderspool as r LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
                                "WHERE r.manager_id = '".$this->session->id."' AND r.`date` <> '2000-01-01 00:00:00'")) {
            $this->data[3] = false;
            $this->data[11] = false;
        } else {
            $this->data[3] = true;
        }
    }
    
    public function checkClients() {
    	$e = error_reporting(0);
        if ($this->db->fetchRow("SELECT id FROM dacons_companies WHERE manager = '".$this->session->id."'")) {
            for ($index = 0; $index < sizeof($this->data); $index++) {
            	$this->data[$index] = !$this->data[$index]; 
            }
        }        
        error_reporting ($e);
    }
    
    public function set($id) {
        $this->data[$id] = true;
    }        
    
    public function isCheck($id) {
        return $this->data[$id];
    }
    
    public function reset($id) {
        $this->data[$id] = false;
    }        
    
    public function resetAfter($id) {
        $this->resetQueue[] = $id;
    }
    
    public function save() {
        for ($index = 0; $index < sizeof($this->resetQueue); $index++) {
        	$this->reset($this->resetQueue[$index]);
        }
        $this->db->query("UPDATE dacons_users SET `help` = '".serialize($this->data)."' WHERE id = '".$this->session->id."'");        
    }
    
    public function getData() {
        return $this->data;
    }
    
}
		
?>
