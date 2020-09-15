<?php
/*
 * Created on 24.09.2007
 * artem.tyumentsev@gmail.com
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 require_once 'Zend_Controller_ActionWithInit.php';	

class ProfileController extends Zend_Controller_ActionWithInit
{
        
    public function indexAction() {
    	$this->template = "profile/change_password";
    }
    
    public function changeAction() 
    {
        $password = $this->getRequest()->getParam('password');
        $password_confirm = $this->getRequest()->getParam('password_confirm');
        if (empty ($password)) 
        {
            $this->view->error = _("Пароль не может быть пустым");
            $this->template = "profile/change_password";
        }
        else if ($password != $password_confirm) 
        {
            $this->view->error = _("Введенные пароли не совпадают");
            $this->template = "profile/change_password";
        }
        else 
        {
            $query = "update dacons_users set `password` = '".md5($password)."' WHERE customer_id=".$this->session->customer_id;
            $this->db->query ($query);
            $this->template = "profile/password_changed";
        }
    }
}
 
?>
