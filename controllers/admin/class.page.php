<?php

Class Controller_Admin_Page Extends Controller_Admin_Base 
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
		if($sortby == '') $sortby = 'idtext';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;	
		
		if(!empty($_POST['fsubmitbulk']))
		{
			if($_POST['ftoken'] == $_SESSION['pageDeleteToken'])
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
							$myPage = new Core_Page($id);
							
							if($myPage->id > 0)
							{
								//tien hanh xoa
								if($myPage->delete())
								{
									$deletedItems[] = $myPage->idtext;
									$this->registry->me->writelog('pagedelete', $myPage->id, array('idtext' => $myPage->idtext));  	
								}
								else
									$cannotDeletedItems[] = $myPage->idtext;
							}
							else
								$cannotDeletedItems[] = $myPage->idtext;
						}
						
						if(count($deletedItems) > 0)
							$success[] = str_replace('###pagename###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
						
						if(count($cannotDeletedItems) > 0)
							$error[] = str_replace('###pagename###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
					}
					else
					{
						//bulk action not select, show error
						$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
					}
				}
			}
			
		}
		
		$_SESSION['pageDeleteToken'] = Helper::getSecurityToken();
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'page/index/';      
		
				
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
		}
		
				
		//tim tong so
		$total = Core_Page::getPages($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$pages = Core_Page::getPages($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'pages' 		=> $pages,
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'pagelist',
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
				$myPage = new Core_Page();
				$myPage->idtext = $formData['fidtext'];
				$myPage->title = $formData['ftitle'];
				$myPage->contents = $formData['fcontents'];
				$myPage->seoTitle = $formData['fseotitle'];
				$myPage->seoKeyword = $formData['fseokeyword'];
				$myPage->seoDescription = $formData['fseodescription'];
				$myPage->enable = (int)$formData['fenable']==1?1:0;
				if(strlen($formData['fseourl']) > 0)
					$myPage->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
				else
					$myPage->seoUrl = Helper::codau2khongdau(strip_tags($formData['fidtext']), true);
				
				if($myPage->addData())
				{
					$success[] = str_replace('###pagename###', $myPage->idtext, $this->registry->lang['controller']['succAdd']);
					$this->registry->me->writelog('pageadd', $myPage->id, array('idtext' => $myPage->idtext));
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['pageAddToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'pageadd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myPage = new Core_Page($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myPage->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fidtext'] = $myPage->idtext;
			$formData['ftitle'] = $myPage->title;
			$formData['fcontents'] = $myPage->contents;
			$formData['fseourl'] = $myPage->seoUrl;
			$formData['fseotitle'] = $myPage->seoTitle;
			$formData['fseokeyword'] = $myPage->seoKeyword;
			$formData['fseodescription'] = $myPage->seoDescription;
			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
					$myPage->idtext = $formData['fidtext'];
					$myPage->title = $formData['ftitle'];
					$myPage->contents = $formData['fcontents'];
					$myPage->seoTitle = $formData['fseotitle'];
					$myPage->seoKeyword = $formData['fseokeyword'];
					$myPage->seoDescription = $formData['fseodescription'];
					$myPage->enable = (int)$formData['fenable']==1?1:0;
					if(strlen($formData['fseourl']) > 0)
						$myPage->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
					else
						$myPage->seoUrl = Helper::codau2khongdau(strip_tags($formData['fidtext']), true);
					
					if($myPage->updateData())
					{
						$success[] = str_replace('###pagename###', $myPage->idtext, $this->registry->lang['controller']['succUpdate']);
						$this->registry->me->writelog('pageedit', $myPage->id, array('idtext' => $myPage->idtext));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
			
			$_SESSION['pageEditToken'] = Helper::getSecurityToken();
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'page',
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
		$myPage = new Core_Page($id);
			
		if($myPage->id > 0)
		{
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myPage->delete())
				{
					$redirectMsg = str_replace('###pagename###', $myPage->idtext, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('pagedelete', $myPage->id, array('idtext' => $myPage->idtext));  	
				}
				else
				{
					$redirectMsg = str_replace('###pagename###', $myPage->idtext, $this->registry->lang['controller']['errDelete']);
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
		
		if($_SESSION['pageAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fidtext']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errIdtextRequired'];
			$pass = false;
		}
		
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['pageEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fidtext']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errIdtextRequired'];
			$pass = false;
		}
		
				
		return $pass;
	}
	
		
}

?>