<?php
/*
 * Создан: 30.10.2007 14:23:53
 * Автор: Александр Перов
 */ 

//include('logging.php');

//$search = iconv("UTF-8","utf8",$_REQUEST['search']);
//echo $search."-".$_REQUEST['search']; 

include_once "functions.php";

require_once 'Zend/Session.php';
$session = new Zend_Session_Namespace('auth');
if ($session->id=="") die();

// customer_id добавить проверку

require_once 'conf/config.php';	
$upload_path = 'uploads/';

global $dbconfig;
$db = new MySQLDriver ($dbconfig);
$db->query ("set names utf8");

$section = $_REQUEST['section'];    

function checkCompany($company,$session,$connection) {
    global $db;
    if ($session->is_super_user == 1) {
        $sql = "SELECT id FROM `dacons_companies` WHERE id='$company' AND manager in (SELECT id FROM dacons_users WHERE customer_id='$session->customer_id') limit 1";
    } else {
        $sql = "SELECT id FROM `dacons_companies` WHERE id='$company' AND manager = '$session->id' limit 1";
    }

    if ($db->fetchRow($db->query($sql,$connection)) == null) return false; else return true;
}

function  randomName($length = 10){
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}

if ($section=='1') // поиск компании
{
    ob_start();
    $search = str_replace("'","\'",$_REQUEST['search']);
    print('<select name="company_vrnt" id="company_vrnt" ondblclick="companyElement.vrnt_dblclick()" onkeydown="companyElement.vrnt_keydown(event,this)" size="6">');

    $sql = "SELECT `id`,`name` FROM `dacons_companies` WHERE `name` like '".$search."%' AND manager in (SELECT id FROM dacons_users WHERE customer_id = '$session->customer_id') LIMIT 10";
    $result = $db->query($sql,$connection);

    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='2') // удалить
{
    ob_start();
    print('<select name="label1_vrnt" id="label1_vrnt" ondblclick="label1Element.vrnt_dblclick()" onkeydown="label1Element.vrnt_keydown(event,this)" size="6" style="width:200px;">');

    if ($session->is_super_user==1) {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l" .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager in " .
            " (SELECT id FROM dacons_users " .
            " WHERE customer_id = '".$session->customer_id."')";
    } else {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l " .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager='".$session->id."'";
    }

    $result = $db->query($sql,$connection);
    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='3') // удалить
{
    ob_start();
    print('<select name="label2_vrnt" id="label2_vrnt" ondblclick="label2Element.vrnt_dblclick()" onkeydown="label2Element.vrnt_keydown(event,this)" size="6" style="width:200px;">');

    if ($session->is_super_user==1) {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l" .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager in " .
            " (SELECT id FROM dacons_users " .
            " WHERE customer_id = '".$session->customer_id."')";
    } else {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l " .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager='".$session->id."'";
    }

    $result = $db->query($sql,$connection);
    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='4') // удалить
{
    ob_start();
    print('<select name="label3_vrnt" id="label3_vrnt" ondblclick="label3Element.vrnt_dblclick()" onkeydown="label3Element.vrnt_keydown(event,this)" size="6" style="width:200px;">');

    if ($session->is_super_user==1) {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l" .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager in " .
            " (SELECT id FROM dacons_users " .
            " WHERE customer_id = '".$session->customer_id."')";
    } else {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l " .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager='".$session->id."'";
    }

    $result = $db->query($sql,$connection);
    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='5') // удалить
{
    ob_start();
    print('<select name="label4_vrnt" id="label4_vrnt" ondblclick="label4Element.vrnt_dblclick()" onkeydown="label4Element.vrnt_keydown(event,this)" size="6" style="width:200px;">');

    if ($session->is_super_user==1) {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l" .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager in " .
            " (SELECT id FROM dacons_users " .
            " WHERE customer_id = '".$session->customer_id."')";
    } else {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l " .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager='".$session->id."'";
    }

    $result = $db->query($sql,$connection);
    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='6') // удалить
{
    ob_start();
    print('<select name="label5_vrnt" id="label5_vrnt" ondblclick="label5Element.vrnt_dblclick()" onkeydown="label5Element.vrnt_keydown(event,this)" size="6" style="width:200px;">');

    if ($session->is_super_user==1) {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l" .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager in " .
            " (SELECT id FROM dacons_users " .
            " WHERE customer_id = '".$session->customer_id."')";
    } else {
        $sql = "SELECT DISTINCT l.`id`,l.`name` FROM `dacons_labels` as l " .
            " LEFT JOIN dacons_companies_labels as cl" .
            " ON cl.label_id = l.id" .
            " LEFT JOIN dacons_companies as c" .
            " ON c.id = cl.company_id" .
            " WHERE l.`name` like '".$_REQUEST['search']."%' " .
            " AND c.manager='".$session->id."'";
    }

    $result = $db->query($sql,$connection);
    while ($rs = $db->fetchRow($result)) {
        echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
    }
    print('</select>');
    echo ob_get_clean();
    die();
}

