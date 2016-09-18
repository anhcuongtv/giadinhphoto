<?php

Class Controller_Site_MemberArea Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		if($this->registry->me->id == 0)
		{
			header('location: ' . $this->registry->conf['rooturl'] . 'login.html');
			exit();
		}
        
		$error = $success = $formData = array();
		//Calculate the current pack location (VN & others)
		$formData['fpaylocation'] = Core_Product::getPayLocation();
		$productPackList = Core_Product::getProducts($formData, '', '','');
		//submit section
		if(isset($_POST['fsubmitsection']))
		{
			$formData = array_merge($formData, $_POST);
			$packId = 0;
			if($formData['fpaymentsection'] > 0)
			{
                //set the pack ID, forward to payment to pay
                $_SESSION['paymentEnterPack'] = $formData['fpaymentsection'];
                header('location: ' . $this->registry->conf['rooturl'] . 'checkout.html');
                exit();
            }
			else
			{   
				$errorPayment[] = $this->registry->lang['controller']['errPaymentSectionEmpty'];
			}
		}

		$tab = $_GET['tab'];
		if($tab != 'payment' && $tab != 'upload')
			$tab = 'info'; //default enable tab is profile information

        $group = Core_ContestPhotoGroup::getList(0, true);
        $sections = Core_ContestPhotoGroup::getAllSection();
        $data = Helper::displaySelectionPhotoGroupForUser($group, true, $_POST['fsection']);
        $paymentOptionList = Helper::displayPaymentOptionList($sections['detail']);
        $paymentPaidList = Helper::displayPaidPaymentList($sections['detail'], $this->registry->me->paidSection);

        $paymentOptionListNew = Core_NewProduct::getList(' p.pStatus = 1 ');

		//load paymentmethod
		$myPaymentPage = new Core_Page(0, $this->registry->langCode);
		$myPaymentPage->getDataByText('paymentmethod');
        $groups = Core_ContestPhotoGroup::getAllPhotoGroup();
		if(!empty($_POST['fsubmitphoto']))
		{
            $groups = Core_ContestPhotoGroup::getAllPhotoGroup();
			$formData = array_merge($formData, $_POST);
			if($this->addPhotoValidator($formData, $error, $groups))
			{
				$formData['ffilesizeinbyte'] = $_FILES['fimage']['size'];
				$imageInfo = getimagesize($_FILES['fimage']['tmp_name']);
				
				$myPhoto = new Core_ContestPhoto();
				$myPhoto->uid = (int)$this->registry->me->id;
				$myPhoto->section = (string)$formData['fsection'];
				$myPhoto->name = strip_tags($formData['fname']);
				$myPhoto->description = strip_tags($formData['fdescription']);
				$myPhoto->filesizeinbyte = (int)$formData['ffilesizeinbyte'];
				$myPhoto->resolution = $imageInfo[0] . 'x' . $imageInfo[1];
				$myPhoto->enable = 1;
				$myPhoto->displaymode = 1;
				$myPhoto->cancomment = 1; 
				
				$addResult = $myPhoto->addData();
                
				if($addResult == Core_ContestPhoto::ERROR_OK)
				{
					//upload ok
					$success[] = $this->registry->lang['controller']['succUploadPhoto'];
					$formData = array('fsection' => $formData['fsection']);
					//add new information
					$information[] = str_replace('###rooturl###', $this->registry->conf['rooturl'], $this->registry->lang['controller']['infoAfterUploadPhoto']);
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errUploadPhoto'];         
				}
			}
			$tab = 'upload';	
		}
		//Nhan ket qua tra ve tu remote server da upload
		//neu co error thi tuc la upload khong thanh cong
		//neu ko co error thi tien hanh xu  ly binh thuong
		if($_GET['submitreturn'] == 1)
		{
			if($_GET['error'] != '')
			{
				switch($_GET['error'])
				{
					case 'empty' : $error[] = $this->registry->lang['controller']['errFileRequire']; break;
					case 'type': case 'size': $error[] = $this->registry->lang['controller']['photoSubmitHelp']; break;
					case 'section': $error[] = $this->registry->lang['controller']['errSectionInvalid']; break;
					case 'name': $error[] = $this->registry->lang['controller']['errNameRequire']; break;
                    case 'exlimitsub': $error[] = str_replace('###MAX###', $this->registry->setting['contestphoto']['maxPhotoPerSubSection'], $this->registry->lang['controller']['errSectionPhotoExceed']); break;
                    case 'exlimitsec': $error[] = str_replace('###MAX###', $this->registry->setting['contestphoto']['maxPhotoPerSection'], $this->registry->lang['controller']['errSectionPhotoExceed']); break ;
					default: $error[] = $this->registry->lang['controller']['errUploadPhoto'];
				}
			}
			else
			{
				//everything ok, check token before add
				if(!empty($_POST['fsubmitphotoremote']))
				{
					$formData = array_merge($formData, $_POST);
                    $groups = Core_ContestPhotoGroup::getAllPhotoGroup();
					if($this->addPhotoReturnValidator($formData, $error, $groups)==true)
					{
                        //get detail section
                        $sectionDetail = Core_ContestPhotoGroup::getDataSectionName($formData['fsection'], true);
                        //check if user already upload for photo group
                        $dataUpload = false;
                        if ($sectionDetail['isGroup']) {
                            $dataUpload = Core_ContestPhotoChild::checkSectionUpload($formData['fsection']);
                        }
                        if (!$dataUpload) {
                            $myPhoto = new Core_ContestPhoto();
                            $myPhoto->uid = (int)$this->registry->me->id;
                            $myPhoto->section = (string)$formData['fsection'];
                            $myPhoto->name = strip_tags($formData['fname']);
                            $myPhoto->description = strip_tags($formData['fdescription']);
                            $myPhoto->filesizeinbyte = (int)$formData['ffilesizeinbyte'];
                            $myPhoto->resolution = $formData['fwidth'] . 'x' . $formData['fheight'];
                            $myPhoto->enable = 1;
                            $myPhoto->displaymode = 1;
                            $myPhoto->cancomment = 1;
                            $myPhoto->fileserver = $formData['ffileserver'];
                            $myPhoto->filepath = $formData['ffilepath'];
                            $myPhoto->filethumb1 = $formData['ffilethumb1'];
                            $myPhoto->filethumb2 = $formData['ffilethumb2'];
                            $detailGroup = new Core_ContestPhotoGroup($formData['fsection']);
                            $myPhoto->parentSection = $detailGroup->parent;
                            $myPhoto->isGroup = $sectionDetail['isGroup'];
                            $addResult = $myPhoto->addData();

                            $myPhotoChild = new Core_ContestPhotoChild();
                            $myPhotoChild->uid = (int)$this->registry->me->id;
                            $myPhotoChild->section = (string)$formData['fsection'];
                            $myPhotoChild->name = strip_tags($formData['fname']);
                            $myPhotoChild->description = strip_tags($formData['fdescription']);
                            $myPhotoChild->filesizeinbyte = (int)$formData['ffilesizeinbyte'];
                            $myPhotoChild->resolution = $formData['fwidth'] . 'x' . $formData['fheight'];
                            $myPhotoChild->enable = 1;
                            $myPhotoChild->displaymode = 1;
                            $myPhotoChild->cancomment = 1;
                            $myPhotoChild->fileserver = $formData['ffileserver'];
                            $myPhotoChild->filepath = $formData['ffilepath'];
                            $myPhotoChild->filethumb1 = $formData['ffilethumb1'];
                            $myPhotoChild->filethumb2 = $formData['ffilethumb2'];
                            $myPhotoChild->parentSection = $detailGroup->parent;
                            $myPhotoChild->parentID = $myPhoto->id;
                            $addResult = $myPhotoChild->addData();
                        } else {
                            $myPhotoChild = new Core_ContestPhotoChild();
                            $myPhotoChild->uid = (int)$this->registry->me->id;
                            $myPhotoChild->section = (string)$formData['fsection'];
                            $myPhotoChild->name = strip_tags($formData['fname']);
                            $myPhotoChild->description = strip_tags($formData['fdescription']);
                            $myPhotoChild->filesizeinbyte = (int)$formData['ffilesizeinbyte'];
                            $myPhotoChild->resolution = $formData['fwidth'] . 'x' . $formData['fheight'];
                            $myPhotoChild->enable = 1;
                            $myPhotoChild->displaymode = 1;
                            $myPhotoChild->cancomment = 1;
                            $myPhotoChild->fileserver = $formData['ffileserver'];
                            $myPhotoChild->filepath = $formData['ffilepath'];
                            $myPhotoChild->filethumb1 = $formData['ffilethumb1'];
                            $myPhotoChild->filethumb2 = $formData['ffilethumb2'];
                            $detailGroup = new Core_ContestPhotoGroup($formData['fsection']);
                            $myPhotoChild->parentSection = $detailGroup->parent;
                            $myPhotoChild->parentID = $dataUpload['p_parentID'];
                            $addResult = $myPhotoChild->addData();
                        }
                        
						if($addResult == Core_ContestPhoto::ERROR_OK)
						{
							//upload ok
							$success[] = $this->registry->lang['controller']['succUploadPhoto'];
							$formData = array('fsection' => $formData['fsection']);
							
							//add new information
							$information[] = str_replace('###rooturl###', $this->registry->conf['rooturl'], $this->registry->lang['controller']['infoAfterUploadPhoto']);
						}
						else
						{
							$error[] = $this->registry->lang['controller']['errUploadPhoto'];         
						}
					}
				}
			}
		}
		
		$myPhotoList = Core_ContestPhoto::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');
        $myPhotoGroupList = Core_ContestPhoto::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '', false, true);
		//$newPhotoList = Core_ContestPhoto::getPhotos(array(), '', '', 12);
		
		$_SESSION['addPhotoToken'] = Helper::getSecurityToken();
		///////////////////////////////
		// FOR REMOTE UPLOAD, PROCESS NEED IMAGE FOR REMOTE FORM ACTION
		if($this->registry->langCode == 'vn')
		{
			$formData['fremoteupload'] = 'vn';
			$formData['fremoteactionurl'] = $this->registry->setting['extra']['uploadimageserver']['vn'];
			$formData['fremoteuid'] = $this->registry->me->id;
			$formData['fremotesessionid'] = Helper::getSessionId();
			$formData['fremotetoken'] = $this->calculateSecurityToken($this->registry->me->id, Helper::getSessionId());
		}

		$this->registry->smarty->assign(
											array('error' => $error,
												'errorPayment'	=> $errorPayment,
												'success'	=> $success,
												'information'	=> $information,
												'productPackList'	=> $productPackList,
												'myPhotoList'	=> $myPhotoList,
                                                'myPhotoGroupList'	=> $myPhotoGroupList,
												//'newPhotoList'	=> $newPhotoList,
                                                'paymentOptionListNew' => $paymentOptionListNew,
												'myPaymentPage'	=> $myPaymentPage,
												'formData'	=> $formData,
												'tab'	=> $tab,
                                                'paymentOptionList' => $paymentOptionList,
                                                'paymentPaidList' => $paymentPaidList,
                                                'totalOptionList' => count($sections['detail']),
                                                'country' => $this->registry->me->country,
                                                'data'  => $data
										)
		);
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
			)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');
	} 
	
	function photodeleteAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myPhoto = new Core_ContestPhoto($id);
		$success = false;
		if($myPhoto->id > 0)
		{
			if($myPhoto->uid == $this->registry->me->id)
			{
				//begin to delete
                if ($myPhoto->isGroup) {

                }

				if($myPhoto->delete())
				{
					$redirectMsg = $this->registry->lang['controller']['succPhotoDelete'];	
					$success = true;
				}
				else
					$redirectMsg = $this->registry->lang['controller']['errPhotoDelete'];	
			}
			else
			{
				$redirectMsg = $this->registry->lang['controller']['errPhotoDeletePermission'];
			}
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errPhotoNotFound'];
		}
		
		//neu photo nay dang nam o remote server, bang chung la hien tai dang chay server us
		//nhung photo duoc danh dau fileserver = vn
		//tien hanh redirect sang server vn de delete image
		//roi return
		if($success && $myPhoto->fileserver == 'vn')
		{
			$token = $this->calculateSecurityToken($this->registry->me->id, Helper::getSessionId(), $myPhoto->fileserver . $myPhoto->filepath . $myPhoto->filethumb1 . $myPhoto->filethumb2);
			
			$url = $this->registry->setting['extra']['uploadimageserver']['vn'] . '?delete=1&uid=' . $this->registry->me->id . '&sid=' . Helper::getSessionId() . '&fileserver=' . $myPhoto->fileserver . '&filepath='.base64_encode($myPhoto->filepath)  . '&filethumb1='.base64_encode($myPhoto->filethumb1)  . '&filethumb2='.base64_encode($myPhoto->filethumb2) . '&token=' . $token ;
			header('location: ' . $url);
			exit();
		}
		
		$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html#myphoto';
		$this->registry->smarty->assign(array('redirect' => $redirectUrl,
												'redirectMsg' => $redirectMsg,
												));
		$this->registry->smarty->display('redirect.tpl');
	}
	
	function photoeditAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myPhoto = new Core_ContestPhoto($id);
		$isRedirect = true;
		
		$error = $success = $formData = array();
		if($myPhoto->id > 0)
		{
            $group = Core_ContestPhotoGroup::getList(0, true);
            //$sections = Core_ContestPhotoGroup::getAllSection();
            $data = Helper::displaySelectionPhotoGroupForUser($group, true, $myPhoto->section);
			if($myPhoto->uid == $this->registry->me->id)
			{
				$isRedirect = false;
				$formData['fsection'] = $myPhoto->section;
				$formData['fname'] = $myPhoto->name;
				$formData['fdescription'] = $myPhoto->description;
				
				if(isset($_POST['fsubmit']))
				{
					$formData = array_merge($formData, $_POST);
					if($this->editPhotoValidator($formData, $error, $myPhoto))
					{
						$myPhoto->section = (string)$formData['fsection'];
						$myPhoto->name = strip_tags($formData['fname']);
						$myPhoto->description = strip_tags($formData['fdescription']);
						$editResult = $myPhoto->updateData();
						if($editResult == Core_ContestPhoto::ERROR_OK)
						{
							$redirectMsg = $this->registry->lang['controller']['succPhotoEdit'];	
							$isRedirect = true;
						}
						else
						{
							$error[] =  $this->registry->lang['controller']['errPhotoEdit'];         
						}
					}
				}
				
				$_SESSION['editPhotoToken'] = Helper::getSecurityToken();
				if($isRedirect == false)
				{
					//show edit form
					$this->registry->smarty->assign(array('error' => $error,
													'formData' => $formData,
													'myPhoto' => $myPhoto,
                                                    'data' => $data
													));
					$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'editphoto.tpl');
					$this->registry->smarty->assign(
						array('contents' => $contents,
						)
					);
					$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 	
				}
			}
			else
			{
				$redirectMsg = $this->registry->lang['controller']['errPhotoDeletePermission'];
			}
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errPhotoNotFound'];
		}
		
		if($isRedirect)
		{
			$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html#myphoto';
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => $redirectMsg,
													));
			$this->registry->smarty->display('redirect.tpl');
		}	
	}

    function photogroupeditAction()
    {
        $id = (int)$this->registry->router->getArg('id');
        $myPhoto = new Core_ContestPhotoChild($id);
        $isRedirect = true;

        $error = $success = $formData = array();
        if($myPhoto->id > 0)
        {
            $group = Core_ContestPhotoGroup::getList(0, true);
            //$sections = Core_ContestPhotoGroup::getAllSection();
            $data = Helper::displaySelectionPhotoGroupForUser($group, true, $myPhoto->section);
            if($myPhoto->uid == $this->registry->me->id)
            {
                $isRedirect = false;
                $formData['fsection'] = $myPhoto->section;
                $formData['fname'] = $myPhoto->name;
                $formData['fdescription'] = $myPhoto->description;

                if(isset($_POST['fsubmit']))
                {
                    $formData = array_merge($formData, $_POST);
                    if($this->editPhotoValidator($formData, $error, $myPhoto))
                    {
                        $myPhoto->section = (string)$formData['fsection'];
                        $myPhoto->name = strip_tags($formData['fname']);
                        $myPhoto->description = strip_tags($formData['fdescription']);
                        $editResult = $myPhoto->updateData();
                        if($editResult == Core_ContestPhoto::ERROR_OK)
                        {
                            $redirectMsg = $this->registry->lang['controller']['succPhotoEdit'];
                            $isRedirect = true;
                        }
                        else
                        {
                            $error[] =  $this->registry->lang['controller']['errPhotoEdit'];
                        }
                    }
                }

                $_SESSION['editPhotoToken'] = Helper::getSecurityToken();
                if($isRedirect == false)
                {
                    //show edit form
                    $this->registry->smarty->assign(array('error' => $error,
                        'formData' => $formData,
                        'myPhoto' => $myPhoto,
                        'data' => $data
                    ));
                    $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'editphoto.tpl');
                    $this->registry->smarty->assign(
                        array('contents' => $contents,
                        )
                    );
                    $this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');
                }
            }
            else
            {
                $redirectMsg = $this->registry->lang['controller']['errPhotoDeletePermission'];
            }
        }
        else
        {
            $redirectMsg = $this->registry->lang['controller']['errPhotoNotFound'];
        }

        if($isRedirect)
        {
            $redirectUrl = $this->registry->conf['rooturl'] . 'site/memberarea/photogroup/id/'.$id;
            $this->registry->smarty->assign(array('redirect' => $redirectUrl,
                'redirectMsg' => $redirectMsg,
            ));
            $this->registry->smarty->display('redirect.tpl');
        }
    }


    function photogroupAction()
    {
        $id = (int)$this->registry->router->getArg('id');
        $myPhotoList = Core_ContestPhotoChild::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');

        $this->registry->smarty->assign(
            array(
                'myPhotoList'	=> $myPhotoList,
            )
        );

        $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'group.tpl');

        $this->registry->smarty->assign(
            array('contents' => $contents,
            )
        );

        $this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');
    }
	
	#############################################################
	#############################################################
	#############################################################
	
	private function addPhotoValidator($formData, &$error, $section = '')
	{
		$pass = true;
		//$section = $this->sectionValue();
		//check form token

        if($formData['ftoken'] != $_SESSION['addPhotoToken'])
		{
			$pass = false;
			$error[] = $this->registry->lang['controllergroup']['securityTokenInvalid'];	
		}
		if(!in_array($formData['fsection'], $section))
		{
			$error[] = $this->registry->lang['controller']['errSectionInvalid'];
			$pass = false;	
		}
		else
		{
			//truy van de kiem tra user nay da upload bao nhieu photo vao section dang chon
			$myPhotoSectionCount = Core_ContestPhoto::getPhotos(array('fsection' => $formData['fsection'], 'fuserid' => $this->registry->me->id), '', '', '', true);

			// lấy giá trị đầu tiên, và cho phép được 4 hình
            $limit = Core_ContestPhotoGroup::getLimitForSection($formData['fsection']);

            if($myPhotoSectionCount >= $limit)
            {
                //exceed limit
                $error[] = str_replace('###MAX###', $limit, $this->registry->lang['controller']['errSectionPhotoExceed']);
                $pass = false;
            }

		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequire'];
			$pass = false;	
		}
		else
		{
			//check existed name
			$myPhotoList = Core_ContestPhoto::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');
			foreach($myPhotoList as $myPhoto)
			{
				if($myPhoto->name == $formData['fname'])
				{
					$error[] = $this->registry->lang['controller']['errNameExisted'];
					$pass = false;
					break;
				}
			}
		}
		
		if(strlen($_FILES['fimage']['name']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errFileRequire'];
			$pass = false;	
		}
		
		return $pass;
	}
	
	
	
	private function addPhotoReturnValidator($formData, &$error, $section)
	{   
		$pass = true;
		//check form token
		if($formData['ftoken'] != $this->calculateSecurityToken($this->registry->me->id, Helper::getSessionId(), $formData['ffileserver'] . $formData['ffilepath'] . $formData['ffilethumb1'] . $formData['ffilethumb2'] . $formData['ffilesizeinbyte'] . $formData['fwidth'] . $formData['fheight']))
		{
			$pass = false;
			$error[] = $this->registry->lang['controllergroup']['securityTokenInvalid'];	
		}
        //get detail section
        $sectionDetail = Core_ContestPhotoGroup::getDataSectionName($formData['fsection'], true);
		if(
			!in_array($formData['fsection'], $section)
		)
		{
			$error[] = $this->registry->lang['controller']['errSectionInvalid'];
			$pass = false;	
		}
		else
		{
			//truy van de kiem tra user nay da upload bao nhieu photo vao section dang chon
            $limit = Core_ContestPhotoGroup::getLimitForSection($formData['fsection']);
            if ($sectionDetail['isGroup']) {
                $myPhotoSectionCount = Core_ContestPhotoChild::getPhotos(array('fsection' => $formData['fsection'], 'fuserid' => $this->registry->me->id), '', '', '', true);
            } else {
                $myPhotoSectionCount = Core_ContestPhoto::getPhotos(array('fsection' => $formData['fsection'], 'fuserid' => $this->registry->me->id), '', '', '', true);
            }

            //CondiTion For Image In One SubSection
            if($myPhotoSectionCount >= $limit)
            {
                //exceed limit
                $error[] = str_replace('###MAX###', $limit, $this->registry->lang['controller']['errSectionPhotoExceed']);
                $pass = false;
            }

		}
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequire'];
			$pass = false;	
		}
		else
		{
			//check existed name
            if ($sectionDetail['isGroup']) {
                $myPhotoList = Core_ContestPhotoChild::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');
            } else {
                $myPhotoList = Core_ContestPhoto::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');
            }

			foreach($myPhotoList as $myPhoto)
			{
				if($myPhoto->name == $formData['fname'])
				{
					$error[] = $this->registry->lang['controller']['errNameExisted'];
					$pass = false;
					break;
				}
			}
		}
		return $pass;
	}
	
	
	private function editPhotoValidator($formData, &$error, $editPhoto)
	{
		$pass = true;
        $groups = Core_ContestPhotoGroup::getAllPhotoGroup();
		//check form token
		if($formData['ftoken'] != $_SESSION['editPhotoToken'])
		{
			$pass = false;
			$error[] = $this->registry->lang['controllergroup']['securityTokenInvalid'];	
		}
		
		if(
			!in_array($formData['fsection'], $groups)
		)
		{
			$error[] = $this->registry->lang['controller']['errSectionInvalid'];
			$pass = false;	
		}
		elseif($editPhoto->section != $formData['fsection'])
		{
			//truy van de kiem tra user nay da upload bao nhieu photo vao section dang chon
			$myPhotoSectionCount = Core_ContestPhoto::getPhotos(array('fsection' => $formData['fsection'], 'fuserid' => $this->registry->me->id), '', '', '', true);
            $limit = Core_ContestPhotoGroup::getLimitForSection($formData['fsection']);

            if($myPhotoSectionCount >= $limit)
            {
                //exceed limit
                $error[] = str_replace('###MAX###', $limit, $this->registry->lang['controller']['errSectionPhotoExceed']);
                $pass = false;
            }
		}

		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNameRequire'];
			$pass = false;	
		}
		else
		{
			//check existed name
			$myPhotoList = Core_ContestPhoto::getPhotos(array('fuserid' => $this->registry->me->id), '', '', '');
			foreach($myPhotoList as $myPhoto)
			{
				if($myPhoto->name == $formData['fname'] && $myPhoto->id != $editPhoto->id)
				{
					$error[] = $this->registry->lang['controller']['errNameExisted'];
					$pass = false;
					break;
				}
			}
		}
		
		return $pass;
	}
	
	/**
	* Thuan toan tuong tu nhu phia server se nhan request, de check tinh hop le cua request
	* 
	* @param mixed $uid
	* @param mixed $sessionid
	*/
	private function calculateSecurityToken($uid, $sessionid, $morestring = '')
	{
		return md5($uid . 'vdt234234sdfsf3234234' . $sessionid . 'c234234234hk' . $morestring);
	}
}

?>