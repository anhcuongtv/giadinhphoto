<?php

Class Controller_Admin_ContestAward Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	
	function indexAction() 
	{
		$_SESSION['awardDeleteToken'] = Helper::getSecurityToken();  //for delete link
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'name';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;	
		
		
				
					
		$awards = Core_ContestAward::getAwards($formData, $sortby, $sorttype, '');
		
		//build redirect string
		$paginateUrl = $this->registry->conf['rooturl_admin'].'contestaward/index/';   
		$redirectUrl = $paginateUrl;
		$redirectUrl = base64_encode($redirectUrl);
		
						
		$this->registry->smarty->assign(array(	'awards' 		=> $awards,
												'redirectUrl'	=> $redirectUrl,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'awardlist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
		
	} 
	
	function addAction()
	{
		$error 	= array();
		$success 	= array();
		$contents 	= '';
		$formData 	= array();
		
		if(!empty($_POST['fsubmit']))
		{
			$formData = array_merge($formData, $_POST);
			//print_r($formData);
			if($this->addActionValidator($formData, $error))
			{
				$myAward = new Core_ContestAward();
				$myAward->name = $formData['fname'];
				$myAward->section = $formData['fsection'];
				$myAward->isactive = $formData['fisactive'];
				
				if($myAward->addData())
				{
					$success[] = $this->registry->lang['controller']['succAdd'];
					$this->registry->me->writelog('award_add', $myAward->id, array('name' => $myAward->name));
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['awardAddToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'awardadd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myAward = new Core_ContestAward($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myAward->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fid'] = $myAward->id;
			$formData['fname'] = $myAward->name;
			$formData['forder'] = $myAward->order;
			$formData['fsection'] = $myAward->section;
			$formData['fisactive'] = $myAward->isactive;
			$formData['fdatecreated'] = $myAward->datecreated;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myAward->name = $formData['fname'];
					$myAward->order = $formData['forder'];
					$myAward->section = $formData['fsection'];
					$myAward->isactive = $formData['fisactive'];
					$myAward->datecreated = $formData['fdatecreated'];
					
					
					if($myAward->updateData())
					{
						$success[] = $this->registry->lang['controller']['succUpdate'];
						$this->registry->me->writelog('award_edit', $myAward->id, array('name' => $myAward->name));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			
			$_SESSION['awardEditToken'] = Helper::getSecurityToken();
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'award',
													'pageTitle'	=> $this->registry->lang['controller']['pageTitle_edit'],
													'contents' 	=> $contents));
			
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => $redirectMsg,
													));
			$this->registry->smarty->display('redirect.tpl');
		}
	}
	
	function deleteAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myAward = new Core_ContestAward($id);
			
		if($myAward->id > 0)
		{
			if($_SESSION['awardDeleteToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myAward->delete())
				{
					$redirectMsg = $this->registry->lang['controller']['succDelete'];
					
					$this->registry->me->writelog('award_delete', $myAward->id, array('name' => $myAward->name));  	
				}
				else
				{
					$redirectMsg = $this->registry->lang['controller']['errDelete'];
				}
			}
			else
			{
				$redirectMsg = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			}
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
		}
		
		$this->registry->smarty->assign(array('redirect' => $this->getRedirectUrl(),
												'redirectMsg' => $redirectMsg,
												));
		$this->registry->smarty->display('redirect.tpl');
			
	}
	
	
	
	####################################################################################################
	####################################################################################################
	####################################################################################################
	
		
	private function addActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['awardAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNamRequired'];
			$pass = false;
		}
		
		if($formData['fisactive'] != '0' && $formData['fisactive'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsactiveInvalid'];
			$pass = false;
		}
		
		if($formData['fsection'] != '')
		{
			if(!in_array($formData['fsection'], array('color', 'mono', 'nature','travel')))
			{
				$error[] = $this->registry->lang['controller']['errInvalidSection'];
				$pass = false;	
			}
		}		
						
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['awardEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNamRequired'];
			$pass = false;
		}
		
		if($formData['fisactive'] != '0' && $formData['fisactive'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsactiveInvalid'];
			$pass = false;
		}
		
		if($formData['fsection'] != '')
		{
			if(!in_array($formData['fsection'], array('color', 'mono', 'nature','travel')))
			{
				$error[] = $this->registry->lang['controller']['errInvalidSection'];
				$pass = false;	
			}
		}		
		
		return $pass;
	}
	
		
}

?>