if ($section=='10') { /* изменение истории */

    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}

    $header = str_replace("'","\'",$_REQUEST['header']);
    $comment = str_replace("'","\'",$_REQUEST['comment']);

			/*
			$header = iconv("UTF-8","utf8",$_REQUEST['header']);
			if ($header=="") $header = $_REQUEST['header'];
			$header = str_replace("'","\'",$header);

			$comment = iconv("UTF-8","utf8",$_REQUEST['comment']);
			if ($comment=="") $comment = $_REQUEST['comment'];
			$comment = str_replace("'","\'",$comment);
			*/			

    // проверяем право на изменение
    $granted = false;

    if ($_SESSION['auth']['is_super_user']) {
        $sql = "SELECT id FROM `dacons_events` WHERE id = '$id' AND company_id = (SELECT id FROM dacons_companies WHERE  manager in (SELECT id FROM dacons_users WHERE customer_id='$session->customer_id') limit 1) limit 1";
    } else {
        $today = date ("Y-m-d H:i:s", mktime (0,0,0,date("m"),date("d")+1,date("Y")));
        $yesterdayEnd = date ("Y-m-d H:i:s", mktime (0,0,0,date("m"),date("d")-1,date("Y")));
        $sql = "SELECT id FROM `events` WHERE id = '$id' AND company_id = (SELECT id FROM dacons_companies WHERE  manager = '$session->id' limit 1) AND `date` <= '$today' AND `date` > '$yesterdayEnd' limit 1";
    }

    $result = $db->query($sql,$connection);
    if ($result != null) $granted = true;


    if ($granted) {
        $sql = "UPDATE `dacons_events` SET name = '$header', comment = '$comment' WHERE id = '$id'";
        $result = $db->query($sql,$connection);
        echo true;
    } else echo false;

}	

if ($section=='11') { /* удаление истории */

    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}
    $header = str_replace("'","\'",$_REQUEST['header']);
    $comment = str_replace("'","\'",$_REQUEST['comment']);

    // проверяем право на изменение
    $granted = false;

    if ($_SESSION['auth']['is_super_user']) {
        $sql = "SELECT id FROM `dacons_events` WHERE id = '$id' AND company_id = (SELECT id FROM dacons_companies WHERE  manager in (SELECT id FROM dacons_users WHERE customer_id='$session->customer_id') limit 1) limit 1";
    } else {
        $today = date ("Y-m-d H:i:s", mktime (0,0,0,date("m"),date("d")+1,date("Y")));
        $yesterdayEnd = date ("Y-m-d H:i:s", mktime (0,0,0,date("m"),date("d")-1,date("Y")));
        $sql = "SELECT id FROM `dacons_events` WHERE id = '$id' AND company_id = (SELECT id FROM dacons_companies WHERE  manager = '$session->id' limit 1) AND `date` <= '$today' AND `date` > '$yesterdayEnd' limit 1";
    }

    $result = $db->query($sql,$connection);
    if ($result != null) $granted = true;

    if ($granted) {
        $sql = "DELETE FROM dacons_events WHERE id = '$id'";
        $result = $db->query($sql,$connection);
        echo true;
    } else echo false;

}	

if ($section=='15') { /* управление избранным */

    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}
    $action = $_REQUEST['action'];

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    if ($action=="add") {
        $sql = "INSERT INTO dacons_favorite_companies (`company_id`,`user_id`) VALUES ('$company_id','$session->id')";
    } else {
        $sql = "DELETE FROM dacons_favorite_companies WHERE company_id = '$company_id' AND user_id = '$session->id'";
    }
    //echo $sql;

    $result = $db->query($sql);
    //echo $sql;
    //var_dump ($result);
    //echo mysql_error ();
    //print mysql_affected_rows ($result);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
    die ();

}	

