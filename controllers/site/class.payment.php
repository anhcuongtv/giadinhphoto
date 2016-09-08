<?php

Class Controller_Site_Payment Extends Controller_Core_Base 
{
	
	function indexAction() 
	{
		$error = $success = $formData = array();
		
		//load paymentmethod
		$myPaymentPage = new Core_Page(0, $this->registry->langCode);
		$myPaymentPage->getDataByText('paymentmethod');
		
		//if not have info before payment
		//redirect to payment to select
		if(!isset($_SESSION['paymentEnterPack']) || !isset($this->registry->setting['payment']['packSection'][$_SESSION['paymentEnterPack']]))
		{
			header('location: ' . $this->registry->conf['rooturl'] . 'memberarea.html?tab=payment');
			exit();
		}
		else
		{
			$packId = $_SESSION['paymentEnterPack'];
			$packTotalPrice = $this->registry->setting['payment']['packSection'][$packId];
			$packCurrency = 'USD';
			
			//Submmit payment
			$paymentSuccess = 0;
			
			if(isset($_GET['pay']))
			{
				//xu ly don hang..
				$paymentSuccess = 1;
				$paymentGate = $_GET['pay'];
				//$_SESSION['paymentEnterPack'] = 0;
			}
		}
		
		
		$this->registry->smarty->assign(
											array('error' => $error,
												'success'	=> $success,
												'myPaymentPage'	=> $myPaymentPage,
												'packId'	=> $packId,
												'packTotalPrice'	=> $packTotalPrice,
												'packCurrency' => $packCurrency,
												'paymentSuccess' => $paymentSuccess,
												'paymentGate' => $paymentGate,
												'formData'	=> $formData,
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