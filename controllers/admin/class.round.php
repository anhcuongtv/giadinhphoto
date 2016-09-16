<?php

Class Controller_Admin_Round Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	
	function indexAction() 
	{
		$_SESSION['roundDeleteToken'] = Helper::getSecurityToken();  //for delete link
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'name';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;
					
		$rounds = Core_ContestRound::getRounds($formData, $sortby, $sorttype, '');
        
		//build redirect string
		$paginateUrl = $this->registry->conf['rooturl_admin'].'round/index/';   
		$redirectUrl = $paginateUrl;
		$redirectUrl = base64_encode($redirectUrl);
		
		//count total image ready
		$countReadyPhoto = Core_ContestPhotoReady::getPhotos(array(), '', '', '', true);
		//count the photo in each round to score
		for($i = 0; $i < count($rounds); $i++)
		{
			//tong so hinh trong round
			$rounds[$i]->numberphoto = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $rounds[$i]->id), '', '', '', true);
			
			//tong so hinh chua cham diem
			$rounds[$i]->numberphotounscored = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $rounds[$i]->id, 'funscored' => 1), '', '', '', true);
			
			//tong so hinh da hoan tat
			$rounds[$i]->numberphotofinished = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $rounds[$i]->id, 'fisfinished' => 'YES'), '', '', '', true);
		}			
		$this->registry->smarty->assign(array(	'rounds' 		=> $rounds,
												'redirectUrl'	=> $redirectUrl,
												'countReadyPhoto' => $countReadyPhoto,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'roundlist',
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
				$myRound = new Core_ContestRound();
				$myRound->name = $formData['fname'];
				$myRound->isactive = $formData['fisactive'];
				$myRound->isgiveaward = $formData['fisgiveaward'];
                $serializePoint = array();
                foreach ($formData['section'] as $key=>$value) {
                    $serializePoint[$key] = $value;
                }
				$myRound->passPoint = serialize($serializePoint);
				
				if($myRound->addData())
				{
					$success[] = $this->registry->lang['controller']['succAdd'];
					$this->registry->me->writelog('round_add', $myRound->id, array('name' => $myRound->name));
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
                
			}
		}
		
		$_SESSION['roundAddToken'] = Helper::getSecurityToken();
        $group = Core_ContestPhotoGroup::getList(0, true);
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
                                                'group'         => $group,
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'roundadd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myRound = new Core_ContestRound($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myRound->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			$formData['fisEnableView'] = $myRound->isEnableView;
			$formData['fid'] = $myRound->id;
			$formData['fname'] = $myRound->name;
			$formData['fisactive'] = $myRound->isactive;
			$formData['fisgiveaward'] = $myRound->isgiveaward;
			$formData['fdatecreated'] = $myRound->datecreated;
			$formData['section'] = unserialize($myRound->passPoint);

			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
                 
					$myRound->name = $formData['fname'];
					$myRound->isactive = $formData['fisactive'];
					$myRound->isgiveaward = $formData['fisgiveaward'];
					$myRound->datecreated = $formData['fdatecreated'];
					$myRound->isEnableView =$formData['fisEnableView'];
                    $serializePoint = array();
                    foreach ($formData['section'] as $key=>$value) {
                        $serializePoint[$key] = $value;
                    }
                    $myRound->passPoint = serialize($serializePoint);
                    
					if($myRound->updateData())
					{
						$success[] = $this->registry->lang['controller']['succUpdate'];
						$this->registry->me->writelog('round_edit', $myRound->id, array('name' => $myRound->name));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
                    $formData['section'] = unserialize($myRound->passPoint);
				}
			}

			$_SESSION['roundEditToken'] = Helper::getSecurityToken();
            $group = Core_ContestPhotoGroup::getList(0, true);
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													'group'         => $group
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'round',
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
		$myRound = new Core_ContestRound($id);
			
		if($myRound->id > 0)
		{
			if($_SESSION['roundDeleteToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myRound->delete())
				{
					$redirectMsg = $this->registry->lang['controller']['succDelete'];
					
					$this->registry->me->writelog('round_delete', $myRound->id, array('name' => $myRound->name));  	
				}
				else
				{
					$redirectMsg = $this->registry->lang['controller']['errDelete'];
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
	
	/**
	* Them binding photo va round
	* 
	*/
	function insertphotoAction()
	{
		//maybe long process
		//turn off timeout
		set_time_limit(0);
		
		$id = (int)$this->registry->router->getArg('id');
		$previd = (int)$this->registry->router->getArg('previd');
		$inserttype = $this->registry->router->getArg('inserttype');
		$redirectUrl = $this->getRedirectUrl();
		
		$myRound = new Core_ContestRound($id);
        
		if($myRound->id > 0)
		{
			if($inserttype == 'all')
			{
				//IT'S SIMPLE HERE
				//BUT FOR FIRST ROUND ONLY
				//TO GET READY PHOTO FOR FIRST ROUND
				$photoReadyIdList = Core_ContestPhotoReady::getIdSectionList();
				//INSERT ID LIST TO ROUND
				Core_ContestPhotoReadyRound::addDataFromList($photoReadyIdList, $myRound->id);				
				$redirectMsg = $this->registry->lang['controller']['succInsertFromReadyList'];
			}	
			else
			{
				//IT'S SO COMPLEX PROCESS HERE
				//TO GET QUALIFIED PHOTO
				
				//step 1: check total photo of prev photo
				//tong so hinh trong round
				$prevNumberPhoto = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $previd), '', '', '', true);
                
				//tong so hinh da hoan tat
				$preNumberPhotoFinished = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $previd, 'fisfinished' => 'YES'), '', '', '', true);
                
				//Previous round is not finished
				if($prevNumberPhoto > $preNumberPhotoFinished)//
				{
					$remainNumberPhoto = $prevNumberPhoto - $preNumberPhotoFinished;
					$redirectMsg = str_replace('###number###', $remainNumberPhoto, $this->registry->lang['controller']['errPrevRoundIsNotFinished']);
				}
				else
				{
					$prevRound = new Core_ContestRound($previd);
                    
					if($prevRound->id > 0)
					{
						//lay nhung photo dat tieu chuan vuot diem sang cua round truoc
						$qualifiedPhotos = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $previd, 'fpasspoint' => unserialize($prevRound->passPoint)), '', '', '');
                        
						$photoIdSectionList = array();
						//generate id-section array list
						for($i = 0; $i < count($qualifiedPhotos); $i++)
						{
							$photoIdSectionList[$qualifiedPhotos[$i]->pid] = $qualifiedPhotos[$i]->section;
						}
						
						//INSERT ID LIST TO ROUND
						Core_ContestPhotoReadyRound::addDataFromList($photoIdSectionList, $myRound->id);
						
						$redirectMsg = $this->registry->lang['controller']['succInsertFromPreviousList'];
					}	
					else
					{
						$redirectMsg = $this->registry->lang['controller']['errNotFound'];
					}
				}
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
	
	/**
	* Cap nhat trang thai cua toan bo photo trong 1 round
	* 
	* totalscore, finish...,
	* unscored judger list
	* 
	*/
	function updatestatsAction()
	{
		//maybe long process
		//turn off timeout
		set_time_limit(0);
		
		$id = (int)$this->registry->router->getArg('id');
		$previd = (int)$this->registry->router->getArg('previd');
		$inserttype = $this->registry->router->getArg('inserttype');
		$redirectUrl = $this->getRedirectUrl();
		
		$myRound = new Core_ContestRound($id);
		if($myRound->id > 0)
		{
			///////////////////////////////////////////////////////////////////////////
			//get all judgers, judgers by section
			$judgers = Core_UserJudge::getJudges(array(), '', '', '');
            $allGroup = Core_ContestPhotoGroup::getAllGroupName();
            foreach ($allGroup as $key=>$name) {
                $judgerSection[$key] = array();
            }
			for($i = 0; $i < count($judgers); $i++)
			{
                $groupJudger = explode(",", $judgers[$i]->group);
                foreach ($groupJudger as $gID) {
                    $judgerSection[$gID][] = $judgers[$i]->uid;
                }
			}
			//get all photo from this round
			$roundPhotos = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $myRound->id), '', '', '');
            
			//process each photo            
			for($i = 0; $i < count($roundPhotos); $i++)
			{
				$photoId = $roundPhotos[$i]->pid;
				$photoSection = $roundPhotos[$i]->section;
				
				//GET THE CURRENT PHOTO
				$currentPhoto = new Core_ContestPhotoReady($photoId);
				
				//GET THE LIST OF JUDGER FOR THIS PHOTO
				$photoPointList = Core_ContestPhotoPoint::getPoints(array('frid' => $myRound->id, 'fpid' => $photoId), '', '', '');
                //tong so diem da duoc cham toi thoi diem hien tai
				$markJudgerList = array();
				$totalPoint = 0;
                
				if(!empty($photoPointList))
				{
					for($k =0; $k < count($photoPointList); $k++)
					{
						$totalPoint += $photoPointList[$k]->point;
						$markJudgerList[] = $photoPointList[$k]->judgerid;
					}
				}
                    
                    // $parseSection = explode('-',$currentPhoto->section);                    
                    // if(count($parseSection) > 1)
                    // {   
                    //     if($parseSection[1] == 'c')
                    //     {
                    //         if($currentPhoto->section == 'color-c')
                    //             $currentPhoto->section = 'color'; 
                    //         if($currentPhoto->section == 'landscape-c')
                    //             $currentPhoto->section = 'landscape-c';
                    //          if($currentPhoto->section == 'sport-c')
                    //             $currentPhoto->section = 'sport-c';
                    //          if($currentPhoto->section == 'color-c')
                    //             $currentPhoto->section = 'color';
                    //         else
                    //            $currentPhoto->section = 'colorbest';
                    //     }
                    //     else
                    //     {
                    //         if($currentPhoto->section == 'mono-m')
                    //             $currentPhoto->section = 'mono';
                    //         else
                    //             $currentPhoto->section = 'monobest';
                    //     }  
                    // }
                    // else
                    // {
                    //     $currentPhoto->section = $currentPhoto->section;        
                    // }
				//danh sach nhung judger chua cham diem cho photo o round nay
				$judgerUnscored = array_diff($judgerSection[$currentPhoto->section], $markJudgerList);
				$roundPhotos[$i]->totalScore = $totalPoint;
				if(count($judgerUnscored) == 0)
				{
					$roundPhotos[$i]->isfinished = 1;
					$roundPhotos[$i]->unscoredlist = '';
				}
				else
				{
					$roundPhotos[$i]->unscoredlist = ',' . implode(',', $judgerUnscored) . ',';
				}
				//update
				$roundPhotos[$i]->updateData();
				
				$redirectMsg = $this->registry->lang['controller']['succUpdateStats'];
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
	
	
	/**
	* Export hinh trong 1 round ra file CSV
	* 
	* Co the export hinh theo section
	* 
	*/
	function exportCsvAction()
	{
		set_time_limit(0);
		
		$error 	= array();
		$success 	= array();
		$contents 	= '';
		$formData 	= array();
		$roundid = $this->registry->router->getArg('id');
		$myRound = new Core_ContestRound($roundid);
		$redirectUrl = $this->getRedirectUrl();
		
		if($myRound->id > 0)
		{
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				if($this->exportCsvActionValidator($formData, $error))
				{
					$formData['frid'] = $myRound->id;
                    
					$roundPhotos = Core_ContestPhotoReadyRound::getPhotosFull($formData, '', '', '');
					if(count($roundPhotos) > 0)
					{
                        foreach ($formData['fsection'] as $section) {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => $section), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList[$section][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }

/*
						if(in_array('color-c', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'color-c'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['color-c'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('landscape-c', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'landscape-c'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['landscape-'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('idea-c', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'idea-c'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['idea-'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('sport-c', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'sport-c'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['sport-'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('mono-m', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'mono-m'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['mono-m'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('idea-m', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'idea-m'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['idea-m'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('sport-m', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'sport-m'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['sport-m'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        if(in_array('landscape-m', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'landscape-m'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['landscape-m'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        
                        if(in_array('travel-t', $formData['fsection']))
						{
							$listTmp = Core_UserJudge::getJudges(array('fsection' => 'travel-t'), 'id', 'ASC', '');
							for($i = 0; $i < count($listTmp); $i++)
							{
								$judgerList['travel-t'][$listTmp[$i]->uid] = $listTmp[$i];
							}
						}
                        
						
						if(in_array('dress-t', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'dress-t'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['dress-t'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
                        
                        if(in_array('country-t', $formData['fsection']))
						{
							$listTmp = Core_UserJudge::getJudges(array('fsection' => 'country-t'), 'id', 'ASC', '');
							for($i = 0; $i < count($listTmp); $i++)
							{
								$judgerList['country-t'][$listTmp[$i]->uid] = $listTmp[$i];
							}
						}
						
                        
						if(in_array('transportation-t', $formData['fsection']))
						{
							$listTmp = Core_UserJudge::getJudges(array('fsection' => 'transportation-t'), 'id', 'ASC', '');
							for($i = 0; $i < count($listTmp); $i++)
							{
								$judgerList['transportation-t'][$listTmp[$i]->uid] = $listTmp[$i];
							}
						}
                        
                        if(in_array('nature-n', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'nature-n'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['nature-n'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
						 if(in_array('flower-n', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'flower-n'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['flower-n'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
						
						 if(in_array('bird-n', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'bird-n'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['bird-n'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }
						
						 if(in_array('snow-n', $formData['fsection']))
                        {
                            $listTmp = Core_UserJudge::getJudges(array('fsection' => 'snow-n'), 'id', 'ASC', '');
                            for($i = 0; $i < count($listTmp); $i++)
                            {
                                $judgerList['snow-n'][$listTmp[$i]->uid] = $listTmp[$i];
                            }
                        }*/
						
                        //var_dump($judgerList);
                        //die();
                        
						//truy van de lay danh sach cham diem cua tung hinh
						for($i = 0; $i < count($roundPhotos); $i++)
						{
							//GET THE LIST OF JUDGER FOR THIS PHOTO
							$photoPointList = Core_ContestPhotoPoint::getPoints(array('frid' => $myRound->id, 'fpid' => $roundPhotos[$i]->pid), 'id', '','');
							$roundPhotos[$i]->photoPointList = array();
							for($j = 0; $j < count($photoPointList); $j++)
							{
								if(isset($judgerList[$roundPhotos[$i]->section][$photoPointList[$j]->judgerid]))
								{
									$photoPointList[$j]->judger = $judgerList[$roundPhotos[$i]->section][$photoPointList[$j]->judgerid];
									$roundPhotos[$i]->photoPointList[] = $photoPointList[$j];
								}
							}
						}						
						//var_dump($roundPhotos);
                        //die();						
						$this->registry->smarty->assign(array(	'roundPhotos' 		=> $roundPhotos,
																'myRound'			=> $myRound,
																'judgerList'		=> $judgerList,
															));
						$filename = Helper::codau2khongdau($myRound->name, true).'_Export_' . implode('_', $formData['fsection'])  .'_' . date('Y-m-d-H-i') . '.csv';
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
            $group = Core_ContestPhotoGroup::getList(0, true);
            $data = Helper::displaySelectionPhotoGroupForUser($group, true);
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'myRound'		=> $myRound,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													'data'          => $data,
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'exportcsv.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'roundlist',
													'pageTitle'	=> $this->registry->lang['controller']['pageTitle_exportcsv'],
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
	
	####################################################################################################
	####################################################################################################
	####################################################################################################
	
		
	private function addActionValidator($formData, &$error)
	{
		$pass = true;
		if($_SESSION['roundAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNamRequired'];
			$pass = false;
		}
		
		if($formData['fisactive'] != '0' && $formData['fisactive'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsactiveInvalid'];
			$pass = false;
		}

        foreach ($formData['section'] as $key=>$index) {
            if ($index <= 0) {
                $error[] = $this->registry->lang['controller']['errPasspointInvalid'].' '.Core_ContestPhotoGroup::getDataSectionName($key);
                $pass = false;
            }
        }
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['roundEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if(strlen($formData['fname']) == 0)
		{
			$error[] = $this->registry->lang['controller']['errNamRequired'];
			$pass = false;
		}
		
		if($formData['fisactive'] != '0' && $formData['fisactive'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsactiveInvalid'];
			$pass = false;
		}

        foreach ($formData['section'] as $key=>$index) {
            if ($index <= 0) {
                $error[] = $this->registry->lang['controller']['errPasspointInvalid'].' '.Core_ContestPhotoGroup::getDataSectionName($key);
                $pass = false;
            }
        }
				
		return $pass;
	}
	
	
	private function exportCsvActionValidator($formData, &$error)
	{
		$pass = true;
        $groups = Core_ContestPhotoGroup::getAllPhotoGroup();
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
                if(!in_array($sec, $groups)){
					$error[] = $this->registry->lang['controller']['errSectionInvalid'];
					$pass = false;	
					break;	
				}
			}		
		}
		
								
		return $pass;
	}
		
}
function listphotoAction(){
				$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;

				$rid 	= $this->registry->router->getArg('id');

		$listImage = Core_ContestPhotoReadyRound::getPhotosBackend($rid, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage,false);
		$total = Core_ContestPhotoReadyRound::getPhotosBackend($rid,'',true);
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
		//get latest account
		//$photos = Core_ContestPhotoReady::getPhotos($formData, $sortby, $sorttype,);
		
		$this->registry->smarty->assign(array(	
												'redirectUrl'	=> $redirectUrl,
												'total' 		=> $total,
												'totalPage'		=> $totalPage,
												'photos'		=> $listImage,
												'countReadyPhoto' => $countReadyPhoto,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'listphoto.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'roundlist',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}

?>