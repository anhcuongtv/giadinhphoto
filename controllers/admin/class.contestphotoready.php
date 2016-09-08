<?php

Class Controller_Admin_ContestPhotoReady Extends Controller_Admin_Base 
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
						$myPhoto = new Core_ContestPhotoReady($id);
						
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
		
		
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'contestphotoready/index/';      
		
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
			else if($searchKeywordIn == 'section')
			{
				$paginateUrl .= 'searchin/section/';
			}
			else if($searchKeywordIn == 'country')
			{
				$paginateUrl .= 'searchin/country/';
			}
			$formData['fkeyword'] = $formData['keywordFilter'] = $keywordFilter;
			$formData['fsearchin'] = $formData['searchKeywordIn'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
		
		//tim tong so
		$total = Core_ContestPhotoReady::getPhotos($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest account
		$photos = Core_ContestPhotoReady::getPhotos($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage);
		
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
		//print_r($photos);		
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'contestphotoreadylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function generateAction()
	{
		$error 	= array();
		$success 	= array();
		$contents 	= '';
		$formData 	= array();
		
		if(!empty($_POST['fsubmit']))
		{
			$formData = array_merge($formData, $_POST);
			if($this->generateActionValidator($formData, $error))
			{
				//Tien hanh  cap nhat thong tin hinh anh	
				if(Core_ContestPhotoReady::generateList())
				{
					header('location: ' . $this->registry->conf['rooturl_admin'] . 'contestphotoready');
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errGenerate'];
				}
			}
		}
		
		$_SESSION['contestphotoreadyGenerateToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'generate.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'contestphotoreadylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_generate'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function exportCsvAction()
	{
		$error 	= array();
		$success 	= array();
		$contents 	= '';
		$formData 	= array();
		
		if(!empty($_POST['fsubmit']))
		{
			$formData = array_merge($formData, $_POST);
			
			if($this->exportCsvActionValidator($formData, $error))
			{  
				$photos = Core_ContestPhotoReady::getPhotos($formData, 'id', 'ASC', '');
				
				if(count($photos) < 0)
				{
					$this->registry->smarty->assign(array(	'photos' 		=> $photos,
														));
					$filename = 'Photo_Export_' . implode('_', $formData['fsection'])  .'_' . date('Y-m-d-H-i') . '.csv';
					header("Cache-Control: public");
				    header("Content-Description: File Transfer");
				    header("Content-Disposition: attachment; filename=$filename");
				    header("Content-Type: application/vnd.ms-excel,charset=UTF-8; encoding=UTF-8"); 
					$this->registry->smarty->display($this->registry->smartyControllerContainer.'exportcsv_output.tpl');
					exit();		
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errExportEmpty'];
				}
			}
		}
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'exportcsv.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'contestphotoreadylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_exportcsv'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	####################################################################################################
	####################################################################################################
	####################################################################################################
	
		
	private function generateActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['contestphotoreadyGenerateToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
								
		return $pass;
	}
	
	private function exportCsvActionValidator($formData, &$error)
	{
		$pass = true;
		
		if(count($formData['fsection']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errSectionInvalid'];
			$pass = false;	
		}
		else
		{
			//check valid section
			for($i = 0; $i < count($formData['fsection']); $i++)
			{
				$sec = $formData['fsection'][$i];
				
				if($sec != 'color-c' && $sec != 'mono-m' && $sec != 'nature-n' && $sec != 'travel-t')
				{
					$error[] = $this->registry->lang['controller']['errSectionInvalid'];
					$pass = false;	
					break;	
				}
			}		
		}					
		return $pass;
	}
}

?>