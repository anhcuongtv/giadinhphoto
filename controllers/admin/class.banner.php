<?php

Class Controller_Admin_Banner Extends Controller_Admin_Base 
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
		$positionidFilter 	= (int)($this->registry->router->getArg('positionid'));
		$keywordFilter 	= $this->registry->router->getArg('keyword');
		$searchKeywordIn= $this->registry->router->getArg('searchin'); 
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'position';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;	
		
		//submit delete bulk action
		if(!empty($_POST['fsubmitbulk']))
		{
			if($_SESSION['bannerDeleteToken'] == $_POST['ftoken'])
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
							$myBanner = new Core_Banner($id);
							
							if($myBanner->id > 0)
							{
								//tien hanh xoa
								if($myBanner->delete())
								{
									$deletedItems[] = $myBanner->name;
									$this->registry->me->writelog('bannerdelete', $myBanner->id, array('name' => $myBanner->name));  	
								}
								else
									$cannotDeletedItems[] = $myBanner->name;
							}
							else
								$cannotDeletedItems[] = $myBanner->name;
						}
						
						if(count($deletedItems) > 0)
							$success[] = str_replace('###name###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
						
						if(count($cannotDeletedItems) > 0)
							$error[] = str_replace('###name###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
					}
					else
					{
						//bulk action not select, show error
						$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
					}
				}
			}
			
		}
		$_SESSION['bannerDeleteToken'] = Helper::getSecurityToken();
		
		
		if(!empty($_POST['fchangeorder']))
		{
			$items = $_POST['forder'];
			$updatedBanners = array();
			foreach($items as $itemId => $itemOrder)
			{
				$itemOrder = (int)$itemOrder;
				$myBanner = new Core_Banner($itemId);
				if($myBanner->order != $itemOrder)
				{
					$myBanner->order = $itemOrder;
					if($myBanner->updateData() == Core_Banner::ERROR_OK)
					{
						$updatedBanners[] = $myBanner->name;
						$this->registry->me->writelog('bannerchangeorder', $myBanner->id, array('name' => $myBanner->name, 'order' => $myBanner->order));
					}
				}	
			}
			
			if(count($updatedBanners) > 0)
			{
				$success[] = str_replace('###name###', implode(', ', $updatedBanners), $this->registry->lang['controller']['succUpdate']);    
			}		
		}
		
		
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'banner/index/';      
		
				
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
		}
		
		if($positionidFilter > 0)
		{
			$paginateUrl .= 'position/'.$positionidFilter . '/';
			$formData['fposition'] = $positionidFilter;
			$formData['search'] = 'position';
		}
		
		if(strlen($keywordFilter) > 0)
		{
			$paginateUrl .= 'keyword/' . $keywordFilter . '/';
			
			if($searchKeywordIn == 'name')
			{
				$paginateUrl .= 'searchin/name/';
			}
			
			$formData['fkeyword'] = $keywordFilter;
			$formData['fsearchin'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
				
		//tim tong so
		$total = Core_Banner::getBanners($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$banners = Core_Banner::getBanners($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'banners' 		=> $banners,
												'positions'		=> Core_BannerPosition::getPositions(array(), '', '', ''),
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'bannerlist',
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
				$myBanner = new Core_Banner();
				$myBanner->name = $formData['fname'];
				$myBanner->link = $formData['flink'];
				$myBanner->width = $formData['fwidth'];
				$myBanner->height = $formData['fheight'];
				$myBanner->positionid = $formData['fposition'];
				$myBanner->enable = $formData['fenable'];
				
				$addResult = $myBanner->addData();
				if($addResult == Core_Banner::ERROR_OK)
				{
					$success[] = str_replace('###name###', $myBanner->name, $this->registry->lang['controller']['succAdd']);
					$this->registry->me->writelog('banneradd', $myBanner->id, array('name' => $myBanner->name));
					$formData = array();  	
				}
				else if($addResult == Core_Banner::ERROR_UPLOAD_IMAGE)
				{
					$error[] = $this->registry->lang['controller']['errAddUpload'];			
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];	
				}
			}
		}
		
		$_SESSION['bannerAddToken'] = Helper::getSecurityToken();
		
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'positions'		=> Core_BannerPosition::getPositions(array(), '', '', ''),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'banneradd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myBanner = new Core_Banner($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myBanner->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fname'] = $myBanner->name;
			$formData['flink'] = $myBanner->link;
			$formData['fwidth'] = $myBanner->width;
			$formData['fheight'] = $myBanner->height;
			$formData['fposition'] = $myBanner->positionid;
			$formData['fenable'] = $myBanner->enable;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myBanner->name = $formData['fname'];
					$myBanner->link = $formData['flink'];
					$myBanner->width = $formData['fwidth'];
					$myBanner->height = $formData['fheight'];
					$myBanner->positionid = $formData['fposition'];
					$myBanner->enable = $formData['fenable'];
					
					$editResult = $myBanner->updateData();
					
					if($editResult == Core_Banner::ERROR_OK)
					{
						$success[] = str_replace('###name###', $myBanner->name, $this->registry->lang['controller']['succUpdate']);
						$this->registry->me->writelog('banneredit', $myBanner->id, array('name' => $myBanner->name));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			$_SESSION['bannerEditToken'] = Helper::getSecurityToken();
			
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'banner'		=> $myBanner,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'positions'		=> Core_BannerPosition::getPositions(array(), '', '', ''),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'bannerlist',
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
		$myBanner = new Core_Banner($id);
			
		if($myBanner->id > 0)
		{
			//check token
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myBanner->delete())
				{
					$redirectMsg = str_replace('###name###', $myBanner->name, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('bannerdelete', $myBanner->id, array('name' => $myBanner->name));  	
				}
				else
				{
					$redirectMsg = str_replace('###name###', $myBanner->name, $this->registry->lang['controller']['errDelete']);
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
		if($_SESSION['bannerAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequired'];
			$pass = false;
		}
		
		if(strlen($formData['flink']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errLinkRequired'];
			$pass = false;
		}
		
		if(strlen($_FILES['fimage']['name']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errFileRequired'];
			$pass = false;
		}
		
		if($formData['fwidth'] == 0)
		{
			$error[] = $this->registry->lang['controller']['errWidthRequired'];
			$pass = false;
		}
		
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		//check token
		if($_SESSION['bannerEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequired'];
			$pass = false;
		}
		
		if(strlen($formData['flink']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errLinkRequired'];
			$pass = false;
		}
		
		if($formData['fwidth'] == 0)
		{
			$error[] = $this->registry->lang['controller']['errWidthRequired'];
			$pass = false;
		}
		
		
				
		return $pass;
	}
	
		
}

?>