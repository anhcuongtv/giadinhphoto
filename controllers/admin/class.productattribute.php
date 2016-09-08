<?php

Class Controller_Admin_ProductAttribute Extends Controller_Admin_Base 
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
			if($_POST['ftoken'] == $_SESSION['productattributeBulkToken'])
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
							$myAttribute = new Core_ProductAttribute($id);
							
							if($myAttribute->id > 0)
							{
								//tien hanh xoa
								if($myAttribute->delete())
								{
									$deletedItems[] = $myAttribute->id;
									$this->registry->me->writelog('productattribute_delete', $myAttribute->id, array());  	
								}
								else
									$cannotDeletedItems[] = $myAttribute->id;
							}
							else
								$cannotDeletedItems[] = $myAttribute->id;
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
		
		if(!empty($_POST['fchangeorder']) && ($_POST['ftoken'] == $_SESSION['productattributeBulkToken']))
		{
			$items = $_POST['forder'];
			$updatedItems = array();
			foreach($items as $itemId => $itemOrder)
			{
				$itemOrder = (int)$itemOrder;
				$myAttribute = new Core_ProductAttribute($itemId);
				if($myAttribute->order != $itemOrder)
				{
					$myAttribute->order = $itemOrder;
					if($myAttribute->updateData())
					{
						$updatedItems[] = $myAttribute->id;
						$this->registry->me->writelog('productattribute_change_order', $myAttribute->id, array('order' => $myAttribute->order));
					}
				}	
			}
			
			if(count($updatedItems) > 0)
			{
				$success[] = str_replace('###id###', implode(', ', $updatedItems), $this->registry->lang['controller']['succUpdate']);    
			}		
		}
		
		$_SESSION['productattributeBulkToken'] = Helper::getSecurityToken();
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'productattribute/index/';      
		
				
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
			elseif($searchKeywordIn == 'description')
			{
				$paginateUrl .= 'searchin/description/';
			}
			
			$formData['fkeyword'] = $keywordFilter;
			$formData['fsearchin'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
				
		//tim tong so
		$total = Core_ProductAttribute::getAttributes($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$attributes = Core_ProductAttribute::getAttributes($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'attributes' 		=> $attributes,
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'productattribute',
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
				$myAttribute = new Core_ProductAttribute();
				$myAttribute->description = $formData['fdescription'];
				$myAttribute->inputType = 'checkbox';
				$myAttribute->defaultValue = $formData['fdefaultvalue'];
				$myAttribute->enable = $formData['fenable']==1?1:0;
				$myAttribute->searchable = $formData['fsearchable']==1?1:0;
				$myAttribute->name = $formData['fname'];
				$myAttribute->valueSet = $formData['fvalueset'];
				
				
				if($myAttribute->addData())
				{
					$success[] = str_replace('###id###', $myAttribute->id, $this->registry->lang['controller']['succAdd']);
					$this->registry->me->writelog('productattribute_add', $myAttribute->id, array());
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['productattributeAddToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'productattribute',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id =(int)$this->registry->router->getArg('id');
		$myAttribute = new Core_ProductAttribute($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myAttribute->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fdescription'] = $myAttribute->description;
			$formData['finputtype'] = $myAttribute->inputType;
			$formData['fdefaultvalue'] = $myAttribute->defaultValue;
			$formData['fenable'] = $myAttribute->enable;
			$formData['fsearchable'] = $myAttribute->searchable;
			$formData['forder'] = $myAttribute->order;
			$formData['fname'] = $myAttribute->name;
			$formData['fvalueset'] = $myAttribute->valueSet;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myAttribute->description = $formData['fdescription'];
					$myAttribute->inputType = 'checkbox';
					$myAttribute->defaultValue = $formData['fdefaultvalue'];
					$myAttribute->enable = $formData['fenable']==1?1:0;
					$myAttribute->searchable = $formData['fsearchable']==1?1:0;
					$myAttribute->order = $formData['forder'];
					$myAttribute->name = $formData['fname'];
					$myAttribute->valueSet = $formData['fvalueset'];
					
					if($myAttribute->updateData())
					{
						$success[] = str_replace('###id###', $myAttribute->id, $this->registry->lang['controller']['succUpdate']);
						$this->registry->me->writelog('productattribute_edit', $myAttribute->id, array());
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			
			$_SESSION['productattributeEditToken'] = Helper::getSecurityToken();
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'myAttribute'		=> $myAttribute,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'productattribute',
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
		$myAttribute = new Core_ProductAttribute($id);
			
		if($myAttribute->id > 0)
		{
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myAttribute->delete())
				{
					$redirectMsg = str_replace('###id###', $myAttribute->id, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('productattribute_delete', $myAttribute->id, array());  	
				}
				else
				{
					$redirectMsg = str_replace('###id###', $myAttribute->id, $this->registry->lang['controller']['errDelete']);
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
		
		if($_SESSION['productattributeAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		//Kiem tra name cua tin tuc
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
		
		if($_SESSION['productattributeEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		
				
		return $pass;
	}
	
		
}

?>