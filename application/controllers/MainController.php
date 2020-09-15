<?php
/*
 * Создан: 31.10.2007 15:24:37
 * Автор: Александр Перов
 */

include('functions.php');

require_once 'Zend_Controller_ActionWithInit.php';
require_once 'Zend/Validate/NotEmpty.php';
require_once 'Zend/Validate/Digits.php';
require_once 'Zend/Validate/Int.php';
require_once 'Zend/Validate/EmailAddress.php';

error_reporting (E_ALL & ~ E_NOTICE);

class MainController extends Zend_Controller_ActionWithInit {

	public function indexAction() {
		$this->selectCompanyAction();
	}

	public function welcomeAction() {
		$this->template = "companies/registrationComplite";
	}

	public function preDispatch() {
		parent::preDispatch();
		if ($this->session->is_admin == 1) {
			$this->_redirect("/managment");
			exit();
		}
		if ($this->session->id == "") $this->_redirect("/index");
		$this->trackPages();
	}

	public function studyAction() {
		$this->help->resetAll();
		$this->indexAction();
	}

	/**
	 * выбор компании
	 */
	public function selectCompanyAction() {

		$this->displayHistory($this->session->id);

		$this->displayLabels();

		if (!is_null($this->getRequest()->getParam("editLabels"))) {
			$category = $this->db->fetchAll("SELECT id,name,picture FROM dacons_labels WHERE parent_id = 0 AND customer_id = '".$this->session->customer_id."'");

			$i = 0;
			for ($index = 0; $index < sizeof($category); $index++) {
				$temp[$i]['parent_id'] = 0;
				$temp[$i]['id'] =  $category[$index]['id'];
				$temp[$i]['name'] =  $category[$index]['name'];
				$i++;
				$category[$index]['labels'] = $this->db->fetchAll("SELECT id,name FROM dacons_labels WHERE parent_id = '".$category[$index]['id']."'");
				for ($index2 = 0; $index2 < sizeof($category[$index]['labels']); $index2++) {
					$temp[$i]['parent_id'] = 1;
					$temp[$i]['id'] =  $category[$index]['labels'][$index2]['id'];
					$temp[$i]['name'] =  $category[$index]['labels'][$index2]['name'];
					$i++;
				}
			}

			$this->view->delCategories = $temp;

			$dir = "images/labels/25/";
			$images = "";
			if(!($res=opendir($dir))) exit("Нет такой директории...");
			while(($file=readdir($res))==TRUE)
				if($file!="." && $file!=".." && preg_match("/(.jpeg|.jpg|.bmp|.png|.gif)$/",$file)) {
					$images .= "<img src=\"/images/labels/25/$file\" width=25 height=25 onclick=\"chCategoryImg(this)\" style=\"cursor:pointer\">";
				}
			closedir($res);

			$this->view->labelsImgs = $images;
		}
		$this->displayManagers();
		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayTodayReminders($this->session->id,$this->session->customer_id,$this->session->is_super_user);

$now_start = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d"),date("Y")));
		$now_end = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d")+1,date("Y")));

		if ($this->session->is_super_user == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`<'$now_start' AND r.`date`>'2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`<'$now_start' AND r.`date`>'2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		}
		$this->view->expiredReminders = $this->db->fetchAll($sql);

		$this->displayAllFavoritesCount($this->session->id);

		$this->template = "main/index";

	}

	public function searchCompanyAction() {
		$this->displayCompaniesList();
		//<encoder_start>
		$this->displayHistory($this->session->id);
		$this->displayLabels();
		$this->displayManagers();

		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayAllFavoritesCount($this->session->id);
		//<encoder_end>
		$this->template = "main/searchCompanyByName";
	}

	public function searchCompanyLabelsAction() {

		$this->displayLabels();

		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayAllFavoritesCount($this->session->id);

		$this->displayManagers();

		$this->displayHistory($this->session->id);
		$this->displayCompaniesList();
		$this->template = "main/searchCompanyByLabel";
	}


	public function displayManagers() {
		if ($this->session->is_super_user != 1) {
			$this->view->managerFilter = -1;
			$sql_count = "SELECT count(*) as cnt FROM dacons_companies WHERE manager = '".$this->session->id."'";
			$temp = $this->db->fetchRow($sql_count);
			$this->view->allCompanyByManager = $temp['cnt'];
			return -1;
		}

		$manager = $this->getRequest()->getParam('manager');
		if ($manager=="" || !is_numeric($manager)) {
			$manager = -1;
			if ($this->session->filter_manager!="") $manager = $this->session->filter_manager;
		}
		$this->view->managerFilter = $manager;

		$sql = "SELECT id, nickname FROM dacons_users WHERE customer_id = '".$this->session->customer_id."' AND readonly<>1 AND is_admin<>1 ORDER BY nickname";
		$this->view->managers = $this->db->fetchAll($sql);

		if ($manager != -1) {
			$sql_count = "SELECT count(*) as cnt FROM dacons_companies WHERE manager = '$manager' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
		} else {
			$sql_count = "SELECT count(*) as cnt FROM dacons_companies WHERE manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
		}
		$temp = $this->db->fetchRow($sql_count);
		$this->view->allCompanyByManager = $temp['cnt'];

		return $manager;
	}


	public function displayAllRemindersCount($user,$customer,$super) {
		if ($super == 1) {
			$sql = "SELECT count(*) as fav FROM dacons_reminderspool WHERE " .
				"((visibility = 'own' AND manager_id = '$user') OR " .
				"(visibility = 'sm' AND manager_id = '$user') OR " .
				"(visibility = 'common' AND manager_id in (SELECT id FROM dacons_users WHERE customer_id = '$customer'))) ";
		} else {
			$sql = "SELECT count(r.id) as fav FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"((r.visibility = 'own' AND r.manager_id = '$user') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."'))) ";
		}
		$favRow = $this->db->fetchRow($sql);
		$this->view->reminderCount = $favRow['fav'];


		$now_start = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d"),date("Y")));
		$now_end = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d")+1,date("Y")));
		if ($super == 1) {
			$sql = "SELECT count(*) as fav FROM dacons_reminderspool as r WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '".$user."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$user."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."'))) ";
		} else {
			$sql = "SELECT count(r.id) as fav FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '".$user."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."'))) ";
		}

		$favRowT = $this->db->fetchRow($sql);
		$this->view->reminderCountToday = $favRowT['fav'];

	}

	public function displayTodayReminders($user,$customer,$super) {
		$now_start = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d"),date("Y")));
		$now_end = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d")+1,date("Y")));
		if ($super == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '$user') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '$user') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '".$user."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$user."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$user."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$customer."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		}
		$this->view->todayReminders = $this->db->fetchAll($sql);
	}

	public function displayAllFavoritesCount($user) {

		$favRow = $this->db->fetchRow("SELECT count(f.company_id) as fav FROM dacons_favorite_companies as f LEFT JOIN dacons_companies as c ON c.id=f.company_id WHERE user_id = '$user' AND c.id IS NOT NULL");
		$this->view->favoriteCount = $favRow['fav'];
	}


	/**
	 * вывод компаний
	 */
	public function displayCompaniesList() {
		$mode = $this->getRequest()->getParam('mode');
		$this->displayLabels();

		if ($this->getRequest()->getParam('gr') != "") {
			$this->processGroupOperations();
		}

		$user_id = $this->session->id;
		$where = "";
		switch ($mode) {
			case "all":
			//echo "<h1>".__FILE__." " .__LINE__."</h1>";
				$where = "manager = '$user_id' ORDER BY name";

				if ($this->session->is_super_user == 1) {
					$where = "manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ORDER BY name";
					if ($this->session->isPDA!=true)
						if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
							$where = "manager = '".$this->session->filter_manager."' ORDER BY name";
						}
				}

				$this->view->nowLocation = _("все");
				$this->view->controller = "main/searchCompany";
				break;
			case "word":
			// проверка буквы
				$mparam = $this->getRequest()->getParam('mparam');
				if (! is_numeric ($mparam))
				{
					global $locale_conf;
					$letter_array = @ $locale_conf ['alphabet'][$mparam];
					if (empty ($letter_array) )
					{
						$letter_array = @ $locale_conf ['alphabet_national'][$mparam];
					}
					if (empty ($letter_array) )
					{
						$letter_array = @ end ($locale_conf ['alphabet']);
					}
				}
				else
				{
					$letter_array = array ('view' => $mparam, 'symbols' => array ($mparam));
				}

		$word_cond_array = array ();
		foreach ($letter_array ['symbols'] as $symbol)
		{
					$word_cond_array [] = " (name like '".$this->db->quote($symbol)."%' or name like '\\\"".$this->db->quote($symbol)."%' or name like '\'".$this->db->quote($symbol)."%') ";
		}

		$word_cond = "(" . join (' OR ', $word_cond_array) . ")";

		$where = "manager = '$user_id' AND $word_cond ORDER BY name";
				if ($this->session->is_super_user == 1) {
					$where = "manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND $word_cond ORDER BY name";
					if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
						$where = "manager = '".$this->session->filter_manager."' AND $word_cond ORDER BY name";
					}
				}

				$this->view->nowLocation = _("на букву")." \"".$letter_array['view']."\"";
				$this->view->controller = "main/searchCompany";
				break;
			case "relations":
			// 1-3 проверка
				$mparam = $this->getRequest()->getParam('mparam');

				$validator = new Zend_Validate_Digits();
				if (!$validator->isValid($mparam)) {
					$this->_redirect($this->getInvokeArg('url')."error");
				}

				$where = "manager = '$user_id' AND relations = '$mparam' ORDER BY name";

				if ($this->session->is_super_user == 1) {
					$where = "manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND relations = '$mparam' ORDER BY name";
					if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
						$where = "manager = '".$this->session->filter_manager."' AND relations = '$mparam' ORDER BY name";
					}
				}

				if ($mparam == 1)
					$this->view->nowLocation = _("нейтральные");
				else if ($mparam == 2)
						$this->view->nowLocation = _("любимые");
					else
						$this->view->nowLocation = _("нелюбимые");

				$this->view->controller = "main/searchCompany";
				break;
			case "label":
			// mparam - int
				$mparam = $this->getRequest()->getParam('mparam');

				$validator = new Zend_Validate_Digits();
				if (!$validator->isValid($mparam)) {
					$this->_redirect($this->getInvokeArg('url')."error");
				}

				//$labels = new Labels();
				$label = $this->db->fetchObject("select * from dacons_labels where id = '$mparam'");

				$where = "SELECT DISTINCT c.* FROM dacons_labels as l " .
					"left join dacons_companies_dacons_labels as cl on cl.label_id = l.id " .
					"left join dacons_companies as c on c.id = cl.company_id " .
					"WHERE c.manager = '$user_id' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

