<?php

Class Controller_Site_Login Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		$error = $warning = $formData = array();
		
		$redirectUrl = $_GET['redirect'];//base64 encoded
		
		if(isset($_POST['fsubmit']))
		{
			
			$myUser = Core_User::getByUsername($_POST['fusername']);
			
			if($myUser->id > 0 && $myUser->password == viephpHashing::hash($_POST['fpassword']))
			{
				
				$myUser->updateLastLogin();
				$_SESSION['userLogin'] = $myUser->id;
										
				session_regenerate_id(true);
				    
				    
				//neu co chon chuc nang remember me
				if(isset($_POST['frememberme']))
				{
					setcookie('myHashing', viephpHashing::cookiehashing($myUser->id, $_POST['fpassword']), time() + 24*3600*14, '/');
				}
				else 
				{
					setcookie('myHashing', "", time()-3600, '/');
				}
				
				
				//check judger
				$myJudger = new Core_UserJudge($myUser->id);
				if($myJudger->uid > 0)
				{
					//redirect to judger
					$redirectUrl = $this->registry->conf['rooturl'] . 'judge.html';    
				}
				else
				{
					$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html?tab=upload';    	
				}
				
				//fix
				//$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html?tab=upload';
				
				//tien hanh redirect
				
				
				if($myUser->groupid == GROUPID_ADMIN)
				{
					$this->registry->me = $myUser;
					$this->registry->me->writelog('login', $myUser->id);
				}
				$this->registry->smarty->assign(array('redirect' => $redirectUrl,
														'redirectMsg' => $this->registry->lang['controller']['succLogin'],
														));
				$this->registry->smarty->display('redirect.tpl');
				exit();
			}
			else
			{
				$error[] = $this->registry->lang['controller']['errAccountInvalid'];
			}
			
		}
		
		if($_GET['refer'] == '1')
		{
			$warning[] = $this->registry->lang['controller']['warnRefer'];
		}
		
		
		$this->registry->smarty->assign(array(	'formData' 	=> $formData,
													'error' 	=> $error,
													'warning' 	=> $warning,
													'redirectUrl' 	=> $redirectUrl
													));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');     
		
	} 
}

?>