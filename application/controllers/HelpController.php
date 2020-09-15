<?php
/*
 * Created on 24.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once 'Zend_Controller_ActionWithInit.php';	

class HelpController extends Zend_Controller_ActionWithInit
{
        
    public function indexAction() {
    	$this->template = "empty";
    }
}
 
?>
