<?php
/*
 * Создан: 08.11.2007 10:27:58
 * Автор: Александр Перов
 */

require_once 'Zend_Controller_ActionWithInit.php';
require_once 'Zend/Validate/Digits.php';
require_once 'Zend/Validate/NotEmpty.php';
require_once 'Zend/Validate/EmailAddress.php';


class SmsmailingController extends Zend_Controller_ActionWithInit {

    public function preDispatch() {
        parent::preDispatch();
        if ($this->session->is_super_user == "") $this->_redirect("/index");
        global $is_demo;
        $this->view->is_demo = $is_demo;
        $this->view->doNotShowPDAlink = true;
        $this->trackPages();
    }

    public function indexAction() {
        $this->template = "smsmailing/index";
        //<encoder_start>
        if (is_null($this->getRequest()->getParam('id'))) {
            $this->view->showInfo = true;
        }

        $id = $this->getRequest()->getParam("id");
        //<encoder_end>
        if (!is_numeric($id) || $id=="") {
            $temp = $this->db->fetchRow("SELECT id FROM dacons_users WHERE customer_id='".$this->session->customer_id."' LIMIT 1");
            $id = $temp["id"];
        }
		
		$sql = "SELECT id, nickname FROM dacons_users WHERE customer_id = '".$this->session->customer_id."' AND readonly<>1 AND is_admin<>1 ORDER BY nickname";
        $this->view->managers = $this->db->fetchAll($sql);
		
		$category = $this->db->fetchAll("SELECT id,name,picture FROM dacons_labels WHERE parent_id = 0 AND customer_id = '".$this->session->customer_id."'");

        for ($index = 0; $index < sizeof($category); $index++) {
            $category[$index]['labels'] = $this->db->fetchAll("SELECT id,name FROM dacons_labels WHERE parent_id = '".$category[$index]['id']."'");
        }

        $this->view->labelsRoot = $category;
        
    }
	
	public function completeAction () {
		$phone_regexp = '(7|8)9[0-9]{9}';
		$preg_phone_regexp = '/(7|8)9[0-9]{9}/';
		
		// создаем строку условия для выбора менеджера
		$manager_ids = array ();
		if (isset ($_POST ['man']) && is_array ($_POST ['man'])) {
			$manager_ids = array_keys ($_POST ['man']);
			foreach ($manager_ids as & $id) {
				$id = intval ($id);
			}
		}
		
		if (empty ($manager_ids)) $manager_ids [] = 0;
		$manager_ids_str = 'and manager in ('.join (', ', $manager_ids).')';
		
		// создаем строку условия для выбора тегов
		$labels_ids = array ();
		if (isset ($_POST ['lab']) && is_array ($_POST ['lab'])) {
			$labels_ids = array_keys ($_POST ['lab']);
			foreach ($labels_ids as & $id) {
				$id = intval ($id);
			}
		}
		
		if ( ! empty ($labels_ids)) {
			$labels_ids_str = 'and label_id in ('.join (', ', $labels_ids).')';
		}
		else {
			$labels_ids_str = '';
		}
		$labels_count = count ($labels_ids);
		
		
		
		
		$where = "";
		
		$sql = "SELECT
				id, name, 
				(
					SELECT count( cl.company_id )
					FROM `dacons_companies_labels` cl
					WHERE c.id = cl.company_id
					$labels_ids_str
					GROUP BY cl.company_id
				) AS labels_count
				FROM dacons_companies c 
				WHERE 
					manager in (SELECT id FROM dacons_users WHERE customer_id = ".$this->session->customer_id.")
                    AND
                   (
	                    #(REPLACE(REPLACE (name,'-',''),' ','') LIKE '%$phone_regexp%') OR
						name    regexp '$phone_regexp' or
						phone   regexp '$phone_regexp' or
						address regexp '$phone_regexp' or
						email   regexp '$phone_regexp' or
						site    regexp '$phone_regexp' or 
	                    (id in (
	                        SELECT pc.company_id FROM dacons_people p LEFT JOIN dacons_people_company pc on pc.person_id = p.id WHERE
							#SELECT fio, email, comment, phone FROM `dacons_people` p where 
							p.phone regexp '$phone_regexp'
							or p.fio regexp '$phone_regexp'
							or p.comment regexp '$phone_regexp'
							or p.email regexp '$phone_regexp'
	                        )
                        )
                  )
                  $manager_ids_str
			      having labels_count >= $labels_count
				  ORDER BY name ";
				  
		$companies_ids = $this->db->fetchAll($sql);
		
		$companies_csv = array ();
		//var_dump ($companies_ids);
		
		foreach ($companies_ids as $k => $v) {
            $id = $v["id"];
            $info = $this->db->fetchRow("select * from dacons_companies where id = '$id' ");

            foreach ($info as $key => $value) {
				preg_match_all ($preg_phone_regexp, $value, $out);
				//print_r ($out);
				if (! empty ($out [0]) ) {
					foreach ($out [0] as $val) {
						$companies_csv [] = array ('phone' => $val, 'name' => $info ['name']);
					}
				}
            }
			
			$people = $this->db->fetchAll("select * from dacons_people where id in ( select person_id from dacons_people_company where company_id = '$id') ");
			
			foreach ($people as $person) {
				foreach ($person as $key => $value) {
					preg_match_all ($preg_phone_regexp, $value, $out);
					//print_r ($out);
					if (! empty ($out [0]) ) {
						foreach ($out [0] as $val) {
							$person_str = join ($person, ",");
							$companies_csv [] = array ('phone' => $val, 'name' => $info ['name'], 'person' => $person_str);
						}
					}
	            }
			}
		}
		
		$this->view->companies_csv = $companies_csv;
		$this->view->companies_ids = $companies_ids;
		
		
		$createDate = time();
        require_once "functions.php";
        $filename = "exportdata/SMS_".date("Y-m-d_H-i",$createDate).".csv";
        $fp = fopen($filename,"w");
        $contents = _("Номер\tКомпания\tЛицо\t\n");
		foreach ($companies_csv as $contact) {
			$line = "";
			foreach ($contact as $k => $v) {
				$line .= "$v\t";
			}
			$contents .= $line . "\n";
		}
        //$contents = str_replace(";", "\t", $contents);
        $contents = iconv("UTF-8", "UTF-16LE", $contents);
        $contents = chr(hexdec('FF')) . chr(hexdec('FE')) . $contents;
        fwrite ($fp, $contents);
        fclose ($fp);
        $this->view->url = $filename;
		
		
		
		
		
		//$this->view->url = 'http://xxx.ru/sms_export_4.05.10.csv';
		$this->template = "smsmailing/complete";
		
	}


}

?>
