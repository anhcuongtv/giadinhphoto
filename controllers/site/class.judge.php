<?php

Class Controller_Site_Judge Extends Controller_Core_Base 
{
	
	function indexAction() 
	{
		//kiem tra xem user hien tai co quyen judge khong
		$myJudger = new Core_UserJudge($this->registry->me->id);
		if($myJudger->uid > 0)
		{
			//GET AVAILABLE SECTION FOR THIS USER    
			$sectionList = array();
			if($myJudger->isColor)
                $sectionList['color-c'] = 'Color » Open Color';
            if($myJudger->isColorBestPortrait)
				$sectionList['landscape-c'] = 'Color » Best Portrait free';
			if($myJudger->isColorBestIdea)
				$sectionList['idea-c'] = 'Color »Best idea free';
           	if($myJudger->isColorBestAction)
				$sectionList['sport-c'] = 'Color »Best Action free';
            if($myJudger->isMono)
                $sectionList['mono-m'] = 'Mono » Open Mono';
			if($myJudger->isMonoBestPortrait)
				$sectionList['landscape-m'] = 'Mono »Best Portrait free';
			if($myJudger->isMonoBestAction)
				$sectionList['sport-m'] = 'Mono »Best Action free';
			if($myJudger->isMonoCreative)
				$sectionList['idea-m'] = 'Mono »Best Creative free';
            if($myJudger->isNature)
                $sectionList['nature-n'] = 'Nature » Open Nature';
            if($myJudger->isNatureBestBird)
                $sectionList['bird-n'] = 'Nature » Best Bird free'; 
            if($myJudger->isNatureBestSnow)
                $sectionList['snow-n'] = 'Nature » Best Snow free';  
            if($myJudger->isNatureBestFlower)
                $sectionList['flower-n'] = 'Nature » Best Flower free';  
            if($myJudger->isTravel)
                $sectionList['travel-t'] = 'Travel » Open Travel';
            if($myJudger->isTravelTransportation)
                $sectionList['transportation-t'] = 'Travel » Best Transportation free';
            if($myJudger->isTravelTraditional)
                $sectionList['dress-t'] = 'Travel » Best Traditional Dress free';
            if($myJudger->isTravelCountry)
                $sectionList['country-t'] = 'Travel » Best Country free';

			if(empty($sectionList))
			{
				$error[] = $this->registry->lang['controller']['errSectionEmpty'];
			}
			else
			{
				if(isset($_GET['success']))
				{
					$success[] = $this->registry->lang['controller']['succSave'];
				}
				//SET CURRENT SECTION FOR NEXT REQUEST AND CURRENT REQUEST
				if(isset($_GET['fsection']) && isset($sectionList[$_GET['fsection']]))
					$currentSection = $_GET['fsection'];                    
				elseif(isset($_SESSION['fsection']) && isset($sectionList[$_SESSION['fsection']]))
					$currentSection = $_SESSION['fsection'];
				else
					$currentSection = key($sectionList);                
				
				//save for next request
				$_SESSION['fsection'] = $currentSection;
				//GET THE CURRENT ROUND
				$roundList = Core_ContestRound::getRounds(array('fisactive' => 1), 'name', 'ASC', 1);
				$myRound = $roundList[0];
                if($myRound == NULL)
                {
                    $redirectUrl = $this->registry->conf['rooturl'];
                    $this->registry->smarty->assign(array('redirect' => $redirectUrl,
                                                                            'redirectMsg' => $this->registry->lang['controller']['errCurrentPhotoNotFound'],
                                                                            ));
                    $this->registry->smarty->display('redirect.tpl');
                    exit();
                }                
				//GET THE JUDGERS OF THIS SECTION
				$judgerList = Core_UserJudge::getJudges(array('fsection' => $currentSection), 'id', 'ASC', '');
				//COUNT TOTAL IMAGE READY FOR THIS SECTION
				$totalPhoto = Core_ContestPhotoReady::getPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id), '', '', '', true);
                //COUNT JUDGED PHOTO, dem so so foto da dc cham
                $totalMarkedPhoto = Core_ContestPhotoReady::getMarkedPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id, 'fpointnull' => '1', 'fjudgerid' => $this->registry->me->id), '', '', '', true);
                
                //GET CURRENT PHOTO
				$currentPhoto = new Core_ContestPhotoReady();                
				
				if(isset($_GET['id']))
				{
					$currentPhoto->getData($_GET['id']);
                    
				}
                
				//current photo is not set
				if($currentPhoto->id == 0)
				{   
                
					//GET THE FIRST UN-MARK PHOTO(Tim photo dau tien chua dc cham)
					//$unmarkPhotos = Core_ContestPhotoReady::getUnmarkedPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id, 'fjudgerid' => $this->registry->me->id), 'id', 'ASC', 1);
					//die('In COntroler Judge');
                    //Trung Core
                    $findphotolist = Core_ContestPhotoReady::findListImage(array('fsection' => $currentSection, 'fround' =>$myRound->id));
                    $findphotomark = Core_ContestPhotoReady::findPhotoMark($this->registry->me->id,$myRound->id);
                    
                    $unmarkPhotos = array_diff($findphotolist,$findphotomark);
                    //end Trung Core
                    if(count($unmarkPhotos) > 0)
					{
						$currentPhoto->getData(reset($unmarkPhotos));                        	
					}
					else
					{   
						//all photos are marked. Get the first photo ready
						$tmpPhotoList = Core_ContestPhotoReady::getPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id), 'id', 'ASC', 1);
                        
                        //var_dump($tmpPhotoList);
						if(count($tmpPhotoList) > 0)
						{
							$currentPhoto = $tmpPhotoList[0];
                           
						}
					}
				}
				
                
				//check current photo existed
				if($currentPhoto->id == 0)
				{
					$error[] = $this->registry->lang['controller']['errCurrentPhotoNotFound'];   
				}
				else
				{   
					//get the next 4 photo
					$nextPhotoList = Core_ContestPhotoReady::getPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id, 'fgreaterthan' => $currentPhoto->id), 'id', 'ASC', 4);  
					$prevPhotoList = Core_ContestPhotoReady::getPhotos(array('fsection' => $currentSection, 'froundid' => $myRound->id, 'flessthan' => $currentPhoto->id), 'id', 'DESC', 4);
                    if(count($prevPhotoList) > 0)
					{
						$prevId = $prevPhotoList[0]->id;
					}
					$prevPhotoList = array_reverse($prevPhotoList);
					
					//GET THE LIST OF JUDGER FOR THIS PHOTO
					$photoPointList = Core_ContestPhotoPoint::getPoints(array('frid' => $myRound->id, 'fpid' => $currentPhoto->id), 'id', '', 100);
					
					//thong tin cham diem cua judger dang xem
					$currentJudgerPoint = new Core_ContestPhotoPoint();
					
					//danh sach ID cua cac judger da cham cho photo nay
					$markJudgerList = array();
					
					//tong so diem da duoc cham toi thoi diem hien tai
					$totalPoint = 0;
					$avgPoint = 0;
					if(!empty($photoPointList))
					{
						for($i =0; $i < count($photoPointList); $i++)
						{
							$totalPoint += $photoPointList[$i]->point;
							$markJudgerList[] = $photoPointList[$i]->judgerid;
							if($photoPointList[$i]->judgerid == $this->registry->me->id)
							{
								$currentJudgerPoint = $photoPointList[$i];
							}
						}
					}
					//CHECK CURRENT ROUND AWARD
					$awardList = array();
					$myPhotoAwards = array();
					if($myRound->isgiveaward)
					{
						//get all award for current section
						$awardList = Core_ContestAward::getAwards(array('fsection' => $currentSection, 'fisactive' => 1), 'name', 'ASC', '');
						
						//get all award of this judger for this photo of this round
						$myPhotoAwards = Core_ContestPhotoAward::getPhotoAwards(array('fpid' => $currentPhoto->id, 'frid' => $myRound->id, 'fjid' => $myJudger->uid), 'id', 'DESC', '');
					    
                    }
					
					
					//xu ly luu diem
					if(isset($_POST['fsubmit']))
					{
						$formData = $_POST;
						$formData['frid'] = $myRound->id;
						$formData['fpid'] = $currentPhoto->id;
						
						if($this->addValidator($formData, $error) && $_SESSION['addPointToken'] == $formData['ftoken'])
						{
							if($currentJudgerPoint->id > 0)
							{
								//judger nay da cham diem hinh nay (o round nay roi)
								//chi can cap nhat thong tin
								$oldPoint = $currentJudgerPoint->point;
								$currentJudgerPoint->modifyhistory = $currentJudgerPoint->modifyhistory . ',' . $currentJudgerPoint->point;
								$currentJudgerPoint->point = $formData['fpoint'];
								if($oldPoint == $formData['fpoint'] || $currentJudgerPoint->updateData())
								{
									if(count($nextPhotoList) > 0)
									{
										$nextId = $nextPhotoList[0]->id;
									}
									else
									{
										$nextId = $currentPhoto->id;
									}
									header('location: ' . $this->registry->conf['rooturl'] . 'judge.html?id='.$nextId.'&success=1');
									//redirect to next image
									/*
									$redirectUrl = $this->registry->conf['rooturl'] . 'judge.html?id=' . $currentPhoto->id;
		
									$this->registry->smarty->assign(array('redirect' => $redirectUrl,
																			'redirectMsg' => $this->registry->lang['controller']['succUpdate'],
																			));
									$this->registry->smarty->display('redirect.tpl');   
									exit();*/   	
									
								}
								else
								{
									$error[] = $this->registry->lang['controller']['errUpdate'];
								}
							}		
							else
							{
								//chua cham, tien hanh them thong tin
								$currentJudgerPoint->pid = $currentPhoto->id;
								$currentJudgerPoint->rid = $myRound->id;
								$currentJudgerPoint->point = $formData['fpoint'];
								$currentJudgerPoint->judgerid = $this->registry->me->id;
								if($currentJudgerPoint->addData())
								{
									if(count($nextPhotoList) > 0)
									{
										$nextId = $nextPhotoList[0]->id;
									}
									else
									{
										$nextId = $currentPhoto->id;
									}
									header('location: ' . $this->registry->conf['rooturl'] . 'judge.html?id='.$nextId.'&success=1');
									
									/*
									$redirectUrl = $this->registry->conf['rooturl'] . 'judge.html?id=' . $currentPhoto->id;
		
									$this->registry->smarty->assign(array('redirect' => $redirectUrl,
																			'redirectMsg' => $this->registry->lang['controller']['succSave'],
																			));
									$this->registry->smarty->display('redirect.tpl'); 
									exit();
									*/     	
								}
								else
								{
									$error[] = $this->registry->lang['controller']['errSave'];
								}
							}
						}
					}
					
					//xu ly luu award
					if(isset($_POST['fsubmitaward']))
					{
						$formData = $_POST;
						
						if($this->validateAwardAdd($formData, $error, $awardList, $myPhotoAwards))
						{
							//begin to add
							$myContestPhotoAward = new Core_ContestPhotoAward();
							$myContestPhotoAward->pid = $currentPhoto->id;	
							$myContestPhotoAward->aid = $formData['faward'];	
							$myContestPhotoAward->rid = $myRound->id;	
							$myContestPhotoAward->jid = $myJudger->uid;
							if($myContestPhotoAward->addData())
							{
								$success[] = $this->registry->lang['controller']['succSaveAward'];
								
								//recalculate my awards			
								$myPhotoAwards = Core_ContestPhotoAward::getPhotoAwards(array('fpid' => $currentPhoto->id, 'frid' => $myRound->id, 'fjid' => $myJudger->uid), 'id', 'DESC', '');
							}
							else
							{
								$error[] = $this->registry->lang['controller']['errSaveAward'];
							}
						}	
					}
					
					if(isset($_GET['delaward']))
					{
						$delawardid = (int)$_GET['delaward'];
						$myDeletePhotoAward = new Core_ContestPhotoAward($delawardid);
						if($myDeletePhotoAward->pid == $currentPhoto->id && $myDeletePhotoAward->rid == $myRound->id && $myDeletePhotoAward->jid == $myJudger->uid)
						{
							if($myDeletePhotoAward->delete())
							{
								$success[] = $this->registry->lang['controller']['succDeleteAward'];	
								//recalculate my awards			
								$myPhotoAwards = Core_ContestPhotoAward::getPhotoAwards(array('fpid' => $currentPhoto->id, 'frid' => $myRound->id, 'fjid' => $myJudger->uid), 'id', 'DESC', '');
							}
							else
							{
								$error[] = $this->registry->lang['controller']['errDeleteAward'];	
							}
						}
						else
						{
							$error[] = $this->registry->lang['controller']['errInvalidAward'];	
						}	
					}
					
					$_SESSION['addPointToken'] = Helper::getSecurityToken();
				}
				
				
				
			}
            
			$this->registry->smarty->assign(array(	'success' => $success,
													'error' => $error,
													'formData' => $formData,
													'sectionList' => $sectionList ,
													'currentSection' => $currentSection,
													'totalPhoto' => $totalPhoto,
													'totalMarkedPhoto' => $totalMarkedPhoto,
													'remainPhoto' => $totalPhoto - $totalMarkedPhoto,
													'myRound' => $myRound,
													'judgerList' => $judgerList,
													'currentPhoto' => $currentPhoto,
													'nextPhotoList' => $nextPhotoList,
													'prevPhotoList' => $prevPhotoList,
													'prevId' => $prevId,
													'markJudgerList' => $markJudgerList,
													'currentJudgerPoint' => $currentJudgerPoint,
													'totalPoint' => $totalPoint,
													'awardList'	=> $awardList,
													'myPhotoAwards' => $myPhotoAwards,
												));
					
			$this->registry->smarty->display($this->registry->smartyControllerContainer.'index.tpl'); 	
		}
		else
		{   
			$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html';
		
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => $this->registry->lang['controller']['errNotJudger'],
													));
			$this->registry->smarty->display('redirect.tpl');
		}
				
		
			
		
	} 
	
	########################################################################
	########################################################################
	########################################################################
	
	function addValidator($formData, &$error)
	{
		$pass = true;
		
		//check valid point
		if($formData['fpoint'] < 1 || $formData['fpoint'] > 5)
		{
			$error[] = $this->registry->lang['controller']['errInvalidPoint'];
			$pass = false;
		}
		
		return $pass;
	}
	
	private function validateAwardAdd($formData, &$error, $awardList, $myPhotoAwards)
	{
		$pass = true;
		
		//check valid award
		$validAward = false;
		for($i = 0; $i < count($awardList); $i++)
		{
			if($formData['faward'] == $awardList[$i]->id)
			{
				$validAward = true;
				break;
			}	
		}
		if(!$validAward)
		{
			$error[] = $this->registry->lang['controller']['errInvalidAward'];
			$pass = false;
		}
		
		//check existed award for this photo
		for($i = 0; $i < count($myPhotoAwards); $i++)
		{
			if($myPhotoAwards[$i]->aid == $formData['faward'])
			{
				$error[] = $this->registry->lang['controller']['errExistedAward'];
				$pass = false;	
			}
		}
		
		
		return $pass;
	}
	
	
}

?>
