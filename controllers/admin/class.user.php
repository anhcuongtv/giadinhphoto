<?php

Class Controller_Admin_User Extends Controller_Admin_Base
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
						$myUser = new Core_User($id);
						
						if($myUser->id > 0)
						{
							//tien hanh xoa
							if($myUser->delete())
							{
								$deletedItems[] = $myUser->username;
								$this->registry->me->writelog('userdelete', $myUser->id, array('username' => $myUser->username, 'email' => $myUser->email));  	
							}
							else
								$cannotDeletedItems[] = $myUser->username;
						}
						else
							$cannotDeletedItems[] = $myUser->username;
					}
					
					if(count($deletedItems) > 0)
						$success[] = str_replace('###username###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
					
					if(count($cannotDeletedItems) > 0)
						$error[] = str_replace('###username###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
				}
				else
				{
					//bulk action not select, show error
					$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
				}
			}
		}
		
		
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'user/index/';      
		
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
			else if($searchKeywordIn == 'email')
			{
				$paginateUrl .= 'searchin/email/';
			}
			else if($searchKeywordIn == 'fullname')
			{
				$paginateUrl .= 'searchin/fullname/';
			}
			$formData['fkeyword'] = $formData['fkeywordFilter'] = $keywordFilter;
			$formData['fsearchin'] = $formData['fsearchKeywordIn'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
		
		//tim tong so
		$total = Core_User::getUsers($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest account
		$users = Core_User::getUsers($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage);
		
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'users' 		=> $users,
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
		
		$this->registry->smarty->assign(array(	'menu'		=> 'userlist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	public function exportAction()
	{
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fselectfield' => array());
		
		$formData['userfields'] = array(
			'u.u_id' ,
			'u_username' ,
			'up_email',
			'up_fullname',
			'up_honor' ,
			'up_gender',
			'up_birthday' ,
			'up_phone1' ,
			'up_phone2',
			'up_address' ,
			'up_address2' ,
			'up_zipcode' ,
			'up_city' ,
			'up_region' ,
			'up_country' ,
			'up_psamembership',
			'up_photoclub' ,
			'up_paid_color' ,
			'up_paid_mono',
			'up_paid_nature' ,
			'up_datecreated' ,
		);
		
		//begin export
		if(!empty($_POST['fsubmit']))
		{
			$formData = array_merge($formData, $_POST);
			
			//check conditional
			if(empty($formData['fselectfield']))
			{
				$error[] = 'Please select a field to export';
			}
			else
			{
				$querySelect = implode(',', $formData['fselectfield']);
				
				if(trim($formData['fwhere']) != '')
				{
					$queryWhere = "\n" . 'WHERE ' . trim($formData['fwhere']);
				}
				else
					$queryWhere = '';
					
				$queryOrder = "\n" . 'ORDER BY ' . $formData['forderfield'] . ' ' . $formData['forderby'];
				
				if(trim($formData['flimit']) != '')
				{
					$queryLimit = "\n" . 'LIMIT ' . trim($formData['flimit']);
				}
				else
					$queryLimit = '';
					
				
				$formData['fcompletequery'] = 'SELECT ' . $querySelect . ' FROM ' . TABLE_PREFIX . 'ac_user u' . "\n" . 'INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id' . $queryWhere . $queryOrder . $queryLimit;
			}
		}
				
		$this->registry->smarty->assign(array(	'formData'		=> $formData,
												'success'		=> $success,
												'error'			=> $error,
												'warning'		=> $warning,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'export.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'userexport',
												'pageTitle'	=> 'Export User',
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	public function deleteAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myUser = new Core_User($id);
		
			
		if($myUser->id > 0)
		{
			if(Helper::checkSecurityToken())
			{
				//tien hanh xoa
				if($myUser->delete())
				{
					$redirectMsg = str_replace('###username###', $myUser->username, $this->registry->lang['controller']['succDelete']);
					
					$this->registry->me->writelog('userdelete', $myUser->id, array('username' => $myUser->username, 'email' => $myUser->email));  	
				}
				else
				{
					$redirectMsg = str_replace('###username###', $myUser->username, $this->registry->lang['controller']['errDelete']);
				}
			}
			else
				$redirectMsg = $this->registry->lang['controllergroup']['errFormTokenInvalid'];   
			
			
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
	
	function addAction()
    {
        $error     = array();
        $success     = array();
        $contents     = '';
        $formData     = array();
        
        if(!empty($_POST['fsubmit']))
        {                     
			if($_SESSION['userAddToken']==$_POST['ftoken'])//kiem tra token
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->addActionValidator($formData, $error))//kiem tra du lieu nhap
				{
					$myUser = new Core_User();
					$myUser->groupid = $formData['fgroupid'];
					$myUser->username = $formData['fusername'];
					$myUser->email = $formData['femail'];
					$myUser->password = viephpHashing::hash($formData['fpassword']);
					$myUser->firstname = $formData['ffirstname'];
					$myUser->lastname = $formData['flastname'];
					$myUser->fullname = $formData['ffirstname'] . ' ' . $formData['flastname'];
					$myUser->honor = $formData['fhonor'];
					$myUser->address = $formData['faddress'];
					$myUser->address2 = $formData['faddress2'];
					$myUser->zipcode = $formData['fzipcode'];
					$myUser->city = $formData['fcity'];
					$myUser->region = $formData['fregion'];
					$myUser->country = $formData['fcountry'];
					$myUser->phone1 = $formData['fphone1'];
					$myUser->phone2 = $formData['fphone2'];
					$myUser->psamembership = $formData['fpsamembership'];
					$myUser->photoclub = $formData['fphotoclub'];
					                                                             
					if($myUser->addData()>0)
					{
						$success[] = str_replace('###username###', $myUser->username, $this->registry->lang['controller']['succAdd']);
						$this->registry->me->writelog('useradd', $myUser->id, array('name' => $myUser->username));
						$formData = array('fgroupid' => $formData['fgroupid']);      
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errAdd'];    
					}
				}
			}
        }
        
        $_SESSION['userAddToken'] = Helper::getSecurityToken();  //them token moi
        
        
        $this->registry->smarty->assign(array(  'formData'         => $formData,
                                                'redirectUrl'    => $this->getRedirectUrl(),
                                                'userGroups'	=> Core_User::getUserGroups(),
                                                'groupPriorityList' => $GLOBALS['groupPriority'],
                                                'error'            => $error,
                                                'success'        => $success,
                                                
                                                ));
        $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
        
        $this->registry->smarty->assign(array(    'menu'        => 'useradd',
                                                'pageTitle'    => $this->registry->lang['controller']['pageTitle_add'],
                                                'contents'     => $contents));
        
        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
    }
    
    function editAction()
    {                         
        $id = (int)$this->registry->router->getArg('id');
        $myUser = new Core_User($id);
        $redirectUrl = $this->getRedirectUrl();
        if($myUser->id > 0)
        {
            //check priviledge priority
            //Yeu cau de edit:
            // 1. Hoac la admin
            // 2. Hoac la edit ban than, dung cho moderator, judge...
            // 3. Hoac la co priority number < priority number cua user duoc edit
            if($this->registry->me->groupid == GROUPID_ADMIN || ($this->registry->me->id == $myUser->id) || ($this->registry->me->groupPriority < $myUser->groupPriority) )
            {
            	$error         = array();
	            $success     = array();
	            $contents     = '';
	            $formData     = array();
	            
	            $formData['fgroupid'] = $myUser->groupid;
	            $formData['femail'] = $myUser->email;
	            $formData['fusername'] = $myUser->username;
	            $formData['ffirstname'] = $myUser->firstname;
	            $formData['flastname'] = $myUser->lastname;
	            $formData['fhonor'] = $myUser->honor;
	            $formData['faddress'] = $myUser->address;
	            $formData['faddress2'] = $myUser->address2;
	            $formData['fzipcode'] = $myUser->zipcode;
	            $formData['fcity'] = $myUser->city;
	            $formData['fregion'] = $myUser->region;
	            $formData['fcountry'] = $myUser->country;
	            $formData['fphone1'] = $myUser->phone1;
	            $formData['fphone2'] = $myUser->phone2;
	            $formData['fpsamembership'] = $myUser->psamembership;
	            $formData['fphotoclub'] = $myUser->photoclub;
	            $formData['fpaidcolor'] = $myUser->paidColor;
	            $formData['fpaidmono'] = $myUser->paidMono;
	            $formData['fpaidnature'] = $myUser->paidNature;
		$formData['fpaidtravel'] = $myUser->paidTravel;
	            
	            
	            if(!empty($_POST['fsubmit']))
	            {
	                if($_SESSION['userEditToken']==$_POST['ftoken'])
	                {
	                    $formData = array_merge($formData, $_POST);
	                    
	                    $formData['fpaidcolor'] = isset($_POST['fpaidcolor'])?1:0;
	                    $formData['fpaidmono'] = isset($_POST['fpaidmono'])?1:0;
	                    $formData['fpaidnature'] = isset($_POST['fpaidnature'])?1:0;
			$formData['fpaidtravel'] = isset($_POST['fpaidtravel'])?1:0;			
							
	                    if($this->editActionValidator($formData, $error))//kiem tra du lieu nhap
	                    {
                       		$myUser->groupid = $formData['fgroupid'];
							$myUser->firstname = $formData['ffirstname'];
							$myUser->lastname = $formData['flastname'];
							$myUser->fullname = $formData['ffirstname'] . ' ' . $formData['flastname'];
							$myUser->honor = $formData['fhonor'];
							$myUser->address = $formData['faddress'];
							$myUser->address2 = $formData['faddress2'];
							$myUser->zipcode = $formData['fzipcode'];
							$myUser->city = $formData['fcity'];
							$myUser->region = $formData['fregion'];
							$myUser->country = $formData['fcountry'];
							$myUser->phone1 = $formData['fphone1'];
							$myUser->phone2 = $formData['fphone2'];
							$myUser->psamembership = $formData['fpsamembership'];
							$myUser->photoclub = $formData['fphotoclub'];
							$myUser->paidColor = $formData['fpaidcolor'];
							$myUser->paidMono = $formData['fpaidmono'];
							$myUser->paidNature = $formData['fpaidnature'];
							$myUser->paidTravel = $formData['fpaidtravel'];
	                        
	                        if($myUser->updateData()>0)
	                        {
	                           $success[] = str_replace('###username###', $myUser->username, $this->registry->lang['controller']['succEdit']);
	                           $this->registry->me->writelog('useredit', $myUser->id, array('name' => $myUser->username));
	                            
	                        }                       
	                        else
	                        {
	                            $error[] = $this->registry->lang['controller']['errEdit'];    
	                        }
	                    }
	                }
	            }
	            $_SESSION['userEditToken']=Helper::getSecurityToken();//Tao token moi  
	            $this->registry->smarty->assign(array(   'formData'     => $formData, 
            											'myUser'	=> $myUser,
	                                                    'redirectUrl'=> $redirectUrl,
	                                                    'encoderedirectUrl'=> base64_encode($redirectUrl),
	                                                    'userGroups'	=> Core_User::getUserGroups(),
	                                                    'groupPriorityList' => $GLOBALS['groupPriority'],
	                                                    'error'        => $error,
	                                                    'success'    => $success,
	                                                    
	                                                    ));
	            $contents .= $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
	            $this->registry->smarty->assign(array(
	                                                    'menu'        => 'userlist',
	                                                    'pageTitle'    => $this->registry->lang['controller']['pageTitle_edit'],
	                                                    'contents'             => $contents));
	            $this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
			}
            else
            {
            	$redirectMsg = $this->registry->lang['global']['notpermissiontitle'];
	            $this->registry->smarty->assign(array('redirect' => $redirectUrl,
	                                                    'redirectMsg' => $redirectMsg,
	                                                    ));
	            $this->registry->smarty->display('redirect.tpl');
			}
            
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

	function resetpassAction()
	{
		$id = (int)$this->registry->router->getArg('id');
        $myUser = new Core_User($id);
        $redirectUrl = $this->getRedirectUrl();
        
        if($myUser->id > 0)
        {
            //check priviledge priority
            //Yeu cau de edit:
            // 1. Hoac la admin
            // 2. Hoac la edit ban than, dung cho moderator, judge...
            // 3. Hoac la co priority number < priority number cua user duoc edit
            if($this->registry->me->groupid == GROUPID_ADMIN || ($this->registry->me->id == $myUser->id) || ($this->registry->me->groupPriority < $myUser->groupPriority) )
            {
            	$error 		= array();
				$success 	= array();
				$contents 	= '';
				$formData 	= array();
				
				 
				 srand((double)microtime()*1000000);
	   	 		 $newpass = rand(100000, 999999);
	   	 		 $newpassEncoded = viephpHashing::hash($newpass);
	   			 
	   			 if($myUser->resetpass($newpassEncoded))
	   			 {
	   		 		 //send mail
	   		 		 $this->registry->smarty->assign(array('newpass' => $newpass,
	   		 	 											'myUser'	=> $myUser));
	   		 		 $mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'resetpass.tpl');
	   		 		 
	   		 		 $sender=  new SendMail($this->registry,
											$myUser->email,
											$myUser->fullname,
											str_replace('{USERNAME}', $myUser->username, $this->registry->setting['mail']['subjectAdminResetpassUser']),
											$mailContents,
											$this->registry->setting['mail']['fromEmail'],
											$this->registry->setting['mail']['fromName']
											);
	   		 		 if($sender->Send())
	   		 		 {
	   		 	 		  $redirectMsg = str_replace('###email###', $myUser->email, $this->registry->lang['controller']['succResetpass']);        
					 }
					 else
					 {
				 		 $redirectMsg = str_replace('###email###', $myUser->email, $this->registry->lang['controller']['errResetpassSendMail']);    
					 }
				 }
				 else
				 {
			 		 $redirectMsg = $this->registry->lang['controller']['errResetpass'];
				 }
				 
				 $redirectUrl = $this->registry->conf['rooturl_admin'] . 'user/edit/id/' . $myUser->id;
	   		 			
			}
            else
            {
            	$redirectMsg = $this->registry->lang['global']['notpermissiontitle'];
			}
            
        }
        else
        {
            $redirectMsg = $this->registry->lang['controller']['errNotFound'];
        }

		
		 $this->registry->smarty->assign(array('redirect' => $redirectUrl,
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
        
       	if(!in_array($formData['fgroupid'], array(GROUPID_MODERATOR, GROUPID_JUDGE, GROUPID_MEMBER)))
        {
        	$error[] = $this->registry->lang['controller']['errGroupRequired'];
            $pass = false;
		}
        
        
        //kiem tra email co dung dinh dang hay khong    :ValidatedEmail
        if(!Helper::ValidatedEmail($formData['femail']))
        {
            $error[] = $this->registry->lang['controller']['errEmailInvalid'];
            $pass = false;
        }
        else
        {
            //kiem tra co trung username hay khong
             if(Core_User::getByEmail($formData['femail'])->id>0)
            {
                $error[] = $this->registry->lang['controller']['errEmailExisted'];
                $pass = false;
            }
        }
                
        if(strlen($formData['fusername']) == 0)
        {
            $error[] = $this->registry->lang['controller']['errUsernameRequired'];
            $pass = false;
        }
        else
        {
            //kiem tra co trung username hay khong
             if(Core_User::getByUsername($formData['fusername'])->id>0)
            {
                $error[] = $this->registry->lang['controller']['errUsernameExisted'];
                $pass = false;
            }
        }
             
        //kiem tra password
        if($formData['fpassword'] == '')
        {
        	$error[] = $this->registry->lang['controller']['errPasswordRequired'];
            $pass = false;
		}
		elseif($formData['fpassword']!=$formData['fpassword2'])//nhap lai password khong dung nhu password dau
        {
            $error[] = $this->registry->lang['controller']['errPasswordRetype'];
            $pass = false;
        }
        
        
        
        return $pass;
    }
     //khong cap nhat username
    private function editActionValidator($formData, &$error)
    {
        $pass = true;
      
      	if($formData['fgroupid'] == 0)
        {
            $error[] = $this->registry->lang['controller']['errGroupRequired'];
            $pass = false;
        }   
                
        return $pass;
    }
	
	
	
}
