<?php

Class Controller_Site_User Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		$username = $this->registry->router->getArg('username');
		$myUser = Core_User::getByUsername($username);

		if($myUser->id == 0)
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
			$redirectUrl = $this->registry->conf['rooturl'];
		}
		else
		{
			//select 1 image of this user
			$userPhoto = Core_ContestPhoto::getPhotos(array('fuserid' => $myUser->id), '', '', 1);
			if($userPhoto[0]->id == 0)
			{
				//user nay khong co hinh nao ca           
				if($myUser->id == $this->registry->me->id)
				{
					//neu la user hien tai dang login, thi redirect wa memberarea de upload
					$redirectMsg = $this->registry->lang['controller']['errMyPhotoNotFound'];
					$redirectUrl = $this->registry->conf['rooturl'] . 'memberarea.html?tab=upload';
				}
				else
				{
					//user nay khong co hinh nao ca
					$redirectMsg = $this->registry->lang['controller']['errUserPhotoNotFound'];
					$redirectUrl = $this->registry->conf['rooturl'];
				}
				
			}
			else
			{
				//redirect toi trang hinh nay
				$redirectMsg = $this->registry->lang['controller']['redirectToPhoto']; 
				$redirectUrl = $this->registry->conf['rooturl'] . 'site/photo/detail/id/' . $userPhoto[0]->id;     
			}
		}
		
		 
		$this->registry->smarty->assign(array('redirect' => $redirectUrl,
												'redirectMsg' => $redirectMsg,
												));
		$this->registry->smarty->display('redirect.tpl'); 
		
	} 
}

?>