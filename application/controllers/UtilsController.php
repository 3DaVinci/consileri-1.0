<?php

/*
 * Создан: 08.11.2007 10:27:58
 * Автор: Александр Перов
 */

require_once 'Zend_Controller_ActionWithInit.php';

class UtilsController extends Zend_Controller_ActionWithInit {

    public function indexAction() {

        $dbparams = $this->getInvokeArg('dbconfig');

        $tables_arr = $this->db->fetchAll("SHOW TABLES FROM `" . $dbparams["dbname"] . "`");
        foreach ($tables_arr as $table) {
            $tables [] = $table [0];
        }

        for ($index = 0; $index < sizeof($tables); $index++) {
            $table = $tables[$index];
            $this->db->query("OPTIMIZE TABLE `$table`")->execute();
        }

        $this->template = "utils/dbOptimize";
    }

    public function optimizesearchindexAction() {
        require_once 'application/classes/search/TextSearcher.php';

        TextSearcher::optimize();

        echo "Индекс оптимизирован. ";
        die();
    }

    public function repairsearchindexAction() {
        require_once 'application/classes/search/TextSearcher.php';
        require_once 'Zend/Search/Lucene/Storage/File/Filesystem.php';

        $limit = 20;
        if ($this->getRequest()->getParam('offset')) {
            $offset = $this->getRequest()->getParam('offset');
        } else {
            $offset = 0;
        }
        if ($this->getRequest()->getParam('limit')) {
            $limit = $this->getRequest()->getParam('limit');
        }
                
        $companiesCount = $this->db->fetchOne("select count(*) from dacons_companies");
        
        $companies = $this->db->fetchAll("select *  from dacons_companies limit $offset, $limit");

        foreach ($companies as $company) {
            $company['people'] = $this->db->fetchAll("SELECT p.id as id, p.fio as fio, p.email as email," .
			" p.comment as comment, p.phone as phone" .
			" FROM dacons_people as p" .
			" LEFT JOIN dacons_people_company as pc" .
			" ON pc.person_id = p.id" .
			" WHERE pc.company_id = '".$company['id']."'");            

            TextSearcher::addOrUpdateCompany($company);
            $offset++;
        }

        TextSearcher::commit();

        if ($companiesCount > $offset) {
            header("Refresh: 1; url=".$this->getInvokeArg("url")."/utils/repairsearchindex?offset={$offset}&limit={$limit}");
            echo "Проверено " . $offset . " компаний. ";
            die();
        }

        echo "Индексация завершена. Проиндексировано {$offset} компаний. ";
        $this->optimizesearchindexAction();
    }

    public function searchindexinfoAction() {
        require_once 'application/classes/search/TextSearcher.php';
        print_r(TextSearcher::getInfo());
        die();
    }

}

?>