if ($section=='16') { /* вывод своих напоминаний */

    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "SELECT `date`,`text` FROM `dacons_reminders` WHERE company_id='$company_id' AND user_id = '$session->id' ORDER BY `date`";
    $result = $db->query($sql,$connection);

    include('incl/month.php');
    include('incl/dateFormater.php');

    ob_start();

    $first = true;
    while ($rs = $db->fetchRow($result)) {
        $mn = smarty_modifier_date_format($rs['date'],"%d.%m.%Y");//." ".$month[smarty_modifier_date_format($rs['date'],"%m")];
        if ($mn!="01.01.2000") $mn = "<span id=\"na2\" style=\"color:#dc8009\">$mn</span>";
        if ($rs['date']=='2000-01-01 00:00:00') $mn = "";
        $mt = str_replace("\n","<br>",$rs['text']);
        //  echo $mn.'<br>'.$mt;
        if ($first) {
            $first = false;

            if ($mn!="01.01.2000" && $mn!="") {
                echo $mn.'<br>'.$mt;
            } else {
                echo $mt;
            }

        } else {

            if ($mn!="01.01.2000" && $mn!="") {
                echo '<br><br>'.$mn.'<br>'.$mt;
            } else {
                echo '<br><br>'.$mt;
            }
        }
    //$isEmpty = false;
    }

    if ($mn!="01.01.2000" && $mn!="") {
        echo '<br><div id="na" onclick="editRem('.$company_id.')" class="editBtn">править</div>';
    } else {
        echo '<div id="na" onclick="editRem('.$company_id.')" class="editBtn">править</div>';
    }

    echo ob_get_clean();
    die();
}

if ($section=='17') { /* вывод для редактирования */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    ob_start();
    $sql = "SELECT `date`, `text` FROM dacons_reminders WHERE company_id='$company_id' AND user_id='$session->id' ORDER BY `date`";
    $result = $db->query($sql, $connection);

    include('incl/dateFormater.php');

    $text = "";
    $first = true;
    while ($rs = $db->fetchRow($result)) {
        $mn = smarty_modifier_date_format($rs['date'],"%d.%m.%Y");
        if ($mn=="01.01.2000") $mn = ""; else $mn .= "\n";

        if ($first) {
            $text .= $mn.$rs['text'];
            $first = false;
        } else {
            $text .= "\n\n".$mn.$rs['text'];
        }
    }

    echo '
            <img src="/images/flag_own.gif" width="14" heigth="13" style="padding-bottom:3px"><br>
            <textarea id="editWndTxt" wrap="on">'.$text.'</textarea><br>
            <div style="padding-top:10px;text-align:right">
            <input type="image" src="/images/confirm.gif" onclick="editReminder('.$company_id.')">
            <input type="image" src="/images/cencel.gif" onclick="cencelReminder('.$company_id.')">
            </div>            
            <script>blocking = true;</script>';
    echo ob_get_clean();
    die();
}

if ($section=='18') {  /* редактирование своего напоминания */

    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}
    $text = $_REQUEST['text'];
    $text = iconv("UTF-8","utf-8",$text);

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    // удаляем
    $sql = "DELETE FROM dacons_reminders WHERE user_id = '$session->id' AND company_id = '$company_id' ";
    $db->query($sql, $connection);

    include('incl/dateFormater.php');

    $sql = "INSERT INTO dacons_reminders_companies (`user_id`,`company_id`) VALUES ('$session->id','$company_id')";
    $db->query($sql, $connection);

    $data = parseDate($text);

    if (sizeof($data)==0) {
        echo 6;
        exit();
    }

    foreach ($data as $k => $v) {
        $sql = "INSERT INTO dacons_reminders (`id`,`text`,`date`,`user_id`,`company_id`) VALUES ('','".str_replace("'", "\'",$v['text'])."','".$v['date']."','$session->id','$company_id')";
        $db->query($sql, $connection);
    }

    echo 5;
    die();
}

if ($section=='18a') {   /* установка флажка своего напоминания */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "INSERT INTO dacons_reminders_companies (`user_id`,`company_id`) VALUES ('$session->id','$company_id')";
    $db->query($sql, $connection);
    echo 1;
    die();
}

if ($section=='19') {  /* получение напоминаний от супер менеджера */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    ob_start();
    $sql = "SELECT `date`, `text` FROM dacons_mreminders WHERE company_id='$company_id' AND customer_id='$session->customer_id' ORDER BY `date`";
    $result = $db->query($sql, $connection);

    include('incl/dateFormater.php');

    $text = "";
    $first = true;
    while ($rs = $db->fetchRow($result)) {
        $mn = smarty_modifier_date_format($rs['date'],"%d.%m.%Y");
        if ($mn=="01.01.2000") $mn = ""; else $mn .= "\n";

        if ($first) {
            $text .= $mn.$rs['text'];
            $first = false;
        } else {
            $text .= "\n\n".$mn.$rs['text'];
        }
    }

    echo '
            <img src="/images/flag_men.gif" width="14" heigth="13" style="padding-bottom:3px"><br>
            <textarea id="editMWndTxt" wrap="on">'.$text.'</textarea><br>
            <div style="padding-top:10px;text-align:right">
            <input type="image" src="/images/confirm.gif" onclick="editMReminder('.$company_id.')">
            <input type="image" src="/images/cencel.gif" onclick="cencelMReminder('.$company_id.')">
            </div>            
            <script>blocking = true;</script>';

    echo ob_get_clean();
    die();
}

