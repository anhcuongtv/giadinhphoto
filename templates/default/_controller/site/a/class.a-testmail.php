<?php

Class Controller_Site_TestMail Extends Controller_Site_Base 
{
	
	function indexAction() 
	{
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////////
		//send mail to admin
		$mailContents = 'Test mail content';
		$sender = new SendMail( $this->registry,
								$this->registry->setting['mail']['toEmail'],
								$this->registry->setting['mail']['toName'],
								'Test mail subject',
								$mailContents,
								$this->registry->setting['mail']['fromEmail'],
								$this->registry->setting['mail']['fromName']
								);
		$sender->Send();     
		
	} 
	
	
}

?>