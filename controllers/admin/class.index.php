<?php

Class Controller_Admin_Index Extends Controller_Core_Base 
{
	
	function indexAction() 
	{
		$server_php = $_SERVER['SERVER_SOFTWARE'];
		//explode to get server info and php info
		$pos = strripos($server_php, 'php');
		$formData['fserverip'] = $_SERVER['SERVER_ADDR'];
		$formData['fserver'] = trim(substr($server_php, 0, $pos-1));
		$formData['fphp'] = trim(substr($server_php, $pos));
		
		//get statistic info
		$stat['user'] = Core_User::getUsers(array(), '', '', '', true);
		$stat['contact'] = Core_Contact::getContacts(array(), '', '', 0, true);
		
		
		$this->registry->smarty->assign(array('formData' => $formData,
												'stat'	=> $stat
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
		$this->registry->smarty->assign(array('contents' => $contents,
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_dashboard'])
												);
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');     
		
	} 
}

?>