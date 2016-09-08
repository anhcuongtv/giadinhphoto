<?php

Class Controller_Site_Contact Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		$success = $error = $formData = array();
		
		$formData['ffullname'] = $this->registry->me->fullname;
		$formData['femail'] = $this->registry->me->email;
		$formData['fphone'] = $this->registry->me->phone1;
		
		//tien hanh luu thong tin lien he
		if(isset($_POST['fsubmit']))
		{
			$formData = $_POST;
			if($this->contactValidate($formData, $error))
			{
				$myContact = new Core_Contact();
				$myContact->userId = $this->registry->me->id;
				$myContact->username = $this->registry->me->username;
				$myContact->fullname = strip_tags($formData['ffullname']);
				$myContact->email = strip_tags($formData['femail']);
				$myContact->phone = strip_tags($formData['fphone']);
				$myContact->message = strip_tags($formData['fmessage']);
				
				if($formData['freason'] == 'general' || $formData['freason'] == 'support')
					$myContact->reason = $formData['freason'];
				
				
					
				if($myContact->addData())
				{
					$_SESSION['contactSpam'] = time();
						
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////
					//send mail to admin
					
					$this->registry->smarty->assign(array('datecreated' => date("F j, Y, g:i a"),
															'myContact' => $myContact
															));
					$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'admin.tpl');
					$sender = new SendMail( $this->registry,
											$this->registry->setting['mail']['toEmail'],
											$this->registry->setting['mail']['toName'],
											str_replace('{ID}', $myContact->id, $this->registry->setting['mail']['subjectContactAdmin']),
											$mailContents,
											$this->registry->setting['mail']['fromEmail'],
											$this->registry->setting['mail']['fromName']
											);
					$sender->Send();
					
					
					$success[] = $this->registry->lang['controller']['succContact'];	
					
					//clear form, keep email
					$formData['freason'] = '';
					$formData['fmessage'] = '';
					
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errContact'];	
				}
			}
		}
		
		//lay thong tin tu page contact
		$page = new Core_Page(0, $this->registry->langCode);
		$page->getDataByText('contact');
			
		$this->registry->smarty->assign(array(	'success' => $success,
												'error'	=> $error,
												'formData'	=> $formData,
												'page'	=> $page
											));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');   
		
	} 
	
	private function contactValidate($formData, &$error)
	{
		$pass = true;
		
		
		//check contact spam
		$contactExpire = 10;	//seconds
		if(isset($_SESSION['contactSpam']) && time() - $_SESSION['contactSpam'] < $contactExpire)
		{
			$error[] = $this->registry->lang['controller']['errSpam'];
			$pass = false;
		}
		
		//check email valid
		if(strlen($formData['ffullname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errFullnameNotValid'];
			$pass = false;
		}
				
		//check email valid
		if(!Helper::ValidatedEmail($formData['femail']))
		{
			$error[] = $this->registry->lang['controller']['errEmailNotValid'];
			$pass = false;
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