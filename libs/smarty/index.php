<?

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
$front->setParam('dbconfig', $dbconfig);


 		//include('incl/browser.php');
		//$b = new browser();	
		//print_r($b->whatBrowser());


$front->returnResponse(true);
//$front->setParam('noErrorHandler', true);
//$front->dispatch();

$response = $front->dispatch();
if ($response->isException()) {
  //  $exceptions = $response->getException();
    //echo $exceptions->renderExceptions();
   // $dump = Zend_Debug::dump($exceptions, $label=null, $echo=false);
   // echo $dump;
echo "Error";
    // отправка ошибки на email и на страницу ошибки
    // обработка исключений ...
} else {

    $encoding = false;
    $encod = $_SERVER["HTTP_ACCEPT_ENCODING"];
    if( strpos($encod, 'x-gzip') !== false ){
        $encoding = 'x-gzip';
    }elseif( strpos($encod,'gzip') !== false ){
        $encoding = 'gzip';
    }else{
        $encoding = false;
    }
    
    if( $encoding ){
        $contents = $response->getBody();   

        $response->setHeader('Content-Encoding',$encoding,true);
        $response->sendHeaders();
        print("\x1f\x8b\x08\x00\x00\x00\x00\x00");
        $size = strlen($contents);
        $contents = gzcompress($contents, 7);
        $contents = substr($contents, 0, $size);    
        print($contents);
    } else {
        $response->sendHeaders();
        $response->outputBody();
    }   


}
//require_once 'Zend/Debug.php';
//Zend_Debug::dump($front->getRequest()->getParam("action"), $label=null, $echo=true);
//Zend_Debug::dump($front, $label=null, $echo=true); 

	
?>