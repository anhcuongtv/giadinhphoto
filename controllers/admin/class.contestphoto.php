<?php

Class Controller_Admin_ContestPhoto Extends Controller_Admin_Base 
{
	public $recordPerPage = 20;
	
	public function indexAction()
	{
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fbulkid' => array());
		
		$_SESSION['securityToken'] = Helper::getSecurityToken();  //for delete link
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		$exceptid 		= (int)$this->registry->router->getArg('exceptid');
		$idFilter 		= (int)($this->registry->router->getArg('id'));
		$keywordFilter 	= $this->registry->router->getArg('keyword'); 
		$searchKeywordIn= $this->registry->router->getArg('searchin');  
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'id';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'ASC') $sorttype = 'DESC';
		$formData['sorttype'] = $sorttype;	
		
		
		if(!empty($_POST['fsubmitbulk']))
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
						$myPhoto = new Core_ContestPhoto($id);
						
						if($myPhoto->id > 0)
						{
							//tien hanh xoa
							if($myPhoto->delete())
							{
								$deletedItems[] = $myPhoto->name;
								$this->registry->me->writelog('contestphoto_delete', $myPhoto->id, array('username' => $myPhoto->username, 'username' => $myPhoto->poster->username));  	
							}
							else
								$cannotDeletedItems[] = $myPhoto->name;
						}
						else
							$cannotDeletedItems[] = $myPhoto->name;
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
		
		
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'contestphoto/index/';      
		
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
		}
		
		
		if(strlen($keywordFilter) > 0)
		{
			
			$paginateUrl .= 'keyword/' . $keywordFilter . '/';
			
			if($searchKeywordIn == 'username')
			{
				$paginateUrl .= 'searchin/username/';
			}
			else if($searchKeywordIn == 'name')
			{
				$paginateUrl .= 'searchin/name/';
			}
			else if($searchKeywordIn == 'description')
			{
				$paginateUrl .= 'searchin/description/';
			}
			$formData['fkeyword'] = $formData['keywordFilter'] = $keywordFilter;
			$formData['fsearchin'] = $formData['searchKeywordIn'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
		
		//tim tong so
		$total = Core_ContestPhoto::getPhotos($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest account
		$photos = Core_ContestPhoto::getPhotos($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage);
		
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
				
		$this->registry->smarty->assign(array(	'photos'	 	=> $photos,
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'contestphotolist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$success = $error = $formData = array();
		$id = $this->registry->router->getArg('id');
		$myPhoto = new Core_ContestPhoto($id);
		$redirectUrl = $this->getRedirectUrl();
        $group = Core_ContestPhotoGroup::getList(0, true);
        $data = Helper::displaySelectionPhotoGroupForUser($group, true, $myPhoto->section);
		if($myPhoto->id > 0)
		{
			$poster = new Core_User($myPhoto->uid);
			
			$formData['fsection'] = $myPhoto->section;
			$formData['fname'] = $myPhoto->name;
			$formData['fdescription'] = $myPhoto->description;
			
			if(isset($_POST['fsubmit']) && $_POST['ftoken'] == $_SESSION['editPhotoToken'])
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editPhotoValidator($formData, $error, $myPhoto))
				{
					$myPhoto->section = strip_tags($formData['fsection']);
					$myPhoto->name = strip_tags($formData['fname']);
					$myPhoto->description = strip_tags($formData['fdescription']);
					$editResult = $myPhoto->updateData();
					
					if($editResult == Core_ContestPhoto::ERROR_OK)
					{
						$success[] =  $this->registry->lang['controller']['succEdit'];               
					}
					else
					{
						$error[] =  $this->registry->lang['controller']['errEdit'];         
					}
				}
			
				
			}
			
			$_SESSION['editPhotoToken'] = Helper::getSecurityToken();		 
						
			$this->registry->smarty->assign(
				array('myPhoto' => $myPhoto,
					'error'	=> $error,
					'success'	=> $success,
					'formData'	=> $formData,
					'redirectUrl' => $this->getRedirectUrl(),
                    'data' => $data
				)
			);
			
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl'); 
			
			$this->registry->smarty->assign(
				array('contents' => $contents,
					'menu' => 'contestphoto'
				)
			);
				
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 	
		}
		else
		{
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => 'Photo Not Found.',
													));
			$this->registry->smarty->display('redirect.tpl');
			exit();
		}
		
		
	}
	
	
	
	private function editPhotoValidator($formData, &$error, $editPhoto)
	{
		$pass = true;
		
		if($formData['fsection'] != 'color' && $formData['fsection'] != 'mono' && $formData['fsection'] != 'nature' && $formData['fsection'] !=  'travel')
		{
			$error[] = $this->registry->lang['controller']['errSectionInvalid'];
			$pass = false;	
		}
			
		
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequire'];
			$pass = false;	
		}
		
		
		return $pass;
	}
}

?>