if ($section=='20') { /* изменение коментариев супер пользователя */
    $company_id = $_REQUEST['id'];
    $text = $_REQUEST['text'];
    $text = iconv("UTF-8","utf-8",$text);

    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    // удаляем
    $sql = "DELETE FROM dacons_mreminders WHERE company_id = '$company_id' AND customer_id = '$session->customer_id' ";
    $db->query($sql, $connection);

    include('incl/dateFormater.php');

    $data = parseDate($text);

    if (sizeof($data)==0) {
        echo 6;
        exit();
    }

    foreach ($data as $k => $v) {
        $sql = "INSERT INTO dacons_mreminders (`id`,`text`,`date`,`customer_id`,`company_id`) VALUES ('','".str_replace("'", "\'",$v['text'])."','".$v['date']."','$session->customer_id','$company_id')";
        $db->query($sql, $connection);
    }

    echo 5;
    die();
}

if ($section=='21') { /* вывод напоминаний супер пользователя */

    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "SELECT `date`,`text` FROM `dacons_mreminders` WHERE company_id='$company_id' AND customer_id='$session->customer_id' ORDER BY `date`";

    $result = $db->query($sql,$connection);
    //$isEmpty = true;
    include('incl/month.php');
    include('incl/dateFormater.php');

    ob_start();

    $first = true;
    while ($rs = $db->fetchRow($result)) {
        $mn = smarty_modifier_date_format($rs['date'],"%d.%m.%Y");
        if ($mn!="01.01.2000") $mn = "<span id=\"na2\" style=\"color:#dc8009\">$mn</span>";
        if ($rs['date']=='2000-01-01 00:00:00') $mn = "";
        $mt = str_replace("\n","<br>",$rs['text']);
        if ($first) {
            $first = false;

            if ($mn!="01.01.2000" && $mn!="") {
                echo $mn.'<br>'.$mt;
            } else {
                echo $mt;
            }

        } else {

            if ($mn!="01.01.2000" && $mn!="") {
                echo '<br><br>'.$mn.'<br>'.$mt;
            } else {
                echo '<br><br>'.$mt;
            }
        }

    }

    if ($mn!="01.01.2000" && $mn!="") {
        echo '<br><div id="na" onclick="editMRem('.$company_id.')" class="editBtn">править</div>';
    } else {
        echo '<div id="na" onclick="editMRem('.$company_id.')" class="editBtn">править</div>';
    }
    $cont = ob_get_clean();
    echo $cont;
    exit();
}

if ($section=='22') {    /* удаление своего напоминания */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    // удаляем
    $sql = "DELETE FROM dacons_reminders_companies WHERE company_id = '$company_id' AND user_id = '$session->id' ";
    $db->query($sql, $connection);

    echo true;
    die();
}               

if ($section=='23') { /* изменение отношения */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "UPDATE dacons_companies SET relations = 2 WHERE id = '$company_id'"; // to do s user
    $db->query($sql, $connection);
    echo true;
    die();
}

if ($section=='24') {  /* изменение отношения */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "UPDATE dacons_companies SET relations = 3 WHERE id = '$company_id'"; // to do s user
    $db->query($sql, $connection);
    echo true;
    die();
}

if ($section=='25') {  /* изменение отношения */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "UPDATE dacons_companies SET relations = 1 WHERE id = '$company_id'"; // to do s user
    $db->query($sql, $connection);

    echo true;
    die();
}

if ($section=='26') {  /* установка напоминания супер пользователя */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error";die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $sql = "INSERT INTO dacons_mreminders_companies (`customer_id`,`company_id`) VALUES ('$session->customer_id','$company_id')";
    $db->query($sql, $connection);
    echo true;
    die();
}

if ($section=='27') { /* удаление напоминания супер пользователя */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    // удаляем
    $sql = "DELETE FROM dacons_mreminders_companies WHERE company_id = '$company_id' AND customer_id = '$session->customer_id' ";
    $db->query($sql, $connection);

    echo true;
    die();
}   

