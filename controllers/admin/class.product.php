<?php

Class Controller_Admin_Product Extends Controller_Admin_Base 
{
    private $recordPerPage = 30;
    
    //Hien thi danh sach
    function indexAction()
    {
        global $langCode;
        $error             = array();
        $success         = array();
        $warning         = array();
        
                       
        $paginateUrl = $this->registry->conf['rooturl_admin'].'product/index/';  
       
        
        //tim tong so
        $total = Core_Product::getProducts($formData, $sortby, $sorttype, '', true);    
        $totalPage = ceil($total/$this->recordPerPage);
        $curPage = $page;
        
            
        //get latest account. $cats: Nhung con meo :)
        $products = Core_Product::getProducts($formData, '', '', '', false);
        //build redirect string
        $redirectUrl = $paginateUrl;
        if($curPage > 1)
            $redirectUrl .= 'page/' . $curPage;
       
        
        $redirectUrl = base64_encode($redirectUrl);
        
                
        $this->registry->smarty->assign(array(  'products'     => $products,
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
        
        $this->registry->smarty->assign(array(    'menu'        => 'productlist',
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
        $formData     = array('fcategory' => array());//Bien chua du lieu trong form
        
        if(!empty($_POST['fsubmit']))//Truong hop da nhan nut submit
        {
            if($_SESSION['productAddToken']==$_POST['ftoken'])
            {
                 $formData = array_merge($formData, $_POST);//Luu cac du lieu trong form nhap lieu vao bien $formData
                 $formData['fprice'] = $this->registry->currency->refinePriceString($formData['fprice']);
	                
	             //calculate currency exchange
	             $formData['fprice'] = $this->registry->currency->convertCurrency($formData['fprice']);
                
                if($this->addActionValidator($formData, $error))//Kiem tra du lieu nhap
                {
                    $myProduct = new Core_Product();//Con meo moi
                     //Neu nguoi dung nhap SeoUrl thi xu li dau cua chuoi nguoi dung nhap
                    $myProduct->name = $formData['fname'];
                    $myProduct->price = $formData['fprice'];
                        
                    $actionResult = $myProduct->addData();
                    
                    if($actionResult == Core_Product::ERROR_OK)
                    {
                        $success[] = str_replace('###name###', $myProduct->name, $this->registry->lang['controller']['succAdd']);
                        $this->registry->me->writelog('productadd', $myProduct->id, array('name' => $myProduct->name));
                        $formData = array('fcategory' => $formData['fcategory']);      
                    }
                    else
                    {
                        $error[] = $this->registry->lang['controller']['errAdd'];    
                    }
                }
            }                                      
           
                
        }
         $_SESSION['productAddToken']=Helper::getSecurityToken();//Tao token moi
        
        $this->registry->smarty->assign(array(	'formData'         => $formData,
                                                'redirectUrl'    => $this->getRedirectUrl(),
                                                'error'            => $error,
                                                'success'        => $success,
                                                
                                                ));
        $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
        $this->registry->smarty->assign(array(
                                                'menu'        => 'productadd',
                                                'pageTitle'    => $this->registry->lang['controller']['pageTitle_add'],
                                                'contents'             => $contents));
        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
    }
    
    //Cap nhat thong tin
    function editAction()
    {                                                 
        $id = (int)$this->registry->router->getArg('id');
        $myProduct = new Core_Product($id);
        $redirectUrl = $this->getRedirectUrl();
        if($myProduct->id > 0)
        {
            
            $error         = array();
            $success     = array();
            $contents     = '';
            $formData     = array();
            
            $formData['fid'] = $myProduct->id;
            $formData['fname'] = $myProduct->name;             
            $formData['fprice'] = $myProduct->price;             
            
            if(!empty($_POST['fsubmit']))
            {
                
                if($_SESSION['productEditToken']==$_POST['ftoken'])
                {
                    $formData = array_merge($formData, $_POST);
                    
                    $formData['fprice'] = $this->registry->currency->refinePriceString($formData['fprice']);
                 	
                 	//calculate currency exchange
                 	$formData['fprice'] = $this->registry->currency->convertCurrency($formData['fprice']);
                 	
                    if($this->editActionValidator($formData, $error))
                    {
                        
	                    $myProduct->price = $formData['fprice'];
                        
                        $actionResult = $myProduct->updateData();
                        if($actionResult == Core_Product::ERROR_OK)
                        {
                            $success[] = str_replace('###name###', $myProduct->name, $this->registry->lang['controller']['succUpdate']);
                            $this->registry->me->writelog('productedit', $myProduct->id, array('name' => $myProduct->name));
                        
                        }
                        else if($actionResult == Core_Product::ERROR_UPLOAD_IMAGE)
                        {
                            $error[] = $this->registry->lang['controller']['errEditUpload'];            
                        }
                        else
                        {
                            $error[] = $this->registry->lang['controller']['errEdit'];    
                        }
                        
                    }
                }
                $_SESSION['productEditToken']=Helper::getSecurityToken();//Tao token moi
            }
            
            //refresh new price
            $myProduct->updateRealPrice();
            
            $this->registry->smarty->assign(array(    'formData'     => $formData, 
            											'myProduct'	=> $myProduct,
	                                                'redirectUrl'=> $redirectUrl,
                                                    'encoderedirectUrl'=> base64_encode($redirectUrl),
                                                    'error'        => $error,
                                                    'success'    => $success,
                                                    
                                                    ));
            $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
            $this->registry->smarty->assign(array(
                                                    'menu'        => 'productlist',
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
   
    //Xoa mot record
    function deleteAction()
    {
        global $langCode;
        $id = (int)$this->registry->router->getArg('id');
        $myProduct = new Core_Product($id);
            
        if($myProduct->id > 0)
        {
            
            //tien hanh xoa
            if($myProduct->delete())
            {
                $redirectMsg = str_replace('###name###', $myProduct->name[$langCode], $this->registry->lang['controller']['succDelete']);
                
                $this->registry->me->writelog('productdelete', $myProduct->id, array('name' => $myProduct->name[$langCode]));      
            }
            else
            {
                $redirectMsg = str_replace('###name###', $myProduct->name[$langCode], $this->registry->lang['controller']['errDelete']);
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
                       
        return $pass;
    }
    //Kiem tra du lieu nhap trong form cap nhat
    private function editActionValidator($formData, &$error)
    {
        $pass = true;
      
                       
        return $pass;
    }
}

?>