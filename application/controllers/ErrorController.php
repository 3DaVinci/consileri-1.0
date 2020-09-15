<?php
/*
 * Created on 24.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once 'Zend_Controller_ActionWithInit.php';	

class ErrorController extends Zend_Controller_ActionWithInit
{
    public function errorAction()
    {
    	Zend_Controller_Response_Abstract::renderExceptions(true); 
    	//echo Zend_Controller_Front::returnResponse();
    	$this->template = "error/index";
    }
    
    public function indexAction() {
    	$this->template = "error/index";
    }
}
 
?>