if ($section=='28') { /* добавление в историю */
    $company_id = $_REQUEST['id'];
    if (!is_numeric($company_id)) {echo "Error"; die();}

    if (!checkCompany($company_id,$session,$connection)) {echo "Error"; die();}

    $name = iconv("UTF-8","UTF-8",str_replace("'","\'",$_REQUEST['htext']));
    $comment = iconv("UTF-8","UTF-8",str_replace("'","\'",$_REQUEST['hcom']));
    $comment = str_replace("\n","<br>",$comment);
    if ($comment=="") $comment = "<br>";
    if ($name != "") {
        $sql = "INSERT INTO dacons_events (`id`,`date`,`name`,`comment`,`company_id`) VALUES ('',now(),'$name','$comment','$company_id')";
        $db->query($sql, $connection);
    }
    echo true;
    die();
}  

if ($section=='29') { /* добавление категории */

    $name = iconv("UTF-8","utf-8",str_replace("'","\'",$_REQUEST['name']));
    $pic = $_REQUEST['pic'];

    preg_match_all("|[a-zA-Z0-9]*\.jpg|i",$pic,$match);


    if ($name != "") {
        $sql = "INSERT INTO dacons_labels (`id`,`name`,`parent_id`,`customer_id`,`picture`) VALUES ('','$name','0','$session->customer_id','".$match[0][0]."')";
        $db->query($sql, $connection);
    }
    echo true;
    die();
}  

if ($section=='30') {

    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}

    $sql = "SELECT name,picture FROM dacons_labels WHERE id='$id' AND customer_id = '$session->customer_id'";

    $result = $db->query($sql, $connection);
    $rs = $db->fetchRow($result);

    $categoryImg = $rs['picture'];
    $name = $rs['name'];

    require_once 'Zend/Json.php';
    echo Zend_Json::encode(array('name' => $rs['name'],'picture' => $rs['picture']));

    die();
            /*$dir = "images/labels/25/"; 
            $images = "";         
             if(!($res=opendir($dir))) exit("Нет такой директории...");
                while(($file=readdir($res))==TRUE)
                  if($file!="." && $file!=".." && ereg(".jpeg|.jpg|.bmp|.png|.gif",$file))
                  {                    
                    $images .= "<img src=\"/images/labels/25/$file\" width=25 height=25 onclick=\"chCategoryImgEdit(this,$id)\" style=\"cursor:pointer\">";                                     
                  }
            closedir($res);
            
            print('
            <div id="editCategoryWnd'.$id.'" class="categoryWndWrap">           
            <div class="categoryWnd">
            <div style="clear:both">
            <div id="editCategoryImg'.$id.'" class="selectCatImg"><img src="/images/labels/25/'.$categoryImg.'" id="categImg'.$id.'"/></div>
            <div style="float:left; padding:4px 0px 0px 10px;"><input type="text" id="editcategoryname'.$id.'" value="'.$name.'" style="width:160px;"/></div>
            </div>
            <div id="clear"></div>
            <div id="newCategoryImgs">
                '.$images.'
            </div>
            
            <div>
                <span onclick="deleteCategory('.$id.')" style="cursor:pointer">Удалить</span>
                <img src="/images/confirm.gif" style="cursor:pointer" onclick="editCategory('.$id.');">
                <img src="/images/cencel.gif" style="cursor:pointer" onclick="hideCategory('.$id.');">
            </div>  
            </div>  </div>          
            ');*/
    die();
}   

if ($section=='31') {

    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}

    $name = iconv("UTF-8","utf-8",str_replace("'","\'",$_REQUEST['name']));
    $pic = $_REQUEST['pic'];

    preg_match_all("|[a-zA-Z0-9]*\.jpg|i",$pic,$match);

    if ($name != "") {
        $sql = "UPDATE dacons_labels SET `name` = '$name', picture = '".$match[0][0]."' WHERE `parent_id` = 0 AND `customer_id` = '$session->customer_id' AND id='$id'";
        $db->query($sql, $connection);
    }
    echo $sql;
    echo true;
    die();
}  

if ($section=='32') {  // добавление метки в категорию

    $category = $_REQUEST['category'];
    if (!is_numeric($category)) {echo "Error"; die();}

    $name = iconv("UTF-8","utf-8",str_replace("'","\'",$_REQUEST['name']));

    if ($name != "") {
        $sql = "INSERT INTO dacons_labels (`id`,`name`,`parent_id`,`customer_id`) VALUES " .
            "('','$name','$category','$session->customer_id')";
        $db->query($sql, $connection);
    }
    echo true;
    die();
} 

