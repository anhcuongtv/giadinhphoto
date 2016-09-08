<?php

Class Controller_Site_News Extends Controller_Site_Base 
{
	public $recordPerPage = 12;
	
	function indexAction() 
	{
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		$keywordFilter 	= $this->registry->router->getArg('keyword');
		
		$paginateUrl = $this->registry->conf['rooturl'].'site/news/index/';      
		
		if($keywordFilter != '')
		{
			$paginateUrl .= 'keyword/'.$keywordFilter . '/';
			$formData['fkeyword'] = $keywordFilter;
			$formData['search'] = 'keyword';
		}
		
		
		
		//tim tong so
		$total = Core_News::getNews($formData, '', '', '', true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$newsList = Core_News::getNews($formData, '', '', (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		$this->registry->smarty->assign(
			array('newsList' => $newsList,
				'formData'		=> $formData,
				'paginateurl' 	=> $paginateUrl, 
				'total'			=> $total,
				'totalPage' 	=> $totalPage,
				'curPage'		=> $curPage,
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
		$myNews = new Core_News($id);
		if($myNews->id > 0)
		{
			//increase view
			$myNews->view++;
			$myNews->updateData();
			
			//find latest news
			$moreNewsSameCategory = Core_News::getNews(array('fexcludeid' => $myNews->id), '', '', '');
			
			
			$this->registry->smarty->assign(
				array('myNews' => $myNews,
					'moreNewsSameCategory' => $moreNewsSameCategory,
				)
			);
			
			$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'detail.tpl'); 
			
			$this->registry->smarty->assign(
				array('contents' => $contents,
						'pageTitle'	=> ($myNews->seoTitle[$this->registry->langCode] != '') ? $myNews->seoTitle[$this->registry->langCode] : $myNews->name[$this->registry->langCode],
						'pageKeyword'	=> $myNews->seoKeyword[$this->registry->langCode],
						'pageDescription'	=> ($myNews->seoDescription[$this->registry->langCode] != '') ? $myNews->seoDescription[$this->registry->langCode] : $myNews->summary[$this->registry->langCode],
				)
			);
				
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl'); 	
		}
		else
		{
			$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'site/news',
													'redirectMsg' => 'News Not Found.',
													));
			$this->registry->smarty->display('redirect.tpl');
			exit();
		}
		
		
	}
}

?>