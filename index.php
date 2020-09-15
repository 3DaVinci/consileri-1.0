<?
error_reporting (E_ALL /*& ~E_NOTICE*/);
ini_set ('display_errors', 1);
date_default_timezone_set ('Europe/Moscow');

header ("Content-Type: text/html; charset=utf-8");

//ini_set ('include_path', '.:includes/');

require_once 'Zend/Controller/Front.php';
require_once 'Zend/Debug.php';



//require_once 'Zend/Session.php'; //
//Zend_Session::start(); //

include 'conf/config.php';

//require_once 'Zend/Locale.php';
//$locale = new Zend_Locale('ru_RU');

//Zend_Controller_Response_Abstract::renderExceptions(true);

$front = Zend_Controller_Front::getInstance();
$front->setControllerDirectory('application/controllers');
$front->setParam('noViewRenderer', true);
$front->setParam('url',$conf['siteurl']);
//$front->setParam('dbconfig', $dbconfig);


 		//include('incl/browser.php');
		//$b = new browser();
		//print_r($b->whatBrowser());


$front->returnResponse(true);
//$front->setParam('noErrorHandler', true);
//$front->dispatch();


$response = $front->dispatch();

$response->sendHeaders();
$response->outputBody();


//require_once 'Zend/Debug.php';
//Zend_Debug::dump($front->getRequest()->getParam("action"), $label=null, $echo=true);
//Zend_Debug::dump($front, $label=null, $echo=true);

?>
