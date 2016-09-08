<?php

Class Controller_Admin_Judger Extends Controller_Admin_Base 
{
	private $recordPerPage = 30;
	
	function indexAction() 
	{
		$_SESSION['judgerDeleteToken'] = Helper::getSecurityToken();  //for delete link
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'id';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'ASC';
		$formData['sorttype'] = $sorttype;
					
		//get latest records
		$judgers = Core_UserJudge::getJudges($formData, $sortby, $sorttype, $this->recordPerPage, false);
        
		//build redirect string
		$paginateUrl = $this->registry->conf['rooturl_admin'].'judger/index/';   
		$redirectUrl = $paginateUrl;
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'judgers' 		=> $judgers,
												'redirectUrl'	=> $redirectUrl,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'judgerlist',
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
			
			$myUser = new Core_User();
			
			if($this->addActionValidator($formData, $error, $myUser))
			{
				$myJudger = new Core_UserJudge();
				$myJudger->uid = $myUser->id;
              		$myJudger->isColor = $formData['fiscolor'];
					$myJudger->isColorBestPortrait = $formData['isColorBestPortrait'];
					$myJudger->isColorBestIdea = $formData['isColorBestIdea'];
					$myJudger->isColorBestAction = $formData['isColorBestAction'];
					$myJudger->isMono = $formData['fismono'];
					$myJudger->isMonoBestPortrait = $formData['isMonoBestPortrait'];
					$myJudger->isMonoBestAction = $formData['isMonoBestAction'];
					$myJudger->isMonoCreative = $formData['isMonoCreative'];
					$myJudger->isNature = $formData['fisnature'];
					$myJudger->isNatureBestBird = $formData['isNatureBestBird'];
					$myJudger->isNatureBestSnow = $formData['isNatureBestSnow'];
					$myJudger->isNatureBestFlower = $formData['isNatureBestFlower'];
					$myJudger->isTravel = $formData['fistravel'];
					$myJudger->isTravelTransportation = $formData['isTravelTransportation'];
                    $myJudger->isTravelTraditional = $formData['isTravelTraditional'];
					$myJudger->isTravelCountry = $formData['isTravelCountry'];
				$myJudger->isViewOnly = $formData['fisviewonly'];
				
				if($myJudger->addData())
				{
					$success[] = $this->registry->lang['controller']['succAdd'];
					$this->registry->me->writelog('judger_add', $myJudger->uid, array('JudgerID' => $myJudger->uid));
					$formData = array();  	
				}
				else
				{
					$error[] = $this->registry->lang['controller']['errAdd'];			
				}
			}
		}
		
		$_SESSION['judgerAddToken'] = Helper::getSecurityToken();
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'redirectUrl'	=> $this->getRedirectUrl(),
												'error'			=> $error,
												'success'		=> $success,
												
												));
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'judgeradd',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_add'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
	}
	
	function editAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myJudger = new Core_UserJudge($id);
		$redirectUrl = $this->getRedirectUrl();
		
		if($myJudger->uid > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
            $formData['fiscolor'] = $myJudger->isColor;
			$formData['isColorBestPortrait'] = $myJudger->isColorBestPortrait;
			$formData['isColorBestIdea'] = $myJudger->isColorBestIdea;
			$formData['isColorBestAction'] = $myJudger->isColorBestAction;
			$formData['isMonoBestPortrait'] = $myJudger->isMonoBestPortrait;
			$formData['isMonoBestAction'] = $myJudger->isMonoBestAction;
			$formData['isMonoCreative'] = $myJudger->isMonoCreative;
			$formData['isNatureBestBird'] = $myJudger->isNatureBestBird;
			$formData['isNatureBestSnow'] = $myJudger->isNatureBestSnow;
			$formData['isNatureBestFlower'] = $myJudger->isNatureBestFlower;
			$formData['isTravelTransportation'] = $myJudger->isTravelTransportation;
			$formData['isTravelTraditional'] = $myJudger->isTravelTraditional;
			$formData['isTravelCountry'] = $myJudger->isTravelCountry;
            $formData['fismono'] = $myJudger->isMono;
			$formData['fisnature'] = $myJudger->isNature;
            $formData['fistravel'] = $myJudger->isTravel;			
			if(!empty($_POST['fsubmit']))
			{
				$formData = array_merge($formData, $_POST);
				
				if($this->editActionValidator($formData, $error))
				{
                    $myJudger->isColor = $formData['fiscolor'];
					$myJudger->isColorBestPortrait = $formData['isColorBestPortrait'];
					$myJudger->isColorBestIdea = $formData['isColorBestIdea'];
					$myJudger->isColorBestAction = $formData['isColorBestAction'];
					$myJudger->isMono = $formData['fismono'];
					$myJudger->isMonoBestPortrait = $formData['isMonoBestPortrait'];
					$myJudger->isMonoBestAction = $formData['isMonoBestAction'];
					$myJudger->isMonoCreative = $formData['isMonoCreative'];
					$myJudger->isNature = $formData['fisnature'];
					$myJudger->isNatureBestBird = $formData['isNatureBestBird'];
					$myJudger->isNatureBestSnow = $formData['isNatureBestSnow'];
					$myJudger->isNatureBestFlower = $formData['isNatureBestFlower'];
					$myJudger->isTravel = $formData['fistravel'];
					$myJudger->isTravelTransportation = $formData['isTravelTransportation'];
                    $myJudger->isTravelTraditional = $formData['isTravelTraditional'];
					$myJudger->isTravelCountry = $formData['isTravelCountry'];

					
					if($myJudger->updateData())
					{
						$success[] = $this->registry->lang['controller']['succUpdate'];
						$this->registry->me->writelog('judger_edit', $myJudger->uid, array('JudgerID' => $myJudger->uid));
					}
					else
					{
						$error[] = $this->registry->lang['controller']['errUpdate'];			
					}
				}
			}
			
            if($myJudger->isColorBestPortrait)    $formData['fsection'][] = 'landscape-c';
            if($myJudger->isColorBestIdea)    $formData['fsection'][] = 'idea-c';
            if($myJudger->isColorBestAction)    $formData['fsection'][] = 'sport-c';
            if($myJudger->isMonoBestPortrait)    $formData['fsection'][] = 'landscape-m';
            if($myJudger->isMonoBestAction)    $formData['fsection'][] = 'sport-m';
            if($myJudger->isMonoCreative)    $formData['fsection'][] = 'idea-m';
            if($myJudger->isNatureBestBird)    $formData['fsection'][] = 'bird-n';
            if($myJudger->isNatureBestSnow)    $formData['fsection'][] = 'snow-n';
			if($myJudger->isNatureBestFlower)	$formData['fsection'][] = 'flower-n';
			if($myJudger->isTravelTransportation)	$formData['fsection'][] = 'transportation-t';
			if($myJudger->isTravelTraditional)	$formData['fsection'][] = 'dress-t';
			if($myJudger->isTravelCountry)	$formData['fsection'][] = 'country-t';
            if($myJudger->isNature)    $formData['fsection'][] = 'nature-n';
			if($myJudger->isTravel)	$formData['fsection'][] = 'travel-t';
            if($myJudger->isMono)    $formData['fsection'][] = 'mono-m';
            if($myJudger->isColor)    $formData['fsection'][] = 'color-c';


			
			$rounds = Core_ContestRound::getRounds($formData, $sortby, 'ASC', '');
			//count the photo in each round to score
			for($i = 0; $i < count($rounds); $i++)
			{
				//tong so hinh trong round
				$rounds[$i]->numberphoto = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $rounds[$i]->id, 'fsection' => $formData['fsection']), '', '', '', true);
				
				//tong so hinh chua cham diem
				$rounds[$i]->numberphotounscored = Core_ContestPhotoReadyRound::getPhotos(array('frid' => $rounds[$i]->id, 'fsection' => $formData['fsection'], 'funscoredid' => $myJudger->uid), '', '', '', true);
				
				$rounds[$i]->numberphotofinished = $rounds[$i]->numberphoto - $rounds[$i]->numberphotounscored;
			}
			
			
			
			$_SESSION['judgerEditToken'] = Helper::getSecurityToken();
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'myJudger'		=> $myJudger,
													'rounds'		=> $rounds,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'error'			=> $error,
													'success'		=> $success,
													
													));
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
			$this->registry->smarty->assign(array(	'menu'		=> 'judger',
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
		$myJudger = new Core_UserJudge($id);
			
		if($myJudger->uid > 0)
		{
			if($_SESSION['judgerDeleteToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myJudger->delete())
				{
					$redirectMsg = $this->registry->lang['controller']['succDelete'];
					
					$this->registry->me->writelog('judger_delete', $myJudger->uid, array('JudgerID' => $myJudger->uid));  	
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
	
	####################################################################################################
	####################################################################################################
	####################################################################################################
	
		
	private function addActionValidator($formData, &$error, Core_User &$myUser)
	{
		$pass = true;
		
		if($_SESSION['judgerAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if($formData['fiscolor'] != '0' && $formData['fiscolor'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIscolorInvalid'];
			$pass = false;
		}
		
		if($formData['fismono'] != '0' && $formData['fismono'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsmonoInvalid'];
			$pass = false;
		}
		
		if($formData['fisnature'] != '0' && $formData['fisnature'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsnatureInvalid'];
			$pass = false;
		}
        
        if($formData['fistravel'] != '0' && $formData['fistravel'] != '1')
        {
            $error[] = $this->registry->lang['controller']['errIstravelInvalid'];
            $pass = false;
        }
		
		//check valid user
		if($formData['fuserid'] > 0)
		{
			$myUser->getData($formData['fuserid']);
		}
		elseif($formData['fusername'] != '')
		{
			$myUser = Core_User::getByUsername($formData['fusername']);
		}
		elseif($formData['femail'] != '')
		{
			$myUser = Core_User::getByEmail($formData['femail']);
		}
		
		if($myUser->id == 0)
		{
			$error[] = $this->registry->lang['controller']['errUserInvalid'];
			$pass = false;	
		}
		else
		{
			//check duplicate 
			$myJudger = new Core_UserJudge($myUser->id);
			if($myJudger->uid > 0)
			{
				$error[] = $this->registry->lang['controller']['errUserExisted'];
				$pass = false;	
			}
		}
		
						
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['judgerEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		if($formData['fiscolor'] != '0' && $formData['fiscolor'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIscolorInvalid'];
			$pass = false;
		}
		
		if($formData['fismono'] != '0' && $formData['fismono'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsmonoInvalid'];
			$pass = false;
		}
		
		if($formData['fisnature'] != '0' && $formData['fisnature'] != '1')
		{
			$error[] = $this->registry->lang['controller']['errIsnatureInvalid'];
			$pass = false;
		}
        
        if($formData['fistravel'] != '0' && $formData['fistravel'] != '1')
        {
            $error[] = $this->registry->lang['controller']['errIstravelInvalid'];
            $pass = false;
        }
				
		return $pass;
	}
	
		
}

?>