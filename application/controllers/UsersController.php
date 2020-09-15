<?php
/*
 * Создан: 27.09.2007 10:45:38
 * Автор: Александр Перов
 */

	require_once 'Zend_Controller_ActionWithInit.php';
	//require_once 'Zend/Auth/Adapter/DbTable.php';
	require_once 'Zend/Session.php';
	/*
	require_once 'application/models/Users.php';
	require_once 'application/models/Customers.php';
	require_once 'application/models/Companies.php';
	*/

	class UsersController extends Zend_Controller_ActionWithInit {

		/**
		 * отображение информации пользователя
		 */
		public function indexAction(){
			// читаем из сессии
			//$users = new Users();
			//$this->view->users = $users->fetchAll()->toArray();
			//$this->template = "users/index";
		}

		/**
		 * вход в систему
		 */
		public function loginAction(){
			//$this->template = "empty";
			//$this->template = 'index/login2';
			$this->template = 'index/login3';

			$this->view->do_not_render_header = true;


			$username = $this->getRequest()->getParam('login_username');
			$password = md5($this->getRequest()->getParam('login_password'));

			$username = preg_replace("/<script(.*)>/ui","",$username);
			$password = preg_replace("/<script(.*)>/ui","",$password);

			$username = str_replace("javascript","",$username);
			$password = str_replace("javascript","",$password);

			if ($username=="" || $password=="") {
				$this->view->login_username = $username;
				$this->view->error = _("Пользователь или пароль не верен");
				return;
			}
			/*
			$authAdapter = new Zend_Auth_Adapter_DbTable($this->db, 'users', 'username', 'password');
			$authAdapter->setIdentity($username)->setCredential($password);
			$result = $authAdapter->authenticate();
			*/
			$username = $this->db->quote ($username);
			$password = $this->db->quote ($password);
			$query = "select * from dacons_users where username = '$username' and password = '$password'";
			$result = $this->db->fetchRow ($query);
			//echo $result->getIdentity() . "\n\n";

            // проверка попыток логина

            if ($this->db->fetchRow("SELECT ip FROM dacons_loginwaiting WHERE `ip` = '".$_SERVER["REMOTE_ADDR"]."' AND endBlocking < '".date ("Y-m-d H:i:s")."'")) {
                $this->db->query("DELETE FROM dacons_loginwaiting WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'");
            }

            if ($this->db->fetchRow("SELECT ip FROM dacons_loginwaiting WHERE `count` >= 10 AND endBlocking > '".date ("Y-m-d H:i:s")."' AND ip = '".$_SERVER["REMOTE_ADDR"]."'")!=false) {
            	$this->view->login_username = $username;
                $this->view->error = _("Превышено количество попыток входа, повторите попытку через 15 минут!");
                return;
            }

			if ($result != false) { // верно
			// запись в сессию
			$row = new stdClass();
			foreach ($result as $key => $value) {
				$row->$key = $value;
			}

            if ($this->getRequest()->getParam('remember_me')) {
                    //Zend_Session::regenerateId();
                    Zend_Session::rememberMe(3600*24*14);
                    $this->session->setExpirationSeconds(864000);//
                    $this->session->agent = $_SERVER['HTTP_USER_AGENT'];
            } else {
             //   //$this->session->setExpirationSeconds(60*60);//
                    $this->session->agent = $_SERVER['HTTP_USER_AGENT'];
            }

			$this->session->nickname = $row->nickname;
			//$this->session->group_id = $row->group_id;
			$this->session->id = $row->id;
			$this->session->is_super_user = $row->is_super_user;
			$this->session->is_admin = $row->is_admin;
			$this->session->customer_id = $row->customer_id;
			$this->session->username = $row->username;

            if ($this->session->is_super_user!="") {
                $this->session->filter_manager = $this->session->id;
            }

            if ($row->readonly == 1) {
                $this->session->readonly = true;
            } else {
            	$this->session->readonly = false;
            }

			/*
			$customers = new Customers();
			$customer = $customers->fetchRow("id = '$row->customer_id'");
			*/
            
            $customer_array = $this->db->fetchRow ("select * from dacons_customers  where id = ".$row->customer_id);
            $customer = new stdClass ();
            foreach ($customer_array as $key => $value) {
            	$customer->$key = $value;
            }
			$this->session->usercompany = $customer->name;
			$this->session->GMT = $customer->GMT - 3;

            // сброс устаревших данных ошибок логина
            $this->db->query("DELETE FROM dacons_loginwaiting WHERE endBlocking < NOW()");

			Zend_Session::rememberMe(3600*24*14);
			$this->_redirect("/main");

			//print_r($row->nickname);
			} else {
				$this->view->login_username = $username;
				$this->view->error = "wrong_login";

                // неверный логин
                if ($this->db->fetchRow("SELECT ip FROM dacons_loginwaiting WHERE `ip` = '".$_SERVER["REMOTE_ADDR"]."'")) {
                    $this->db->query("UPDATE dacons_loginwaiting SET endBlocking = '".date ("Y-m-d H:i:s", mktime (date("H"),date("i")+15,date("s"),date("m"),date("d"),date("Y")))."', count = count + 1 WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'");
                } else {
                	$this->db->query("INSERT INTO dacons_loginwaiting (`ip`, `endBlocking`, `count`) VALUES ('".$_SERVER["REMOTE_ADDR"]."','".date ("Y-m-d H:i:s", mktime (date("H"),date("i")+15,date("s"),date("m"),date("d"),date("Y")))."',1)");
                }
			}

		}


		/**
		 * выход из системы
		 */
		public function logoutAction(){
			$isPDA = $this->session->isPDA;
            Zend_Session::forgetMe();
			Zend_Session::destroy(true);
			if ($isPDA==true) {
				global $conf;
            	$this->_redirect($conf['siteurl']."/users/logoutStatus?pda");
			} else {
			   global $conf;
			   $this->_redirect($conf['siteurl']."/users/logoutStatus");
			}
		}

		public function logoutStatusAction(){
			$this->template = "users/logout";
		}
	}

?>
