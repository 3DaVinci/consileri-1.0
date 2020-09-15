<?php
/*
 * Создан: 01.11.2007 11:47:57
 * Автор: Александр Перов
 */

if(!function_exists('get_called_class')) {
    function get_called_class($bt = false,$l = 1) {
        if (!$bt) $bt = debug_backtrace();
        if (!isset($bt[$l])) throw new Exception("Cannot find called class -> stack level too deep.");
        if (!isset($bt[$l]['type'])) {
            throw new Exception ('type not set');
        }
        else switch ($bt[$l]['type']) {
            case '::':
                $lines = file($bt[$l]['file']);
                $i = 0;
                $callerLine = '';
                do {
                    $i++;
                    $callerLine = $lines[$bt[$l]['line']-$i] . $callerLine;
                } while (stripos($callerLine,$bt[$l]['function']) === false);
                preg_match('/([a-zA-Z0-9\_]+)::'.$bt[$l]['function'].'/',
                            $callerLine,
                            $matches);
                if (!isset($matches[1])) {
                    // must be an edge case.
                    throw new Exception ("Could not find caller class: originating method call is obscured.");
                }
                switch ($matches[1]) {
                    case 'self':
                    case 'parent':
                        return get_called_class($bt,$l+1);
                    default:
                        return $matches[1];
                }
                // won't get here.
            case '->': 
                if (!is_object($bt[$l]['object'])) throw new Exception ("Edge case fail. __get called on non object.");
                return get_class($bt[$l]['object']);

            default: throw new Exception ("Unknown backtrace method type");
        }
    }
}

function parsePeopleData($people) {

    $i = 0;
    $result = array();
    $peopleArray = split("\n\r\n",$people);

    foreach ($peopleArray as $k => $v) {

        $isFirst = true;
        $peopleData = split(",",$v);
        foreach ($peopleData as $k2 => $v2) {

            if (ereg("^[^@]+@([a-z0-9\-]+\.)+[a-z]{2,4}$",trim($v2))) {

                if (trim($v2)!="")
                    if ($result[$i]['email']=="") {
                        $result[$i]['email'] = trim($v2);
                    } else {
                        $result[$i]['email'] .= ", ".trim($v2);
                    }

            } else if ($isFirst) {

                    if (trim($v2)!="")
                        if ($result[$i]['fio']=="") {
                            $result[$i]['fio'] = trim($v2);
                        }
                    $isFirst = false;

                } else if (ereg("^[0-9 ()-]+$",trim($v2))) {

                        if (trim($v2)!="")
                            if ($result[$i]['phone']=="") {
                                $result[$i]['phone'] = trim($v2);
                            } else {
                                $result[$i]['phone'] .= ", ".trim($v2);
                            }

                    } else {

                        if (trim($v2)!="")
                            if ($result[$i]['comment']=="") {
                                $result[$i]['comment'] = trim($v2);
                            } else {
                                $result[$i]['comment'] .= ", ".trim($v2);
                            }

                    }

        }

        $i++;
    }

    return $result;
}

function getCSV ($db, $session) {
    $head = _("id;Название;Телефоны;E-mail;Сайты;Адреса;Примечание;Реквизиты1;Реквизиты2;Реквизиты3;Реквизиты4;");
    $companies = $db->fetchAll("SELECT id,name,phone,email,site,address,about FROM dacons_companies WHERE manager in (SELECT id FROM dacons_users WHERE customer_id = '".$session->customer_id."')");

    $line = "";
    $pcount = 0;
    foreach ($companies as $v) {

		$line .= '"'.str_replace('"', '""', str_replace("\r","",$v['id'])).'";';
		$line .= '"'.str_replace('"', '""', str_replace("\r","",$v['name'])).'";';
		$line .= '"'.str_replace('"', '""', str_replace("\r","",$v['phone'])).'";';
		$line .= '"'.str_replace('"', '""', str_replace("\r","",$v['email'])).'";';
		$line .= '"'.str_replace('"', '""', str_replace("\r","",$v['site'])).'";';
        $line .= '"'.str_replace('"', '""', str_replace("\r","",$v['address'])).'";';
        $line .= '"'.str_replace('"', '""', str_replace("\r","",$v['about'])).'";';

        $props = $db->fetchAll("SELECT * FROM dacons_company_properties WHERE company_id = '".$v['id']."'");

        foreach($props as $v2) {
			$line.='"';
            if ($v2['INN']!="") $line .= _("ИНН:")." ".$v2['INN']."\n";
            if ($v2['KPP']!="") $line .= _("КПП:")." ".$v2['KPP']."\n";
            if ($v2['settlementAccount']!="") $line .= _("p/c")." ".$v2['settlementAccount']."\n";
            if ($v2['bank']!="") $line .= _("В банке:")." ".$v2['bank']."\n";
            if ($v2['BIK']!="") $line .= _("БИК:")." ".$v2['BIK']."\n";
            if ($v2['account']!="") $line .= _("к/c:")." ".$v2['account']."\n";
            if ($v2['OKPO']!="") $line .= _("ОКПО:")." ".$v2['OKPO']."\n";
            if ($v2['OKONH']!="") $line .= _("ОКОНХ:")." ".$v2['OKONH']."\n";
            if ($v2['OGRN']!="") $line .= _("ОГРН:")." ".$v2['OGRN']."\n";
            if ($v2['OKVED']!="") $line .= _("ОКВЕД:")." ".$v2['OKVED']."\n";
            if ($v2['cname']!="") $line .= _("Наименование:")." ".$v2['cname']."\n";
            if ($v2['director']!="") $line .= _("Руководитель:")." ".$v2['director']."\n";
            if ($v2['address']!="") $line .= _("Адрес:")." ".$v2['address']."\n";
            //
            if ($line[strlen($line)-1]=="\n") {
                $line = substr($line,0,strlen($line)-1);
            }
			$line.='";';
        }

        if (sizeof($props)==0) {$line .= ";;;;";}
        if (sizeof($props)==1) {$line .= ";;;";}
        if (sizeof($props)==2) {$line .= ";;";}
        if (sizeof($props)==3) {$line .= ";";}

        $people = $db->fetchAll("SELECT p.fio,p.phone,p.email,p.comment FROM dacons_people_company as pc " .
            "LEFT JOIN dacons_people as p ON pc.person_id = p.id " .
            "WHERE pc.company_id = '".$v['id']."'");
        $tpcount = 0;
        foreach($people as $v3) {
			$line .= '"';
            if (array_key_exists('fio', $v3) && ($v3['fio']!="")) 
				$line .= str_replace('"', '""', str_replace("\r","",$v3['fio']))."\n";
            if (array_key_exists('phone', $v3) && ($v3['phone']!="")) 
				$line .= str_replace('"', '""', str_replace("\r","",$v3['phone']))."\n";
            if (array_key_exists('email', $v3) && ($v3['email']!="")) 
				$line .= str_replace('"', '""', str_replace("\r","",$v3['email']))."\n";
            if (array_key_exists('comment', $v3) && ($v3['comment']!="")) 
				$line .= str_replace('"', '""', str_replace("\r","",$v3['comment']))."\n";
			if ($line[strlen($line)-1]=="\n") {
                $line = substr($line,0,strlen($line)-1);
            }
            $line .= '";';
            $tpcount++;
        }


        $line .= "\r\n";
        if ($tpcount>$pcount) $pcount = $tpcount;
    }

    for ($index = 1; $index <= $pcount; $index++) {
        $head .= _("Контактное лицо")." ".$index.";";
    }


    $contents = $head."\n".$line;
    return $contents;
}

