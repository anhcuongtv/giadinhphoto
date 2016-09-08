<?php

Class Controller_Site_Logout Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		session_regenerate_id(true);
		session_destroy();
		
		setcookie('myHashing', "", time()-3600, '/');     
		
		$redirectMsg = $this->registry->lang['controller']['succLogout'];
		
		$this->registry->smarty->assign(array('redirect' => $this->registry->conf['homepage'],
											'redirectMsg' => $redirectMsg,
													));
		$this->registry->smarty->display('redirect.tpl');
	} 
}

?>