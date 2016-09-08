<?php

Class Controller_Site_Profile Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		$error = array();
		$success = array();
		$contents = '';
		$formData = array();
		
		if($this->registry->me->id > 0)
		{
			$formData['fimage'] = $this->registry->me->avatar;
						
			if(!empty($_POST['fsubmit']))
			{
				//validate register data
				$formData = array_merge($formData, $_POST);
				$this->registry->me->firstname = (string)$formData['ffirstname'];
				$this->registry->me->lastname = (string)$formData['flastname'];
				$this->registry->me->fullname = (string)$formData['ffirstname'] . ' ' . $formData['flastname'];
				$this->registry->me->honor = (string)$formData['fhonor'];
				$this->registry->me->address = (string)$formData['faddress'];
				$this->registry->me->address2 = (string)$formData['faddress2'];
				$this->registry->me->zipcode = (string)$formData['fzipcode'];
				$this->registry->me->city = (string)$formData['fcity'];
				$this->registry->me->region = (string)$formData['fregion'];
				$this->registry->me->country = (string)$formData['fcountry'];
				$this->registry->me->phone1 = (string)$formData['fphone1'];
				$this->registry->me->phone2 = (string)$formData['fphone2'];
				$this->registry->me->psamembership = (string)$formData['fpsamembership'];
				$this->registry->me->photoclub = (string)$formData['fphotoclub'];
				$this->registry->me->newpass = $formData['fnewpass1'];
				
				
				if($this->submitValidator($formData, $error))
				{
					/*
					$this->registry->me->avatarCurrent = $formData['fimage'];
					
					if(isset($_POST['fdeleteimage']) && $_POST['fdeleteimage'] == '1')
					{
						$this->registry->me->deleteImage();
					}
					*/
					
					if($this->registry->me->updateData($error) > 0)
					{
						//redirect to memberarea page
						$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'memberarea.html',
																'redirectMsg' => $this->registry->lang['controller']['succUpdate'],
																));
						$this->registry->smarty->display('redirect.tpl');
						exit();
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];
					}
					
					//re-init image
					//$formData['fimage'] = $this->registry->me->avatar;
					
				}
			}
			
			$_SESSION['userProfileToken'] = Helper::getSecurityToken();
			
			$this->registry->smarty->assign(array(	'formData' 	=> $formData,
													'user'		=> $this->registry->me,
													'error' 	=> $error,
													'success' 	=> $success,
													'success' 	=> $success
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
			$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');     
		}
		else
		{
			$redirect = 'http://' . $_SERVER['SERVER_NAME'] .  $_SERVER['REQUEST_URI'];
			$url =  $this->conf['rooturl'] . 'site/login?redirect=' . base64_encode($redirect);
			header('location: ' . $url);
			exit();
		}
		
	} 
	
	
	private function submitValidator($formData, &$error)
	{
		$pass = true;
		
		//check form token
		if($formData['ftoken'] != $_SESSION['userProfileToken'])
		{
			$pass = false;
			$error[] = $this->registry->lang['controllergroup']['securityTokenInvalid'];	
		}
		
		if(strlen($formData['flastname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errLastnameRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['ffirstname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errFirstnameRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['faddress']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errAddressRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['fzipcode']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errZipcodeRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['fcity']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errCityRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['fregion']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errRegionRequire'];
			$pass = false;	
		}
		
		if(strlen($formData['fcountry']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errCountryRequire'];
			$pass = false;	
		}
		else if(!isset($this->registry->setting['country'][$formData['fcountry']]))
		{
			$error[] = $this->registry->lang['controller']['errCountryInvalid'];
			$pass = false;		
		}
		
		if(strlen($formData['fphone1']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errPhoneRequire'];
			$pass = false;	
		}
		
		//check oldpass
		//change password
		if(strlen($formData['foldpass']) > 0 || strlen($formData['fnewpass1']) > 0 || strlen($formData['fnewpass2']) > 0)
		{
			
			if(!viephpHashing::authenticate($formData['foldpass'], $this->registry->me->password))
			{
				$pass = false;
				$this->registry->me->newpass = '';
				$error[] = $this->registry->lang['controller']['errOldpassNotvalid'];
			}
			
			if(strlen($formData['fnewpass1']) < 4)
			{
				$pass = false;
				$this->registry->me->newpass = '';
				$error[] = $this->registry->lang['controller']['errNewpassnotvalid'];
			}	
			
			if($formData['fnewpass1'] != $formData['fnewpass2'])
			{
				$pass = false;
				$this->registry->me->newpass = '';
				$error[] = $this->registry->lang['controller']['errNewpassnotmatch'];
			}
			
			
		}
		
				
		
		return $pass;
	}
}

?>