class MySQLDriver {
    private $conn;
    private $res;
    function __construct ($dbconfig) {
        $this->conn = mysql_connect ($dbconfig['host'], $dbconfig['username'], $dbconfig['password']);
        //echo "mysql_connect ({$dbconfig['host']}, {$dbconfig['username']}, {$dbconfig['password']});";
        mysql_query ("use `".$dbconfig['dbname']. "`");
        global $is_demo;
        $this->is_demo = $is_demo;
    }
    function query ($query) {
        if ($this->is_demo) {
            $query_type = strtolower (substr ($query, 0, 6));
            $denied_types = array ('update', 'insert', 'delete');
            if (in_array ($query_type, $denied_types)) return;
        }
        if (empty ($query)) return;
        $this->res = mysql_query ($query);
        if (($msg = mysql_error ($this->conn)) != '') {
            die ("<br>error in query: <br>$query<br><br>$msg");
        }
        return $this->res;
    }
    function fetchRow ($query) {
    //echo "<br>$query";
        if (! is_resource ($query)) $this->query ($query);
        return mysql_fetch_assoc ($this->res);
    }

    function fetchObject ($query) {
    //echo "<br>$query";
        if (! is_resource ($query)) $this->query ($query);
        return mysql_fetch_object ($this->res);
    }
	
    function fetchAll ($query) {
        $ret_arr = array ();
        if (! is_resource ($query)) $this->query ($query);
        while ($row = mysql_fetch_assoc ($this->res)) {
            $ret_arr [] = $row;
        }
        return $ret_arr;
    }
	
    function quote ($str) {
        return mysql_real_escape_string($str);
    }

    function insert ($table, $values) {
        if ($this->is_demo) return;
        $keys_arr = array_keys ($values);
        foreach ($keys_arr as & $key) {
            $key = "`$key`";
        }
        $keys = join (', ', $keys_arr);
        $values_arr = array_values ($values);
        foreach ($values_arr as & $value) {
            if (get_magic_quotes_gpc()) { $value = stripslashes($value); }
            $value = '"'.$this->quote ($value).'"';
        }
        $values = join (', ', $values_arr);
        $query = "insert into $table($keys) values($values)";
        $this->query ($query);
        return mysql_insert_id();
    }
    function update ($table, $values, $where) {
        if ($this->is_demo) return;
        $query = "update $table set ";
        $set_arr = array ();

        foreach ($values as $key => $value) {
            if (get_magic_quotes_gpc()) { $value = stripslashes($value); }
            $set_arr [] = " $key = '".$this->quote ($value)."' ";
        }
        $query .= join (', ', $set_arr);

        $query .= " where $where";
        $this->query ($query);
    }

    function delete ($table, $where) {
        if ($this->is_demo) return;
        $query = "delete from  $table  ";
        $query .= " where $where";
        $this->query ($query);
    }
    function fetchCol ($query) {
        $arr = $this->fetchAll($query);
        $ret_arr = array ();
        if (count ($arr) < 1) return $ret_arr;
        $keys = array_keys ($arr[0]);
        $key = $keys [0];
        foreach ($arr as $k => $row) {
            $ret_arr [] = $row [$key];
        }
        return $ret_arr;
    }

    function fetchOne ($query) {
        $arr = $this->fetchRow($query);
        $ret_arr = array ();
        if (count ($arr) < 1) return null;
        $keys = array_keys ($arr);
        return $arr [$keys[0]];
    }
}

?>
