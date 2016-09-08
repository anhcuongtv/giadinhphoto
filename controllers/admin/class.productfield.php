<?php

Class Controller_Admin_ProductField Extends Controller_Admin_Base 
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
		$keywordFilter 	= $this->registry->router->getArg('keyword');
		$searchKeywordIn= $this->registry->router->getArg('searchin'); 
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'order';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;	
		
		if(!empty($_POST['fsubmitbulk']))
		{
			if($_POST['ftoken'] == $_SESSION['productfieldBulkToken'])
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
							$myField = new Core_ProductField($id);
							
							if($myField->id > 0)
							{
								//tien hanh xoa
								if($myField->delete())
								{
									$deletedItems[] = $myField->id;
									$this->registry->me->writelog('productfielddelete', $myField->id, array());  	
								}
								else
									$cannotDeletedItems[] = $myField->id;
							}
							else
								$cannotDeletedItems[] = $myField->id;
						}
						
						if(count($deletedItems) > 0)
							$success[] = str_replace('###id###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
						
						if(count($cannotDeletedItems) > 0)
							$error[] = str_replace('###id###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
					}
					else
					{
						//bulk action not select, show error
						$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
					}
				}
			}
			
		}
		
		if(!empty($_POST['fchangeorder']) && ($_POST['ftoken'] == $_SESSION['productfieldBulkToken']))
		{
			$items = $_POST['forder'];
			$updatedItems = array();
			foreach($items as $itemId => $itemOrder)
			{
				$itemOrder = (int)$itemOrder;
				$myField = new Core_ProductField($itemId);
				if($myField->order != $itemOrder)
				{
					$myField->order = $itemOrder;
					if($myField->updateData())
					{
						$updatedItems[] = $myField->id;
						$this->registry->me->writelog('productfield_change_order', $myField->id, array('order' => $myField->order));
					}
				}	
			}
			
			if(count($updatedItems) > 0)
			{
				$success[] = str_replace('###id###', implode(', ', $updatedItems), $this->registry->lang['controller']['succUpdate']);    
			}		
		}
		
		$_SESSION['productfieldBulkToken'] = Helper::getSecurityToken();
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'productfield/index/';      
		
				
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
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
		$total = Core_ProductField::getFields($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$fields = Core_ProductField::getFields($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'fields' 		=> $fields,
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'productfield',
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
				$myField = new Core_ProductField();
				$myField->description = $formData['fdescription'];
				$myField->enable = $formData['fenable']==1?1:0;
				$myField->name = $formData['fname'];
				
				
				if($myField->addData())
				{
					$success[] = str_replace('###id###', $myField->id, $this->registry->lang['controller']['succAdd']);
					$this->registry->me->writelog('productfield_add', $myField->id, array());
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['productfieldAddToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'productfield',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id =(int)$this->registry->router->getArg('id');
		$myField = new Core_ProductField($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myField->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fenable'] = $myField->enable;
			$formData['forder'] = $myField->order;
			$formData['fname'] = $myField->name;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myField->enable = $formData['fenable']==1?1:0;
					$myField->order = $formData['forder'];
					$myField->name = $formData['fname'];
					
					if($myField->updateData())
					{
						$success[] = str_replace('###id###', $myField->id, $this->registry->lang['controller']['succUpdate']);
						$this->registry->me->writelog('productfield_edit', $myField->id, array());
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			
			$_SESSION['productfieldEditToken'] = Helper::getSecurityToken();
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'myField'		=> $myField,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'productfield',
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
		$myField = new Core_ProductField($id);
			
		if($myField->id > 0)
		{
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myField->delete())
				{
					$redirectMsg = str_replace('###id###', $myField->id, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('productfield_delete', $myField->id, array());  	
				}
				else
				{
					$redirectMsg = str_replace('###id###', $myField->id, $this->registry->lang['controller']['errDelete']);
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
		
		if($_SESSION['productfieldAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		foreach($formData['fname'] as $langcode => $value)
		{
			if(strlen($value) == 0)
			{
				$error[] = str_replace('###LANGCODE###', strtoupper($langcode), $this->registry->lang['controller']['errNameRequired']);
           		$pass = false;
			}
		}
       			
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['productfieldEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		foreach($formData['fname'] as $langcode => $value)
		{
			if(strlen($value) == 0)
			{
				$error[] = str_replace('###LANGCODE###', strtoupper($langcode), $this->registry->lang['controller']['errNameRequired']);
           		$pass = false;
			}
		}
		
				
		return $pass;
	}
	
		
}

?>