if ($section=='33') {  // редактирование метки

    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}

    $sql = "SELECT name FROM dacons_labels WHERE id='$id' AND customer_id = '$session->customer_id'";
    $result = $db->query($sql, $connection);
    $rs = $db->fetchRow($result);
    $name = $rs['name'];

    require_once 'Zend/Json.php';
    echo Zend_Json::encode(array('name' => $rs['name']));
    die();
    print('
            <div id="editLabel'.$id.'" class="labelWndWrap">
            <div class="labelWnd">    
            <textarea name="nl" id="editLabelName'.$id.'" wrap="on" class="labelTxt">'.$name.'</textarea>
            <span onclick="deleteLabel('.$id.')" style="cursor:pointer">Удалить</span>
            <img src="/images/confirm.gif" style="cursor:pointer" onclick="editLabelSubmit('.$id.');">
            <img src="/images/cencel.gif" style="cursor:pointer" onclick="hideEditLabel('.$id.');">
            </div></div>
            ');

    die();
} 

if ($section=='34') {  // обновление метки
    $id = $_REQUEST['id'];
    if (!is_numeric($id)) {echo "Error"; die();}

    $name = iconv("UTF-8","utf-8",str_replace("'","\'",$_REQUEST['name']));

    if ($name != "") {
        $sql = "UPDATE dacons_labels SET name='$name' WHERE id='$id' AND customer_id = '$session->customer_id'";
        $db->query($sql, $connection);
    }
    echo true;
    die();
}

if ($section=='35') {  // удаление метки
    $id = $_REQUEST['id'];
    $act = $_REQUEST['act'];
    if (!is_numeric($id) || !is_numeric($act)) {echo "Error"; die();}

    // проверить права

    if ($act=='-1') { // удаление всех меток из компаний
        $sql = "DELETE FROM dacons_companies_labels WHERE label_id = '$id'";
        $db->query($sql, $connection);

        $sql = "DELETE FROM dacons_labels WHERE id='$id' AND parent_id<>0 AND customer_id = '$session->customer_id'";
        $db->query($sql, $connection);
    } else { // присвоение метки другой компании
        $sql = "UPDATE dacons_companies_labels SET label_id='$act' WHERE label_id = '$id'";
        $db->query($sql, $connection);

        $sql = "DELETE FROM dacons_labels WHERE id='$id' AND parent_id<>0 AND customer_id = '$session->customer_id'";
        $db->query($sql, $connection);
    }

    echo true;
    die();
}

if ($section=='36') {  // удаление категории
    $id = $_REQUEST['id'];
    $act = $_REQUEST['act'];
    if ($id==$act) die();

    if (!is_numeric($id) || !is_numeric($act)) {echo "Error"; die();}

    // проверить права

    if ($act=='-1') { // удаление всей категории
        $sql = "SELECT id FROM dacons_labels WHERE parent_id = '$id'";
        $result = $db->query($sql, $connection);
        $first = true;
        $temp = "";
        while ($row = $db->fetchRow($result)) {
            if ($first) {
                $temp .= $row['id'];
                $first = false;
            }
            $temp .= ",".$row['id'];
        }
        if ($first) {
            $temp .= $id;
        } else {
            $temp .= ",".$id;
        }

        $sql = "DELETE FROM dacons_companies_labels WHERE label_id IN (".$temp.")";
        $db->query($sql, $connection);

        $sql = "DELETE FROM dacons_labels WHERE id in (".$temp.")";
        $db->query($sql, $connection);


    } else { // присвоение другой категории
        $sql = "UPDATE dacons_labels SET parent_id='$act' WHERE parent_id = '$id'";
        $db->query($sql, $connection);
        $sql = "DELETE FROM dacons_labels WHERE id = '$id'";
        $db->query($sql, $connection);
    }

    echo true;
    die();
}

if ($section=='40') {  // удаление напоминания
    $id = $_REQUEST['id'];
    if (is_numeric($_REQUEST['cid'])) {
        $cid = $_REQUEST['cid']; // проверить компанию
        if (checkCompany($cid,$session,$connection)==false) die(false);
    } else {
        $cid = $session->current_company;
    }

    if (!is_numeric($id)) die(false);
    $sql = "DELETE FROM dacons_reminderspool WHERE id = '$id' AND company_id = '".$cid."'";

    $db->query($sql, $connection);
    echo true;
    die();
}

