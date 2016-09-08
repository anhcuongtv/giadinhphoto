<?php

Class Controller_Admin_BannerPosition Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	
	function indexAction() 
	{
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fbulkid' => array());
		
		$_SESSION['securityToken'] = Helper::getSecurityToken();  //for delete link
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		$idFilter 		= (int)($this->registry->router->getArg('id'));
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'name';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;	
		
		if(!empty($_POST['fsubmitbulk']))
		{
			if($_SESSION['bannerpositionDeleteToken'] == $_POST['ftoken'])
			{
				if(!isset($_POST['fbulkid']))
				{
					$warning[] = $this->registry->lang['controllergroup']['bulkItemNoSelected'];
				}
				else
				{
					$formData['fbulkid'] = $_POST['fbulkid'];
					
					//check for delete 
					if($_POST['fbulkaction'] == 'delete')
					{
						$delArr = $_POST['fbulkid'];
						$deletedItems = array();
						$cannotDeletedItems = array();
						foreach($delArr as $id)
						{
							//check valid user and not admin user
							$myPosition = new Core_BannerPosition($id);
							
							if($myPosition->id > 0)
							{
								//tien hanh xoa
								if($myPosition->delete())
								{
									$deletedItems[] = $myPosition->name;
									$this->registry->me->writelog('bannerpositiondelete', $myPosition->id, array('name' => $myPosition->name));  	
								}
								else
									$cannotDeletedItems[] = $myPosition->name;
							}
							else
								$cannotDeletedItems[] = $myPosition->name;
						}
						
						if(count($deletedItems) > 0)
							$success[] = str_replace('###positionname###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
						
						if(count($cannotDeletedItems) > 0)
							$error[] = str_replace('###positionname###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
					}
					else
					{
						//bulk action not select, show error
						$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
					}
				}
			}
			
		}
		
		$_SESSION['bannerpositionDeleteToken'] = Helper::getSecurityToken();
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'bannerposition/index/';      
		
				
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
		}
		
				
		//tim tong so
		$total = Core_BannerPosition::getPositions($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$positions = Core_BannerPosition::getPositions($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'positions' 	=> $positions,
												'formData'		=> $formData,
												'success'		=> $success,
												'error'			=> $error,
												'warning'		=> $warning,
												'filterUrl'		=> $filterUrl,
												'paginateurl' 	=> $paginateUrl, 
												'redirectUrl'	=> $redirectUrl,
												'total'			=> $total,
												'totalPage' 	=> $totalPage,
												'curPage'		=> $curPage,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'bannerpositionlist',
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
			
			if($this->addActionValidator($formData, $error))
			{
				$myPosition = new Core_BannerPosition();
				$myPosition->name = $formData['fname'];
				$myPosition->description = $formData['fdescription'];
				if($myPosition->addData())
				{
					$success[] = str_replace('###positionname###', $myPosition->name, $this->registry->lang['controller']['succAdd']);
					$this->registry->me->writelog('bannerpositionadd', $myPosition->id, array('name' => $myPosition->name));
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['positionAddToken'] = Helper::getSecurityToken();
		
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'bannerpositionadd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myPosition = new Core_BannerPosition($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myPosition->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fname'] = $myPosition->name;
			$formData['fdescription'] = $myPosition->description;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myPosition->name = $formData['fname'];
					$myPosition->description = $formData['fdescription'];
					
					if($myPosition->updateData())
					{
						$success[] = str_replace('###positionname###', $myPosition->name, $this->registry->lang['controller']['succUpdate']);
						$this->registry->me->writelog('bannerpositionedit', $myPosition->id, array('name' => $myPosition->name));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'bannerpositionlist',
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
		$myPosition = new Core_BannerPosition($id);
			
		if($myPosition->id > 0)
		{
			//check token
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myPosition->delete())
				{
					$redirectMsg = str_replace('###positionname###', $myPosition->name, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('bannerpositiondelete', $myPosition->id, array('name' => $myPosition->name));  	
				}
				else
				{
					$redirectMsg = str_replace('###positionname###', $myPosition->name, $this->registry->lang['controller']['errDelete']);
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
		
		//check token
		if($_SESSION['positionAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequired'];
			$pass = false;
		}
		
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		//check token
		if($_SESSION['positionEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequired'];
			$pass = false;
		}
		
				
		return $pass;
	}
	
		
}

?>