<?php

Class Controller_Admin_ProductSupplier Extends Controller_Admin_Base 
{
    private $recordPerPage = 20;
    //Hien thi danh sach
    function indexAction() 
    {
        global $langCode;
        $error             = array();
        $success         = array();
        $warning         = array();
        $formData         = array('fbulkid' => array());
        $page             = (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
        //Thong tin tim kiem
        $idFilter         = (int)($this->registry->router->getArg('id'));//id cua con meo
        $enableFilter     = ($this->registry->router->getArg('enable')); //Trang thai
        $keywordFilter    = ($this->registry->router->getArg('keyword'));//Tu khoa
        $searchinFilter   = ($this->registry->router->getArg('searchin'));//Tim kiem trong cai gi?
        
        //check sort column condition
        $sortby     = $this->registry->router->getArg('sortby');
        if($sortby == '') $sortby = 'id';      
        $formData['sortby'] = $sortby;
        $sorttype     = $this->registry->router->getArg('sorttype');
        if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
        $formData['sorttype'] = $sorttype;    
        //Xoa cac con meo
        if(!empty($_POST['fsubmitbulk']))
        {
            if($_SESSION['productsupplierBulkToken']==$_POST['ftoken'])
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
                        $deletedCats = array();
                        $cannotDeletedCats = array();
                        foreach($delArr as $id)
                        {
                            //check valid user and not admin user
                            $myProductSupplier = new Core_ProductSupplier($id);
                            
                            if($myProductSupplier->id > 0)
                            {
                                //tien hanh xoa
                                if($myProductSupplier->delete())
                                {
                                    $deletedCats[] = $myProductSupplier->name[$langCode];
                                    $this->registry->me->writelog('ProductSupplierdelete', $myProductSupplier->id, array('name' => $myProductSupplier->name[$langCode]));      
                                }
                                else
                                    $cannotDeletedCats[] = $myProductSupplier->name[$langCode];
                            }
                            else
                                $cannotDeletedCats[] = $myProductSupplier->name[$langCode];
                        }
                        
                        if(count($deletedCats) > 0)
                            $success[] = str_replace('###name###', implode(', ', $deletedCats), $this->registry->lang['controller']['succDelete']);
                        
                        if(count($cannotDeletedCats) > 0)
                            $error[] = str_replace('###name###', implode(', ', $cannotDeletedCats), $this->registry->lang['controller']['errDelete']);
                    }
                    else
                    {
                        //bulk action not select, show error
                        $warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
                    }
                }
            }
            
        }
        $_SESSION['productsupplierBulkToken']=Helper::getSecurityToken();//Tao token moi
                
        $paginateUrl = $this->registry->conf['rooturl_admin'].'productsupplier/index/';  
        //Sap xep:                                                                                                         
        if($idFilter > 0)
        {
            $paginateUrl .= 'id/'.$idFilter . '/';
            $formData['fid'] = $idFilter;
            $formData['search'] = 'id';
        }
       
         if(strlen($enableFilter) > 0)
        {
            $paginateUrl .= 'enable/'.$enableFilter . '/';
            $formData['fenable'] = $enableFilter;
            $formData['search'] = 'enable';
        }
         if(strlen($keywordFilter) > 0)
        {
            $paginateUrl .= 'keyword/'.$keywordFilter . '/';
            $formData['fkeyword'] = $keywordFilter;
            $formData['search'] = 'keyword';
        }
         if(strlen($searchinFilter) > 0)
        {
            $paginateUrl .= 'searchin/'.$searchinFilter . '/';
            $formData['fsearchin'] = $searchinFilter;
            $formData['search'] = 'searchin';
        }
        //tim tong so
        $total = Core_ProductSupplier::getProductSuppliers($formData, $sortby, $sorttype, '', true);    
        $totalPage = ceil($total/$this->recordPerPage);
        $curPage = $page;
        
            
        //get latest account. $cats: Nhung con meo :)
        $myProductSuppliers = Core_ProductSupplier::getProductSuppliers($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
        //build redirect string
        $redirectUrl = $paginateUrl;
        if($curPage > 1)
            $redirectUrl .= 'page/' . $curPage;
            
        
        $redirectUrl = base64_encode($redirectUrl);
        
                
        $this->registry->smarty->assign(array(  'myProductSuppliers'     => $myProductSuppliers,
                                                'formData'        => $formData,
                                                'success'        => $success,
                                                'error'            => $error,
                                                'warning'        => $warning,
                                                'paginateurl'     => $paginateUrl, 
                                                'redirectUrl'    => $redirectUrl,
                                                'total'            => $total,
                                                'totalPage'     => $totalPage,
                                                'curPage'        => $curPage,
                                                ));
        
        
        $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
        
        $this->registry->smarty->assign(array(    'menu'        => 'productsupplierlist',
                                                'pageTitle'    => $this->registry->lang['controller']['pageTitle_list'],
                                                'contents'     => $contents));
        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
        
    } 
    
    //Tinh nang them record moi    
    function addAction()
    {
        
        $error     = array();
        $success     = array();
        $contents     = ''; //Bien chua noi dung giao dien cua trang!!!!!!!!!!!
        $formData     = array();//Bien chua du lieu trong form
        
        if(!empty($_POST['fsubmit']))//Truong hop da nhan nut submit
        {
            if($_SESSION['productsupplierAddToken']==$_POST['ftoken'])
            {
                 $formData = array_merge($formData, $_POST);//Luu cac du lieu trong form nhap lieu vao bien $formData
                
                if($this->addActionValidator($formData, $error))//Kiem tra du lieu nhap
                {
                    $myProductSupplier = new Core_ProductSupplier();//Con meo moi
                    $myProductSupplier->enable = (int)$formData['fenable']==1?1:0;
                    $myProductSupplier->email = $formData['femail'];
                    $myProductSupplier->address = $formData['faddress'];
                    $myProductSupplier->fax = $formData['ffax'];
                    $myProductSupplier->phone = $formData['fphone'];
                    $myProductSupplier->website = $formData['fwebsite'];
                     //Neu nguoi dung nhap SeoUrl thi xu li dau cua chuoi nguoi dung nhap
                    //Truong hop nguoi dung khong nhap thi chung ta lay idtext de thay the!!!!!
                    if(strlen($formData['fseourl']) > 0)
                        $myProductSupplier->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                    else
                        $myProductSupplier->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname'][$this->registry->langCode]), true);
                        
                    $myProductSupplier->name = $formData['fname'];
                    $myProductSupplier->contents = $formData['fcontents'];
                   
                    $myProductSupplier->seoTitle = $formData['fseotitle'];
                    $myProductSupplier->seoKeyword = $formData['fseokeyword'];
                    $myProductSupplier->seoDescription = $formData['fseodescription'];
                    //Hinh anh
                    $actionResult = $myProductSupplier->addData();
                    
                    if($actionResult == Core_ProductSupplier::ERROR_OK)
                    {
                        $success[] = str_replace('###name###', $myProductSupplier->name[$this->registry->langCode], $this->registry->lang['controller']['succAdd']);
                        $this->registry->me->writelog('ProductSupplieradd', $myProductSupplier->id, array('name' => $myProductSupplier->name[$this->registry->langCode], 'order' => $myProductSupplier->order));
                        $formData = array('fparentid' => $formData['fparentid']);      
                    }
                    else if($actionResult == Core_ProductSupplier::ERROR_UPLOAD_IMAGE)
                    {
                        $error[] = $this->registry->lang['controller']['errAddUpload'];            
                    }
                    else
                    {
                        $error[] = $this->registry->lang['controller']['errAdd'];    
                    }
                }
            }                                      
           
                
        }
         $_SESSION['ProductSupplierAddToken']=Helper::getSecurityToken();//Tao token moi
        
        $this->registry->smarty->assign(array(  'formData'         => $formData,
                                                'redirectUrl'    => $this->getRedirectUrl(),
                                                'error'            => $error,
                                                'success'        => $success,
                                                
                                                ));
        $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
        $this->registry->smarty->assign(array(
                                                'menu'        => 'productsupplierlist',
                                                'pageTitle'    => $this->registry->lang['controller']['pageTitle_add'],
                                                'contents'             => $contents));
        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
    }
    
    //Cap nhat thong tin mot con meo
    function editAction()
    {                                                 
        $id = (int)$this->registry->router->getArg('id');
        $myProductSupplier = new Core_ProductSupplier($id);
        $redirectUrl = $this->getRedirectUrl();
        if($myProductSupplier->id > 0)
        {
            
            $error         = array();
            $success     = array();
            $contents     = '';
            $formData     = array();
            
            $formData['fbulkid'] = array();
            $formData['fid'] = $myProductSupplier->id;
            $formData['forder'] = $myProductSupplier->order;
            $formData['fparentid'] = $myProductSupplier->parentid;
            $formData['fenable'] = $myProductSupplier->enable;             
            $formData['fseourl'] = $myProductSupplier->seoUrl;
            
            $formData['femail'] = $myProductSupplier->email;
            $formData['faddress'] = $myProductSupplier->address;
            $formData['ffax'] = $myProductSupplier->fax;
            $formData['fphone'] = $myProductSupplier->phone;
            $formData['fwebsite'] = $myProductSupplier->website;
            
            $formData['fname'] = $myProductSupplier->name;
            $formData['fseotitle'] = $myProductSupplier->seoTitle;
            $formData['fseokeyword'] = $myProductSupplier->seoKeyword;
            $formData['fseodescription'] = $myProductSupplier->seoDescription;
            $formData['fcontents'] = $myProductSupplier->contents;                                                 
            
            $formData['fimage'] = $myProductSupplier->image;
            $formData['fsmallImage'] = $myProductSupplier->smallImage;
            if(!empty($_POST['fsubmit']))
            {
                if($_SESSION['productsupplierEditToken']==$_POST['ftoken'])
                {
                    $formData = array_merge($formData, $_POST);
                    if($this->editActionValidator($formData, $error))
                    {
                        //xoa hinh neu chon
                        if(isset($_POST['fdeleteimage']))
                        {
                            $myProductSupplier->deleteImage();
                            $formData['fimage'] = $formData['fsmallImage'] = '';
                        }
                        
                        //Cac thong tin khong ngon ngu:
                        $myProductSupplier->order = (int)$formData['forder'];
                        $myProductSupplier->parentid = (int)$formData['fparentid'];
                        $myProductSupplier->enable = (int)$formData['fenable']==1?1:0;
                        if(strlen($formData['fseourl']) > 0)
                            $myProductSupplier->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                        else
                            $myProductSupplier->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname']), true);
                        $myProductSupplier->email = $formData['femail'];
                        $myProductSupplier->address = $formData['faddress'];
                        $myProductSupplier->fax = $formData['ffax'];
                        $myProductSupplier->phone = $formData['fphone'];
                        $myProductSupplier->website = $formData['fwebsite'];
                        //Cac thong tin lien quan ngon ngu:    
                        $myProductSupplier->name = $formData['fname'];          
                        $myProductSupplier->seoTitle = $formData['fseotitle'];
                        $myProductSupplier->seoKeyword = $formData['fseokeyword'];
                        $myProductSupplier->seoDescription = $formData['fseodescription'];
                        $myProductSupplier->contents = $formData['fcontents'];
                        //Hinh anh
                        
                        $actionResult=$myProductSupplier->updateData();
                        if($actionResult == Core_ProductSupplier::ERROR_OK)
                        {
                            $success[] = str_replace('###name###', $myProductSupplier->name[$this->registry->langCode], $this->registry->lang['controller']['succUpdate']);
                            $this->registry->me->writelog('ProductSupplieredit', $myProductSupplier->id, array('name' => $myProductSupplier->name[$this->registry->langCode], 'order' => $myProductSupplier->order));
                        
                            $formData['fimage'] = $myProductSupplier->image; 
                            $formData['fsmallImage'] = $myProductSupplier->getSmallImage(); 
                        }
                        else if($actionResult == Core_ProductSupplier::ERROR_UPLOAD_IMAGE)
                        {
                            $error[] = $this->registry->lang['controller']['errEditUpload'];            
                        }
                        else
                        {
                            $error[] = $this->registry->lang['controller']['errEdit'];    
                        }
                    }
                }
                $_SESSION['productsupplierEditToken']=Helper::getSecurityToken();//Tao token moi
            }
            
            $this->registry->smarty->assign(array(    'formData'     => $formData, 
                                                    'redirectUrl'=> $redirectUrl,
                                                    'encoderedirectUrl'=> base64_encode($redirectUrl),
                                                    'error'        => $error,
                                                    'success'    => $success,
                                                    
                                                    ));
            $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
            $this->registry->smarty->assign(array(
                                                    'menu'        => 'productsupplierlist',
                                                    'pageTitle'    => $this->registry->lang['controller']['pageTitle_edit'],
                                                    'contents'             => $contents));
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
   
    //Xoa mot con meo!
    function deleteAction()
    {
        global $langCode;
        $id = (int)$this->registry->router->getArg('id');
        $myProductSupplier = new Core_ProductSupplier($id);
            
        if($myProductSupplier->id > 0)
        {
            
            //tien hanh xoa
            if($myProductSupplier->delete())
            {
                $redirectMsg = str_replace('###name###', $myProductSupplier->name[$langCode], $this->registry->lang['controller']['succDelete']);
                
                $this->registry->me->writelog('ProductSupplierdelete', $myProductSupplier->id, array('name' => $myProductSupplier->name[$langCode]));      
            }
            else
            {
                $redirectMsg = str_replace('###name###', $myProductSupplier->name[$langCode], $this->registry->lang['controller']['errDelete']);
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