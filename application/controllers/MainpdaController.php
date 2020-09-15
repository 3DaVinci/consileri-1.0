<?php
/*
 * Created on 24.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

    require_once 'Zend_Controller_ActionWithInit.php';
    /*
    require_once 'application/models/Reminders.php';
    require_once 'application/models/MReminders.php';
    */

class MainpdaController extends Zend_Controller_ActionWithInit
{

    public function indexAction() {
		$this->template = "error/index";
    }

    public function preDispatch(){
        parent::preDispatch();
        global $conf;
        if ($this->session->id == "") $this->_redirect($conf ['siteurl']."/index");
        $this->trackPages();
    }

    public function deleteReminder($id) {

        if (!is_numeric($id)) return;
        // проверить принадлежность

        if ($this->getRequest()->getParam("t")!="1") {

            $temp = $this->db->fetchRow("SELECT count(id) as cnt, company_id FROM dacons_reminders WHERE company_id = (SELECT company_id FROM reminders WHERE id='$id') GROUP BY company_id");

            $check = $this->db->fetchRow("SELECT id FROM dacons_companies WHERE id = '".$temp['company_id']."' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
            if ($check == false) return;

            //$reminders = new Reminders();
            $this->db->delete('dacons_reminders',"id = '$id'");
            if ($temp['cnt']<2) {
                $this->db->query("DELETE FROM dacons_reminders_companies WHERE company_id = '".$temp['company_id']."' AND user_id = '".$this->session->id."'");
            }

        } else {

            $temp = $this->db->fetchRow("SELECT count(id) as cnt, company_id FROM dacons_mreminders WHERE company_id = (SELECT company_id FROM mreminders WHERE id='$id') GROUP BY company_id");

            $check = $this->db->fetchRow("SELECT id FROM dacons_companies WHERE id = '".$temp['company_id']."' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
            if ($check == false) return;

            //$mreminders = new MReminders();
            $this->db->delete("dacons_mreminders", "id = '$id'");

            if ($temp['cnt']<2) {
                $this->db->query("DELETE FROM dacons_mreminders_companies WHERE company_id = '".$temp['company_id']."' AND customer_id = '".$this->session->customer_id."'");
            }

        }
    }

    /*
     * удаление напоминания (помеченного)
     */
    public function deleteReminder2($id) {

        if (!is_numeric($id)) return;

        $check = $this->db->fetchRow("SELECT id FROM dacons_companies WHERE id = '$id' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
        if ($check == false) return;

        if ($this->getRequest()->getParam("t")!="1") {
            //require_once 'application/models/Reminders_Companies.php';
            //$reminders = new Reminders_Companies();

            $this->db->query("DELETE FROM dacons_reminders_companies WHERE user_id = '".$this->session->id."' AND company_id = '$id'");
        } else {
            //require_once 'application/models/MReminders_Companies.php';
            //$mreminders = new MReminders_Companies();
            $this->db->query("DELETE FROM dacons_mreminders_companies WHERE customer_id = '".$this->session->customer_id."' AND company_id = '$id'");
        }
    }

    public function historyAction() {
    	if ($this->session->isPDA!=true) return;
        if (!is_numeric($this->session->current_company)) {
            $this->_redirect($conf ['siteurl']."/");
            return;
	}
        $company = $this->session->current_company;
        $companyName = $this->db->fetchRow("SELECT name FROM dacons_companies WHERE id = '".$company."'");
        $this->view->company = $companyName['name'];

        $temp = $this->db->fetchAll("SELECT * FROM `dacons_events` WHERE `company_id` = '".$company."' " .
                                    "ORDER BY `date` DESC limit 0,10");
        $GMT = $this->session->GMT;

        if ($GMT != 0)
        foreach ($temp as $k => $v) {
            $temp[$k]['date'] = date("Y-m-d H:i:s",strtotime($temp[$k]['date']) + (3600 * $GMT));
        }

        $this->view->events = $temp;
        $this->template = "main/history";
    }

    public function historyAllAction() {
        if ($this->session->isPDA!=true) return;
        if (!is_numeric($this->session->current_company)) {
            $this->_redirect($conf ['siteurl']."/");
            return;
	}
        $company = $this->session->current_company;
        $companyName = $this->db->fetchRow("SELECT name FROM dacons_companies WHERE id = '".$company."'");
        $this->view->company = $companyName['name'];

        $temp = $this->db->fetchAll("SELECT * FROM `dacons_events` WHERE `company_id` = '".$company."' " .
                                    "ORDER BY `date` DESC");


        $GMT = $this->session->GMT;

        if ($GMT != 0)
        foreach ($temp as $k => $v) {
            $temp[$k]['date'] = date("Y-m-d H:i:s",strtotime($temp[$k]['date']) + (3600 * $GMT));
        }

        $this->view->events = $temp;
        $this->template = "main/history";
    }

    public function remindersByCompanyAction() {
        if ($this->session->isPDA!=true) return;
        if (!is_numeric($this->session->current_company)) return;
        $company = $this->session->current_company;
        $companyName = $this->db->fetchRow("SELECT name FROM dacons_companies WHERE id = '".$this->session->current_company."'");
        $this->view->company = $companyName['name'];

         if ($this->getRequest()->getParam("delrem")!="") {
            $this->deleteReminder($this->getRequest()->getParam("delrem"));
        }

        if ($this->getRequest()->getParam("delrem2")!="") {
            $this->deleteReminder2($this->getRequest()->getParam("delrem2"));
        }

        if ($this->session->is_super_user == 1) {
        $exclude = array();
        $exclude2 = array();
        $this->view->reminderDated = $this->db->fetchAll("SELECT * FROM (SELECT rm.id as id, rm.`date` as `date`, rm.text as text, rm.company_id as company_id, com.name as name,1 as t from dacons_reminders as rm " .
                                                         "LEFT JOIN dacons_companies as com ON com.id = rm.company_id " .
                                                         "WHERE rm.user_id = '".$this->session->id."' AND com.id = '".$company."' AND rm.date<>'2000-01-01 00:00:00' " .
                                                         "UNION SELECT mrm.id as id, mrm.`date` as `date`, mrm.text as text, mrm.company_id as company_id, com2.name as name, 2 as t " .
                                                         "FROM dacons_mreminders as mrm " .
                                                         "LEFT JOIN dacons_companies as com2 ON com2.id = mrm.company_id " .
                                                         "WHERE mrm.customer_id = '".$this->session->customer_id."' AND com2.id = '".$company."' AND mrm.date<>'2000-01-01 00:00:00') as s " .
                                                         "ORDER BY `date`");

        foreach ($this->view->reminderDated as $k => $v) {
            if ($v['t']==1) $exclude[] = $v['name'];
            if ($v['t']==2) $exclude2[] = $v['name'];
        }

        $this->view->reminderUnDated = $this->db->fetchAll("SELECT * FROM (SELECT rm.id as id, rm.`date` as `date`, rm.text as text, rm.company_id as company_id, com.name as name,1 as t from dacons_reminders as rm " .
                                                         "LEFT JOIN dacons_companies as com ON com.id = rm.company_id " .
                                                         "WHERE rm.user_id = '".$this->session->id."' AND com.id = '".$company."' AND rm.date='2000-01-01 00:00:00' " .
                                                         "UNION SELECT mrm.id as id, mrm.`date` as `date`, mrm.text as text, mrm.company_id as company_id, com2.name as name, 2 as t " .
                                                         "FROM dacons_mreminders as mrm " .
                                                         "LEFT JOIN dacons_companies as com2 ON com2.id = mrm.company_id " .
                                                         "WHERE mrm.customer_id = '".$this->session->customer_id."' AND com2.id = '".$company."' AND mrm.date='2000-01-01 00:00:00') as s " .
                                                         "ORDER BY `date`");

        foreach ($this->view->reminderUnDated as $k => $v) {
            if ($v['t']==1) $exclude[] = $v['name'];
            if ($v['t']==2) $exclude2[] = $v['name'];
        }

        $this->view->reminderChecked = $this->db->fetchAll("SELECT * FROM (SELECT com.id as company_id, com.name, 1 as t FROM dacons_reminders_companies as rc " .
                                                           "LEFT JOIN dacons__companies as com ON com.id = rc.company_id " .
                                                           "WHERE rc.user_id = '".$this->session->id."' AND com.id = '".$company."' " .
                                                           "UNION " .
                                                           "SELECT com.id as company_id, com.name, 2 as t FROM dacons_dacons_mreminders_companies as mrc " .
                                                           "LEFT JOIN dacons_companies as com ON com.id = mrc.company_id " .
                                                           "WHERE mrc.customer_id = '".$this->session->customer_id."' AND com.id = '".$company."') as s");
        $this->view->exclude = $exclude;
        $this->view->exclude2 = $exclude2;

        } else {
        $exclude = array();
        $exclude2 = array();
        $this->view->reminderDated = $this->db->fetchAll("SELECT * FROM (SELECT rm.id as id, rm.`date` as `date`, rm.text as text, rm.company_id as company_id, com.name as name,1 as t from dacons_reminders as rm " .
                                                         "LEFT JOIN dacons_companies as com ON com.id = rm.company_id " .
                                                         "WHERE rm.user_id = '".$this->session->id."' AND rm.date<>'2000-01-01 00:00:00' AND com.id = '".$company."' " .
                                                         "UNION SELECT mrm.id as id, mrm.`date` as `date`, mrm.text as text, mrm.company_id as company_id, com2.name as name, 2 as t " .
                                                         "FROM dacons_mreminders as mrm " .
                                                         "LEFT JOIN dacons_companies as com2 ON com2.id = mrm.company_id " .
                                                         "WHERE mrm.customer_id = '".$this->session->customer_id."' AND com2.manager='".$this->session->id."' AND com2.id = '".$company."' AND mrm.date<>'2000-01-01 00:00:00') as s " .
                                                         "ORDER BY `date`");

        foreach ($this->view->reminderDated as $k => $v) {
            if ($v['t']==1) $exclude[] = $v['name'];
            if ($v['t']==2) $exclude2[] = $v['name'];
        }

        $this->view->reminderUnDated = $this->db->fetchAll("SELECT * FROM (SELECT rm.id as id, rm.`date` as `date`, rm.text as text, rm.company_id as company_id, com.name as name,1 as t from dacons_reminders as rm " .
                                                         "LEFT JOIN dacons_companies as com ON com.id = rm.company_id " .
                                                         "WHERE rm.user_id = '".$this->session->id."' AND rm.date='2000-01-01 00:00:00' AND com.id = '".$company."' " .
                                                         "UNION SELECT mrm.id as id, mrm.`date` as `date`, mrm.text as text, mrm.company_id as company_id, com2.name as name, 2 as t " .
                                                         "FROM dacons_mreminders as mrm " .
                                                         "LEFT JOIN dacons_companies as com2 ON com2.id = mrm.company_id " .
                                                         "WHERE mrm.customer_id = '".$this->session->customer_id."' AND com2.manager='".$this->session->id."' AND com2.id = '".$company."' AND mrm.date='2000-01-01 00:00:00') as s " .
                                                         "ORDER BY `date`");
        }

        foreach ($this->view->reminderUnDated as $k => $v) {
            if ($v['t']==1) $exclude[] = $v['name'];
            if ($v['t']==2) $exclude2[] = $v['name'];
        }

        $this->view->reminderChecked = $this->db->fetchAll("SELECT * FROM (SELECT com.id as company_id, com.name, 1 as t FROM dacons_reminders_companies as rc " .
                                                           "LEFT JOIN dacons_companies as com ON com.id = rc.company_id " .
                                                           "WHERE rc.user_id = '".$this->session->id."' AND com.manager = '".$this->session->id."' AND com.id = '".$company."' " .
                                                           "UNION " .
                                                           "SELECT com.id as company_id, com.name, 2 as t FROM dacons_mreminders_companies as mrc " .
                                                           "LEFT JOIN dacons_companies as com ON com.id = mrc.company_id " .
                                                           "WHERE mrc.customer_id = '".$this->session->customer_id."' AND com.id = '".$company."' AND com.manager = '".$this->session->id."') as s");
        $this->view->exclude = $exclude;
        $this->view->exclude2 = $exclude2;

        $this->template = "main/remindersByCompany";

    }

    public function todayRemindersAction() {

        if ($this->session->isPDA!=true) return;

        if ($this->getRequest()->getParam("delrem")!="") {
            $this->deleteReminder($this->getRequest()->getParam("delrem"));
        }

        if ($this->getRequest()->getParam("delrem2")!="") {
            $this->deleteReminder2($this->getRequest()->getParam("delrem2"));
        }

        $this->displayTodayReminders($this->session->id,$this->session->customer_id,$this->session->is_super_user);
        $this->template = "main/todayReminders";
    }

    public function displayTodayReminders($user,$customer,$super) {

        if ($this->session->isPDA!=true) return;

        $from = date ("Y-m-d");
        $this->view->remToday = $this->db->fetchAll("SELECT DISTINCT r.id as `rid`, r.`date` as `date`, r.text as `text`," .
                                                    " c.name as `name`, c.id as `id` FROM `dacons_reminders` as r " .
                                                    "LEFT JOIN `dacons_companies` as c ON r.company_id = c.id " .
                                                    "WHERE r.user_id = '$user' AND " .
                                                    "r.date >= '$from 00:00:00' AND r.date < '$from 23:59:59' ");

       if ($super == 1) {
       $this->view->remTodayM = $this->db->fetchAll("SELECT DISTINCT r.id as `rid`, r.`date` as `date`, r.text as `text`," .
                                                    " c.name as `name`, c.id as `id` FROM `dacons_mreminders` as r " .
                                                    "LEFT JOIN `dacons_companies` as c ON r.company_id = c.id " .
                                                    "WHERE r.customer_id = '$customer' AND " .
                                                    "r.date >= '$from 00:00:00' AND r.date < '$from 23:59:59' ");

       } else {
       $this->view->remTodayM = $this->db->fetchAll("SELECT DISTINCT r.id as `rid`, r.`date` as `date`, r.text as `text`," .
                                                    " c.name as `name`, c.id as `id` FROM `dacons_mreminders` as r " .
                                                    "LEFT JOIN `dacons_companies` as c ON r.company_id = c.id " .
                                                    "WHERE r.customer_id = '$customer' AND c.manager='$user' AND " .
                                                    "r.date >= '$from 00:00:00' AND r.date < '$from 23:59:59' ");
       }
    }

    public function companyAddHistoryAction() {
        //require_once 'application/models/Events.php';

        $name = $this->getRequest()->getParam('name');
        $comment = $this->getRequest()->getParam('comment');


        if ($name != "") {
            #$events = new Events();
            $this->db->insert('events', array('name' => $name,
                                  'comment' => str_replace("\n","<br>",$comment),
                                  'company_id' => $this->session->current_company,
                                  'date' => date ("Y-m-d H:i:s")));

        }

        $this->_redirect("/mainpda/history");

    }

    public function deleteEventAction() {
    	if ($this->session->isPDA!=true) return;
        $id = $this->getRequest()->getParam("id");
        if (!is_numeric($id)) return;
        $company = $this->session->current_company;

        $this->db->query("DELETE FROM dacons_events WHERE id = '$id' AND company_id = '$company'");
        global $conf;
        $this->_redirect($conf ['siteurl']."/mainpda/history");

    }

    public function editEventAction() {

        if ($this->session->isPDA!=true) return;
        if (!is_numeric($this->session->current_company)) return;
        $id = $this->getRequest()->getParam("id");
        if (!is_numeric($id)) return;
        $company = $this->session->current_company;


        $temp = $this->db->fetchRow("SELECT e.`name`, e.`comment` FROM dacons_events as e " .
                                    "LEFT JOIN dacons_companies as c ON c.id = e.company_id " .
                                    "WHERE e.id = '$id' AND c.id = '$company'");

        $this->view->id = $id;
        $this->view->name = $temp['name'];
        $this->view->comment = str_replace("<br>","\n",$temp['comment']);

        $this->template = "main/editEvent";

    }

    public function editEventSubmitAction() {
    	if ($this->session->isPDA!=true) return;
        if (!is_numeric($this->session->current_company)) return;
        $company = $this->session->current_company;
        $id = $this->getRequest()->getParam("id");
        if (!is_numeric($id)) return;
        //require_once 'application/models/Events.php';

        $name = $this->getRequest()->getParam("name");
        $comment = $this->getRequest()->getParam("comment");

        if ($name != "") {
            #$events = new Events();
            $this->db->update('dacons_events', array('name' => $name,
                                  'comment' => str_replace("\n","<br>",$comment),
                                  ),"company_id = '$company' AND id = '$id'");
			global $conf;
            $this->_redirect($conf ['siteurl']."/mainpda/history");
        } else {
            $this->view->id = $id;
            $this->view->name = $name;
            $this->view->comment = $comment;
            $this->view->error = _("Введите название события.");
            $this->template = "main/editEvent";
        }

    }

}

?>
