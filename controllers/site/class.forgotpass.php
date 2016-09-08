<?php

Class Controller_Site_Forgotpass Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		if($_GET['sub'] == 'reset')
		{
			$this->resetAction();
			return;
		}
		
		$error = $warning = $formData = array();
		
		$redirectUrl = $_GET['redirect'];//base64 encoded
		
		if(isset($_POST['fsubmit']))
		{
			$formData = $_POST;
			
			$myUser = Core_User::getByEmail($formData['femail']);	
			if($myUser->id > 0)
			{
				//xu ly de tai activatedcode cho viec change password
				$activatedCode = md5($myUser->id . $myUser->username . rand(1000,9999) . time());
				$myUser->activatedcode = $activatedCode;
				if($myUser->updateData($error))
				{
					//tien hanh goi email
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//send mail to user
					$this->registry->smarty->assign(array(	'activatedCode' 	=> $activatedCode,
															'myUser'	=> $myUser,
													));
					$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'user.tpl');
					$sender2=  new SendMail($this->registry,
											$myUser->email,
											$myUser->fullname == '' ? $myUser->username : $myUser->fullname,
											$this->registry->lang['controller']['mailSubject'] . ' ' .$this->registry->conf['rooturl'],
											$mailContents,
											$this->registry->setting['mail']['fromEmail'],
											$this->registry->setting['mail']['fromName']
											);
					$sender2->Send();	
					
					$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'login.html',
															'redirectMsg' => $this->registry->lang['controller']['succSubmitEmail'],
															));
					$this->registry->smarty->display('redirect.tpl');
					exit();
				}
			}
			else
			{
				$error = $this->registry->lang['controller']['errAccountInvalid'];
			}	
						
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
	
	function resetAction()
	{
		$error = $warning = $formData = array();
		
		$myUser = Core_User::getByUsername($_GET['username']);	
		$activatedCode = $_GET['code'];
		
		if($myUser->activatedcode != $activatedCode)
		{
			$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'forgotpass.html',
													'redirectMsg' => $this->registry->lang['controller']['errInvalidCode'],
													));
			$this->registry->smarty->display('redirect.tpl');
		}
		else
		{
			if(isset($_POST['fsubmit']))
			{
				//validate password
				if($_POST['fpassword'] != $_POST['fpassword2'])
				{
					$error = $this->registry->lang['controller']['errPassNotMatch'];
				}
				else
				{
					$myUser->newpass = $_POST['fpassword'];
					$myUser->activatedcode = '';
					if($myUser->updateData($error))
					{
						$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'login.html',
																'redirectMsg' => $this->registry->lang['controller']['succReset'],
																));
						$this->registry->smarty->display('redirect.tpl');
						exit();
					}
					else
					{
						$error = $this->registry->lang['controller']['errReset'];	
					}
				}	
			}
			
			$this->registry->smarty->assign(array(	'formData' 	=> $formData,
														'error' 	=> $error,
														'warning' 	=> $warning,
														'redirectUrl' 	=> $redirectUrl
														));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'reset.tpl'); 
			$this->registry->smarty->assign(array('contents' => $contents,
												'pageTitle' => $this->registry->lang['controller']['pageTitle'],
												'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
												'pageDescription' => $this->registry->lang['controller']['pageDescription'],
												));
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');     	
		}
		
		
		
		
	}
}

?>