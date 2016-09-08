<?php

Class Controller_Site_Register Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		//check if disable register new member
		if($this->registry->setting['extra']['enableRegister'] == false)
		{
			header('location: ' . $this->registry->conf['rooturl'] . 'login.html');
			exit();
		}
		
		$success = $error = $formData = array();
		
		$redirectUrlAfterLogin = $_GET['redirect'];
		
		//tien hanh dang ky thanh vien
		if(isset($_POST['fsubmit']))
		{
			$formData = $_POST;
			//$formData['fpassword'] = Helper::RandomNumber(100000,999999);
			                
			if($this->registerValidate($formData, $error))
			{
				$myUser = new Core_User();
				$myUser->username = (string)$formData['fusername'];
				//$myUser->password = (string)viephpHashing::hash($formData['fpassword']);
				$myUser->password = (string)viephpHashing::hash($formData['fpassword1']);
				$myUser->email = (string)$formData['femail'];
				$myUser->groupid = GROUPID_MEMBER;
				$myUser->firstname = (string)$formData['ffirstname'];
				$myUser->lastname = (string)$formData['flastname'];
				$myUser->fullname = (string)$formData['ffirstname'] . ' ' . $formData['flastname'];
				$myUser->honor = (string)$formData['fhonor'];
				$myUser->address = (string)$formData['faddress'];
				$myUser->address2 = (string)$formData['faddress2'];
				$myUser->zipcode = (string)$formData['fzipcode'];
				$myUser->city = (string)$formData['fcity'];
				$myUser->region = (string)$formData['fregion'];
				$myUser->country = (string)$formData['fcountry'];
				$myUser->phone1 = (string)$formData['fphone1'];
				$myUser->phone2 = (string)$formData['fphone2'];
				$myUser->psamembership = (string)$formData['fpsamembership'];
				$myUser->photoclub = (string)$formData['fphotoclub'];
				
				if($myUser->addData())
				{
					$_SESSION['registerSpam'] = time();
					$redirectUrl = $this->registry->conf['rooturl'] . 'login.html';
					if($redirectUrlAfterLogin != '')
						$redirectUrl .= '?redirect=' . $redirectUrlAfterLogin;
						
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//send mail to admin
					
					$this->registry->smarty->assign(array('datecreated' => date("F j, Y, g:i a"),
															'myUser' => $myUser,
															'formData'	=> $formData,
															'activatedCode' => '',
															));
					$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'admin.tpl');
					$sender = new SendMail( $this->registry,
											$this->registry->setting['mail']['toEmail'],
											$this->registry->setting['mail']['toName'],
											str_replace('{USERNAME}', $myUser->username, $this->registry->setting['mail']['subjectRegisterAdmin']),
											$mailContents,
											$this->registry->setting['mail']['fromEmail'],
											$this->registry->setting['mail']['fromName']
											);
					$sender->Send();
					
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//send mail to user
					$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'user.tpl');
					$sender2=  new SendMail($this->registry,
											$myUser->email,
											$myUser->fullname == '' ? $myUser->username : $myUser->fullname,
											str_replace('{USERNAME}', $myUser->username, $this->registry->setting['mail']['subjectRegisterUser']),
											$mailContents,
											$this->registry->setting['mail']['fromEmail'],
											$this->registry->setting['mail']['fromName']
											);
					$sender2->Send();
					
					//tu dong dang nhap
					$_SESSION['userLogin'] = $myUser->id;
										
					session_regenerate_id(true);
					
					
					//redirect to login page
					$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'memberarea.html',
															'redirectMsg' => $this->registry->lang['controller']['succRegister'],
															));
					$this->registry->smarty->display('redirect.tpl');
					exit();
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errRegister'];	
				}
			}
		}
		
		//get token for form
		$_SESSION['userRegisterToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'success' => $success,
												'error'	=> $error,
												'formData'	=> $formData
											));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
		
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');     
		
	} 
	
	private function registerValidate($formData, &$error)
	{
		$pass = true;
		
		//check form token
		if($formData['ftoken'] != $_SESSION['userRegisterToken'])
		{
			$pass = false;
			$error[] = $this->registry->lang['controllergroup']['securityTokenInvalid'];	
		}
		
		//check register spam
		$registerExpire = 10;	//seconds
		if(isset($_SESSION['registerSpam']) && time() - $_SESSION['registerSpam'] < $registerExpire)
		{
			$error[] = $this->registry->lang['controller']['errSpam'];
			$pass = false;
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
		
		 //check valid username string
		if(strlen($formData['fusername']) < 6 || strlen($formData['fusername']) > 30 || preg_match('/[^a-z0-9_]/', $formData['fusername']) > 0)
		{
			$error[] = $this->registry->lang['controller']['errUsernameNotValid'];
			$pass = false;
		}
		else
		{
			//check invalid username
			$invalidUsernames = explode(',', $this->registry->setting['user']['invalidinvalidUsername']);
			if(in_array($formData['fusername'], $invalidUsernames))
			{
				$error[] = $this->registry->lang['controller']['errUsernameBadName'];
				$pass = false;	
			}
			else
			{
				//check existed username
				$myUser = Core_User::getByUsername($formData['fusername']);
				if($myUser->id > 0)
				{
					$error[] = $this->registry->lang['controller']['errUsernameExisted'];
					$pass = false;	
				}
			}
			
			
		}
		
		//check password length
		if(strlen($formData['fpassword1']) < 6)
		{
			$error[] =  $this->registry->lang['controller']['errPasswordLength'];   
			$pass = false;
		}
		
		//check password matched
		if($formData['fpassword1'] != $formData['fpassword2'])
		{
			$error[] = $this->registry->lang['controller']['errPasswordMatch'];   
			$pass = false;
		}
		
		
		//check email valid
		if(!Helper::ValidatedEmail($formData['femail']))
		{
			$error[] = $this->registry->lang['controller']['errEmailNotValid'];
			$pass = false;
		}
		else
		{
			if($formData['femail'] != $formData['femail2'])
			{
				$error[] = $this->registry->lang['controller']['errEmailNotMatch'];
				$pass = false;	
			}
			else
			{
				//check existed email
				$myUser = Core_User::getByEmail($formData['femail']);
				if($myUser->id > 0)
				{
					$error[] = $this->registry->lang['controller']['errEmailExisted'];
					$pass = false;	
				}
			}
			
		}
		
		
		
		//check security code
		if(strlen($formData['fcaptcha']) == 0 || $formData['fcaptcha'] != $_SESSION['verify_code'])
		{
			$error[] = $this->registry->lang['controller']['errSecurityCode'];   
			$pass = false;
		}
		
		
		
		
				
		return $pass;
	}
}

?>