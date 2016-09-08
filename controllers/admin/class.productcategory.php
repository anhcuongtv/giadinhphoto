<?php

Class Controller_Admin_ProductCategory Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	//ham hien thi danh sach o trang admin
	function indexAction() 
	{
        global $langCode;//bien ngon ngu
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fbulkid' => array());
		$_SESSION['securityToken']=Helper::getSecurityToken();//Token
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		if(!empty($_POST['fsubmitbulk']))
		{
            if($_SESSION['productcategoryBulkToken']==$_POST['ftoken'])
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
                            $myProductCat = new Core_ProductCategory($id);
                            
                            if($myProductCat->id > 0)
                            {
                                //tien hanh xoa
                                if($myProductCat->delete())
                                {
                                    $deletedCategories[] = $myProductCat->name[$langCode];
                                    $this->registry->me->writelog('ProductCategorydelete', $myProductCat->id, array('name' => $myProductCat->name[$langCode]));      
                                }
                                else
                                    $cannotDeletedCategories[] = $myProductCat->name[$langCode];
                            }
                            else
                                $cannotDeletedCategories[] = $myProductCat->name[$langCode];
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
		//cap nhat thu tu
		if(!empty($_POST['fchangeorder']))
		{
            if($_SESSION['productcategoryBulkToken']==$_POST['ftoken'])
            {
                $items = $_POST['forder'];
                $updatedCategories = array();
                foreach($items as $itemId => $itemOrder)
                {
                    $itemOrder = (int)$itemOrder;
                    $myProductCat = new Core_ProductCategory($itemId);
                    if($myProductCat->order != $itemOrder)
                    {
                        $myProductCat->order = $itemOrder;
                        if($myProductCat->updateData())
                        {
                            $updatedCategories[] = $myProductCat->name[$langCode];
                            $this->registry->me->writelog('gamecategorychangeorder', $myProductCat->id, array('name' => $myProductCat->name[$langCode], 'order' => $myProductCat->order));
                        }
                    }    
                }
                
                if(count($updatedCategories) > 0)
                {
                    $success[] = str_replace('###categoryname###', implode(', ', $updatedCategories), $this->registry->lang['controller']['succUpdate']);    
                }
            }
			    		
		}
		$_SESSION['productcategoryBulkToken']=Helper::getSecurityToken();//Gan token de kiem soat viec nhan nut submit form   		
		$paginateUrl = $this->registry->conf['rooturl_admin'].'productcategory/index/';      
		
		
		//tim tong so
		$total = Core_ProductCategory::getCategories(array(), '', '', '', true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest account
		$categories = Core_ProductCategory::getCategories(array(), '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false, true);
		
		
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'productcategorylist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
		
	} 
	
	//ham them record moi	
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
            if($_SESSION['productcategoryAddToken']==$_POST['ftoken'])
            {
                 $formData = array_merge($formData, $_POST);
                
                if($this->addActionValidator($formData, $error))
                {
                    $myProductCat = new Core_ProductCategory();
                    //thong tin khong lien quan ngon ngu
                    $myProductCat->name = $formData['fname'];
                    $myProductCat->parentid = (int)$formData['fparentid'];
                    $myProductCat->enable = (int)$formData['fenable']==1?1:0;
                     //Neu nguoi dung nhap SeoUrl thi xu li dau cua chuoi nguoi dung nhap       
                    //Truong hop nguoi dung khong nhap thi chung ta lay idtext de thay the!!!!!
                    if(strlen($formData['fseourl']) > 0)
                        $myProductCat->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                    else
                        $myProductCat->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname'][$langCode]), true);
                    //cac thong tin lien quan ngong ngu
                    $myProductCat->seoTitle = $formData['fseotitle'];
                    $myProductCat->seoKeyword = $formData['fseokeyword'];
                    $myProductCat->seoDescription = $formData['fseodescription'];
                    if($myProductCat->addData())//them vao database
                    {
                        $success[] = str_replace('###categoryname###', $myProductCat->name[$langCode], $this->registry->lang['controller']['succAdd']);
                        $this->registry->me->writelog('ProductCategoryadd', $myProductCat->id, array('name' => $myProductCat->name[$langCode], 'order' => $myProductCat->order));
                        $formData = array('fparentid' => $formData['fparentid']);      
                    }
                    else
                    {
                        $error[] = $this->registry->lang['controller']['errAdd'];            
                    }
                }
            }
            $_SESSION['productcategoryAddToken']=Helper::getSecurityToken();//Tao token moi
		}
		
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'parentCategories' => Core_ProductCategory::getFullCategories(),
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		$this->registry->smarty->assign(array(
												'menu'		=> 'productcategoryadd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 			=> $contents));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	
	 //ham xu li cap nhat du lieu
	function editAction()
	{
        global $langCode;
		$id = (int)$this->registry->router->getArg('id');
		$myProductCat = new Core_ProductCategory($id);
		
		$redirectUrl = $this->getRedirectUrl();
		if($myProductCat->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			 //Truyen du lieu hien co vao form
			$formData['fbulkid'] = array();
			$formData['fid'] = $myProductCat->id;
			$formData['fname'] = $myProductCat->name;
			$formData['forder'] = $myProductCat->order;
			$formData['fparentid'] = $myProductCat->parentid;
			$formData['fenable'] = $myProductCat->enable;
			$formData['fseourl'] = $myProductCat->seoUrl;
			$formData['fseotitle'] = $myProductCat->seoTitle;
			$formData['fseokeyword'] = $myProductCat->seoKeyword;
			$formData['fseodescription'] = $myProductCat->seoDescription;
			
			if(!empty($_POST['fsubmit']))//truong hop da nhan nut submit
			{
                if($_SESSION['productcategoryEditToken']==$_POST['ftoken'])//kiem tra token
                {
                    $formData = array_merge($formData, $_POST);
                    
                    if($this->editActionValidator($formData, $error))//kiem tra du lieu co hop le hay khong
                    {
                        //Cac thong tin khong ngon ngu:
                        $myProductCat->order = (int)$formData['forder'];
                        $myProductCat->parentid = (int)$formData['fparentid'];
                        $myProductCat->enable = (int)$formData['fenable']==1?1:0;
                        if(strlen($formData['fseourl']) > 0)
                            $myProductCat->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                        else
                            $myProductCat->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname']), true);
                        //Cac thong tin lien quan ngon ngu:    
                        $myProductCat->name = $formData['fname'];          
                        $myProductCat->seoTitle = $formData['fseotitle'];
                        $myProductCat->seoKeyword = $formData['fseokeyword'];
                        $myProductCat->seoDescription = $formData['fseodescription'];
                        
                        if($myProductCat->updateData())//cap nhat database
                        {
                            $success[] = str_replace('###categoryname###', $myProductCat->name[$langCode], $this->registry->lang['controller']['succUpdate']);
                            $this->registry->me->writelog('ProductCategoryedit', $myProductCat->id, array('name' => $myProductCat->name[$langCode], 'order' => $myProductCat->order));
                        }
                        else
                        {
                            $error[] = $this->registry->lang['controller']['errUpdate'];            
                        }
                    }
                }
                $_SESSION['productcategoryEditToken'] = Helper::getSecurityToken();//Tao token moi
				    
			}
			
			$this->registry->smarty->assign(array(	'formData' 	=> $formData,
													'subcategories' => $myProductCat->getSub(true),
													'parentCategories' => Core_ProductCategory::getFullCategories(),
													'redirectUrl'=> $redirectUrl,
													'error'		=> $error,
													'success'	=> $success,
													
													));
			$contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			$this->registry->smarty->assign(array(
													'menu'		=> 'productcategorylist',
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
    //ham xu li xoa du lieu
	function deleteAction()
	{
        global $langCode;
		$id = (int)$this->registry->router->getArg('id');//lay id cua record can xoa
		$myProductCat = new Core_ProductCategory($id);
		if($myProductCat->id > 0)
		{
			//tien hanh xoa
			if($myProductCat->delete())
			{
				$redirectMsg = str_replace('###categoryname###', $myProductCat->name[$langCode], $this->registry->lang['controller']['succDelete']);
				
				$this->registry->me->writelog('ProductCategorydelete', $myProductCat->id, array('name' => $myProductCat->name[$langCode]));  	
			}
			else
			{
				$redirectMsg = str_replace('###categoryname###', $myProductCat->name[$langCode], $this->registry->lang['controller']['errDelete']);
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
	//Kiem tra du lieu nhap trong form cap nhat
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
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