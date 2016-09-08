<?php

Abstract Class Controller_Site_Base Extends Controller_Core_Base 
{
	
	function __construct($registry)
	{
		parent::__construct($registry);
		
		//SHOPPING CART INITIALIZATION
		$myCart = new Core_Cart();
		$this->registry->cart = $myCart;
		
		//calculate online visitor
		global $session;
		$onlineVisitor = $session->get_users_online();
		
		//lay tong so user
		$siteTotalUsers = Core_User::getUsers(array('fgroupid' => GROUPID_MEMBER), '', '', '', true);    
		
		//lay photo statistic
		$siteTotalPhotos = Core_ContestPhoto::getPhotos(array('fenable' => 'YES'), '', '', '', true);
		
		//lay photo view total
		$siteTotalViewPhotos = Core_ContestPhoto::getTotalView();

		$this->registry->smarty->assign(array(
										  'cart' => $myCart,
										  'onlineVisitor' => $onlineVisitor,
										  'siteTotalUsers' => $siteTotalUsers,
										  'siteTotalPhotos' => $siteTotalPhotos,
										  'siteTotalViewPhotos' => $siteTotalViewPhotos,
										  ));
	}
	
	/**
	* Kiem tra xem controller/action co the xem dc neu da disable tinh nang xem photo tu website
	* 	
	*/
	public function checkEnablePhotogallery()
	{
		//check if disable photo gallery
		if($this->registry->setting['extra']['enablePhotogallery'] == false && $this->registry->me->canViewPhoto() == false )
		{
			header('location: ' . $this->registry->setting['extra']['disablePhotogalleryRedirect']);
			exit();
		}
	}
    
    protected function sectionValue()
    {      
        $section = array(
                    //mau
                    'color'=>array('color-c','landscape-c','sport-c', 'idea-c'),
                    //trang den
                    'mono'=>array('mono-m','landscape-m','sport-m', 'idea-m'),
                    //thien nhien
                    'nature'=>array('nature-n','bird-n','snow-n', 'flower-n'),
                    //du lich
                    'travel'=>array('travel-t','transportation-t','dress-t', 'country-t'),
                    );
        return $section;
    }
	
}
?>