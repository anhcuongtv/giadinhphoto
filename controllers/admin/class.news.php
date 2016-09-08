<?php

Class Controller_Admin_News Extends Controller_Admin_Base 
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
        $parentidFilter   = (int)($this->registry->router->getArg('parentid'));//parentid cua con meo 
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
            if($_SESSION['newsBulkToken']==$_POST['ftoken'])
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
                            $myNews = new Core_News($id);
                            
                            if($myNews->id > 0)
                            {
                                //tien hanh xoa
                                if($myNews->delete())
                                {
                                    $deletedCats[] = $myNews->name[$langCode];
                                    $this->registry->me->writelog('newsdelete', $myNews->id, array('name' => $myNews->name[$langCode]));      
                                }
                                else
                                    $cannotDeletedCats[] = $myNews->name[$langCode];
                            }
                            else
                                $cannotDeletedCats[] = $myNews->name[$langCode];
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
        $_SESSION['newsBulkToken']=Helper::getSecurityToken();//Tao token moi
                
        $paginateUrl = $this->registry->conf['rooturl_admin'].'news/index/';  
        //Sap xep:                                                                                                         
        if($idFilter > 0)
        {
            $paginateUrl .= 'id/'.$idFilter . '/';
            $formData['fid'] = $idFilter;
            $formData['search'] = 'id';
        }
        if($parentidFilter > 0)
        {
            $paginateUrl .= 'parentid/'.$parentidFilter . '/';
            $formData['fparentid'] = $parentidFilter;
            $formData['search'] = 'parentid';
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
        $total = Core_News::getNews($formData, $sortby, $sorttype, '', true);    
        $totalPage = ceil($total/$this->recordPerPage);
        $curPage = $page;
        
            
        //get latest account. $cats: Nhung con meo :)
        $newsList = Core_News::getNews($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
        //build redirect string
        $redirectUrl = $paginateUrl;
        if($curPage > 1)
            $redirectUrl .= 'page/' . $curPage;
            
        
        $redirectUrl = base64_encode($redirectUrl);
        
                
        $this->registry->smarty->assign(array(  'newsList'     => $newsList,
                                                'formData'        => $formData,
                                                'categories'	=> Core_NewsCategory::getFullCategories(),   
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
        
        $this->registry->smarty->assign(array(    'menu'        => 'newslist',
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
            if($_SESSION['newsAddToken']==$_POST['ftoken'])
            {
                 $formData = array_merge($formData, $_POST);//Luu cac du lieu trong form nhap lieu vao bien $formData
                
                if($this->addActionValidator($formData, $error))//Kiem tra du lieu nhap
                {
                    $myNews = new Core_News();//Con meo moi
                    $myNews->enable = (int)$formData['fenable']==1?1:0;
                     //Neu nguoi dung nhap SeoUrl thi xu li dau cua chuoi nguoi dung nhap
                    //Truong hop nguoi dung khong nhap thi chung ta lay idtext de thay the!!!!!
                    if(strlen($formData['fseourl']) > 0)
                        $myNews->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                    else
                        $myNews->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname'][$this->registry->langCode]), true);
                        
                    $myNews->name = $formData['fname'];
                    $myNews->contents = $formData['fcontents'];
                    $myNews->summary = $formData['fsummary'];
                    $myNews->tags = $formData['ftags'];
                   
                    $myNews->seoTitle = $formData['fseotitle'];
                    $myNews->seoKeyword = $formData['fseokeyword'];
                    $myNews->seoDescription = $formData['fseodescription'];
                    
                    $myNews->categoryList = $formData['fcategory'];
                    
                    //Hinh anh
                    $actionResult = $myNews->addData();
                    
                    
                    if($actionResult == Core_News::ERROR_OK)
                    {
                        $success[] = str_replace('###name###', $myNews->name[$this->registry->langCode], $this->registry->lang['controller']['succAdd']);
                        $this->registry->me->writelog('newsadd', $myNews->id, array('name' => $myNews->name[$this->registry->langCode]));
                        $formData = array('fcategory' => $formData['fcategory']);      
                    }
                    else if($actionResult == Core_News::ERROR_UPLOAD_IMAGE)
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
         $_SESSION['newsAddToken']=Helper::getSecurityToken();//Tao token moi
        
        $this->registry->smarty->assign(array(    'formData'         => $formData,
                                                'categories'	=> Core_NewsCategory::getFullCategories(),
                                                'redirectUrl'    => $this->getRedirectUrl(),
                                                'error'            => $error,
                                                'success'        => $success,
                                                
                                                ));
        $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
        $this->registry->smarty->assign(array(
                                                'menu'        => 'newsadd',
                                                'pageTitle'    => $this->registry->lang['controller']['pageTitle_add'],
                                                'contents'             => $contents));
        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
    }
    
    //Cap nhat thong tin mot con meo
    function editAction()
    {                                                 
        $id = (int)$this->registry->router->getArg('id');
        $myNews = new Core_News($id);
        $redirectUrl = $this->getRedirectUrl();
        if($myNews->id > 0)
        {
            
            $error         = array();
            $success     = array();
            $contents     = '';
            $formData     = array('fcategory' => array());
            
            $formData['fbulkid'] = array();
            $formData['fcategory'] = $myNews->categoryList;
            $formData['fid'] = $myNews->id;
            $formData['fparentid'] = $myNews->parentid;
            $formData['fenable'] = $myNews->enable;             
            $formData['fseourl'] = $myNews->seoUrl;
            
            $formData['fname'] = $myNews->name;
            $formData['fsummary'] = $myNews->summary;
            $formData['fseotitle'] = $myNews->seoTitle;
            $formData['fseokeyword'] = $myNews->seoKeyword;
            $formData['fseodescription'] = $myNews->seoDescription;
            $formData['fcontents'] = $myNews->contents;                                                 
            $formData['ftags'] = $myNews->tags;                                                 
            
            $formData['fimage'] = $myNews->image;
            $formData['fsmallImage'] = $myNews->smallImage;
            if(!empty($_POST['fsubmit']))
            {
                
                if($_SESSION['newsEditToken']==$_POST['ftoken'])
                {
                    $formData = array_merge($formData, $_POST);
                    if($this->editActionValidator($formData, $error))
                    {
                        //xoa hinh neu chon
                        if(isset($_POST['fdeleteimage']))
                        {
                            $myNews->deleteImage();
                            $formData['fimage'] = $formData['fsmallImage'] = '';
                        }
                        
                        //Cac thong tin khong ngon ngu:
                        $myNews->enable = (int)$formData['fenable']==1?1:0;
                        if(strlen($formData['fseourl']) > 0)
                            $myNews->seoUrl = Helper::codau2khongdau($formData['fseourl'], true);
                        else
                            $myNews->seoUrl = Helper::codau2khongdau(strip_tags($formData['fname'][$this->registry->langCode]), true);
                        //Cac thong tin lien quan ngon ngu:    
                        $myNews->name = $formData['fname'];          
                        $myNews->summary = $formData['fsummary'];          
                        $myNews->seoTitle = $formData['fseotitle'];
                        $myNews->seoKeyword = $formData['fseokeyword'];
                        $myNews->seoDescription = $formData['fseodescription'];
                        $myNews->contents = $formData['fcontents'];
                        $myNews->tags = $formData['ftags'];
                        //Hinh anh
                        $myNews->categoryList = $formData['fcategory'];
                        
                        $actionResult=$myNews->updateData();
                        if($actionResult == Core_News::ERROR_OK)
                        {
                            $success[] = str_replace('###name###', $myNews->name[$this->registry->langCode], $this->registry->lang['controller']['succUpdate']);
                            $this->registry->me->writelog('newsedit', $myNews->id, array('name' => $myNews->name[$this->registry->langCode]));
                        
                            $formData['fimage'] = $myNews->image; 
                            $formData['fsmallImage'] = $myNews->getSmallImage(); 
                        }
                        else if($actionResult == Core_News::ERROR_UPLOAD_IMAGE)
                        {
                            $error[] = $this->registry->lang['controller']['errEditUpload'];            
                        }
                        else
                        {
                            $error[] = $this->registry->lang['controller']['errEdit'];    
                        }
                    }
                }
                $_SESSION['newsEditToken']=Helper::getSecurityToken();//Tao token moi
            }
            
            $this->registry->smarty->assign(array(    'formData'     => $formData, 
                                                    'categories'	=> Core_NewsCategory::getFullCategories(),
                                                    'redirectUrl'=> $redirectUrl,
                                                    'encoderedirectUrl'=> base64_encode($redirectUrl),
                                                    'error'        => $error,
                                                    'success'    => $success,
                                                    
                                                    ));
            $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
            $this->registry->smarty->assign(array(
                                                    'menu'        => 'newslist',
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
        $myNews = new Core_News($id);
            
        if($myNews->id > 0)
        {
            
            //tien hanh xoa
            if($myNews->delete())
            {
                $redirectMsg = str_replace('###name###', $myNews->name[$langCode], $this->registry->lang['controller']['succDelete']);
                
                $this->registry->me->writelog('newsdelete', $myNews->id, array('name' => $myNews->name[$langCode]));      
            }
            else
            {
                $redirectMsg = str_replace('###name###', $myNews->name[$langCode], $this->registry->lang['controller']['errDelete']);
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
         //Kiem tra name cua tin tuc
        if(strlen($formData['fname']['vn']) == 0 || strlen($formData['fname']['en']) ==0) 
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