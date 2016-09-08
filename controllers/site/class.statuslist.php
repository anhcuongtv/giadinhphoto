<?php

Class Controller_Site_Statuslist Extends Controller_Site_Base 
{
	public $recordPerPage = 300;
	function indexAction() 
	{
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		$paginateUrl = $this->registry->conf['rooturl'].'site/statuslist/index/';      
		
				
		
		//tim tong so
		$formData = array('fgroupid' => GROUPID_MEMBER);
		$total = Core_User::getUsers($formData, '', '', '', true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$userList = Core_User::getUsers($formData, '', 'ASC', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		
		$this->registry->smarty->assign(
			array('userList' => $userList,
				'formData'		=> $formData,
				'paginateurl' 	=> $paginateUrl, 
				'total'			=> $total,
				'totalPage' 	=> $totalPage,
				'curPage'		=> $curPage,
				'orderStartCount' => ($curPage-1)*$this->recordPerPage
			)
		);
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');   
		
	} 
	
	
}

?>