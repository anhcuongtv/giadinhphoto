<?php

Class Controller_Site_Page Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		$error = array();
		
		$seourl = $this->registry->router->getArg('seourl');
		if($seourl == '')
		{
			$error[] = $this->registry->lang['controller']['notFound'];
		}
		else
		{
			$page = new Core_Page(0, $this->registry->langCode);
			$page->getDataByText($seourl);
			
			if($page->id == 0)
				$error[] = $this->registry->lang['controller']['notFound'];
		}
		
		$this->registry->smarty->assign(
			array('error' => $error,
				'page'	=> $page,
				'pagename' => $seourl,
			)
		);
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
					'pageTitle' => $page->seoTitle[$this->registry->langCode],
					'pageKeyword' => $page->seoKeyword[$this->registry->langCode],
					'pageDescription' => $page->seoDescription[$this->registry->langCode],
			)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 
		
		     
		
	} 
}

?>