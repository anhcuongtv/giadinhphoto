<?php

Class Controller_Admin_Order Extends Controller_Admin_Base 
{
	private $recordPerPage = 20;
	
	function indexAction() 
	{
		$error 			= array();
		$success 		= array();
		$warning 		= array();
		$formData 		= array('fbulkid' => array());
		
		$_SESSION['securityToken'] = Helper::getSecurityToken();  //for delete link
		$page 			= (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
		
		$idFilter = (int)($this->registry->router->getArg('id'));
		$invoiceidFilter = (int)($this->registry->router->getArg('invoiceid'));
		$keywordFilter 	= $this->registry->router->getArg('keyword');
		$searchKeywordIn= $this->registry->router->getArg('searchin'); 
		
		//check sort column condition
		$sortby 	= $this->registry->router->getArg('sortby');
		if($sortby == '') $sortby = 'order';
		$formData['sortby'] = $sortby;
		$sorttype 	= $this->registry->router->getArg('sorttype');
		if(strtoupper($sorttype) != 'DESC') $sorttype = 'DESC';
		$formData['sorttype'] = $sorttype;	
		
		if(!empty($_POST['fsubmitbulk']))
		{
			if($_POST['ftoken'] == $_SESSION['orderBulkToken'])
			{
				if(!isset($_POST['fbulkid']))
				{
					$warning[] = $this->registry->lang['controllergroup']['bulkItemNoSelected'];
				}
				else
				{
					$formData['fbulkid'] = $_POST['fbulkid'];
					
					//check for delete 
					if($_POST['fbulkaction'] == 'delete')
					{
						$delArr = $_POST['fbulkid'];
						$deletedItems = array();
						$cannotDeletedItems = array();
						foreach($delArr as $id)
						{
							//check valid user and not admin user
							$myOrder = new Core_Order($id);
							
							if($myOrder->id > 0)
							{
								//tien hanh xoa
								if($myOrder->delete())
								{
									$deletedItems[] = $myOrder->id;
									$this->registry->me->writelog('order_delete', $myOrder->id, array('detail' => var_export($myOrder, true)));  	
								}
								else
									$cannotDeletedItems[] = $myOrder->id;
							}
							else
								$cannotDeletedItems[] = $myOrder->id;
						}
						
						if(count($deletedItems) > 0)
							$success[] = str_replace('###id###', implode(', ', $deletedItems), $this->registry->lang['controller']['succDelete']);
						
						if(count($cannotDeletedItems) > 0)
							$error[] = str_replace('###id###', implode(', ', $cannotDeletedItems), $this->registry->lang['controller']['errDelete']);
					}
					else
					{
						//bulk action not select, show error
						$warning[] = $this->registry->lang['controllergroup']['bulkActionInvalidWarn'];
					}
				}
			}
			
		}
		
				
		$_SESSION['orderBulkToken'] = Helper::getSecurityToken();
				
		$paginateUrl = $this->registry->conf['rooturl_admin'].'order/index/';      
		
				
		if($invoiceidFilter > 0)
		{
			$paginateUrl .= 'invoiceid/'.$invoiceidFilter . '/';
			$formData['finvoiceid'] = $invoiceidFilter;
			$formData['search'] = 'invoiceid';
		}
		
		if($idFilter > 0)
		{
			$paginateUrl .= 'id/'.$idFilter . '/';
			$formData['fid'] = $idFilter;
			$formData['search'] = 'id';
		}
		
		if(strlen($keywordFilter) > 0)
		{
			$paginateUrl .= 'keyword/' . $keywordFilter . '/';
			
			if($searchKeywordIn == 'email')
				$paginateUrl .= 'searchin/email/';
			elseif($searchKeywordIn == 'status')
				$paginateUrl .= 'searchin/status/';
			elseif($searchKeywordIn == 'firstname')
				$paginateUrl .= 'searchin/firstname/';
			elseif($searchKeywordIn == 'lastname')
				$paginateUrl .= 'searchin/lastname/';
			elseif($searchKeywordIn == 'phone')
				$paginateUrl .= 'searchin/phone/';
			elseif($searchKeywordIn == 'comment')
				$paginateUrl .= 'searchin/comment/';
			elseif($searchKeywordIn == 'address')
				$paginateUrl .= 'searchin/address/';
			elseif($searchKeywordIn == 'city')
				$paginateUrl .= 'searchin/city/';
			elseif($searchKeywordIn == 'region')
				$paginateUrl .= 'searchin/region/';
			elseif($searchKeywordIn == 'country')
				$paginateUrl .= 'searchin/country/';
			elseif($searchKeywordIn == 'zipcode')
				$paginateUrl .= 'searchin/zipcode/';
			
			$formData['fkeyword'] = $keywordFilter;
			$formData['fsearchin'] = $searchKeywordIn;
			$formData['search'] = 'keyword';
		}
				
		//tim tong so
		$total = Core_Order::getOrders($formData, $sortby, $sorttype, 0, true);    
		$totalPage = ceil($total/$this->recordPerPage);
		$curPage = $page;
		
			
		//get latest records
		$orders = Core_Order::getOrders($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
		
		//filter for sortby & sorttype
		$filterUrl = $paginateUrl;
		
		//append sort to paginate url
		$paginateUrl .= 'sortby/' . $sortby . '/sorttype/' . $sorttype . '/';
		
		//build redirect string
		$redirectUrl = $paginateUrl;
		if($curPage > 1)
			$redirectUrl .= 'page/' . $curPage;
			
		
		$redirectUrl = base64_encode($redirectUrl);
		
				
		$this->registry->smarty->assign(array(	'orders' 		=> $orders,
												'formData'		=> $formData,
												'success'		=> $success,
												'error'			=> $error,
												'warning'		=> $warning,
												'filterUrl'		=> $filterUrl,
												'paginateurl' 	=> $paginateUrl, 
												'redirectUrl'	=> $redirectUrl,
												'total'			=> $total,
												'totalPage' 	=> $totalPage,
												'curPage'		=> $curPage,
												));
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'index.tpl');
		
		$this->registry->smarty->assign(array(	'menu'		=> 'order',
												'pageTitle'	=> $this->registry->lang['controller']['pageTitle_list'],
												'contents' 	=> $contents));
		
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
		
	} 
	
		
	function editAction()
	{
		$id =(int)$this->registry->router->getArg('id');
		$print 			= (int)($this->registry->router->getArg('print'));   
		$subaction 		= $this->registry->router->getArg('do');        
		$myOrder = new Core_Order($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myOrder->id > 0)
		{
			$error 		= array();
			$success 	= array();
			$contents 	= '';
			$formData 	= array();
			
			$myOrder->productList = Core_OrderProduct::getProducts(array('forderid' => $myOrder->id), '', '', '');
			
			//Cap nhat comment order
			if(isset($_POST['fsubmitcomment']))
			{
				//update price cho order shipping                   
				$myOrder->comment = strip_tags($_POST['fcomment']);

				if($myOrder->updateData())
				{
					$success[] = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['succUpdate']); 
				}
				else
				{
					$error[] = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['errUpdate']);   
				}
			}
			
						
			//update status
			if(isset($_POST['fstatus']))
			{
				$formData = $_POST;
				if($formData['fstatus'] != 'pending' && $formData['fstatus'] != 'cancel' && $formData['fstatus'] != 'completed' && $formData['fstatus'] != 'error')
				{
					$error[] = $this->registry->lang['controller']['errStatusNotValid']; 
				}
				else
				{
					$myOrder->status = $formData['fstatus'];
					
					if($myOrder->updateData())
					{
						$success[] = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['succUpdate']); 
						
						if($formData['fstatus'] == 'completed')
						{
							$myUser = new Core_User($myOrder->memberid);
							
							//var_dump($myOrder->productList);
							for($i =0; $i < count($myOrder->productList); $i++)
							{
								//var_dump($myOrder->productList[$i]);				
								$myProduct = new Core_Product($myOrder->productList[$i]->productId);
								if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeColor']))
								{
									$myUser->paidColor = 1;
								}
								
								if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeMono']))
								{
									$myUser->paidMono = 1;
								}
								
								if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeNature']))
								{
									$myUser->paidNature = 1;
								}
                                
                                if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeTravel']))
                                {
                                    $myUser->paidTravel = 1;
                                }
							}
							$myUser->updateData(); 
							
							//set paid flag to current date if it currently 0 (not set yet, maybe cause by switch status to cancel, pending,...)
							if($myOrder->datepaid == 0)
							{
								$myOrder->datepaid = time();
								$myOrder->updateData();
							}
						}
						else 
						{
							$myOrder->datepaid = 0;
							
							
							$myOrder->updateData();
							
						}
					}
					else
					{
						$error[] = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['errUpdate']);   
					}
				}
			}
			
			
			
			$_SESSION['orderEditToken'] = Helper::getSecurityToken();
			
			
			
			
			$this->registry->smarty->assign(array(	'formData' 		=> $formData,
													'myOrder'		=> $myOrder,
													'redirectUrl'	=> $this->getRedirectUrl(),
													'encodedRedirectUrl'	=> base64_encode($this->getRedirectUrl()),
													'error'			=> $error,
													'success'		=> $success,
													
													));
													
													
			if($print == '1')
			{
				$contents = $this->registry->smarty->fetch($this->registry->smartyControllerGroupContainer.'order_print.tpl');
				
				$this->registry->smarty->assign(array('contents' => $contents,
													'pageTitle' => 'Order #' . $myOrder->invoiceid,
													));
				$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index_print.tpl');   
			}
			else 
			{
				$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'edit.tpl');
			
				$this->registry->smarty->assign(array(	'menu'		=> 'order',
														'pageTitle'	=> $this->registry->lang['controller']['pageTitle_edit'],
														'contents' 	=> $contents));
				
				$this->registry->smarty->display($this->registry->smartyControllerGroupContainer . 'index.tpl');
			}
			
			
			
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => $redirectMsg,
													));
			$this->registry->smarty->display('redirect.tpl');
		}
	}
	
	function deleteAction()
	{
		$id = (int)$this->registry->router->getArg('id');
		$myOrder = new Core_Order($id);
		
		$redirectUrl = $this->getRedirectUrl();
		
		if($myOrder->id > 0)
		{
			if($_SESSION['securityToken'] == $_GET['token'])
			{
				//tien hanh xoa
				if($myOrder->delete())
				{
					$redirectMsg = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['succDelete']);
					                                                                                     
					$this->registry->me->writelog('order_delete', $myOrder->id, array('detail' => var_export($myOrder, true)));  
				}
				else
				{
					$redirectMsg = str_replace('###id###', $myOrder->id, $this->registry->lang['controller']['errDelete']);
				}
			}
			else
			{
				$redirectMsg = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			}
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
			
		}
		
		
		$this->registry->smarty->assign(array('redirect' => $redirectUrl,
												'redirectMsg' => $redirectMsg,
												));
		$this->registry->smarty->display('redirect.tpl');
		
			
	}
	
	####################################################################################################
	####################################################################################################
	####################################################################################################
	
		
	private function addActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['productfieldAddToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		foreach($formData['fname'] as $langcode => $value)
		{
			if(strlen($value) == 0)
			{
				$error[] = str_replace('###LANGCODE###', strtoupper($langcode), $this->registry->lang['controller']['errNameRequired']);
           		$pass = false;
			}
		}
       			
				
		return $pass;
	}
	
	private function editActionValidator($formData, &$error)
	{
		$pass = true;
		
		if($_SESSION['productfieldEditToken'] != $formData['ftoken'])
		{
			$error[] = $this->registry->lang['controllergroup']['errFormTokenInvalid'];
			$pass = false;
		}
		
		foreach($formData['fname'] as $langcode => $value)
		{
			if(strlen($value) == 0)
			{
				$error[] = str_replace('###LANGCODE###', strtoupper($langcode), $this->registry->lang['controller']['errNameRequired']);
           		$pass = false;
			}
		}
		
				
		return $pass;
	}
	
		
}

?>