<?php

Class Controller_Site_Index Extends Controller_Site_Base 
{
	function indexAction() 
	{   //header('Location: '.$this->registry->conf['rooturl'].'article-instruction.html');
        
		
		//process timer for countdown
		$countdateArray = explode('/', $this->registry->setting['extra']['countdownDate']);
		$counttimeArray = explode('/', $this->registry->setting['extra']['countdownTime']);
		$countdownTimestamp = mktime((int)trim($counttimeArray[0]), (int)trim($counttimeArray[1]), 0, (int)trim($countdateArray[1]), (int)trim($countdateArray[0]), (int)trim($countdateArray[2]));

		//get data from folder image data
		$imagelist = scandir($this->registry->setting['extra']['imagedata']);
        unset($imagelist[0]);
		unset($imagelist[1]);
        $imageName = $imagelist[array_rand($imagelist)];
        
        //count country
        $countCountry = Core_User::countCountry();
        
		$this->registry->smarty->assign(
			array(
				'jsCountdown' => date('F j,Y H:i', $countdownTimestamp),
                'imageName'   => $imageName,
                'countCountry' => $countCountry
			)
		);
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
			)
		);
			
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');
        
	} 
}

?>