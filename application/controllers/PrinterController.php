<?php
/*
 * Создан: 30.10.2007 14:17:45
 * Автор: Александр Перов
 */

	require_once 'Zend_Controller_ActionWithInit.php';
	require_once 'Zend/Validate/Digits.php';
	/*
	require_once 'application/models/Companies.php';
	require_once 'application/models/Cities.php';
	require_once 'application/models/Labels.php';
	require_once 'application/models/Companies_Labels.php';
	require_once 'application/models/People_Company.php';
	require_once 'application/models/People.php';
	require_once 'application/models/Events.php';
	*/

	class PrinterController extends Zend_Controller_ActionWithInit{

		public function postDispatch(){
			echo $this->view->render($this->template.'.tpl');
 		}

		public function indexAction() {
			global $conf;
            $this->_redirect($conf['siteurl']."index");
		}

		public function companyInfoAction() {
			//require_once 'application/models/Company_Properties.php';
			if ($this->session->current_company == "") die('null');

			//$companies = new Companies();
			$sql = "id = '".$this->session->current_company."' AND manager = '".$this->session->id."'";

			if ($this->session->is_super_user == 1) {
				$sql = "id = '".$this->session->current_company."' AND manager in (SELECT id FROM dacons_users WHERE customer_id ='".$this->session->customer_id."')";
			}

			$company = $this->db->fetchObject("select * from dacons_companies where ".$sql);

			$this->view->company = $company->name;
			$this->view->name = $company->name;
			$this->view->relations = $company->relations;
			$this->view->phone = $company->phone;
			$this->view->site = $company->site;
			$this->view->email = $company->email;
			$this->view->address = $company->address;
			$this->view->about = $company->about;

			//$this->view->city = $company->findParentRow('Cities')->name;
			
			//$this->view->labels = $company->findLabelsViaCompanies_LabelsByCompany()->toArray();
			$this->view->labels = $this->db->fetchAll("SELECT L.name" .
                                              " FROM dacons_labels as L" .
                                              " LEFT JOIN dacons_companies_labels as lc" .
                                              " ON lc.label_id = L.id" .
                                              " WHERE lc.company_id = '{$this->session->current_company}'" .
                                              " ORDER BY L.id ASC");
			//$this->view->people = $company->findPeopleViaPeople_CompanyByCompany()->toArray();
			//$company_list[$k]["people"] = $company->findPeopleViaPeople_CompanyByCompany()->toArray();
            $this->view->people = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
                                              " p.comment as comment, p.phone as phone" .
                                              " FROM dacons_people as p" .
                                              " LEFT JOIN dacons_people_company as pc" .
                                              " ON pc.person_id = p.id" .
                                              " WHERE pc.company_id = '{$this->session->current_company}'" .
                                              " ORDER BY p.id ASC");

			// определяем страницу

			$page = $this->getRequest()->getParam('page');

			if ($page == null) $page = 1;

			// проверить page
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

			//$events = new Events();
			$this->view->events = $this->db->fetchAll("SELECT * FROM `dacons_events` WHERE `company_id` = '".$this->session->current_company."' " .
									 " ORDER BY `date` DESC limit ".(($page-1)*20).",20");

             // реквезиты
            //$properties = new Company_Properties();
            $property = $this->db->fetchAll("select * from dacons_company_properties where `company_id` = '".$this->session->current_company."' " .
                                              "AND (INN <> '' OR KPP <> '' OR settlementAccount <> '' OR bank <> '' " .
                                              "OR BIK <> '' OR account <> '' OR OKPO <> '' OR OKONH <> '' " .
                                              "OR OGRN <> '' OR OKVED <> '' OR cname <> '' OR director <> '')");
            $this->view->props = $property;

			$this->template = "printer/printCompany";
		}

		/**
		 * список компаний (копия метода MainController displayCompaniesList())
		 */
		public function companiesListAction() {

            $mode = $this->getRequest()->getParam('mode');
			$mparam = '';

            $user_id = $this->session->id;
            $where = "";
            switch ($mode) {
                case "all":
                    $where = "manager = '$user_id' ORDER BY name";

                    if ($this->session->is_super_user == 1) {
                        $where = "manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ORDER BY name";
                    }

                    $this->view->nowLocation = _("все");
                    $this->view->controller = "main/searchCompany";
                    break;
                case "word":
                    // проверка буквы
                    $mparam = $this->getRequest()->getParam('mparam');

                    $where = "manager = '$user_id' AND name like '".$this->db->quote($mparam."%")."' ORDER BY name";

                    if ($this->session->is_super_user == 1) {
                        $where = "manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND name like '".$this->db->quote($mparam."%")."' ORDER BY name";
                    }
				

                    $this->view->nowLocation = _("на букву")." \"$mparam\"";
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
                    }

                    if ($mparam == 1)
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
                             "left join dacons_companies_labels as cl on cl.label_id = l.id " .
                             "left join dacons_companies as c on c.id = cl.company_id " .
                             "WHERE c.manager = '$user_id' AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

                    if ($this->session->is_super_user == 1) {
                        $where = "SELECT DISTINCT c.* FROM dacons_labels as l " .
                                 "left join dacons_companies_labels as cl on cl.label_id = l.id " .
                                 "left join dacons_companies as c on c.id = cl.company_id " .
                                 "WHERE c.manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') AND l.name=(SELECT name FROM dacons_labels WHERE id='$mparam') ORDER BY c.name";

                    }


                    $this->view->nowLocation = _("Метка:") . " <span class=\"color1\">".$label->name."</span>";
                    $this->view->controller = "main/searchCompanyLabels";


                    break;
                 case "favorites":
                    $this->view->nowLocation = _("избранное");
                    $this->view->controller = "main/searchCompany";
                 break;

                 case "manager":
                    $mparam = $this->getRequest()->getParam('mparam');
                    if (!is_numeric($mparam)) {die();}

                    $this->view->manager = $mparam;
                    $this->view->nowLocation = _("менеджер");
                    $this->view->controller = "main/searchCompany";
                 break;

            default:
                    global $conf;
            		$this->_redirect($conf['siteurl']."/error");
            }
            //$companies = new Companies();

            $this->view->mode = $mode;
            $this->view->mparam = $mparam;


            $page = $this->getRequest()->getParam('page');

            $limit_label = "";

            if ($page != null) {

                $validator = new Zend_Validate_Digits();
                if (!$validator->isValid($page)) {
                    $page = 1;
                }

                $sql = "SELECT count(id) as `cnt` FROM `dacons_companies` WHERE ".$where;

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
                    }

                }

                if ($mode=="favorites") {
                    $sql = "SELECT count(c.id) as `cnt` FROM dacons_companies as c LEFT JOIN dacons_favorite_companies as f on f.company_id = c.id WHERE f.user_id = '$user_id'";
                }

                if ($mode=="manager") {
                    $sql = "SELECT count(id) as `cnt` FROM dacons_companies WHERE manager='$mparam' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."')";
                }

                $temp = $this->db->fetchRow($sql);

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
                    $sql = "SELECT c.id as id FROM dacons_companies as c LEFT JOIN dacons_favorite_companies as f on f.company_id = c.id WHERE f.user_id = '$user_id' ".$limit_label;
            }

            if ($mode=="manager") {
                    $sql = "SELECT id FROM dacons_companies WHERE manager='$mparam' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ".$limit_label;
                    if ($mparam==-1) {
                        $sql = "SELECT id FROM dacons_companies WHERE manager in (SELECT id FROM dacons_users WHERE customer_id = '".$this->session->customer_id."') ".$limit_label;
                    }
            }

            $companies_ids = $this->db->fetchAll($sql);


            
            foreach ($companies_ids as $k => $v) {
                //Zend_Debug::dump($v, $label=null, $echo=true);
                $id = $v["id"];

                // prop
                $company = $this->db->fetchObject("select * from dacons_companies where id = '$id' ");
                $company_list[$k]["prop"] = $this->db->fetchRow("select * from dacons_companies where id = '$id' ");
                //$company_list[$k]["prop"]["city"] = $company->findParentRow('Cities')->name;
                // site email
                $company_list[$k]["site"] = explode(",",$company_list[$k]["prop"]["site"]);
                $company_list[$k]["email"] = explode(",",$company_list[$k]["prop"]["email"]);
                // labels

                $company_list[$k]["labels"] = $this->db->fetchAll("SELECT L.id as id, L.name as name, L.parent_id as parent_id, (select picture from dacons_labels where id=L.parent_id) as picture FROM `dacons_labels` as L " .
                                "LEFT JOIN dacons_companies_labels as c on c.label_id = L.id " .
                                "WHERE c.company_id = '".$company->id."' AND L.parent_id<>0 " .
                                "AND L.customer_id = '".$this->session->customer_id."' " .
                                "ORDER BY L.parent_id");

                // people
                //$company_list[$k]["people"] = $company->findPeopleViaPeople_CompanyByCompany()->toArray();
                $company_list[$k]["people"] = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
                                              " p.comment as comment, p.phone as phone" .
                                              " FROM dacons_people as p" .
                                              " LEFT JOIN dacons_people_company as pc" .
                                              " ON pc.person_id = p.id" .
                                              " WHERE pc.company_id = '$id'" .
                                              " ORDER BY p.id ASC");


            }

            $this->view->companyList = $company_list;
            $this->template = "printer/printCompaniesList";
		}


        public function printSelectedAction() {

            $companies_ids = array();
            $company_list = array();

            foreach ($this->getRequest()->getParams() as $k => $v) {
                if (preg_match("/^checkComp([0-9]*)$/",$k,$match))
                {
                    if (is_numeric($match[1])) {
                        $companies_ids[] = $match[1];
                    }
                }
            }

            //$companies = new Companies();
            foreach ($companies_ids as $k => $v) {
                $id = $v;

                // prop
                /*-
                $company = $companies->fetchRow("id = '$id' ");
                $company_list[$k]["prop"] = $company->toArray();
				*/
                $company = $this->db->fetchObject("select * from dacons_companies where id = '$id' ");
                $company_list[$k]["prop"] = $this->db->fetchRow("select * from dacons_companies where id = '$id' ");
                //$company_list[$k]["prop"]["city"] = $company->findParentRow('Cities')->name;
                // site email
                $company_list[$k]["site"] = explode(",",$company_list[$k]["prop"]["site"]);
                $company_list[$k]["email"] = explode(",",$company_list[$k]["prop"]["email"]);
                // labels

                $company_list[$k]["labels"] = $this->db->fetchAll("SELECT L.id as id, L.name as name, L.parent_id as parent_id, (select picture from dacons_labels where id=L.parent_id) as picture FROM `dacons_labels` as L " .
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


            }

            $this->view->companyList = $company_list;
            $this->template = "printer/printCompaniesList";
        }

	}
?>