if ($section=='41') {  // редактирование напоминания
    $id = $_REQUEST['id'];
    $vis = $_REQUEST['vis'];
    if ($vis!='sm' && $vis!='own' && $vis!='common') die(false);
    $t = $_REQUEST['t'];

    if (isset($_REQUEST['cid'])) {
        $cid = $_REQUEST['cid']; // проверить компанию
        if (checkCompany($cid,$session,$connection)==false) die(false);
    } else {
        $cid = $session->current_company;
    }

    if (!is_numeric($id) || trim($t=="") || !is_numeric($cid)) die(false);
    include('incl/dateFormater.php');
    $t = iconv("UTF-8","utf-8",$t);
    $data = parseDate($t);

    $time = strtotime($data[0]['date']);
    $data[0]['date'] = date("Y-m-d H:i:s",mktime(0,0,0,date("m",$time),date("d",$time),date("Y",$time)));
    if ($session->is_super_user == 1) {
        if (sizeof($data)!=0) {
            $sql = "UPDATE dacons_reminderspool SET visibility = '$vis', `text` =  '".str_replace("'","\'",$data[0]['text'])."', `date` = '".$data[0]['date']."' WHERE id = '$id' AND company_id = '".$cid."'";
            $db->query($sql, $connection);
            die(true);
        }
    } else {

    // проверить visibility
        if (sizeof($data)!=0) {
            $sql = "UPDATE dacons_reminderspool SET visibility = '$vis', `text` =  '".str_replace("'","\'",$data[0]['text'])."', `date` = '".$data[0]['date']."' WHERE id = '$id' AND company_id = '".$cid."'";
            $db->query($sql, $connection);
            die(true);
        }
    }

    die(true);
}

if ($section=='42') {  // изменение скрепки
    $id = $_REQUEST['id'];
    $state = $_REQUEST['state'];

    if (!is_numeric($id) || !is_numeric($state)) die(false);

    $sql = "SELECT locked FROM dacons_history WHERE company_id = '".$id."' AND user_id = '".$session->id."'";
    if ($db->fetchRow($db->query($sql,$connection)) == null) {
        $sql = "INSERT INTO dacons_history (company_id,user_id,locked) VALUES ('".$id."','".$session->id."','$state')";
        $db->query($sql, $connection);
    } else {
        $sql = "UPDATE dacons_history SET locked = '$state' WHERE company_id = '".$id."' AND user_id = '".$session->id."'";
        $db->query($sql, $connection);
    }



    die(true);
}

if ($section=='43') {  // добавление напоминания
    $t = $_REQUEST['t'];
    $t = iconv("UTF-8","utf-8",$t);
    $v = $_REQUEST['v'];
    $company = $_REQUEST['c'];
    //check
    if (checkCompany($company,$session,$connection)==false) die(false);

    if (trim($t)!="" && $v!="") {
        include('incl/dateFormater.php');

        $data = parseDate($t);
        $time = strtotime($data[0]['date']);
        $data[0]['date'] = date("Y-m-d H:i:s",mktime(0,0,0,date("m",$time),date("d",$time),date("Y",$time)));

        if ($session->is_super_user == 1) {
            if (sizeof($data)!=0) {
                $sql = "INSERT INTO dacons_reminderspool (id,`text`,company_id,`date`,manager_id,visibility) VALUES ('','".$data[0]['text']."','".$company."','".$data[0]['date']."','".$session->id."','".$v."')";
                $db->query($sql, $connection);
            }
        } else {
            if (sizeof($data)!=0 && $v!='sm') {
                $sql = "INSERT INTO dacons_reminderspool (id,`text`,company_id,`date`,manager_id,visibility) VALUES ('','".$data[0]['text']."','".$company."','".$data[0]['date']."','".$session->id."','".$v."')";
                $db->query($sql, $connection);
            }
        }
    // reset
    }

    die(true);
}         

