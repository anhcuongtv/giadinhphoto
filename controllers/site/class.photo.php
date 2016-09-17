<?php

Class Controller_Site_Photo Extends Controller_Site_Base 
{
	public $recordPerPage = 12;
	
	function indexAction() 
	{
		$this->checkEnablePhotogallery();
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		$flag = 1;
		$sectionFilter 	= $this->registry->router->getArg('section');
        $groupID 	= $this->registry->router->getArg('group');
		$timeFilter 	= $this->registry->router->getArg('time');
        $keywordFilter     = $this->registry->router->getArg('keyword');
		$roundFilter 	= $this->registry->router->getArg('round');

        $group = Core_ContestPhotoGroup::getList(0, true);
        //$sections = Core_ContestPhotoGroup::getAllSection();
        $data = Helper::displaySelectionPhotoGroupForUser($group, true, $sectionFilter);
		
		$paginateUrl = $this->registry->conf['rooturl'].'site/photo/index/';      
		
		if($sectionFilter != '')
		{
			$paginateUrl .= 'section/'.$sectionFilter . '/';
			$formData['fsection'] = $sectionFilter;
			$formData['search'] = 'section';
		}
		
		if(in_array($timeFilter, array('24hours', '3days', '1week', '1month')))
		{
			$paginateUrl .= 'time/'.$timeFilter . '/';
			$formData['ftime'] = $timeFilter;
			$formData['search'] = 'time';
		}
		
		if($keywordFilter != '')
		{
			$paginateUrl .= 'keyword/'.$keywordFilter . '/';
			$formData['fkeyword'] = $keywordFilter;
			$formData['search'] = 'keyword';
		}
        
        if($roundFilter != '')
        {
            if ($groupID) {
                $currentActive = Core_ContestPhotoChild::getEnableView($roundFilter);
            } else {
                $currentActive = Core_ContestPhoto::getEnableView($roundFilter);
            }

        	if($roundFilter ==  $currentActive){
	            $paginateUrl .= 'round/'.$roundFilter . '/';
	            $roundData = new Core_ContestRound($roundFilter);
	            $formData['fround'] = $roundData->id;
	            if($roundData->id == NULL)
	            {
	                header('location: ' . $this->registry->conf['rooturl']);     
	            }
	           
	            //$formData['fcondition'] = unserialize($roundData->passPoint);
	            $this->registry->smarty->assign(array('round' => $roundData->id));
       		}else{
       			header('location: ' . $this->registry->conf['rooturl']);     
       		}
        }
        if($sectionFilter != '' || in_array($timeFilter, array('24hours', '3days', '1week', '1month')) || $keywordFilter != '' || $roundFilter != ''){
        	$flag = 1;
        }else if($roundFilter == ''){
        	       	$flag = 0;
        }
        
		//tim tong so
		
        //get Round
		//get latest records
		if($roundFilter != ''){
            if ($groupID) {
                $total = Core_ContestPhotoChild::getPhotosx($formData, '', '', '', true);
                $totalPage = ceil($total/$this->recordPerPage);
                $curPage = $page;
                $newPhotoList = Core_ContestPhotoChild::getPhotosx($formData, '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
            } else {
                $total = Core_ContestPhoto::getPhotosx($formData, '', '', '', true);
                $totalPage = ceil($total/$this->recordPerPage);
                $curPage = $page;
                $newPhotoList = Core_ContestPhoto::getPhotosx($formData, '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
            }
        } else {
            if ($groupID) {
                $total = Core_ContestPhotoChild::getPhotos($formData, '', '', '', true);
                $totalPage = ceil($total/$this->recordPerPage);
                $curPage = $page;
                $newPhotoList = Core_ContestPhotoChild::getPhotos($formData, '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
            } else {
                $total = Core_ContestPhoto::getPhotos($formData, '', '', '', true);
                $totalPage = ceil($total/$this->recordPerPage);
                $curPage = $page;
                $newPhotoList = Core_ContestPhoto::getPhotos($formData, '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
            }
		}
        $formData1 = array('fgroupid' => GROUPID_MEMBER);
        $totalUser = Core_User::getUsers($formData1, '', '', '', true);

        $groups = Core_ContestPhotoGroup::getAllGroupName();

		$this->registry->smarty->assign(
			array('newPhotoList' => $newPhotoList,
				'formData'		=> $formData,
				'paginateurl' 	=> $paginateUrl, 
				'total'			=> $total,
				'totalPage' 	=> $totalPage,
				'curPage'		=> $curPage,
				'totalUser'		=> $totalUser,
                'groups'        => $groups,
                'data' => $data
			)
		);
		
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
			)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 
	} 
	
	function detailAction()
	{
		$id = $this->registry->router->getArg('id');
        $group = $this->registry->router->getArg('group');
		//parsing encodedPhotoid
		$idpart = explode('-', $id, 2);
        if ($group){
            $object = "Core_ContestPhotoChild";
        } else {
            $object = "Core_ContestPhoto";
        }

		if($idpart[0] != '')
		{
            if ($group){
                $id = (int)Core_ContestPhotoChild::encodePhotoId($idpart[0], 'decode');
            } else {
                $id = (int)Core_ContestPhoto::encodePhotoId($idpart[0], 'decode');
            }
		}

        $myPhoto = new $object($id);
		//gioi han chi owner moi coi
		//if($myPhoto->id > 0 && ($myPhoto->uid == $this->registry->me->id || $this->registry->me->canViewPhoto()))
		if($myPhoto->id > 0)
		{
			
			$poster = new Core_User($myPhoto->uid);
			
			//increase view
			$myPhoto->increaseView();
			
			//get poster image
            if ($group){
                $posterPhotoList = Core_ContestPhotoChild::getPhotos(array('fuserid' => $poster->id), '', '', '');
                $newerPhotoList = Core_ContestPhotoChild::getPhotos(array('fgreaterthan' => $myPhoto->id), '', '', 8);
            } else {
                $posterPhotoList = Core_ContestPhoto::getPhotos(array('fuserid' => $poster->id), '', '', '');
                $newerPhotoList = Core_ContestPhoto::getPhotos(array('fgreaterthan' => $myPhoto->id), '', '', 8);
            }

			//find prev/next photoid
			//$prevId = 0;
			//$nextId = 0;
			$prevPhoto = new $object();
			$nextPhoto = new $object();
			
			$curPos = 0;
			for($i = 0; $i < count($posterPhotoList); $i++)
			{
				if($posterPhotoList[$i]->id == $myPhoto->id)
				{
					$curPos = $i + 1;
					if($i == 0)
					{
						$prevPhoto = $posterPhotoList[count($posterPhotoList)-1];
						//$prevId = $posterPhotoList[count($posterPhotoList)-1]->id;
					}
					else
					{
						$prevPhoto = $posterPhotoList[$i-1];
						//$prevId = $posterPhotoList[$i-1]->id;
					}
					
					if($i == count($posterPhotoList) - 1)
					{
						$nextPhoto = $posterPhotoList[0];
						//$nextId = $posterPhotoList[0]->id;
					}
					else
					{
						$nextPhoto = $posterPhotoList[$i+1];
						//$nextId = $posterPhotoList[$i+1]->id;
					}
				}
			}
			$this->registry->smarty->assign(
				array('myPhoto' => $myPhoto,
						'poster'	=> $poster,
						'posterPhotoList'	=> $posterPhotoList,
						'newerPhotoList'	=> $newerPhotoList,
						'nextPhoto' => $nextPhoto,
						'prevPhoto' => $prevPhoto,
                        'group' => $group,
						'curPos'	=> $curPos
				)
			);
			
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'detail.tpl'); 
			
			$this->registry->smarty->assign(
				array('contents' => $contents,
				)
			);
				
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 	
		}
		else
		{
			$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'site/photo',
													'redirectMsg' => 'Photo Not Found.',
													));
			$this->registry->smarty->display('redirect.tpl');
			exit();
		}
		
		
	}
}

?>