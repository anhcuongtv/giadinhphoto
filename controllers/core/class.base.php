<?php

Abstract Class Controller_Core_Base 
{
	protected $registry;

	function __construct($registry) 
	{
		//set smarty template container
		$registry->set('smartyControllerContainerRoot', '_controller/');
		$registry->set('smartyControllerGroupContainer', '_controller/' . $registry->controllerGroup . '/');
		$registry->set('smartyControllerContainer', '_controller/' . $registry->controllerGroup.'/'.$registry->controller . '/');
		$registry->set('smartyMailContainerRoot', '_mail/');
		$registry->set('smartyMailGroupContainer', '_mail/' . $registry->controllerGroup . '/');
		$registry->set('smartyMailContainer', '_mail/' . $registry->controllerGroup.'/'.$registry->controller . '/');
		
		$registry->smarty->assign(array('smartyControllerContainerRoot'	=> '_controller/', 
										'smartyControllerGroupContainer' => '_controller/' . $registry->controllerGroup . '/',
										  'smartyControllerContainer' => '_controller/' .  $registry->controllerGroup.'/' . $registry->controller . '/', 
										  'smartyMailContainerRoot' => '_mail/', 
										  'smartyMailGroupContainer' => '_mail/' . $registry->controllerGroup . '/', 
										  'smartyMailContainer' => '_mail/' . $registry->controllerGroup.'/'.$registry->controller . '/', 
										  ));
		$this->registry = $registry;
	}

	function __call($name, $args)
	{
		$backLink = $this->registry->conf['rooturl'];
		$this->registry->smarty->assign(array('boxContents' => '<div><a href="' . $backLink . '">' . $this->registry->lang['default']['pageNotFoundRecommend'] . '</a></div>',
												'boxTitle' => $this->registry->lang['default']['pageNotFound']
												));	
		$contents = $this->registry->smarty->fetch('notfound.tpl');
		
		$breadcrumbs = array(array('link' => 'index', 'title' => $this->registry->lang['default']['home']),
							array('link' => '', 'title' => $this->registry->lang['default']['pageNotFound']));
							
		$this->registry->smarty->assign(array('breadcrumbs' => $breadcrumbs,
												'contents' => $contents
												));					
		$this->registry->smarty->display('index.tpl');
	}
	
	public function authorization()
	{
		
		if($this->registry->me->id == 0)
		{
			$redirectUrl = $this->registry->conf['rooturl'].substr($_SERVER['REQUEST_URI'],1);
			
			header('location: '.$this->registry->conf['rooturl'].'login.html?refer=1&redirect=' . base64_encode($redirectUrl));
			exit();	
		}
	}
	
	abstract function indexAction();
	
	
}
?>