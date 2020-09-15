<?php
/*
 * Created on 25.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


require_once 'Zend/Controller/Action.php';
require_once 'libs/smarty/Zend_View_Smarty.php';
require_once 'libs/smarty/Smarty.class.php';
//require_once 'Zend/Db.php';
//require_once 'Zend/Db/Table.php';
require_once 'Help.php';
require_once 'Zend/Session.php';
include_once "functions.php";
//require_once 'Zend/Config/Ini.php';
require_once 'libs/DBConnect.php';

 class Zend_Controller_ActionWithInit extends Zend_Controller_Action {

 	protected $db;
 	protected $template;
 	protected $session;
    protected $help;

 	public function init(){
 		// ����������� Smarty
 		//$this->view = new Zend_View_Smarty("application/views/scripts",array("compile_dir"=>"templates_c"));
 		
 		$this->view = new mySmarty ();
 		$this->view->template_dir = "application/views/scripts";
 		$this->view->siteurl = $this->getInvokeArg("url");

 		global $conf, $locale_conf, $is_saas;
                $this->session = new Zend_Session_Namespace('auth');
		if (! empty ($this->session->customer_id) && $is_saas) @include_once $this->getSaasConfigFile();
 		$this->view->conf_url = $conf['siteurl'];
 		$this->view->siteurl = $conf['siteurl'];
		$this->view->lang = $conf['lang'];
		$this->view->bank_properties_right = $locale_conf ['bank_properties_right'];
		$this->view->bank_properties_left  = $locale_conf ['bank_properties_left'];
		$this->view->locale_conf = $locale_conf;

		global $dbconfig;
		$this->db = DBConnect::getInstance();
		
		$this->db->query('SET NAMES utf8');

                if (get_magic_quotes_gpc ()) {
                    foreach ($_GET as $key => & $val) {
                        $val = stripslashes ($val);
                    } 
                    unset ($val);
                    foreach ($_POST as $key => & $val) {
                        $val = stripslashes ($val);
                    }
                    unset ($val);
                }

		// ��� ����������
		$this->view->controllerName = $this->getRequest()->getControllerName();
		$this->view->actionName = $this->getRequest()->getActionName();

		global $is_demo;
		$this->view->is_demo = (! empty ($is_demo));

        // ������
        //$config = new Zend_Config_Ini('conf/app.ini', 'sandbox');
        //Zend_Session::setOptions($config->toArray());

        if (is_numeric($this->session->id)) {
            // ��������� �������
            if ($this->session->agent != $_SERVER['HTTP_USER_AGENT']) {
                Zend_Session::forgetMe();
                Zend_Session::destroy(true);
            }
        }

        $this->help = new Help($this->db,$this->session);

        if (!is_null($this->getRequest()->getParam('pda'))) {
        	$this->session->isPDA = true;
        }
        if (!is_null($this->getRequest()->getParam('nopda'))) {
            $this->session->isPDA = null;
        }
 	}

 	public function postDispatch(){
		if ($this->session->is_admin == 1)
		{
			$query = "select * from dacons_users where username = '{$this->session->username}' and password = md5('123456')";
			$result = $this->db->fetchRow ($query);

			if ($result) {
				$this->view->change_pass_question = true;
			}	
		}
		$this->view->help = $this->help->getData();
		if (is_numeric($this->view->mode)){
			$this->view->mode = $this->session->mode;
		}
		
		if ($this->session->isPDA==true) {
			echo $this->view->fetch('pda/header.tpl');
			echo $this->view->fetch('pda/'.$this->template.'.tpl');
			echo $this->view->fetch('pda/footer.tpl');
		} else {
			echo $this->view->fetch('preContent.tpl');
			echo $this->view->fetch($this->template.'.tpl');
			echo $this->view->fetch('postContent.tpl');
		}
		$this->help->save();
 	}

    protected function trackPages() {
    	try {
            if ($this->db->fetchRow("SELECT `date` FROM dacons_stats WHERE `date` = '".date("Y-m-d")."'")==false) {
                $this->db->query("INSERT INTO dacons_stats (`date`,`registrations`,`pages`) VALUES ('".date("Y-m-d")."',(SELECT count(id) FROM dacons_customers),'1')");
            } else {
                $this->db->query("UPDATE dacons_stats SET pages = pages + 1 WHERE `date` = '".date("Y-m-d")."'");
            }

            $year = date("Y");
            if ($this->db->fetchRow("SELECT `weekNum` FROM dacons_statsbycompanies WHERE `year` = '$year' AND `weekNum` = '".date("W")."' AND `customer_id` = '".$this->session->customer_id."'")==false) {
                $this->db->query("INSERT INTO dacons_statsbycompanies (`weekNum`,`year`,`pages`,`customer_id`) VALUES ('".date("W")."','$year','1','".$this->session->customer_id."')");
            } else {
                $this->db->query("UPDATE dacons_statsbycompanies SET pages = pages + 1 WHERE `year` = '$year' AND `weekNum` = '".date("W")."' AND `customer_id` = '".$this->session->customer_id."'");
            }

        } catch (Zend_Exception $e) {}
    }

    protected function resortReminder($reminders) {
        $dated_own = array();
        $undated_own = array();
        $dated_sm = array();
        $undated_sm = array();
        $dated_com = array();
        $undated_com = array();

        foreach ($reminders as $k => $v) {
            if ($v['visibility']=='own') {
            	if ($v['date']=="2000-01-01 00:00:00") {
                    $undated_own[] = $v;
                } else {
                    $dated_own[] = $v;
                }
            } else if ($v['visibility']=='sm') {
            	if ($v['date']=="2000-01-01 00:00:00") {
                    $undated_sm[] = $v;
                } else {
                    $dated_sm[] = $v;
                }
            } else {
            	if ($v['date']=="2000-01-01 00:00:00") {
                    $undated_com[] = $v;
                } else {
                    $dated_com[] = $v;
                }
            }

        }
        return array_merge ($dated_sm,$undated_sm,$dated_own,$undated_own,$dated_com,$undated_com);
    }

    public function getBanner() {
        $banner = $this->db->fetchRow("SELECT id, `text`, `link` FROM dacons_ads ORDER BY RAND() LIMIT 1");
        $this->db->query("UPDATE dacons_ads SET hits = hits + 1 WHERE id = '".$banner['id']."'");
        return $banner;
    }
    
    protected function _redirect ($url, $options = array ())
    {
    	global $conf;
    	// ������� :(
    	$header = 'Location:';
    	if (strtolower (substr ($url, 0, strlen ($header))) == strtolower($header)) {
    		$url = substr ($url, strlen ($header));
    	}
    	$url = trim ($url);
    	$url = trim ($url, '/');
    	
    	if (strpos ($url, $conf ['siteurl']) === false) {
    		$url = $conf ['siteurl'].'/'.$url;
    	}
    	//die ($url);
    	parent::_redirect($url, $options);
    }
    
    public function getInvokeArg ($name)
    {
    	global $conf;
    	return (isset ($conf [$name])) ? $conf [$name] : null;
    	//return (isset ($this->params [$name])) ? $this->params [$name] : null;
    }
    
    public function setParam ($name, $val) 
    {
    	if (empty ($this->params)) $this->params = array ();
    	$this->params [$name] = $val;
    }

    protected function getSaasConfigFile ($redirect=true) {
        $file = 'conf/saas/'.$this->session->customer_id.'.php';
        if ($this instanceof IndexController) $redirect = false;
        if ($redirect && !file_exists ($file)) $this->_redirect ('index/activate');
        return $file;
    }

 }

 


?>
