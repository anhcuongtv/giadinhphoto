<?php

Class Controller_Admin_NewsCategory Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	
	function indexAction() 
	{
        global $langCode;
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fbulkid' => array());
		$_SESSION['securityToken']=Helper::getSecurityToken();//Token
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		if(!empty($_POST['fsubmitbulk']))
		{
            if($_SESSION['newscategoryBulkToken']==$_POST['ftoken'])
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
                        $deletedCategories = array();
                        $cannotDeletedCategories = array();
                        foreach($delArr as $id)
                        {
                            //check valid user and not admin user
                            $myCat = new Core_NewsCategory($id);
                            
                            if($myCat->id > 0)
                            {
                                //tien hanh xoa
                                if($myCat->delete())
                                {
                                    $deletedCategories[] = $myCat->name[$langCode];
                                    $this->registry->me->writelog('newscategorydelete', $myCat->id, array('name' => $myCat->name[$langCode]));      
                                }
                                else
                                    $cannotDeletedCategories[] = $myCat->name[$langCode];
                            }
                            else
                                $cannotDeletedCategories[] = $myCat->name[$langCode];
                        }
                        
                        if(count($deletedCategories) > 0)
                            $success[] = str_replace('###categoryname###', implode(', ', $deletedCategories), $this->registry->lang['controller']['succDelete']);
                        
                        if(count($cannotDeletedCategories) > 0)
                            $error[] = str_replace('###categoryname###', implode(', ', $cannotDeletedCategories), $this->registry->lang['controller']['errDelete']);
                    }
                    else
                    {
                        //bulk action not select, show error
                        $warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
                    }
                }
            }
			
		}
		
		if(!empty($_POST['fchangeorder']))
		{
            if($_SESSION['newscategoryBulkToken']==$_POST['ftoken'])
            {
                $items = $_POST['forder'];
                $updatedCategories = array();
                foreach($items as $itemId => $itemOrder)
                {
                    $itemOrder = (int)$itemOrder;
                    $myCat = new Core_NewsCategory($itemId);
                    if($myCat->order != $itemOrder)
                    {
                        $myCat->order = $itemOrder;
                        if($myCat->updateData())
                        {
                            $updatedCategories[] = $myCat->name[$langCode];
                            $this->registry->me->writelog('gamecategorychangeorder', $myCat->id, array('name' => $myCat->name[$langCode], 'order' => $myCat->order));
                        }
                    }    
                }
                
                if(count($updatedCategories) > 0)
                {
                    $success[] = str_replace('###categoryname###', implode(', ', $updatedCategories), $this->registry->lang['controller']['succUpdate']);    
                }
            }
			    		
		}
		$_SESSION['newscategoryBulkToken']=Helper::getSecurityToken();//Gan token de kiem soat viec nhan nut submit form   		
		$paginateUrl = $this->registry->conf['rooturl_admin'].'newscategory/index/';      
		
		
		//tim tong so
		$total = Core_NewsCategory::getCategories(array(), '', '', '', true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest account
		$categories = Core_NewsCategory::getCategories(array(), '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false, true);
		
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'categories' 	=> $categories,
												'formData'		=> $formData,
												'success'		=> $success,
												'error'			=> $error,
												'warning'		=> $warning,
												'paginateurl' 	=> $paginateUrl, 
												'redirectUrl'	=> $redirectUrl,
												'total'			=> $total,
												'totalPage' 	=> $totalPage,
												'curPage'		=> $curPage,
												));
		
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'newscategorylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
		
	} 
	
		
	function addAction()
	{
        global $langCode;
		$error 	= array();
		$success 	= array();
		$contents 	= '';
		$formData 	= array();
		
		$parentid = (int)($this->registry->router->getArg('parentid'));
		if($parentid > 0)
			$formData['fparentid'] = $parentid; 
		
		if(!empty($_POST['fsubmit']))
		{
            if($_SESSION['newscategoryAddToken']==$_POST['ftoken'])
            {
                 $formData = array_merge($formData, $_POST);
                
                if($this->addActionValidator($formData, $error))
                {
                    $myCat = new Core_NewsCategory();
                    $myCat->idtext = $formData['fidtext'];//Identify String cua muc tin
                    $myCat->name = $formData['fname'];
                    $myCat->parentid = (int)$formData['fparentid'];
                    $myCat->enable = (int)$formData['fenable']==1?1:0;
                     //Neu nguoi dung nhap SeoUrl thi xu li dau cua chuoi nguoi dung nhap       
                    //Truong hop nguoi dung khong nhap thi chung ta lay idtext de thay the!!!!!
                    if(strlen($formData['fseourl']) > 0)
                        $myCat->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                    else
                        $myCat->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname'][$langCode]), true);
                    $myCat->seoTitle = $formData['fseotitle'];
                    $myCat->seoKeyword = $formData['fseokeyword'];
                    $myCat->seoDescription = $formData['fseodescription'];
                    if($myCat->addData())
                    {
                        $success[] = str_replace('###categoryname###', $myCat->name[$langCode], $this->registry->lang['controller']['succAdd']);
                        $this->registry->me->writelog('newscategoryadd', $myCat->id, array('name' => $myCat->name[$langCode], 'order' => $myCat->order));
                        $formData = array('fparentid' => $formData['fparentid']);      
                    }
                    else
                    {
                        $error[] = $this->registry->lang['controller']['errAdd'];            
                    }
                }
            }
            $_SESSION['newscategoryAddToken']=Helper::getSecurityToken();//Tao token moi
		}
		
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'parentCategories' => Core_NewsCategory::getFullCategories(),
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		$this->registry->smarty->assign(array(
												'menu'		=> 'newscategorylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 			=> $contents));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	
	
	function editAction()
	{
        global $langCode;
		$id = (int)$this->registry->router->getArg('id');
		$myCat = new Core_NewsCategory($id);
		
		$redirectUrl = $this->getRedirectUrl();
		if($myCat->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$formData['fbulkid'] = array();
			$formData['fid'] = $myCat->id;
			$formData['fname'] = $myCat->name;
			$formData['forder'] = $myCat->order;
			$formData['fparentid'] = $myCat->parentid;
			$formData['fenable'] = $myCat->enable;
			$formData['fseourl'] = $myCat->seoUrl;
			$formData['fseotitle'] = $myCat->seoTitle;
			$formData['fseokeyword'] = $myCat->seoKeyword;
			$formData['fseodescription'] = $myCat->seoDescription;
			
			if(!empty($_POST['fsubmit']))
			{
                if($_SESSION['newscategoryEditToken']==$_POST['ftoken'])
                {
                    $formData = array_merge($formData, $_POST);
                    
                    if($this->editActionValidator($formData, $error))
                    {
                        //Cac thong tin khong ngon ngu:
                        $myCat->order = (int)$formData['forder'];
                        $myCat->parentid = (int)$formData['fparentid'];
                        $myCat->enable = (int)$formData['fenable']==1?1:0;
                        if(strlen($formData['fseourl']) > 0)
                            $myCat->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                        else
                            $myCat->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname']), true);
                        //Cac thong tin lien quan ngon ngu:    
                        $myCat->name = $formData['fname'];          
                        $myCat->seoTitle = $formData['fseotitle'];
                        $myCat->seoKeyword = $formData['fseokeyword'];
                        $myCat->seoDescription = $formData['fseodescription'];
                        
                        if($myCat->updateData())
                        {
                            $success[] = str_replace('###categoryname###', $myCat->name[$langCode], $this->registry->lang['controller']['succUpdate']);
                            $this->registry->me->writelog('newscategoryedit', $myCat->id, array('name' => $myCat->name[$langCode], 'order' => $myCat->order));
                        }
                        else
                        {
                            $error[] = $this->registry->lang['controller']['errUpdate'];            
                        }
                    }
                }
                $_SESSION['newscategoryEditToken'] = Helper::getSecurityToken();//Tao token moi
				    
			}
			
			$this->registry->smarty->assign(array(	'formData' 	=> $formData,
													'subcategories' => $myCat->getSub(true),
													'parentCategories' => Core_NewsCategory::getFullCategories(),
													'redirectUrl'=> $redirectUrl,
													'error'		=> $error,
													'success'	=> $success,
													
													));
			$contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			$this->registry->smarty->assign(array(
													'menu'		=> 'newscategorylist',
													'pageTitle'	=> $this->registry->lang['controller']['pageTitle_edit'],
													'contents' 			=> $contents));
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
        global $langCode;
		$id = (int)$this->registry->router->getArg('id');
		$myCat = new Core_NewsCategory($id);
		if($myCat->id > 0)
		{
			//tien hanh xoa
			if($myCat->delete())
			{
				$redirectMsg = str_replace('###categoryname###', $myCat->name[$langCode], $this->registry->lang['controller']['succDelete']);
				
				$this->registry->me->writelog('newscategorydelete', $myCat->id, array('name' => $myCat->name[$langCode]));  	
			}
			else
			{
				$redirectMsg = str_replace('###categoryname###', $myCat->name[$langCode], $this->registry->lang['controller']['errDelete']);
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
	
	//Kiem tra du lieu nhap trong form them moi	
	private function addActionValidator($formData, &$error)
	{
		$pass = true;
		
		if(strlen($formData['fname']['vn']) == 0 || strlen($formData['fname']['en']) ==0)//Kiem tra name cua muc tin  
		{
			$error[] = $this->registry->lang['controller']['errNameRequired'];
			$pass = false;
		}
		
		
		return $pass;
	}
	//Kiem tra du lieu nhap trong form cap nhat
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
        //Kiem tra name:
		if(strlen($formData['fname']['vn']) == 0 || strlen($formData['fname']['en'])==0)
        {
            $error[] = $this->registry->lang['controller']['errNameRequired'];
            $pass = false;
        }
				
		return $pass;
	}
}

?>