				if ($this->session->is_super_user == 1) {
					$where = "SELECT DISTINCT c.* FROM dacons_labels as l " .
						"left join dacons_companies_labels as cl on cl.label_id = l.id " .
						"left join dacons_companies as c on c.id = cl.company_id " .
						"WHERE c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

					if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
						$where = "SELECT DISTINCT c.* FROM dacons_labels as l " .
							"left join dacons_companies_labels as cl on cl.label_id = l.id " .
							"left join dacons_companies as c on c.id = cl.company_id " .
							"WHERE c.manager == '".$this->session->filter_manager."' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";
					}
				}

				//$where = "manager = '$user_id' AND id in (SELECT company_id FROM dacons_companies_labels WHERE companies_labels.label_id = '$mparam') ORDER BY name";
				$this->view->nowLocation = _("Метка").": <span class=\"color1\">".$label->name."</span>";
				$this->view->controller = "main/searchCompanyLabels";

				$this->increaseLabelCounter($mparam);

				break;
			case "favorites":
			//$where = "SELECT * FROM dacons_companies as c LEFT JOIN dacons_favorite_companies as f on f.company_id = c.id WHERE f.user_id = '$user_id'";
				$this->session->filter_manager = $this->session->id;
				$this->view->managerFilter = $this->session->id;

				$this->view->nowLocation = _("избранное");
				$this->view->controller = "main/searchCompany";
				break;

			case "manager":
				$mparam = $this->getRequest()->getParam('mparam');
				if (!is_numeric($mparam)) {die();}

				$this->session->filter_manager = $mparam;
				$this->view->managerFilter = $mparam;

				if ($this->getRequest()->getParam('fakemode')!=""
					&& $this->getRequest()->getParam('fakemode')!="manager"
					&& $this->getRequest()->getParam('fakemode')!="favorites") {

					$this->getRequest()->setParam('mode',$this->getRequest()->getParam('fakemode'));
					$this->getRequest()->setParam('fakemode','');

					$this->getRequest()->setParam('mparam',$this->getRequest()->getParam('fakemparam'));
					$this->getRequest()->setParam('fakemparam','');

					$this->displayCompaniesList();
					return;
				}

				if ($this->getRequest()->getParam('return')==1) {
					$this->_redirect("/main");
				}

				$this->view->nowLocation = _("менеджер");
				$this->view->controller = "main/searchCompany";
				break;

			default:
				$this->_redirect("/error");
		}
		//$companies = new Companies();

		$this->view->mode = $mode;
		$this->view->mparam = @$mparam;

		$page = $this->getRequest()->getParam('page');

		$limit_label = "";

		if ($page != null) {

			$validator = new Zend_Validate_Digits();
			if (!$validator->isValid($page)) {
				$page = 1;
			}

			$sql = "SELECT count(id) as `cnt` FROM `dacons_companies` WHERE ".$where;
			//echo "<h1>".__FILE__." " .__LINE__."</h1>";
			//echo $sql;
			if ($mode=="label") {
				$sql = "SELECT DISTINCT count(c.id) as `cnt` FROM dacons_labels as l " .
					"left join dacons_companies_labels as cl on cl.label_id = l.id " .
					"left join dacons_companies as c on c.id = cl.company_id " .
					"WHERE c.manager = '$user_id' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

				if ($this->session->is_super_user == 1) {
					$sql = "SELECT DISTINCT count(c.id) as `cnt` FROM dacons_labels as l " .
						"left join dacons_companies_labels as cl on cl.label_id = l.id " .
						"left join dacons_companies as c on c.id = cl.company_id " .
						"WHERE c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

					if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
						$sql = "SELECT DISTINCT count(c.id) as `cnt` FROM dacons_labels as l " .
							"left join dacons_companies_labels as cl on cl.label_id = l.id " .
							"left join dacons_companies as c on c.id = cl.company_id " .
							"WHERE c.manager = '".$this->session->filter_manager."' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";
					}

				}

			}

			if ($mode=="favorites") {
				$sql = "SELECT count(c.id) as `cnt` FROM dacons_companies as c LEFT JOIN dacons_favorite_companies as f on f.company_id = c.id WHERE f.user_id = '$user_id'";
			}

			if ($mode=="manager") {
				$sql = "SELECT count(id) as `cnt` FROM dacons_companies WHERE manager='$mparam' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
				if ($mparam==-1) {
					$sql = "SELECT count(id) as `cnt` FROM dacons_companies WHERE manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
				}
			}

			$temp = $this->db->fetchRow($sql);
			$this->view->recordsFound = $temp["cnt"];

			$elementsPerPage = 10;
			$pageCount = floor($temp["cnt"] / $elementsPerPage) + 1;

			if (floor($temp["cnt"]/$elementsPerPage) == ($temp["cnt"]/$elementsPerPage)) $pageCount--;

			$start = (($page-1)*$elementsPerPage);
			$where .= " LIMIT $start,$elementsPerPage";
			$limit_label = " LIMIT $start,$elementsPerPage";

			$this->view->pages = $pageCount;
			$this->view->page = $page;

		}


		$company_list = array();

		$sql = "SELECT id FROM dacons_companies WHERE ".$where;

		if ($mode == "label") {
			$sql = "SELECT DISTINCT c.id FROM dacons_labels as l " .
				"left join dacons_companies_labels as cl on cl.label_id = l.id " .
				"left join dacons_companies as c on c.id = cl.company_id " .
				"WHERE c.manager = '$user_id' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name ".$limit_label;

			if ($this->session->is_super_user == 1) {
				$sql = "SELECT DISTINCT c.id FROM dacons_labels as l " .
					"left join dacons_companies_labels as cl on cl.label_id = l.id " .
					"left join dacons_companies as c on c.id = cl.company_id " .
					"WHERE c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name ".$limit_label;

				if ($this->session->filter_manager!="" && $this->session->filter_manager!=-1) {
					$sql = "SELECT DISTINCT c.id FROM dacons_labels as l " .
						"left join dacons_companies_labels as cl on cl.label_id = l.id " .
						"left join dacons_companies as c on c.id = cl.company_id " .
						"WHERE c.manager = '".$this->session->filter_manager."' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name ".$limit_label;
				}
			}

		}

		if ($mode=="favorites") {
			$sql = "SELECT c.id as id FROM dacons_companies as c LEFT JOIN dacons_favorite_companies as f on f.company_id = c.id WHERE f.user_id = '$user_id' ORDER BY c.name ".$limit_label;
		}

		if ($mode=="manager") {
			$sql = "SELECT id FROM dacons_companies WHERE manager='$mparam' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ORDER BY name ".$limit_label;
			if ($mparam==-1) {
				$sql = "SELECT id FROM dacons_companies WHERE manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ORDER BY name ".$limit_label;
			}
		}

		$companies_ids = $this->db->fetchAll($sql);
		if (!$this->view->recordsFound)
			$this->view->recordsFound = count($companies_ids);

		require_once 'Zend/Json.php';
		$temp = array();

		foreach ($companies_ids as $k => $v) {

			$id = $v["id"];
			$temp[] = $id;

			// prop
			$company = $this->db->fetchObject("select * from dacons_companies where id = '$id' ");
			$company_list[$k]["prop"] = $this->db->fetchRow("select * from dacons_companies where id = '$id' ");
			//$company_list[$k]["prop"] = $company->toArray();

			// site email
			$company_list[$k]["site"] = explode(",",$company_list[$k]["prop"]["site"]);
			$company_list[$k]["email"] = explode(",",$company_list[$k]["prop"]["email"]);
			// labels


			$company_list[$k]["labels"] = $this->db->fetchAll("SELECT L.id as id, L.name as name, L.parent_id as parent_id, (select name from dacons_labels where id=L.parent_id) as pname, (select picture from dacons_labels where id=L.parent_id) as picture FROM `dacons_labels` as L " .
				"LEFT JOIN dacons_companies_labels as c on c.label_id = L.id " .
				"WHERE c.company_id = '".$company->id."' AND L.parent_id<>0 " .
				"AND L.customer_id = '".$this->session->customer_id."' " .
				"ORDER BY L.parent_id");

			// people
			$company_list[$k]["people"] = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
				" p.comment as comment, p.phone as phone" .
				" FROM dacons_people as p" .
				" LEFT JOIN dacons_people_company as pc" .
				" ON pc.person_id = p.id" .
				" WHERE pc.company_id = '$id'" .
				" ORDER BY p.id ASC");

			// fast

			$commands = $this->db->fetchAll("SELECT (SELECT user_id FROM dacons_favorite_companies WHERE company_id = '".$id."' AND user_id = '".$this->session->id."' LIMIT 1) as `fav`, " .
				"(SELECT user_id FROM dacons_history WHERE company_id = '".$id."' AND user_id = '".$this->session->id."' AND locked = '1' LIMIT 1) as `clip`");


			if ($commands[0]['fav'] != null) {
				$company_list[$k]["prop"]["isFavorite"] = true;
			} else {
				$company_list[$k]["prop"]["isFavorite"] = false;
			}

			if ($commands[0]['clip'] != null) {
				$company_list[$k]["prop"]["isClip"] = true;
			} else {
				$company_list[$k]["prop"]["isClip"] = false;
			}

			// напоминания v1.2
			if ($this->session->is_super_user == 1) {
				$sql = "SELECT * FROM dacons_reminderspool WHERE (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
					"OR (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'sm') " .
					"OR (company_id='".$id."' AND visibility = 'common') ORDER BY visibility, text ASC";
			} else {
				$sql = "SELECT r.*, u.nickname FROM dacons_reminderspool as r " .
					"LEFT JOIN dacons_users as u ON u.id = r.manager_id " .
					"WHERE (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
					"OR (company_id='".$id."' AND visibility = 'sm') " .
					"OR (company_id='".$id."' AND visibility = 'common') ORDER BY visibility, text ASC";
			}

			$company_list[$k]["prop"]["remindersPool"] = $this->resortReminder($this->db->fetchAll($sql));

		}

		$this->view->grCompany = Zend_Json::encode($temp);
		$this->view->companyList = $company_list;
		$this->session->mode = $this->view->mode;

	}

	/**
	 * выполнение груповых операций
	 */
	public function processGroupOperations() {

		$m = explode(":",$this->getRequest()->getParam('gr'));
		if ($m[0]=="" || !is_numeric($m[1])) return;

		$temp = array();
		switch ($m[0]) {
			case "manager":
				$go = false;
				foreach ($this->getRequest()->getParams() as $k => $v) {
					if (preg_match("/^checkComp([0-9]*)$/",$k,$match)) {
						if (is_numeric($match[1])) {
							$temp[] = $match[1];
							$go = true;
						}
					}
				}

				if ($go) {
					$temp = implode(",",$temp);
					// обновляем менеджера
					// проверить права
					//$this->db->query("UPDATE dacons_companies SET manager = '$m[1]' WHERE id IN ($temp)");
					$this->db->update('dacons_companies',array('manager' => $m[1]), "id IN ($temp)");
				}


				break;
			case "label":

				$go = false;
				foreach ($this->getRequest()->getParams() as $k => $v) {
					if (preg_match("/^checkComp([0-9]*)$/",$k,$match)) {
						if (is_numeric($match[1])) {
							$temp[] = $match[1];
							$go = true;
						}
					}
				}

				if ($go) {
				// вставляем метки (игнорируя ошибки)
				//$labels_Company = new Companies_Labels();
					for ($index = 0; $index < sizeof($temp); $index++) {
						try {
							$this->db->delete('dacons_companies_labels','company_id ='.intval ($temp[$index]).
								' and label_id = '.intval ($m[1]));
							$this->db->insert('dacons_companies_labels',array('company_id' => intval($temp[$index]),
								'label_id' => intval($m[1])));
						} catch (Zend_Exception $e) {}
					}
				}

				break;
		}
	}

	/**
	 * запись в журнал
	 */
	public function historyWriter($companyId, $userId) {
		$hisroryRow = $this->db->fetchRow("select * from dacons_history where `company_id` = '$companyId' AND `user_id`='$userId'");

		if ($hisroryRow == null) { // нет записи
			$this->db->insert('dacons_history',array('company_id' => $companyId,
				'user_id' => $userId,
				'updated' => date("Y-m-d H:i:s")));
		} else {
			$this->db->update('dacons_history',array('updated' => date("Y-m-d H:i:s")),
				"`company_id` = '$companyId' " .
				"AND `user_id`='$userId'");
		}

	}

	/**
	 * обработка выбора компании
	 */
	public function selectCompanySubmitAction() {

		$selectedCompany = $this->getRequest()->getParam('company');
		$this->view->company = $selectedCompany;

		if ($selectedCompany == "") {
			$this->selectCompanyAction();
			$this->view->selectError = _("Не выбрано");
			return;
		}

		$this->displayManagers();

		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayAllFavoritesCount($this->session->id);

		$row = $this->db->fetchObject("select * from dacons_companies where `name` = '".str_replace("'","\'",$selectedCompany)."' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");

		if ($row == null) { // нет компании

			$this->view->name = htmlspecialchars($selectedCompany);
			$this->getRequest()->setParam('page',1);
			$this->selectCompanyNotFoundAction();

		} else { // есть компания

			if ($this->session->id == $row->manager) { // компания менеджера

				$this->session->current_company = $row->id;
				$this->_redirect($this->getInvokeArg('url')."/main/companyBrief");

			} else { // чужая компания
				//<encoder_start>
				if ($this->session->is_super_user == 1) {
					$this->session->current_company = $row->id;
					$this->_redirect($this->getInvokeArg('url')."/main/companyBrief");
				}

				// узнаем имя менеджера
				$manager_id = $row->manager;

				// меняем базу

				//$users = new Users();
				$user = $this->db->fetchRow("select * from dacons_users where id = '$manager_id'");
				if ($user->nickname=="") $user->nickname = "Не установлено";
				$this->view->companymanager = $user->nickname;
				$this->selectCompanyOthersAction();
				//<encoder_end>

			}
		}

	}

	/**
	 * страница компания не найдена
	 */
	public function selectCompanyNotFoundAction() {
		if ($this->getRequest()->getParam('gr') != "") {
			$this->processGroupOperations();
		}

		$this->displayHistory($this->session->id);
		$this->displayManagers();
		$this->displayLabels();

		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayAllFavoritesCount($this->session->id);

        $selectedCompany = $this->getRequest()->getParam('company');
		$this->view->selectedCompany = $selectedCompany;        		
		require_once 'application/classes/search/TextSearcher.php';
        
        $companyIds = TextSearcher::find($selectedCompany);        
        if (sizeof($companyIds)){        
            $where = "id IN (".  implode(',', $companyIds).")";
        } else {
            $where = "(1=0)";
        }
        
		$page = $this->getRequest()->getParam('page');

		if ($page != null) {

			$validator = new Zend_Validate_Digits();
			if (!$validator->isValid($page)) {
				$page = 1;
			}

			$sql = "SELECT count(id) as `cnt` FROM `dacons_companies` WHERE ".$where;

			$temp = $this->db->fetchRow($sql);

			$elementsPerPage = 10;
			$pageCount = floor($temp["cnt"] / $elementsPerPage) + 1;

			if (floor($temp["cnt"]/$elementsPerPage) == ($temp["cnt"]/$elementsPerPage)) $pageCount--;

			$start = (($page-1)*$elementsPerPage);
            
            if (!$this->session->is_super_user){
                $where .= " ORDER BY (manager = {$this->session->id}) DESC";
            }
			$where .= " LIMIT $start,$elementsPerPage";

			$this->view->pages = $pageCount;
			$this->view->page = $page;

		}

		$company_list = array();

		$sql = "SELECT id, manager FROM dacons_companies WHERE ".$where;

		$companies_ids = $this->db->fetchAll($sql);
		//$users = new Users();

		require_once 'Zend/Json.php';
		$temp = array();

		foreach ($companies_ids as $k => $v) {
			$id = $v["id"];
			$temp[] = $id;

			// prop
			#$company = $this->db->fetchObject("select * from dacons_companies where id = '$id' ");
			$company_list[$k]["prop"] = $this->db->fetchRow("select * from dacons_companies where id = '$id' ");
			$company = new stdClass ();
			foreach ($company_list[$k]["prop"] as $key => $value) {
				$company->$key=$value;
			}
			//$company_list[$k]["prop"]["city"] = $company->findParentRow('Cities')->name;
			// site email
			$company_list[$k]["site"] = explode(",",$company_list[$k]["prop"]["site"]);
			$company_list[$k]["email"] = explode(",",$company_list[$k]["prop"]["email"]);
			// labels
			$company_list[$k]["labels"] = $this->db->fetchAll("SELECT L.id as id, L.name as name, L.parent_id as parent_id, (select name from dacons_labels where id=L.parent_id) as pname, (select picture from dacons_labels where id=L.parent_id) as picture FROM `dacons_labels` as L " .
				"LEFT JOIN dacons_companies_labels as c on c.label_id = L.id " .
				"WHERE c.company_id = '".$company->id."' AND L.parent_id<>0 " .
				"AND L.customer_id = '".$this->session->customer_id."' " .
				"ORDER BY L.parent_id");
			// people
			$company_list[$k]["people"] = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
				" p.comment as comment, p.phone as phone" .
				" FROM dacons_people as p" .
				" LEFT JOIN dacons_people_company as pc" .
				" ON pc.person_id = p.id" .
				" WHERE pc.company_id = '$id'" .
				" ORDER BY p.id ASC");

			$company_list[$k]["blocked"] = false;

			if ($this->session->is_super_user != 1) {
				$company_manager = $v["manager"];
				if ($this->session->id != $company_manager) {
					$company_list[$k]["blocked"] = true;
					$user = $this->db->fetchObject("select * from dacons_users where id = '$company_manager'");
					if ($user->nickname=="") $user->nickname = "Не установлено";
					$company_list[$k]["manager"] = $user->nickname;
				}
			}


			// fast

			$commands = $this->db->fetchAll("SELECT (SELECT user_id FROM dacons_favorite_companies WHERE company_id = '".$id."' AND user_id = '".$this->session->id."' LIMIT 1) as `fav`, " .
				"(SELECT user_id FROM dacons_history WHERE company_id = '".$id."' AND user_id = '".$this->session->id."' AND locked = '1' LIMIT 1) as `clip`");


			if ($commands[0]['fav'] != null) {
				$company_list[$k]["prop"]["isFavorite"] = true;
			} else {
				$company_list[$k]["prop"]["isFavorite"] = false;
			}

			if ($commands[0]['clip'] != null) {
				$company_list[$k]["prop"]["isClip"] = true;
			} else {
				$company_list[$k]["prop"]["isClip"] = false;
			}

			// пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ v1.2
			if ($this->session->is_super_user == 1) {
				$sql = "SELECT * FROM dacons_reminderspool WHERE (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
					"OR (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'sm') " .
					"OR (company_id='".$id."' AND visibility = 'common') ORDER BY visibility, text ASC";
			} else {
				$sql = "SELECT r.*, u.nickname FROM dacons_reminderspool as r " .
					"LEFT JOIN dacons_users as u ON u.id = r.manager_id " .
					"WHERE (company_id='".$id."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
					"OR (company_id='".$id."' AND visibility = 'sm') " .
					"OR (company_id='".$id."' AND visibility = 'common') ORDER BY visibility, text ASC";
			}

			$company_list[$k]["prop"]["remindersPool"] = $this->resortReminder($this->db->fetchAll($sql));


		}
		$this->view->companyList = $company_list;

		$this->view->grCompany = Zend_Json::encode($temp);
		$this->template = "main/selectCompanyNotFound";
	}

	/**
	 * страница чужая компания
	 */
	public function selectCompanyOthersAction() {

		$this->displayHistory($this->session->id);
		$this->template = "main/selectCompanyOthers";
	}

	/**
	 * страница добавления компании
	 */
	public function addCompanyAction() {
		//<encoder_start>
		$this->displayHistory($this->session->id);
		$this->displayLabels();

		$newCompany = htmlspecialchars($this->getRequest()->getParam('name'));
		$this->view->name = $newCompany;
		$this->view->company = $newCompany;
		//if ($newCompany == "")
		//	$this->_redirect($this->getInvokeArg('url')."main/");


		$this->view->phone = $this->getRequest()->getParam('phone');
		//$this->view->relations = $this->getRequest()->getParam('relations');
		$this->view->site = $this->getRequest()->getParam('site');
		$this->view->email = $this->getRequest()->getParam('email');
		$request_about = $this->getRequest()->getParam('about');
		$about = (empty ($request_about)) ? (@ file_get_contents ("conf/about_add_company.txt") ): $request_about;
		$this->view->about = $about;

		//$this->view->city = $this->getRequest()->getParam('city');
		$this->view->address = $this->getRequest()->getParam('address');


		$this->view->cname1 = htmlspecialchars($this->getRequest()->getParam('cname1'));
		$this->view->director1 = $this->getRequest()->getParam('director1');
		$this->view->inn1 = $this->getRequest()->getParam('inn1');
		$this->view->kpp1 = $this->getRequest()->getParam('kpp1');
		$this->view->settlementAccount1 = $this->getRequest()->getParam('settlementAccount1');
		$this->view->bank1 = htmlspecialchars($this->getRequest()->getParam('bank1'));
		$this->view->bik1 = $this->getRequest()->getParam('bik1');
		$this->view->account1 = $this->getRequest()->getParam('account1');
		$this->view->okpo1 = $this->getRequest()->getParam('okpo1');
		$this->view->okonh1 = $this->getRequest()->getParam('okonh1');
		$this->view->ogrn1 = $this->getRequest()->getParam('ogrn1');
		$this->view->okved1 = htmlspecialchars($this->getRequest()->getParam('okved1'));
		$this->view->prop_address1 = htmlspecialchars($this->getRequest()->getParam('prop_address1'));


		$this->view->cname2 = htmlspecialchars($this->getRequest()->getParam('cname2'));
		$this->view->director2 = $this->getRequest()->getParam('director2');
		$this->view->inn2 = $this->getRequest()->getParam('inn2');
		$this->view->kpp2 = $this->getRequest()->getParam('kpp2');
		$this->view->settlementAccount2 = $this->getRequest()->getParam('settlementAccount2');
		$this->view->bank2 = htmlspecialchars($this->getRequest()->getParam('bank2'));
		$this->view->bik2 = $this->getRequest()->getParam('bik2');
		$this->view->account2 = $this->getRequest()->getParam('account2');
		$this->view->okpo2 = $this->getRequest()->getParam('okpo2');
		$this->view->okonh2 = $this->getRequest()->getParam('okonh2');
		$this->view->ogrn2 = $this->getRequest()->getParam('ogrn2');
		$this->view->okved2 = htmlspecialchars($this->getRequest()->getParam('okved2'));
		$this->view->prop_address2 = htmlspecialchars($this->getRequest()->getParam('prop_address2'));

		$this->view->cname3 = htmlspecialchars($this->getRequest()->getParam('cname3'));
		$this->view->director3 = $this->getRequest()->getParam('director3');
		$this->view->inn3 = $this->getRequest()->getParam('inn3');
		$this->view->kpp3 = $this->getRequest()->getParam('kpp3');
		$this->view->settlementAccount3 = $this->getRequest()->getParam('settlementAccount3');
		$this->view->bank3 = htmlspecialchars($this->getRequest()->getParam('bank3'));
		$this->view->bik3 = $this->getRequest()->getParam('bik3');
		$this->view->account3 = $this->getRequest()->getParam('account3');
		$this->view->okpo3 = $this->getRequest()->getParam('okpo3');
		$this->view->okonh3 = $this->getRequest()->getParam('okonh3');
		$this->view->ogrn3 = $this->getRequest()->getParam('ogrn3');
		$this->view->okved3 = htmlspecialchars($this->getRequest()->getParam('okved3'));
		$this->view->prop_address3 = htmlspecialchars($this->getRequest()->getParam('prop_address3'));

		$this->view->cname4 = htmlspecialchars($this->getRequest()->getParam('cname4'));
		$this->view->director4 = $this->getRequest()->getParam('director4');
		$this->view->inn4 = $this->getRequest()->getParam('inn4');
		$this->view->kpp4 = $this->getRequest()->getParam('kpp4');
		$this->view->settlementAccount4 = $this->getRequest()->getParam('settlementAccount4');
		$this->view->bank4 = htmlspecialchars($this->getRequest()->getParam('bank4'));
		$this->view->bik4 = $this->getRequest()->getParam('bik4');
		$this->view->account4 = $this->getRequest()->getParam('account4');
		$this->view->okpo4 = $this->getRequest()->getParam('okpo4');
		$this->view->okonh4 = $this->getRequest()->getParam('okonh4');
		$this->view->ogrn4 = $this->getRequest()->getParam('ogrn4');
		$this->view->okved4 = htmlspecialchars($this->getRequest()->getParam('okved4'));
		$this->view->prop_address4 = htmlspecialchars($this->getRequest()->getParam('prop_address4'));

		$this->view->people = htmlspecialchars($this->getRequest()->getParam('people'));

			/*$this->view->label1 = htmlspecialchars($this->getRequest()->getParam('label1'));
			$this->view->label2 = htmlspecialchars($this->getRequest()->getParam('label2'));
			$this->view->label3 = htmlspecialchars($this->getRequest()->getParam('label3'));
			$this->view->label4 = htmlspecialchars($this->getRequest()->getParam('label4'));
			$this->view->label5 = htmlspecialchars($this->getRequest()->getParam('label5'));
			*/
		//$cities = new Cities();
		//$this->view->cities = $cities->fetchAll("id<>0","name")->toArray();

		$temp = array();
		$temp2 = array();
		foreach ($this->getRequest()->getParams() as $k => $v) {
			if (preg_match("/^ch([0-9]*)$/",$k,$match)) {
				$temp[] = $match[1];
			} else if (preg_match("/^newch([0-9]*)$/",$k,$match)) {
					$temp2[$match[1]] = $v;
				}
		}
		//<encoder_end>
		$this->view->lb = $temp;
		$this->view->nlb = $temp2;

		$this->template = "main/addCompany";
	}

	/**
	 * обработка добавления компании
	 */
	public function addCompanySubmitAction() {
		foreach ($_POST as & $val) {
			$val = trim ($val);
			$val = stripslashes ($val);
		}
		unset ($val);
		//<encoder_start>
		$request = $this->getRequest();
		$name = $request->getParam('name');
		$phone = $request->getParam('phone');
		$site = $request->getParam('site');
		$email = $request->getParam('email');
		//$relations = $request->getParam('relations');
		$about = $request->getParam('about');

		//$city = $request->getParam('city');
		$address = $request->getParam('address');


		$cname1 = $request->getParam('cname1');
		$director1 = $request->getParam('director1');
		$inn1 = $request->getParam('inn1');
		$kpp1 = $request->getParam('kpp1');
		$settlementAccount1 = $request->getParam('settlementAccount1');
		$bank1 = $request->getParam('bank1');
		$bik1 = $request->getParam('bik1');
		$account1 = $request->getParam('account1');
		$okpo1 = $request->getParam('okpo1');
		$okonh1 = $request->getParam('okonh1');
		$ogrn1 = $request->getParam('ogrn1');
		$okved1 = $request->getParam('okved1');
		$prop_address1 = $request->getParam('prop_address1');

		$cname2 = $request->getParam('cname2');
		$director2 = $request->getParam('director2');
		$inn2 = $request->getParam('inn2');
		$kpp2 = $request->getParam('kpp2');
		$settlementAccount2 = $request->getParam('settlementAccount2');
		$bank2 = $request->getParam('bank2');
		$bik2 = $request->getParam('bik2');
		$account2 = $request->getParam('account2');
		$okpo2 = $request->getParam('okpo2');
		$okonh2 = $request->getParam('okonh2');
		$ogrn2 = $request->getParam('ogrn2');
		$okved2 = $request->getParam('okved2');
		$prop_address2 = $request->getParam('prop_address2');

		$cname3 = $request->getParam('cname3');
		$director3 = $request->getParam('director3');
		$inn3 = $request->getParam('inn3');
		$kpp3 = $request->getParam('kpp3');
		$settlementAccount3 = $request->getParam('settlementAccount3');
		$bank3 = $request->getParam('bank3');
		$bik3 = $request->getParam('bik3');
		$account3 = $request->getParam('account3');
		$okpo3 = $request->getParam('okpo3');
		$okonh3 = $request->getParam('okonh3');
		$ogrn3 = $request->getParam('ogrn3');
		$okved3 = $request->getParam('okved3');
		$prop_address3 = $request->getParam('prop_address3');

		$cname4 = $request->getParam('cname4');
		$director4 = $request->getParam('director4');
		$inn4 = $request->getParam('inn4');
		$kpp4 = $request->getParam('kpp4');
		$settlementAccount4 = $request->getParam('settlementAccount4');
		$bank4 = $request->getParam('bank4');
		$bik4 = $request->getParam('bik4');
		$account4 = $request->getParam('account4');
		$okpo4 = $request->getParam('okpo4');
		$okonh4 = $request->getParam('okonh4');
		$ogrn4 = $request->getParam('ogrn4');
		$okved4 = $request->getParam('okved4');
		$prop_address4 = $request->getParam('prop_address4');

		$people = $request->getParam('people');

		$manager_id = $this->session->id;
		//<encoder_end>
			/*
			 * валидаторы
			 */

		include ('incl/messages.php');

		$error = array();
		$valid = true;

		if ($name == "") {
			$valid = false;
			$error['name'] = $message['companyName'];
		}

		$validator = new Zend_Validate_EmailAddress();
		if ($email!="" && !$validator->isValid($email)) {
			$valid = false;
			$error['email'] = sprintf($message['email'],$email);
		}

		$validator = new Zend_Validate_Digits();
		if (!$valid) {
			$this->view->error = $error;
			$this->addCompanyAction();
		} else {
		// добавление в базу
		// проверка на наличие

			$crow = $this->db->fetchRow("select * from dacons_companies where `name` = '".str_replace("'","\'",$name)."' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
			if ($crow != null) {
				$this->view->error = array('name' => strtr(_("Компания %name уже существует!"),array('%name'=>$name)));
				$this->addCompanyAction();
				return;
			}

            $companyArray = array('name' => $name,
				'site' => str_replace("http://","",$site),
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'about' => $about,
				'manager' => $manager_id);
			$company_id = $this->db->insert('dacons_companies', $companyArray);
            
            $companyArray['id'] = $company_id;
            
			//$company_properties = new Company_Properties();
			$this->db->insert('dacons_company_properties',array('company_id' => $company_id,
				'cname' => $cname1,
				'director' => $director1,
				'inn' => $inn1,
				'kpp' => $kpp1,
				'settlementAccount' => $settlementAccount1,
				'bank' => $bank1,
				'bik' => $bik1,
				'account' => $account1,
				'okpo' => $okpo1,
				'okonh' => $okonh1,
				'ogrn' => $ogrn1,
				'okved' => $okved1,
				'address' => $prop_address1));

			if ($cname2!="" ||
				$director2!="" ||
				$inn2!="" ||
				$kpp2!="" ||
				$settlementAccount2!="" ||
				$bank2!="" ||
				$bik2!="" ||
				$account2!="" ||
				$okpo2!="" ||
				$okonh2!="" ||
				$ogrn2!="" ||
				$okved2!="" ||
				$prop_address2!="") {

				$this->db->insert('dacons_company_properties',array('company_id' => $company_id,
					'cname' => $cname2,
					'director' => $director2,
					'inn' => $inn2,
					'kpp' => $kpp2,
					'settlementAccount' => $settlementAccount2,
					'bank' => $bank2,
					'bik' => $bik2,
					'account' => $account2,
					'okpo' => $okpo2,
					'okonh' => $okonh2,
					'ogrn' => $ogrn2,
					'okved' => $okved2,
					'address' => $prop_address2,
					'num' => 1));
			}

			if ($cname3!="" ||
				$director3!="" ||
				$inn3!="" ||
				$kpp3!="" ||
				$settlementAccount3!="" ||
				$bank3!="" ||
				$bik3!="" ||
				$account3!="" ||
				$okpo3!="" ||
				$okonh3!="" ||
				$ogrn3!="" ||
				$okved3!="" ||
				$prop_address3!="") {

				$this->db->insert('dacons_company_properties',array('company_id' => $company_id,
					'cname' => $cname3,
					'director' => $director3,
					'inn' => $inn3,
					'kpp' => $kpp3,
					'settlementAccount' => $settlementAccount3,
					'bank' => $bank3,
					'bik' => $bik3,
					'account' => $account3,
					'okpo' => $okpo3,
					'okonh' => $okonh3,
					'ogrn' => $ogrn3,
					'okved' => $okved3,
					'address' => $prop_address3,
					'num' => 2));
			}

			if ($cname4!="" ||
				$director4!="" ||
				$inn4!="" ||
				$kpp4!="" ||
				$settlementAccount4!="" ||
				$bank4!="" ||
				$bik4!="" ||
				$account4!="" ||
				$okpo4!="" ||
				$okonh4!="" ||
				$ogrn4!="" ||
				$okved4!="" ||
				$prop_address4!="") {

				$this->db->insert('dacons_company_properties',array('company_id' => $company_id,
					'cname' => $cname4,
					'director' => $director4,
					'inn' => $inn4,
					'kpp' => $kpp4,
					'settlementAccount' => $settlementAccount4,
					'bank' => $bank4,
					'bik' => $bik4,
					'account' => $account4,
					'okpo' => $okpo4,
					'okonh' => $okonh4,
					'ogrn' => $ogrn4,
					'okved' => $okved4,
					'address' => $prop_address4,
					'num' => 3));
			}

			// метки

			//$labels = new Labels();
			//$labels_Company = new Companies_Labels();

			// удалить метки
			$this->db->delete('dacons_companies_labels',"`company_id` = '$company_id'");

			foreach ($request->getParams() as $k => $v) {
				if (preg_match("/^ch([0-9]*)$/",$k,$match)) {
					$this->db->insert('dacons_companies_labels',array('company_id' => "$company_id", 'label_id' => $match[1]));
				} else if (preg_match("/^newch([0-9]*)$/",$k,$match)) {
					// new
						if (!is_numeric($match[1])) continue;
						if ($v=="") continue;
						$newLabelId = $this->db->insert('dacons_labels',array('name' => $v, 'parent_id' => $match[1], 'customer_id' => $this->session->customer_id));
						$this->db->insert('dacons_companies_labels',array('company_id' => "$company_id", 'label_id' => $newLabelId));
					}
			}

			// контактные лица

			$personsData = parsePeopleData($people);

			//$people = new People();
			//$people_Companies = new People_Company();

			foreach ($personsData as $k => $v) {                
                $companyArray['people'][$k] = array('fio' => $v['fio'],
					'email' => $v['email'],
					'phone' => $v['phone'],
					'comment' => $v['comment']);
				$people_id = $this->db->insert('dacons_people', $companyArray['people'][$k]);
				$this->db->insert('dacons_people_company', array('person_id' => $people_id,
					'company_id' => $company_id));
			}

			// в журнал
			$this->db->insert('dacons_history', array('company_id' => $company_id,
				'user_id' => $this->session->id,
				'updated' => date("Y-m-d H:i:s")));
            
            require_once 'application/classes/search/TextSearcher.php';
            
            TextSearcher::addCompany($companyArray);

			$this->session->current_company = $company_id;
			$this->_redirect($this->getInvokeArg('url')."/main/companyBrief");
		}

	}

	/**
	 * вывод истории
	 */
	private function displayHistory($user) {

		require_once 'incl/Scheduler.php';
		new Scheduler($this->session);

		//$this->view->history = $this->db->fetchAll("SELECT h.company_id as `company_id`, (SELECT name FROM dacons_companies WHERE id = h.company_id) as name FROM History as h WHERE `user_id`='$user' ORDER BY updated DESC");
		$this->view->history = $this->db->fetchAll("SELECT h.company_id as `company_id`, c.name as `name`, h.locked as locked FROM dacons_history as h " .
			"LEFT JOIN dacons_companies as c ON c.id = h.company_id WHERE h.`user_id`='$user' ORDER BY h.updated DESC");
	}

	/**
	 * показ меток
	 */
	private function displayLabels() {

		$category = $this->db->fetchAll("SELECT id,name,picture FROM dacons_labels WHERE parent_id = 0 AND customer_id = '".$this->session->customer_id."'");

		for ($index = 0; $index < sizeof($category); $index++) {
			$category[$index]['labels'] = $this->db->fetchAll("SELECT id,name FROM dacons_labels WHERE parent_id = '".$category[$index]['id']."'");
		}

		$this->view->labelsRoot = $category;


	}

	/**
	 * страница бриф компании
	 */
	public function companyBriefAction() {
		//<encoder_start>
		if ($this->help->isCheck(12)) $this->help->resetAfter(12);

		// проверка прав на просмотр

		// проверка страницы

		if ($this->session->current_company == "") die('null');

		// if ($this->session->is_super_user == 1) {
		$this->displayManagers();
		// }

		$this->displayLabels();

		$this->displayAllRemindersCount($this->session->id,$this->session->customer_id,$this->session->is_super_user);
		$this->displayAllFavoritesCount($this->session->id);

		// обновляем журнал
		$this->historyWriter($this->session->current_company,$this->session->id);

		//$companies = new Companies();
		$sql = "id = '".$this->session->current_company."' AND manager = '".$this->session->id."'";
		if ($this->session->is_super_user == 1) {
		//$id = $this->getRequest()->getParam('id');
			$sql = "id = '".$this->session->current_company."' AND manager in (SELECT id FROM dacons_users WHERE customer_id ='".$this->session->customer_id."')";//  AND manager <>'$id'
		}

		$company = $this->db->fetchObject("select * from dacons_companies where ".$sql);

		if ($this->session->is_super_user == 1) {
		//$users = new Users();
			$this->view->manager = $this->db->fetchRow("select * from dacons_users where id = '".$company->manager."'");
			$this->view->managersList = $this->db->fetchAll("select * from dacons_users where customer_id = '".$this->session->customer_id."' AND id<>'".$company->manager."' AND readonly<>1 AND is_admin<>1");
		}
		$this->view->company_id = $company->id;


		$this->view->company = $company->name;
		$this->view->name = $company->name;
		$this->view->relations = $company->relations;
		$this->view->phone = $company->phone;
		$this->view->site = explode(",",$company->site);
		$this->view->email = explode(",",$company->email);
		$this->view->address = $company->address;
		$this->view->about = $company->about;

		$this->view->labels = $this->db->fetchAll("SELECT L.id as id, L.name as name, L.parent_id as parent_id, (select name from dacons_labels where id=L.parent_id) as pname, (select picture from dacons_labels where id=L.parent_id) as picture FROM `dacons_labels` as L " .
			"LEFT JOIN dacons_companies_labels as c on c.label_id = L.id " .
			"WHERE c.company_id = '".$company->id."' AND L.parent_id<>0 " .
			"AND L.customer_id = '".$this->session->customer_id."' " .
			"ORDER BY L.parent_id");
		//<encoder_end>

		$this->view->people = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
			" p.comment as comment, p.phone as phone" .
			" FROM dacons_people as p" .
			" LEFT JOIN dacons_people_company as pc" .
			" ON pc.person_id = p.id" .
			" WHERE pc.company_id = '$company->id'" .
			" ORDER BY p.id ASC");

		// определяем страницу

		$page = $this->getRequest()->getParam('page');

		if ($page == null) $page = 1;

		/// проверить page
		$validator = new Zend_Validate_Digits();
		if (!$validator->isValid($page)) {
			$page = 1;
		}

		$temp = $this->db->fetchRow("SELECT count(id) as `cnt` FROM `dacons_events` WHERE " .
			"`company_id` = '".$this->session->current_company."' ");
		$pages = array();

		$pageCount = floor($temp["cnt"] / 20) + 1;
		for ($index = 1; $index <= $pageCount; $index++) {

			$start = (($index-1)*20);
			$end = (($index*20)-1);
			if ($index == $pageCount) $end = $temp["cnt"]-1;
			if ($start < 0) $start = 0;
			if ($end < 0) $end = 0;
			$t = $this->db->fetchRow("SELECT (SELECT `date` FROM `dacons_events` WHERE `company_id` = '".$this->session->current_company."' ORDER BY `date` DESC limit $start,1) as `from`, " .
				"(SELECT `date` FROM `dacons_events` WHERE `company_id` = '".$this->session->current_company."' ORDER BY `date` DESC limit $end,1) as `to`");

			$pages[$index] = array ('id' => $index,
				'from' => $t["from"],
				'to' => $t["to"]);
		}
		$this->view->pages = $pages;
		$this->view->page = $page;


		$this->view->yesterday = strtotime('-1 day');
		///$events = new Events();


		$temp = $this->db->fetchAll("SELECT * FROM `dacons_events` WHERE `company_id` = '".$this->session->current_company."' " .
			" ORDER BY `date` DESC limit ".(($page-1)*20).",20");
		$GMT = $this->session->GMT;

		if ($GMT != 0)
			foreach ($temp as $k => $v) {
				$temp[$k]['date'] = date("Y-m-d H:i:s",strtotime($temp[$k]['date']) + (3600 * $GMT));
			}

		$this->view->events = $temp;



		$commands = $this->db->fetchAll("SELECT (SELECT user_id FROM dacons_favorite_companies WHERE company_id = '".$this->session->current_company."' AND user_id = '".$this->session->id."' LIMIT 1) as `fav`, " .
			"(SELECT user_id FROM dacons_history WHERE company_id = '".$this->session->current_company."' AND user_id = '".$this->session->id."' AND locked = 1 LIMIT 1) as `clip`");


		if ($commands[0]['fav'] != null) {
			$this->view->isFavorite = true;
		} else {
			$this->view->isFavorite = false;
		}

		if ($commands[0]['clip'] == null) {
			$this->view->isClip = true;
		} else {
			$this->view->isClip = false;
		}



		if ($this->session->isPDA==true) {
		//$this->view->MRemCount = $commands[0]['mremC'];
		//$this->view->RemCount = $commands[0]['remC'];
		}

		// напоминания v1.2
		if ($this->session->is_super_user == 1) {
			$sql = "SELECT * FROM dacons_reminderspool WHERE (company_id='".$this->session->current_company."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
				"OR (company_id='".$this->session->current_company."' AND manager_id = '".$this->session->id."' AND visibility = 'sm') " .
				"OR (company_id='".$this->session->current_company."' AND visibility = 'common') ORDER BY visibility, date(`date`), text ASC";
		} else {
			$sql = "SELECT r.*, u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id " .
				"WHERE (company_id='".$this->session->current_company."' AND manager_id = '".$this->session->id."' AND visibility = 'own') " .
				"OR (company_id='".$this->session->current_company."' AND visibility = 'sm') " .
				"OR (company_id='".$this->session->current_company."' AND visibility = 'common') ORDER BY visibility, date(date), text ASC";
		}
		$this->view->remindersPool = $this->resortReminder($this->db->fetchAll($sql));

		$this->displayHistory($this->session->id);

		// реквезиты
		//$properties = new Company_Properties();
		$property = $this->db->fetchAll("select *  from dacons_company_properties where `company_id` = '".$this->session->current_company."' " .
			"AND (INN <> '' OR KPP <> '' OR settlementAccount <> '' OR bank <> '' " .
			"OR BIK <> '' OR account <> '' OR OKPO <> '' OR OKONH <> '' " .
			"OR OGRN <> '' OR OKVED <> '' OR cname <> '' OR director <> '') ORDER BY num");
		$this->view->props = $property;

		//файлы
		$this->view->files = $this->db->fetchAll("SELECT * FROM dacons_uploads WHERE `company_id`='".$this->session->current_company."' ORDER BY `id` DESC");

		$this->increaseCompanyCounter($this->session->current_company);

		$this->template = "main/companyBrief";
	}

	/**
	 * добавление события
	 */
	public function companyAddHistoryAction() {

		$name = $this->getRequest()->getParam('name');
		$comment = $this->getRequest()->getParam('comment');


		$added = false;
		if ($name != "") {
		//$events = new Events();
			$this->db->insert('dacons_events', array('name' => $name,
				'comment' => str_replace("\n","<br>",$comment),
				'company_id' => $this->session->current_company,
				'date' => date ("Y-m-d H:i:s")));
			$added = true;
		}

		if ($this->session->isPDA==true) {
			if ($added) {
				$added = "?pda_added=1";
			} else {
				$added = "?pda_added=2&pda_p1=$name&pda_p2=$comment";
			}
			$this->_redirect($this->getInvokeArg('url')."/main/companyBrief".$added);
		} else {
			$this->_redirect($this->getInvokeArg('url')."/main/companyBrief");
		}
	}

	/**
	 * просмотр из журнала
	 */
	public function companyBriefFromHistoryAction() {

		$company_id = $this->getRequest()->getParam('id');
		if ($company_id == null) $company_id = $this->session->current_company;
		// пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ id

		$validator = new Zend_Validate_Digits();
		if (!$validator->isValid($company_id)) {
			$this->_redirect($this->getInvokeArg('url')."error");
		}

		// пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ пїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅпїЅ
		//$companies = new Companies();
		$sql = "`manager` = '".$this->session->id."' AND `id` = $company_id";

		if ($this->session->is_super_user == 1) $sql = "`manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND `id` = $company_id";

		$row = $this->db->fetchObject("select * from dacons_companies where ".$sql);
		if ($row == null) {
			$this->_redirect($this->getInvokeArg('url')."error");
		}

		if ($company_id != null) $this->session->current_company = $company_id;

		// обновляем журнал

		//$history = new History();
		$this->db->update('dacons_history',array('updated' => date("Y-m-d H:i:s")),
			"`company_id` = '$company_id' " .
			"AND `user_id`='".$this->session->id."'");

		$this->companyBriefAction();

	}

	public function companyBriefFromLabelAction() {

		$this->displayLabels();

		$mode = $this->getRequest()->getParam('mode');

		if ($mode == "label") {

		//$labels = new Labels;
			$mparam = $this->getRequest()->getParam('mparam');
			$page = $this->getRequest()->getParam('page');

			$validator = new Zend_Validate_Digits();
			if (!$validator->isValid($mparam)) {
				$this->_redirect($this->getInvokeArg('siteurl')."/error");
			}

			$validator = new Zend_Validate_Digits();
			if (!$validator->isValid($page)) {
				$this->_redirect($this->getInvokeArg('siteurl')."/error");
			}

			$label = $this->db->fetchObject("select * from dacons_labels where id = '$mparam'");

			$link = $this->getInvokeArg('siteurl')."/main/searchCompanyLabels?mode=label&mparam=$mparam&page=$page";
			$this->view->backlink = "<b>"._("Метка").":</b> <a href=\"$link\" class=\"color1\">$label->name</a>";

		}

		$this->companyBriefFromHistoryAction();

	}

	/**
	 * редактирование компании
	 */
	public function editCompanyAction() {


		$company_id = $this->session->current_company;

		$this->displayHistory($this->session->id);
		$this->displayLabels();


		$this->view->company_id = $company_id;

		$commands = $this->db->fetchAll("SELECT (SELECT user_id FROM dacons_favorite_companies WHERE company_id = '".$company_id."' AND user_id = '".$this->session->id."' LIMIT 1) as `fav`, " .
			"(SELECT user_id FROM dacons_history WHERE company_id = '".$company_id."' AND user_id = '".$this->session->id."' AND locked = 1 LIMIT 1) as `clip`");


		if ($commands[0]['fav'] != null) {
			$this->view->isFavorite = true;
		} else {
			$this->view->isFavorite = false;
		}

		if ($commands[0]['clip'] == null) {
			$this->view->isClip = true;
		} else {
			$this->view->isClip = false;
		}


		if ($this->getRequest()->getParam('isForm') == '1') {


			$this->view->name = htmlspecialchars($this->getRequest()->getParam('name'));
			//$this->view->company = $this->getRequest()->getParam('name');

			$this->view->relations = $this->getRequest()->getParam('relations');
			$this->view->phone = $this->getRequest()->getParam('phone');
			$this->view->site = $this->getRequest()->getParam('site');
			$this->view->email = $this->getRequest()->getParam('email');
			$this->view->address = htmlspecialchars($this->getRequest()->getParam('address'));
			$this->view->about = $this->getRequest()->getParam('about');

			$this->view->cname1 = htmlspecialchars($this->getRequest()->getParam('cname1'));
			$this->view->director1 = $this->getRequest()->getParam('director1');
			$this->view->inn1 = $this->getRequest()->getParam('inn1');
			$this->view->kpp1 = $this->getRequest()->getParam('kpp1');
			$this->view->settlementAccount1 = $this->getRequest()->getParam('settlementAccount1');
			$this->view->bank1 = htmlspecialchars($this->getRequest()->getParam('bank1'));
			$this->view->bik1 = $this->getRequest()->getParam('bik1');
			$this->view->account1 = $this->getRequest()->getParam('account1');
			$this->view->okpo1 = $this->getRequest()->getParam('okpo1');
			$this->view->okonh1 = $this->getRequest()->getParam('okonh1');
			$this->view->ogrn1 = $this->getRequest()->getParam('ogrn1');
			$this->view->okved1 = htmlspecialchars($this->getRequest()->getParam('okved1'));
			$this->view->prop_address1 = htmlspecialchars($this->getRequest()->getParam('prop_address1'));


			$this->view->cname2 = htmlspecialchars($this->getRequest()->getParam('cname2'));
			$this->view->director2 = $this->getRequest()->getParam('director2');
			$this->view->inn2 = $this->getRequest()->getParam('inn2');
			$this->view->kpp2 = $this->getRequest()->getParam('kpp2');
			$this->view->settlementAccount2 = $this->getRequest()->getParam('settlementAccount2');
			$this->view->bank2 = htmlspecialchars($this->getRequest()->getParam('bank2'));
			$this->view->bik2 = $this->getRequest()->getParam('bik2');
			$this->view->account2 = $this->getRequest()->getParam('account2');
			$this->view->okpo2 = $this->getRequest()->getParam('okpo2');
			$this->view->okonh2 = $this->getRequest()->getParam('okonh2');
			$this->view->ogrn2 = $this->getRequest()->getParam('ogrn2');
			$this->view->okved2 = htmlspecialchars($this->getRequest()->getParam('okved2'));
			$this->view->prop_address2 = htmlspecialchars($this->getRequest()->getParam('prop_address2'));

			$this->view->cname3 = htmlspecialchars($this->getRequest()->getParam('cname3'));
			$this->view->director3 = $this->getRequest()->getParam('director3');
			$this->view->inn3 = $this->getRequest()->getParam('inn3');
			$this->view->kpp3 = $this->getRequest()->getParam('kpp3');
			$this->view->settlementAccount3 = $this->getRequest()->getParam('settlementAccount3');
			$this->view->bank3 = htmlspecialchars($this->getRequest()->getParam('bank3'));
			$this->view->bik3 = $this->getRequest()->getParam('bik3');
			$this->view->account3 = $this->getRequest()->getParam('account3');
			$this->view->okpo3 = $this->getRequest()->getParam('okpo3');
			$this->view->okonh3 = $this->getRequest()->getParam('okonh3');
			$this->view->ogrn3 = $this->getRequest()->getParam('ogrn3');
			$this->view->okved3 = htmlspecialchars($this->getRequest()->getParam('okved3'));
			$this->view->prop_address3 = htmlspecialchars($this->getRequest()->getParam('prop_address3'));

			$this->view->cname4 = htmlspecialchars($this->getRequest()->getParam('cname4'));
			$this->view->director4 = $this->getRequest()->getParam('director4');
			$this->view->inn4 = $this->getRequest()->getParam('inn4');
			$this->view->kpp4 = $this->getRequest()->getParam('kpp4');
			$this->view->settlementAccount4 = $this->getRequest()->getParam('settlementAccount4');
			$this->view->bank4 = htmlspecialchars($this->getRequest()->getParam('bank4'));
			$this->view->bik4 = $this->getRequest()->getParam('bik4');
			$this->view->account4 = $this->getRequest()->getParam('account4');
			$this->view->okpo4 = $this->getRequest()->getParam('okpo4');
			$this->view->okonh4 = $this->getRequest()->getParam('okonh4');
			$this->view->ogrn4 = $this->getRequest()->getParam('ogrn4');
			$this->view->okved4 = htmlspecialchars($this->getRequest()->getParam('okved4'));
			$this->view->prop_address4 = htmlspecialchars($this->getRequest()->getParam('prop_address4'));

			$this->view->people = htmlspecialchars($this->getRequest()->getParam('people'));

			//$companies = new Companies();
			$sql = "`id` = '$company_id' AND `manager`='".$this->session->id."'";
			if ($this->session->is_super_user == 1) $sql = "`id` = '$company_id' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
			$company = $this->db->fetchObject("select * from dacons_companies where ".$sql);


			$temp = array();
			$temp2 = array();
			foreach ($this->getRequest()->getParams() as $k => $v) {
				if (preg_match("/^ch([0-9]*)$/",$k,$match)) {
					$temp[] = $match[1];
				} else if (preg_match("/^newch([0-9]*)$/",$k,$match)) {
						$temp2[$match[1]] = $v;
					}
			}

			$this->view->lb = $temp;
			$this->view->nlb = $temp2;

		} else {

		//$companies = new Companies();
			$sql = "`id` = '$company_id' AND `manager`='".$this->session->id."'";
			if ($this->session->is_super_user == 1) $sql = "`id` = '$company_id' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
			$company = $this->db->fetchObject("select * from dacons_companies where ".$sql);

			$this->view->name = htmlspecialchars($company->name);
			$this->view->company = $company->name;
			$this->view->relations = $company->relations;

			$this->view->phone = $company->phone;
			$this->view->site = $company->site;
			$this->view->email = $company->email;
			$this->view->address = htmlspecialchars($company->address);
			$this->view->about = $company->about;

			$labels = $this->db->fetchAll(" SELECT L.*
												FROM dacons_labels L
												LEFT JOIN dacons_companies_labels CL ON L.id = CL.label_id
												WHERE CL.company_id = '$company_id'");

			$temp = array();
			for ($index = 0; $index < sizeof($labels); $index++) {
				$temp[] = $labels[$index]['id'];
			}
			$this->view->lb = $temp;

			//$company_properties = new Company_Properties();
			$properties = $this->db->fetchAll("select * from dacons_company_properties where `company_id` = '$company_id'","num");

			foreach($properties as $k => $v) {

				if ($v['num']==0) {
					$this->view->cname1 = htmlspecialchars($v['cname']);
					$this->view->director1 = $v['director'];
					$this->view->inn1 = $v['INN'];
					$this->view->kpp1 = $v['KPP'];
					$this->view->settlementAccount1 = $v['settlementAccount'];
					$this->view->bank1 = htmlspecialchars($v['bank']);
					$this->view->bik1 = $v['BIK'];
					$this->view->account1 = $v['account'];
					$this->view->okpo1 = $v['OKPO'];
					$this->view->okonh1 = $v['OKONH'];
					$this->view->ogrn1 = $v['OGRN'];
					$this->view->okved1 = htmlspecialchars($v['OKVED']);
					$this->view->prop_address1 = htmlspecialchars($v['address']);
				}

				if ($v['num']==1) {
					$this->view->cname2 = htmlspecialchars($v['cname']);
					$this->view->director2 = $v['director'];
					$this->view->inn2 = $v['INN'];
					$this->view->kpp2 = $v['KPP'];
					$this->view->settlementAccount2 = $v['settlementAccount'];
					$this->view->bank2 = htmlspecialchars($v['bank']);
					$this->view->bik2 = $v['BIK'];
					$this->view->account2 = $v['account'];
					$this->view->okpo2 = $v['OKPO'];
					$this->view->okonh2 = $v['OKONH'];
					$this->view->ogrn2 = $v['OGRN'];
					$this->view->okved2 = htmlspecialchars($v['OKVED']);
					$this->view->prop_address2 = htmlspecialchars($v['address']);
				}

				if ($v['num']==2) {
					$this->view->cname3 = htmlspecialchars($v['cname']);
					$this->view->director3 = $v['director'];
					$this->view->inn3 = $v['INN'];
					$this->view->kpp3 = $v['KPP'];
					$this->view->settlementAccount3 = $v['settlementAccount'];
					$this->view->bank3 = htmlspecialchars($v['bank']);
					$this->view->bik3 = $v['BIK'];
					$this->view->account3 = $v['account'];
					$this->view->okpo3 = $v['OKPO'];
					$this->view->okonh3 = $v['OKONH'];
					$this->view->ogrn3 = $v['OGRN'];
					$this->view->okved3 = htmlspecialchars($v['OKVED']);
					$this->view->prop_address3 = htmlspecialchars($v['address']);
				}

				if ($v['num']==3) {
					$this->view->cname4 = htmlspecialchars($v['cname']);
					$this->view->director4 = $v['director'];
					$this->view->inn4 = $v['INN'];
					$this->view->kpp4 = $v['KPP'];
					$this->view->settlementAccount4 = $v['settlementAccount'];
					$this->view->bank4 = htmlspecialchars($v['bank']);
					$this->view->bik4 = $v['BIK'];
					$this->view->account4 = $v['account'];
					$this->view->okpo4 = $v['OKPO'];
					$this->view->okonh4 = $v['OKONH'];
					$this->view->ogrn4 = $v['OGRN'];
					$this->view->okved4 = htmlspecialchars($v['OKVED']);
					$this->view->prop_address4 = htmlspecialchars($v['address']);
				}

			}

			$peopleString = "";

			$people = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
				" p.comment as comment, p.phone as phone" .
				" FROM dacons_people as p" .
				" LEFT JOIN dacons_people_company as pc" .
				" ON pc.person_id = p.id" .
				" WHERE pc.company_id = '$company->id'" .
				" ORDER BY p.id ASC");


			foreach ($people as $k => $v) {
				$peopleString .= $v['fio'];
				if ($v['phone']!="") $peopleString .= ", ". $v['phone'];
				if ($v['email']!="") $peopleString .= ", ". $v['email'];
				if ($v['comment']!="")  $peopleString .= ", ". htmlspecialchars($v['comment']);
				$peopleString .= "\n\n";
			}

			$this->view->people = $peopleString;


		}
		$this->template = "main/editCompany";
	}

	public function gotoEditCompanyAction() {
		$id = $this->getRequest()->getParam('id');
		if (!is_numeric($id)) {$this->_redirect("/error");}
		$company_id = $id;

		// проверка принадлежности
		///$companies = new Companies();
		$sql = "`manager` = '".$this->session->id."' AND `id` = '$company_id'";
		if ($this->session->is_super_user == 1) $sql = "`manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND `id` = $company_id";
		$row = $this->db->fetchObject("select * from dacons_companies where ".$sql);
		if ($row == null) {
			$this->_redirect($this->getInvokeArg('url')."/error");
		}
		$this->session->current_company = $id;
		$this->editCompanyAction();

	}

	/**
	 * обработка редактирования компании
	 */
	public function editCompanySubmitAction() {
		$request = $this->getRequest();

		$request->getParams();

		$name = trim ($request->getParam('name'));
		$phone = trim ($request->getParam('phone'));
		$site = trim ($request->getParam('site'));
		$email = trim ($request->getParam('email'));
		$about = trim ($request->getParam('about'));

		$address = $request->getParam('address');

		$cname1 = $request->getParam('cname1');
		$director1 = $request->getParam('director1');
		$inn1 = $request->getParam('inn1');
		$kpp1 = $request->getParam('kpp1');
		$settlementAccount1 = $request->getParam('settlementAccount1');
		$bank1 = $request->getParam('bank1');
		$bik1 = $request->getParam('bik1');
		$account1 = $request->getParam('account1');
		$okpo1 = $request->getParam('okpo1');
		$okonh1 = $request->getParam('okonh1');
		$ogrn1 = $request->getParam('ogrn1');
		$okved1 = $request->getParam('okved1');
		$prop_address1 = $request->getParam('prop_address1');

		$cname2 = $request->getParam('cname2');
		$director2 = $request->getParam('director2');
		$inn2 = $request->getParam('inn2');
		$kpp2 = $request->getParam('kpp2');
		$settlementAccount2 = $request->getParam('settlementAccount2');
		$bank2 = $request->getParam('bank2');
		$bik2 = $request->getParam('bik2');
		$account2 = $request->getParam('account2');
		$okpo2 = $request->getParam('okpo2');
		$okonh2 = $request->getParam('okonh2');
		$ogrn2 = $request->getParam('ogrn2');
		$okved2 = $request->getParam('okved2');
		$prop_address2 = $request->getParam('prop_address2');

		$cname3 = $request->getParam('cname3');
		$director3 = $request->getParam('director3');
		$inn3 = $request->getParam('inn3');
		$kpp3 = $request->getParam('kpp3');
		$settlementAccount3 = $request->getParam('settlementAccount3');
		$bank3 = $request->getParam('bank3');
		$bik3 = $request->getParam('bik3');
		$account3 = $request->getParam('account3');
		$okpo3 = $request->getParam('okpo3');
		$okonh3 = $request->getParam('okonh3');
		$ogrn3 = $request->getParam('ogrn3');
		$okved3 = $request->getParam('okved3');
		$prop_address3 = $request->getParam('prop_address3');

		$cname4 = $request->getParam('cname4');
		$director4 = $request->getParam('director4');
		$inn4 = $request->getParam('inn4');
		$kpp4 = $request->getParam('kpp4');
		$settlementAccount4 = $request->getParam('settlementAccount4');
		$bank4 = $request->getParam('bank4');
		$bik4 = $request->getParam('bik4');
		$account4 = $request->getParam('account4');
		$okpo4 = $request->getParam('okpo4');
		$okonh4 = $request->getParam('okonh4');
		$ogrn4 = $request->getParam('ogrn4');
		$okved4 = $request->getParam('okved4');
		$prop_address4 = $request->getParam('prop_address4');

		$people = $request->getParam('people');

		$label1 = $request->getParam('label1');
		$label2 = $request->getParam('label2');
		$label3 = $request->getParam('label3');
		$label4 = $request->getParam('label4');
		$label5 = $request->getParam('label5');

			/*
			 * валидаторы
			 */

		include ('incl/messages.php');

		$error = array();
		$valid = true;
		$validator = new Zend_Validate_NotEmpty();
		if (!$validator->isValid($name)) {
			$valid = false;
			$error['name'] = $message['companyName'];
		}

		$tname = trim($name);
		$crow = $this->db->fetchObject("select * from dacons_companies where `name` = '".str_replace("'","\'",$tname)."' AND `id` <> '".$this->session->current_company."' AND `manager` in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')");
		if ($crow != null) {
			$valid = false;
			$error['name'] = strtr(_("Компания %name уже существует!"), array('%name'=>$name));
		}

		$validator = new Zend_Validate_EmailAddress();
		$emails = explode(",",$email);
		for ($index = 0; $index < sizeof($emails); $index++) {
			if ($emails[$index]!="" && !$validator->isValid(trim($emails[$index]))) {
				$valid = false;
				$error['email'] = sprintf($message['email'],trim($emails[$index]));
			}
		}

		$validator = new Zend_Validate_Digits();
		if (!$valid) {
			$this->view->error = $error;
			$this->editCompanyAction();
		} else {

			$company_id = $this->session->current_company;
            
            $companyArray = array('site' => str_replace("http://","",$site),
				'email' => $email,
				'name' => $name,
				'phone' => $phone,
				'address' => $address,
				'about' => $about,
                'id' => $company_id);
            
			$this->db->update('dacons_companies', array('site' => str_replace("http://","",$site),
				'email' => $email,
				'name' => $name,
				'phone' => $phone,
				'address' => $address,
				'about' => $about),"`id` = '$company_id'");

			//$company_properties = new Company_Properties();
			$res = $this->db->fetchRow("SELECT id FROM dacons_company_properties WHERE `company_id` = '$company_id' AND `num` = 0");
			if ($res) {
				$this->db->update('dacons_company_properties',array('cname' => $cname1,
					'director' => $director1,
					'inn' => $inn1,
					'kpp' => $kpp1,
					'settlementAccount' => $settlementAccount1,
					'bank' => $bank1,
					'bik' => $bik1,
					'account' => $account1,
					'okpo' => $okpo1,
					'okonh' => $okonh1,
					'ogrn' => $ogrn1,
					'okved' => $okved1,
					'address' => $prop_address1),"`company_id` = '$company_id' AND `num` = '0'");
			}
			else
			{
				if ($cname1!="" ||
					$director1!="" ||
					$inn1!="" ||
					$kpp1!="" ||
					$settlementAccount1!="" ||
					$bank1!="" ||
					$bik1!="" ||
					$account1!="" ||
					$okpo1!="" ||
					$okonh1!="" ||
					$ogrn1!="" ||
					$okved1!="" ||
					$prop_address1!="") {

					$this->db->insert('dacons_company_properties',array('cname' => $cname1,
						'director' => $director1,
						'inn' => $inn1,
						'kpp' => $kpp1,
						'settlementAccount' => $settlementAccount1,
						'bank' => $bank1,
						'bik' => $bik1,
						'account' => $account1,
						'okpo' => $okpo1,
						'okonh' => $okonh1,
						'ogrn' => $ogrn1,
						'okved' => $okved1,
						'company_id' => $company_id,
						'address' => $prop_address1,
						'num' => 0));
				}
			}

			$res = $this->db->fetchRow("SELECT id FROM dacons_company_properties WHERE `company_id` = '$company_id' AND `num` = 1");


			if ($res) {
				$this->db->update('dacons_company_properties',array('cname' => $cname2,
					'director' => $director2,
					'inn' => $inn2,
					'kpp' => $kpp2,
					'settlementAccount' => $settlementAccount2,
					'bank' => $bank2,
					'bik' => $bik2,
					'account' => $account2,
					'okpo' => $okpo2,
					'okonh' => $okonh2,
					'ogrn' => $ogrn2,
					'okved' => $okved2,
					'address' => $prop_address2),"`company_id` = '$company_id' AND `num` = '1'");

			} else {
				if ($cname2!="" ||
					$director2!="" ||
					$inn2!="" ||
					$kpp2!="" ||
					$settlementAccount2!="" ||
					$bank2!="" ||
					$bik2!="" ||
					$account2!="" ||
					$okpo2!="" ||
					$okonh2!="" ||
					$ogrn2!="" ||
					$okved2!="" ||
					$prop_address2!="") {

					$this->db->insert('dacons_company_properties',array('cname' => $cname2,
						'director' => $director2,
						'inn' => $inn2,
						'kpp' => $kpp2,
						'settlementAccount' => $settlementAccount2,
						'bank' => $bank2,
						'bik' => $bik2,
						'account' => $account2,
						'okpo' => $okpo2,
						'okonh' => $okonh2,
						'ogrn' => $ogrn2,
						'okved' => $okved2,
						'company_id' => $company_id,
						'address' => $prop_address2,
						'num' => 1));
				}
			}

			$res = $this->db->fetchRow("SELECT id FROM dacons_company_properties WHERE `company_id` = '$company_id' AND `num` = 2");

			if ($res) {
				$this->db->update('dacons_company_properties',array('cname' => $cname3,
					'director' => $director3,
					'inn' => $inn3,
					'kpp' => $kpp3,
					'settlementAccount' => $settlementAccount3,
					'bank' => $bank3,
					'bik' => $bik3,
					'account' => $account3,
					'okpo' => $okpo3,
					'okonh' => $okonh3,
					'ogrn' => $ogrn3,
					'okved' => $okved3,
					'address' => $prop_address3),"`company_id` = '$company_id' AND `num` = '2'");

			} else {
				if ($cname3!="" ||
					$director3!="" ||
					$inn3!="" ||
					$kpp3!="" ||
					$settlementAccount3!="" ||
					$bank3!="" ||
					$bik3!="" ||
					$account3!="" ||
					$okpo3!="" ||
					$okonh3!="" ||
					$ogrn3!="" ||
					$okved3!="" ||
					$prop_address3!="") {

					$this->db->insert('dacons_company_properties',array('cname' => $cname3,
						'director' => $director3,
						'inn' => $inn3,
						'kpp' => $kpp3,
						'settlementAccount' => $settlementAccount3,
						'bank' => $bank3,
						'bik' => $bik3,
						'account' => $account3,
						'okpo' => $okpo3,
						'okonh' => $okonh3,
						'ogrn' => $ogrn3,
						'okved' => $okved3,
						'company_id' => $company_id,
						'address' => $prop_address3,
						'num' => 2));
				}
			}

			$res = $this->db->fetchRow("SELECT id FROM dacons_company_properties WHERE `company_id` = '$company_id' AND `num` = 3");

			if ($res) {
				$this->db->update('dacons_company_properties',array('cname' => $cname4,
					'director' => $director4,
					'inn' => $inn4,
					'kpp' => $kpp4,
					'settlementAccount' => $settlementAccount4,
					'bank' => $bank4,
					'bik' => $bik4,
					'account' => $account4,
					'okpo' => $okpo4,
					'okonh' => $okonh4,
					'ogrn' => $ogrn4,
					'okved' => $okved4,
					'address' => $prop_address4),"`company_id` = '$company_id' AND `num` = '3'");

			} else {
				if ($cname4!="" ||
					$director4!="" ||
					$inn4!="" ||
					$kpp4!="" ||
					$settlementAccount4!="" ||
					$bank4!="" ||
					$bik4!="" ||
					$account4!="" ||
					$okpo4!="" ||
					$okonh4!="" ||
					$ogrn4!="" ||
					$okved4!="" ||
					$prop_address4!="") {

					$this->db->insert('dacons_company_properties',array('cname' => $cname4,
						'director' => $director4,
						'inn' => $inn4,
						'kpp' => $kpp4,
						'settlementAccount' => $settlementAccount4,
						'bank' => $bank4,
						'bik' => $bik4,
						'account' => $account4,
						'okpo' => $okpo4,
						'okonh' => $okonh4,
						'ogrn' => $ogrn4,
						'okved' => $okved4,
						'company_id' => $company_id,
						'address' => $prop_address4,
						'num' => 3));
				}
			}


			// метки

			//$labels = new Labels();
			//$labels_Company = new Companies_Labels();

			// удалить метки
			$this->db->delete('dacons_companies_labels', "`company_id` = '$company_id'");

			foreach ($request->getParams() as $k => $v) {
				if (preg_match("/^ch([0-9]*)$/",$k,$match)) {
					$this->db->insert('dacons_companies_labels', array('company_id' => "$company_id", 'label_id' => $match[1]));
				} else if (preg_match("/^newch([0-9]*)$/",$k,$match)) {
					// new
						if (!is_numeric($match[1])) continue;
						if ($v=="") continue;
						$newLabelId = $this->db->insert('dacons_labels', array('name' => $v, 'parent_id' => $match[1], 'customer_id' => $this->session->customer_id));
						$this->db->insert('dacons_companies_labels', array('company_id' => "$company_id", 'label_id' => $newLabelId));
					}
			}

			// контактные лица
			$personsData = parsePeopleData($people);

			// удалить старые записи
			$company = $this->db->fetchObject("select * from dacons_companies where `id` = '$company_id'");

			$peopleToDel = $this->db->fetchAll("SELECT P.*
											FROM dacons_people P
											LEFT JOIN dacons_people_company PC ON P.id = PC.person_id
											WHERE PC.company_id = '$company_id'");

			foreach ($peopleToDel as $k => $v) {
				$this->db->delete("dacons_people", "`id` = '".$v['id']."'");
				$this->db->delete('dacons_people_company',"`person_id` = '".$v['id']."'");
			}

			foreach ($personsData as $k => $v) {
                $companyArray['people'][$k] = array('fio' => $v['fio'],
					'email' => $v['email'],
					'phone' => $v['phone'],
					'comment' => $v['comment']);
				$people_id = $this->db->insert('dacons_people', $companyArray['people'][$k]);
				$this->db->insert('dacons_people_company', array('person_id' => $people_id,
					'company_id' => $company_id));
			}
            
            require_once 'application/classes/search/TextSearcher.php';

            TextSearcher::updateCompany($companyArray);

			$this->_redirect($this->getInvokeArg('url')."/main/companyBrief");
		}

	}

	public function remindersAction() {

		$this->displayManagers(); // moved
		if ($this->session->is_super_user == 1) {

			$this->session->filter_manager = $this->session->id;
			$this->view->managerFilter = $this->session->id;

		}

		// Костыль, созданный специально под шаблоны
		if (! empty ($_GET ['delrem'])) {
		//echo "user_id = ".$this->session->id." and id = ".intval ($_GET ['delrem']);
			$this->db->delete('dacons_reminders',"user_id = ".$this->session->id." and id = ".intval ($_GET ['delrem']));
			$this->db->delete('dacons_reminderspool',"manager_id = ".$this->session->id." and id = ".intval ($_GET ['delrem']));
		}

		// сегодня
		$now_start = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d"),date("Y")));
		$now_end = date ("Y-m-d H:i:s", mktime (0+$this->session->GMT,0,0,date("m"),date("d")+1,date("Y")));
		if ($this->session->is_super_user == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`>='$now_start' AND r.`date`<'$now_end' AND" .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		}
		$this->view->todayReminders = $this->db->fetchAll($sql);

		// пїЅпїЅпїЅпїЅпїЅпїЅпїЅ
		if ($this->session->is_super_user == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id ,c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`>='$now_end' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id ,c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`>='$now_end' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		}

		$this->view->futureReminders = $this->db->fetchAll($sql);

		// будущие
		if ($this->session->is_super_user == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`<'$now_start' AND r.`date`>'2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`<'$now_start' AND r.`date`>'2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				"ORDER BY date(r.`date`), r.`text`";
		}
		$this->view->expiredReminders = $this->db->fetchAll($sql);

		// без даты
		if ($this->session->is_super_user == 1) {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name` FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id WHERE " .
				"r.`date`='2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'common' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				//"ORDER BY r.id";
				"ORDER BY r.text";
		} else {
			$sql = "SELECT r.id, r.text, r.company_id, r.date, r.visibility, c.manager as manager_id, c.name as `name`,u.nickname FROM dacons_reminderspool as r " .
				"LEFT JOIN dacons_companies as c ON c.id = r.company_id " .
				"LEFT JOIN dacons_users as u ON u.id = r.manager_id WHERE " .
				"r.`date`='2000-01-01 00:00:00' AND " .
				"((r.visibility = 'own' AND r.manager_id = '".$this->session->id."') OR " .
				"(r.visibility = 'sm' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')) OR " .
				"(r.visibility = 'common' AND c.manager = '".$this->session->id."' AND r.manager_id in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."'))) " .
				//"ORDER BY r.id";
				"ORDER BY r.text";
		}
		$withoutDateReminders = $this->db->fetchAll($sql);
		$temp = array();
		foreach ($withoutDateReminders as $k => $v) {
			if ($v['visibility']=='own') {
				$temp[] = $v;
			}
		}
		foreach ($withoutDateReminders as $k => $v) {
			if ($v['visibility']!='own') {
				$temp[] = $v;
			}
		}

		$this->view->withoutDateReminders = $temp;

		$this->template = "main/reminders";
	}

	public function viewPropertiesAction() {

		$this->displayHistory($this->session->id);

		$properties = new Company_Properties();
		$property = $properties->fetchAll("`company_id` = '".$this->session->current_company."'")->toArray();



		$this->view->company = $this->getRequest()->getParam('company');

		$this->view->props = $property;

		$this->template = "main/viewProperties";

	}

	public function compressionTestAction() {
		$encoding = false;
		$encod = $_SERVER["HTTP_ACCEPT_ENCODING"];
		if( strpos($encod, 'x-gzip') !== false ) {
			$encoding = 'x-gzip';
		}elseif( strpos($encod,'gzip') !== false ) {
			$encoding = 'gzip';
		}else {
			$encoding = false;
		}
		if ($encoding) {
			$this->view->text = _("Сжатие активно!");
		} else {
			$this->view->text = _("Сжатие не активно!<br>Вас браузер не передает параметр: HTTP_ACCEPT_ENCODING");
		}
		$this->template = "main/compression";
	}

	public function addReminderAction() { /* добавление напоминания */
		$t = $this->getRequest()->getParam('t');
		$v = $this->getRequest()->getParam('v');
		if (trim($t)!="" && $v!="") {
			include('incl/dateFormater.php');

			$data = parseDate($t);
			$time = strtotime($data[0]['date']);
			$data[0]['date'] = date("Y-m-d H:i:s",mktime(0,0,0,date("m",$time),date("d",$time),date("Y",$time)));

			if ($this->session->is_super_user == 1) {
				if (sizeof($data)!=0) {
					$this->db->insert('dacons_reminderspool',array('text' => $data[0]['text'],'company_id' => $this->session->current_company,'date' => $data[0]['date'],'manager_id' => $this->session->id,'visibility' => $v));
				}
			} else {
				if (sizeof($data)!=0 && $v!='sm') {
					$this->db->insert('dacons_reminderspool',array('text' => $data[0]['text'],'company_id' => $this->session->current_company,'date' => $data[0]['date'],'manager_id' => $this->session->id,'visibility' => $v));
				}
			}
				/*
				if ($this->help->isCheck(10)) {
					$this->help->reset(10);
					$this->help->reset(11);
					$this->help->reset(15);
					$this->help->save();
				}*/
		}

		$this->_redirect("/main/companyBrief");

	}


	// statistics

	public function increaseCompanyCounter($id) {
		$dt = date ("Y-m-d H:i:s", mktime (date("H"),date("i")+10,date("s"),date("m"),date("d"),date("Y")));
		$this->db->query("UPDATE dacons_companies SET viewed = viewed + 1, viewed_date = '$dt' where id = '$id' AND viewed_date < now()");
	}

	public function increaseLabelCounter($id) {
		$dt = date ("Y-m-d H:i:s", mktime (date("H"),date("i")+10,date("s"),date("m"),date("d"),date("Y")));
		$this->db->query("UPDATE dacons_labels SET viewed = viewed + 1, viewed_date = '$dt' where id = '$id' AND viewed_date < now()");
	}

}

?>
