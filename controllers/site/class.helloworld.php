<?php

Class Controller_Site_HelloWorld Extends Controller_Core_Base 
{
	
	function indexAction() 
	{
		echo '<h1>test</h1>';
		/*		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
			)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 
		*/
		     
		
	} 
	
	function addAction() 
	{
		$id = $this->registry->router->getArg('id');
		
		$myHelloworld = new Core_Helloworld();
		
		
		$myHelloworld->id = $id;
		$myHelloworld->text = 'Helloworld - ' . $id;
		
		if($myHelloworld->addData() > 0)
		{
			$success = $this->registry->lang['controller']['addSuccess'];
		}
		else
		{
			$error = $this->registry->lang['controller']['addError'];
		}
		
		$this->registry->smarty->assign(
											array('success' => $success,
													'error' => $error
											)
		);
				
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'add.tpl'); 
			
		$this->registry->smarty->assign(
											array('contents' => $contents,
											)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 
		
		     
		
	} 
}

?>