if ($section=='44') {  // аплоад файлов к компании
	$company = $_REQUEST['company'];
	$files=array();

	$files = $_REQUEST['file'];

	$res = array();
	$today = date ("Y-m-d H:i:s", mktime (date("H"),date("i"),0,date("m"),date("d")+1,date("Y")));
	foreach ($files as $file) {
		if ($file['save'] == 'on') {
			do
				$new_name = randomName(15);
			while (file_exists($upload_path.$new_name));
			if (rename($file[tmpname], $upload_path.$new_name)) {		
				$ext = strtolower(substr(strrchr($file['filename'], '.'), 1));//получаем разрешение файла
				if (in_array($ext, array('txt','guide','rtf','odt','sxw','tex','info','wpd','doc','docx','docm','lwp','xls','csv','ods','xlsx','sxc','dotx','pps','ppsx','pptm','pptx','xlsm','001','ini','log','xsl','xslt','pdf','ppt')))
					$type = 1; //офисные документы
				elseif	(in_array($ext, array('bmp','gif','hdr','jpeg','jpg','jpe','jp2','pcx','png','psd','raw','tga','tiff','tif','wdp','hdp','xpm','pdn','cpt','al','cdr','cgm','eps','ps','svg','wmf','emf'))) 
					$type = 2; //картинки
				elseif	(in_array($ext, array('7z','ace','arj','bzip2','cab','cpio','deb','f','gzip','gz','ha','img','iso','jar','lha','lzh','lzx','rar','rpm','smc','tar','zip','zoo')))
					$type = 3; //архивы
				else 
					$type = 0; //другое
				
				$sql = "INSERT INTO dacons_uploads (`original_name`,`filename`,`size`,`company_id`,`comment`,`type`,`date`) VALUES ('{$file['filename']}','{$new_name}','{$file['size']}','$company','{$file['comment']}','$type','$today')"; 
				$db->query($sql);
				$file[id] = mysql_insert_id();
				$file[date] = date ("Y-m-d H:i", mktime (date("H"),date("i"),0,date("m"),date("d")+1,date("Y")));;
				$file[type] = $type;
				unset($file[tmpname]);
				unset($file[save]);
				array_push($res,$file);
			}
		} else {
			@unlink($file['tmpname']);
		}
		
		//теперь надо получить список всех файлов этой компании
		//$files = $db->fetchAll("SELECT * FROM dacons_uploads WHERE `company_id`='$company'");
	}
	
	//удалим все старые файлы из tmp
	// текущее время
	$tmpdir=$upload_path.'tmp/';
	$time_sec=time();	
	$files=scandir($tmpdir);
	foreach($files as $file){
		// время изменения файла
		$time_file=filemtime($tmpdir.$file);
		// тепрь узнаем сколько прошло времени (в секундах)
		$time=$time_sec-$time_file;  
		if ($time>1*60*60)
			@unlink($tmpdir.$file);
	}
	
	die(json_encode($res));
} 

if ($section=='45') { // даунлоад файлов
	$file = $db->fetchRow("SELECT u.`filename`,u.`original_name`, c.`manager` FROM dacons_uploads as u LEFT JOIN dacons_companies as c ON u.company_id=c.id WHERE u.`id`='".$_REQUEST['f']."'");

	if (($session->id != $file['manager']) and (!($session->is_super_user == 1))){
		var_dump($session);
		header ("HTTP/1.0 403 Forbidden");
		exit;
	}

	// отдаваемое файло
	$filename = $upload_path.$file['filename'];

	// есл файла нет
	if (!file_exists($filename)) {
	    header ("HTTP/1.0 404 Not Found");
	    exit;
	}

	// получим размер файла
	$fsize = filesize($filename);
	// дата модификации файла для кеширования
	$ftime = date("D, d M Y H:i:s T", filemtime($filename));
	// смещение от начала файла
	$range = 0;

	// пробуем открыть
	$handle = @fopen($filename, "rb");

	// если не удалось
	if (!$handle){
	  header ("HTTP/1.0 403 Forbidden");
	  exit;
	}

	// Если запрашивающий агент поддерживает докачку
	if ($_SERVER["HTTP_RANGE"]) {
	    $range = $_SERVER["HTTP_RANGE"];
	    $range = str_replace("bytes=", "", $range);
	    $range = str_replace("-", "", $range);
	    // смещаемся по файлу на нужное смещение
	    if ($range) {
	        fseek($handle, $range);
	    }
	}

	// если есть смещение
	if ($range) {
	  header("HTTP/1.1 206 Partial Content");
	} else {
	  header("HTTP/1.1 200 OK");
	}

	header("Content-Disposition: attachment; filename=\"{$file['original_name']}\"");
	header("Last-Modified: {$ftime}");
	header("Content-Length: ".($fsize-$range));
	header("Accept-Ranges: bytes");
	header("Content-Range: bytes {$range}-".($fsize - 1)."/".$fsize);

	// подправляем под IE что б не умничал
	if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
	  Header('Content-Type: application/force-download');
	else
	  Header('Content-Type: application/octet-stream');

	while(!feof($handle)) {
	    $buf = fread($handle,512);
	    print($buf);
	}

	fclose($handle);
	exit;
}

if ($section = '46') { //удаление файла
	$id = $_REQUEST['f'];
    if (!is_numeric($id)) {echo "Error"; die();}

    // проверяем право на изменение
    $granted = true;
	$file = $db->fetchRow("SELECT u.`filename`,u.`original_name`, c.`manager` FROM dacons_uploads as u LEFT JOIN dacons_companies as c ON u.company_id=c.id WHERE u.`id`='".$_REQUEST['f']."'");

	if (($session->id != $file['manager']) and (!($session->is_super_user==1))){
		$granted = false;
	}

    if ($granted) {
        $sql = "DELETE FROM dacons_uploads WHERE id = '$id'";
        $result = $db->query($sql,$connection);
		@unlink($upload_path.$file['filename']);
        echo true;
    } else echo false;	
	exit;
}

?>
