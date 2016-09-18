<?php

Class Controller_Site_Checkout Extends Controller_Site_Base 
{
	
	public $recordPerPage = 3;
	
	
	function indexAction()
	{
		header('location: ' . $this->registry->conf['rooturl'] . 'site/checkout/paymentform');
		exit();	
	}
	
	function paymentformAction() 
	{
		$error = $success = $formData = array();
		
		//load paymentmethod
		$myPaymentPage = new Core_Page(0, $this->registry->langCode);
		$myPaymentPage->getDataByText('paymentmethod');
        $packDetail = '';
		//if not have info before payment
		//redirect to payment to select
		if(!isset($_SESSION['paymentEnterPack']))
		{    
			header('location: ' . $this->registry->conf['rooturl'] . 'memberarea.html?tab=payment');
            exit();
		}
		else
		{
			$formData['fpaylocation'] = Core_Product::getPayLocation();
			$packId = $_SESSION['paymentEnterPack'];
            $me = new Core_User();

            $currentOrderInformation['contactemail'] = $this->registry->me->email;
            $currentOrderInformation['billing_firstname'] = $this->registry->me->firstname;
            $currentOrderInformation['billing_mid'] = '';
            $currentOrderInformation['billing_lastname'] = $this->registry->me->lastname;
            $currentOrderInformation['billing_address'] = $this->registry->me->address;
            $currentOrderInformation['billing_address2'] = $this->registry->me->address2;
            $currentOrderInformation['billing_city'] = $this->registry->me->city;
            $currentOrderInformation['billing_region'] = $this->registry->me->region;
            $currentOrderInformation['billing_country'] = $this->registry->me->country;
            $currentOrderInformation['billing_city_text'] = $this->registry->me->city;
            $currentOrderInformation['billing_region_text'] = $this->registry->me->region;
            $currentOrderInformation['billing_country_text'] = $this->registry->me->country;
            $currentOrderInformation['billing_zipcode'] = $this->registry->me->zipcode;
            $currentOrderInformation['billing_phone'] = $this->registry->me->phone1;
            $currentOrderInformation['billing_phone2'] = $this->registry->me->phone2;
            $currentOrderInformation['shipping_firstname'] = $this->registry->me->firstname;
            $currentOrderInformation['shipping_mid'] = '';
            $currentOrderInformation['shipping_lastname'] = $this->registry->me->lastname;
            $currentOrderInformation['shipping_address'] = $this->registry->me->address;
            $currentOrderInformation['shipping_address2'] = $this->registry->me->address2;
            $currentOrderInformation['shipping_city'] = $this->registry->me->city;
            $currentOrderInformation['shipping_region'] = $this->registry->me->region;
            $currentOrderInformation['shipping_country'] = $this->registry->me->country;
            $currentOrderInformation['shipping_city_text'] = $this->registry->me->city;
            $currentOrderInformation['shipping_region_text'] = $this->registry->me->region;
            $currentOrderInformation['shipping_country_text'] = $this->registry->me->country;
            $currentOrderInformation['shipping_zipcode'] = $this->registry->me->zipcode;
            $currentOrderInformation['shipping_phone'] = $this->registry->me->phone1;
            $currentOrderInformation['shipping_phone2'] = $this->registry->me->phone2;

            $_SESSION['orderTemp'] = $currentOrderInformation;

            $this->registry->cart->emptyCart();
            $this->registry->cart->addItem($packId, 1, '');
            $this->registry->cart->saveToSession();

            $packDetail = new Core_NewProduct($_SESSION['paymentEnterPack']);
		}
       
		$this->registry->smarty->assign(
											array('error' => $error,
												'success'	=> $success,
												'myPaymentPage'	=> $myPaymentPage,
												'packId'	=> $packId,
												'formData'	=> $formData,
												'monthOptions'		=> $this->monthList(),
												'yearOptions'		=> $this->yearList(),
                                                'packDetail'    => $packDetail,
                                                'country' => $this->registry->me->country,
										)
		);
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'paymentform.tpl'); 
			
		$this->registry->smarty->assign(
			array('contents' => $contents,
			)
		);

		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');
	} 
	
	  
	/**
	* User chon nut PLACE ORDER - dat hang
	*
	* Doi voi chung nang nay thi khong tien hanh thanh toan truc tuyen ma chi luu lai don hang
	* va cho update thong tin sau
	* 
	*/
	public function placeorderAction()
	{
		$error = array();
		$success = array();
		$contents = '';
		
		
		if(!in_array($_POST['ftype'], array('cash', 'bank', 'postoffice')))
		{
			$redirectUrl = $this->registry->conf['rooturl'] . 'site/checkout/paymentform';
			$this->registry->smarty->assign(array('redirect' => $redirectUrl,
													'redirectMsg' => $this->registry->lang['controller']['paymentTypeIsNotValid'],
													));
			$this->registry->smarty->display('redirect.tpl');
			exit();	
		}
		//check for return url from paypal
		$myOrder = $this->processNewOrder($error);
		
		//update payment type
		$myOrder->paymentmethod = $_POST['ftype'];
		$myOrder->comment = strip_tags($_POST['fcomment']);
		$myOrder->updateData();
		
		$this->finishOrder($myOrder, true);
		
		$this->registry->smarty->assign(array(	'invoice'			=> $myOrder->invoiceid,		
												'error' 			=> $error,
												'success' 			=> $success
												));
		
		
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'placeorder.tpl'); 
			
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');   
		
	}
	
	
	
		
		
	/**
	* Tien hanh payment 
	* 
	* Phuong thuc payment Online co the lua chon la: 
	* a. Direct Payment - tu dong nhap credit card info ngay tren website
	* b. Paypal Express Checkout - chuyen sang paypal va thanh toan, sau do return website
	* c. Ngan luong: cong thanh toan o Viet nam, tich hop mot so ngan hang o VN
	* 
	*/
	public function paymentAction()
	{
		$formData = array();
		$errorCheckout = '';  
		
		//check & redirect if cart is empty
		$this->checkCartEmpty();
		
		//tien hanh confirm and checkout with Paypal payment pro (direct payment or express checkout)
		$errorFromCheckout = '';
		if(isset($_POST['fsubmit']))
		{
			// user click paypal express checkout button
			// this page from paypal redirect to
			// begin using API to request and check ACK,
			// if true, redirect to expresscheckout process(login to paypal...)
			if(isset($_POST['method']) && $_POST['method'] == 'SetExpressCheckout' )
			{
				$this->payment_paypal_expresscheckout($errorFromCheckout);
			}
			else	//direct payment from PAYPAL
			{
				$formData = $_POST;
				$invoiceIdSuccess = '';
				
				if(!isset($_POST['fcardtype']) || !in_array($_POST['fcardtype'], array('MasterCard', 'Visa', 'Discover', 'Amex')))
				{
					$errorCheckout = $this->registry->lang['controller']['paymentErrCardType'];
				}
				else
				{
					$invoiceIdSuccess = $this->payment_paypal_directpayment($errorFromCheckout);		
				}
				
				if(strlen($invoiceIdSuccess) > 0)
				{
					//if payment success in direct_payment method
					//redirect to thank you page
					$this->review($invoiceIdSuccess);
					exit();
				}
			}
			
			
		}
		
		//////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////
		//return from paypal website, after buyer login at paypal
		if($this->registry->router->getArg('expresscheckoutreturn')=='1')
		{
			$invoiceIdSuccess = $this->payment_paypal_expresscheckout($errorFromCheckout);	 
			if(strlen($invoiceIdSuccess) > 0)
			{
				
				if($this->registry->router->getArg('cancel') == '1')              
				{
					header('location: ' . $this->registry->conf['rooturl'] . 'memberarea.html?tab=payment');
					exit();	
				}
				else
				{
					//if payment success in direct_payment method
					//redirect to thank you page
					$this->review($invoiceIdSuccess);
					exit();
				}
				
			}
		}
		
				
		
		//if checkout error, begin to process and show error to user
		if($errorFromCheckout != '')
		{
			//print_r($errorFromCheckout);
			$errorCheckout = $this->getDirectPaymentCheckoutError($errorFromCheckout);
		}
		
		$this->registry->smarty->assign(array(	'formData' 		=> $formData,
												'errorCheckout' => $errorCheckout,
												'invoice' 		=> $invoiceid)); 
		
		$this->paymentformAction();  
			
	}
	
	public function historyAction()
	{
		if($this->registry->me->id == 0)
		{
			header('location: ' . $this->registry->conf['rooturl'] . 'site/cart');
			exit();
		}
		
		$invoiceId = $this->registry->router->getArg('invoiceid');
		$contents = '';
		$print = $this->registry->router->getArg('print');

		if($invoiceId != '')
		{
			$myOrder = new Core_Order();
			$myOrder->getDataByInvoiceid($invoiceId);
			
			if($myOrder->id == 0 || ($myOrder->memberid != $this->registry->me->id && $myOrder->contactemail != $this->registry->me->email))
			{
				$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'site/checkout/history',
														'redirectMsg' => $this->registry->lang['controller']['errInvoiceIdNotValid']));
				$this->registry->smarty->display('redirect.tpl');
				exit();		
			}
			else
			{
				$this->registry->smarty->assign(array(	'totalprice' 		=> $myOrder->subtotal,
														'shippingprice'		=> $myOrder->shipprice,
														'taxValue'			=> $myOrder->tax,
														'taxprice'			=> $myOrder->taxprice,
														'totalpriceAfterTax'=> $myOrder->subtotal + $myOrder->shipprice + $myOrder->taxprice,
														'continueshoppingurl'	=> isset($_SESSION['continueshoppingurl'])?$_SESSION['continueshoppingurl']:'',
														'error' 			=> $error,
														'success' 			=> $success,
														'myOrder'			=> $myOrder,
														'productList'		=> Core_OrderProduct::getProducts(array('forderid' => $myOrder->id), '', '', '')
														));
														
				$contents = $this->registry->smarty->fetch($this->registry->smartyControllerGroupContainer.'order_print.tpl');
				
				$this->registry->smarty->assign(array('contents' => $contents,
													'pageTitle' => 'Order #' . $myOrder->invoiceid,
													));
				$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index_print.tpl');    
			}
		}
		else
		{
			$error             = array();
	        $success         = array();
	        $formData = array();
	        $page             = (int)($this->registry->router->getArg('page'))>0?(int)($this->registry->router->getArg('page')):1;
	        
	       	                
	        $paginateUrl = $this->registry->conf['rooturl'].'site/checkout/history/';  
	        
	        $formData['fmemberid'] = $this->registry->me->id;
	        $formData['fcontactemail'] = $this->registry->me->email;
	        
	        //tim tong so
	        $total = Core_Order::getOrders($formData, $sortby, $sorttype, '', true);    
	        $totalPage = ceil($total/$this->recordPerPage);
	        $curPage = $page;
	        
	            
	        //get latest account. $cats: Nhung con meo :)
	        $orders = Core_Order::getOrders($formData, $sortby, $sorttype, (($page - 1)*$this->recordPerPage).','.$this->recordPerPage, false);
	                
	        $this->registry->smarty->assign(array(  'orders'     => $orders,
	                                                'formData'        => $formData,
	                                                'success'        => $success,
	                                                'error'            => $error,
	                                                'paginateUrl'     => $paginateUrl, 
	                                                'total'            => $total,
	                                                'totalPage'     => $totalPage,
	                                                'curPage'        => $curPage,
	                                                ));
	        
	        
	        $contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'history.tpl');
	        
	        $this->registry->smarty->assign(array('contents' => $contents,
													'pageTitle' => 'Order History',
												));
			$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index.tpl');    
		}		
	}
	
	
	/**
	* Dung de xu ly neu user chon payment thong qua direct payment (visa, master card, discovery)
	* 
	* @return: if payment success, function will return invoiceID of the order, otherwise a empty string
	*/
	private function payment_paypal_directpayment(&$error)
	{
		
		//insert new order
		$myOrder = $this->processNewOrder($error);
		$invoiceId = $myOrder->invoiceid;
		
		if($myOrder->id <= 0)
		{
			$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'] . 'site/checkout',
													'redirectMsg' => $this->registry->lang['controller']['errInvoiceIdNotValid']));
			$this->registry->smarty->display('redirect.tpl');
			exit();	
		}
		
		/////////////////////////////////////////////////////////////////
		//INITIALIZATION OF ORDER AND ORDER PRODUCTS
		$priceAfterAll = $myOrder->subtotal + $myOrder->shipprice + $myOrder->taxprice;
		$totalprice = $myOrder->subtotal;
		$taxAmount = $myOrder->tax;
		$taxprice = $myOrder->taxprice;
		$orderId = $myOrder->id;
		
		//lay order product
		$orderProductList = Core_OrderProduct::getProducts(array('forderid' => $myOrder->id), '', '', '');	
		$myOrder->productList = $orderProductList;
		
		//----------------------------------------------------------------
		//----------------------------------------------------------------
		//begin to process payment after finish order
			
		// Set request-specific fields.
		$paymentType = urlencode('Sale');				// or 'Sale'
		$ipAddress = urlencode(Helper::getIpAddress());
		$firstName = urlencode($_POST['ffirstname']);
		$lastName = urlencode($_POST['flastname']);
		$creditCardType = urlencode($_POST['fcardtype']);
		$creditCardNumber = urlencode(str_replace('-', '', $_POST['fcardnumber']));
		$expDateMonth = $_POST['fexpiredmonth'];
		// Month must be padded with leading zero
		$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
		

		$expDateYear = urlencode($_POST['fexpiredyear']);
		$cvv2Number = urlencode($_POST['fcvvnumber']);
		$zip = urlencode($_POST['fzipcode']); 
		$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		//order information
		$totalPriceString = urlencode($this->registry->currency->formatPrice($this->registry->currency->convertCurrency($priceAfterAll, 'usd'), false));
		$itemAmount = urlencode($this->registry->currency->formatPrice($this->registry->currency->convertCurrency($totalprice, 'usd'), false));
		$shipAmount = urlencode($this->registry->currency->formatPrice($this->registry->currency->convertCurrency($shippingprice, 'usd'), false));
		$taxAmount = urlencode($this->registry->currency->formatPrice($this->registry->currency->convertCurrency($taxprice, 'usd'), false));
		$invNum = urlencode($invoiceId);

		//FIX AMOUNT FOREIGN EXCHANGE PROBLEM !important
		if($totalPriceString != ($itemAmount + $shipAmount + $taxAmount))
		{
			$shipAmount = $totalPriceString - $itemAmount - $taxAmount;
		}
		
		// Add request-specific fields to the request string.
		$nvpStr =	"&PAYMENTACTION=$paymentType&IPADDRESS=$ipAddress&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
					"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
					"&ZIP=$zip&CURRENCYCODE=$currencyID".
					"&AMT=$totalPriceString&ITEMAMT=$itemAmount&SHIPPINGAMT=$shipAmount&TAXAMT=$taxAmount&INVNUM=$invNum";
		//die($nvpStr);

		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->Paypal_PPHttpPost('DoDirectPayment', '51.0', $nvpStr);
		
		//save the API Response for this order
		$myPaypalDirectResponse = new Core_PaypalDirectPaymentResponse();
		$myPaypalDirectResponse->orderId = $myOrder->id;
		$myPaypalDirectResponse->ack = $httpParsedResponseAr['ACK'];
		$myPaypalDirectResponse->apiversion = urldecode($httpParsedResponseAr['VERSION']);
		$myPaypalDirectResponse->apibuild = urldecode($httpParsedResponseAr['BUILD']);
		$myPaypalDirectResponse->timestamp = urldecode($httpParsedResponseAr['TIMESTAMP']);
		$myPaypalDirectResponse->correlationid = $httpParsedResponseAr['CORRELATIONID'];
		$myPaypalDirectResponse->ipaddress = urldecode($ipAddress);
		$myPaypalDirectResponse->serializeddata = serialize($httpParsedResponseAr);
		$myPaypalDirectResponse->addData();
		
		//----------------------------------------
		// PROCESS AFTER GET RESPONSE FROM PAYPAL 
		//For old order
		
		if(substr_count($httpParsedResponseAr["ACK"], 'Success') > 0)
		{
			//begin to update the time of paid order
			$myOrder->status = 'pending';
			$myOrder->paymentmethod = 'paypal_direct';
			$myOrder->datepaid = time();     
			
			$this->finishOrder($myOrder, true);
			//exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
			
			
		} 
		else  
		{
			$myOrder->isTransactionFail = 1;
			$error = $httpParsedResponseAr;
			$invoiceId = '';
		}
		
		//Update order
		
		$myOrder->transactionid = $httpParsedResponseAr['CORRELATIONID'];
		$myOrder->updateData();
		
		return $invoiceId;
	}
	
	/**
	* Dung de xu ly neu user chon payment thong qua express checkout (account paypal)
	*  - day la buoc request sau khi user click nut paypal express checkout
	* 
	*/
	private function payment_paypal_expresscheckout(&$error)
	{
		$invoiceId = $this->registry->router->getArg('invoice');		 
		$expresscheckoutReturn = $this->registry->router->getArg('expresscheckoutreturn');		 
		$expresscheckoutReturnCancel = $this->registry->router->getArg('cancel');		 
		
				  
		/**
		* Process old order different from new order
		*  - with old order, we don't need to create new order to database, because all information had been inserted to database before.
		* 		so, we only checkout to finish payment price
		*  - with new order, so we need to fetch all information and save it to order table, after that, we will
		* 		process to payment
		*/
		
		
		
		if($invoiceId != '')
		{
			$myOrder = new Core_Order();   
			$myOrder->getDataByInvoiceid($invoiceId);
		}
		
		if($expresscheckoutReturn != '1' || $expresscheckoutReturnCancel == '1')
		{
			$myOrder = $this->processNewOrder($error);
			$invoiceId = $myOrder->invoiceid;
		}
		
		//begin to process payment after finish order
			
		// Set request-specific fields.
		$paymentType = urlencode('Sale');				// or 'Sale'
		$name = urlencode($myOrder->billingFirstname . ' ' . $myOrder->billingLastname);
		$currencyID = urlencode('USD');							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		$ipAddress = urlencode(Helper::getIpAddress());	 
		
		
		
		//order information
		$returnUrl = urlencode($this->registry->conf['rooturl'].'site/checkout/payment/expresscheckoutreturn/1/invoice/' . $invoiceId . '?useraction=commit');
		$cancelUrl = urlencode($this->registry->conf['rooturl'].'site/checkout/payment/expresscheckoutreturn/1/cancel/1/invoice/' . $invoiceId);
		$logoImage = urlencode($this->registry->conf['rooturl'].$this->registry->currentTemplate.'/images/site/paypal_header.gif'); 
		$invNum = $invoiceId;
		
		//lay order product
		$orderProductList = Core_OrderProduct::getProducts(array('forderid' => $myOrder->id), '', '', '');	
		$myOrder->productList = $orderProductList;      
		
		$totalpriceCheck = 0;			
		$nvpStrItems = '';
		//Intergrate order details into the express checkout flow
		for($i=0; $i < count($orderProductList); $i++)
		{
			//echo $this->registry->currency->convertCurrency($items[$i]['realpriceValue'], 'usd', 'vnd');
			$totalpriceCheck = $totalpriceCheck + $orderProductList[$i]->unitCost * $orderProductList[$i]->quantity;
			$nvpStrItems .= '&L_NAME'.$i.'='.urlencode($orderProductList[$i]->productName).'&L_NUMBER'.$i.'='.($i+1).'&L_DESC'.$i.'='.urlencode($orderProductList[$i]->attribute).'&L_AMT'.$i.'='.urlencode($this->registry->currency->convertCurrency($orderProductList[$i]->unitCost, 'usd', 'vnd')).'&L_QTY'.$i.'='.$orderProductList[$i]->quantity.'';
		}
		
		$totalPriceString = $this->registry->currency->convertCurrency($myOrder->subtotal + $myOrder->shipprice + $myOrder->taxprice, 'usd', 'vnd'); 
		$itemAmount = $this->registry->currency->convertCurrency($totalpriceCheck, 'usd', 'vnd'); 
		$shipAmount = $this->registry->currency->convertCurrency($myOrder->shipprice, 'usd', 'vnd'); 
		$taxAmount = $this->registry->currency->convertCurrency($myOrder->taxprice, 'usd', 'vnd'); 
		
		//FIX AMOUNT FOREIGN EXCHANGE PROBLEM !important
		if($totalPriceString != ($itemAmount + $shipAmount + $taxAmount))
		{
			$shipAmount = $totalPriceString - $itemAmount - $taxAmount;
		}
		
		
		// Add request-specific fields to the request string.
		$nvpStr =	"&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID&RETURNURL=$returnUrl&CANCELURL=$cancelUrl".
					"&AMT=$totalPriceString&ALLOWNOTE=1&NAME=$name&useraction=commit".
					"&HDRIMG=$logoImage" . $nvpStrItems . 
					"&ITEMAMT=$itemAmount&TAXAMT=$taxAmount&SHIPPINGAMT=$shipAmount&INVNUM=$invNum";
					
		//die($nvpStr);			
		//process when user be redirected from paypal, using RETURN URL to payment
		if($expresscheckoutReturn == '1')
		{
			
			//Buyer cancel the transaction
			if($this->registry->router->getArg('cancel') == '1')
			{
				$this->registry->smarty->assign('cancel_return', 1);
			}
			else //Buyer accept the transaction, begin DoExpressCheckout to charge money
			{
				$payerId = $_GET['PayerID'];	
				$token = $_GET['token'];	
				
				$nvpStr .= "&PAYERID=$payerId&TOKEN=$token";
				$httpParsedResponseAr = $this->Paypal_PPHttpPost('DoExpressCheckoutPayment', '52.0', $nvpStr);
				
				//save the API Response for this order
				$myPaypalDirectResponse = new Core_PaypalDirectPaymentResponse();
				$myPaypalDirectResponse->orderId = $myOrder->id;
				$myPaypalDirectResponse->ack = $httpParsedResponseAr['ACK'];
				$myPaypalDirectResponse->apiversion = urldecode($httpParsedResponseAr['VERSION']);
				$myPaypalDirectResponse->apibuild = urldecode($httpParsedResponseAr['BUILD']);
				$myPaypalDirectResponse->timestamp = urldecode($httpParsedResponseAr['TIMESTAMP']);
				$myPaypalDirectResponse->correlationid = $httpParsedResponseAr['CORRELATIONID'];
				$myPaypalDirectResponse->ipaddress = urldecode($ipAddress);
				$myPaypalDirectResponse->serializeddata = serialize($httpParsedResponseAr);
				$myPaypalDirectResponse->addData();
				
				if(substr_count($httpParsedResponseAr["ACK"], 'Success') > 0)
				{
					//begin to update the time of paid order
					$myOrder->status = 'pending';
					$myOrder->paymentmethod = 'paypal_expresscheckout'; 
					
					//Update order
					$myOrder->datepaid = time();
					
					$this->finishOrder($myOrder, true);
					//exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
				} 
				else  
				{
					$myOrder->isTransactionFail = 1;
					$error = $httpParsedResponseAr;
					$invoiceId = '';
				}
				
				
				$myOrder->transactionid = $httpParsedResponseAr['CORRELATIONID'];
				$myOrder->updateData();
				
			}
		}
		else //send request to setExpressCheckout Only
		{
			// Execute the API operation; see the PPHttpPost function above.
			$httpParsedResponseAr = $this->Paypal_PPHttpPost('SetExpressCheckout', '53.0', $nvpStr);
			
			if($httpParsedResponseAr['ACK'] == 'Success')
			{
				if($this->registry->setting['payment']['paypal']['isTesting'] == '1')
				{
					$paypalUrl =  $this->registry->setting['payment']['paypal']['sandboxUrl'];
				}
				else
				{
					$paypalUrl =  $this->registry->setting['payment']['paypal']['liveUrl'];   	
				}
				$paypalUrl .= '?cmd=_express-checkout&token=' . urldecode($httpParsedResponseAr['TOKEN']) . '&useraction=commit';
				
				header("location: " . $paypalUrl);
				//exit();
			}
			else
			{
				$error = $httpParsedResponseAr;	
				$invoiceId = '';
			}
		}
		
		
		return $invoiceId;	 
	}
	
	
	
	/**
	 * Review order sau khi finish order tu trang paypal
	 *
	 */
	private function review($invoiceId = '')
	{
		$error = array();
		$success = array();
		$contents = '';
		
		if($invoiceId == '')
		{
			$invoiceId = $this->registry->router->getArg('invoiceid');
		}
		
		//cancel_return process
		if(strlen($invoiceId) == 0)
		{
			$this->registry->smarty->assign(array('cancel_return'	=> '1',
													'continueshoppingurl'	=> isset($_SESSION['continueshoppingurl'])?$_SESSION['continueshoppingurl']:'',
													));
		}
		else 
		{
			$invoiceId = Helper::queryFilterString($invoiceId);
			
			//return process
			//FIND CURRENT ORDER SHIPPING INFORMATION
			$myOrder = new Core_Order();
			$myOrder->getDataByInvoiceid($invoiceId);
			$myOrder->productList = Core_OrderProduct::getProducts(array('forderid' => $myOrder->id), '', '', '');
			
			if($myOrder->id > 0)
			{
				
				$this->registry->smarty->assign(array(	'totalprice' 		=> $myOrder->subtotal,
														'shippingprice'		=> $myOrder->shipprice,
														'taxprice'			=> $myOrder->taxprice,
														'totalpriceAfterTax'=> $myOrder->subtotal + $myOrder->shipprice + $myOrder->taxprice,
														'continueshoppingurl'	=> isset($_SESSION['continueshoppingurl'])?$_SESSION['continueshoppingurl']:'',
														'error' 			=> $error,
														'success' 			=> $success,
														'myOrder'			=> $myOrder,
														));
															
			}
			else 
			{
				//redirect to product page
				$this->registry->smarty->assign(array(	'redirect' => isset($_SESSION['continueshoppingurl'])?$_SESSION['continueshoppingurl']: $this->registry->conf['rooturl'].'site/product',
														'redirectMsg' => 'Order #'.$invoiceId.' not found',
														));
				$this->registry->smarty->display('redirect.tpl');
				exit();
			}
		}
		$contents = $this->registry->smarty->fetch($this->registry->smartyControllerContainer.'review.tpl'); 
			
		$this->registry->smarty->assign(array('contents' => $contents,
											'pageTitle' => $this->registry->lang['controller']['pageTitle'],
											'pageKeyword' => $this->registry->lang['controller']['pageKeyword'],
											'pageDescription' => $this->registry->lang['controller']['pageDescription'],
											));
		$this->registry->smarty->display($this->registry->smartyControllerGroupContainer.'index_checkout.tpl'); 
	}
	
		
	#########################################################
	############	FUNCTION
	########################################################
	
	private function checkCartEmpty()
	{
		if($this->registry->cart->itemCount() <= 0)       
		{
			$this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'].'memberarea.html?tab=payment',
													'redirectMsg' => $this->registry->lang['controller']['errCartEmpty']));
			$this->registry->smarty->display('redirect.tpl');
			exit();
		}
	}
	
	
	
		
	/**
	* Thuc hien thao tac them 1 row vao table order
	* 
	* @param array $orderInformation
	* @return int $orderId
	*/
	private function insertneworder($orderInformation, $memberId)
	{
		$myOrder = new Core_Order();
		$myOrder->status = 'pending';
		$myOrder->memberid = $memberId;
		$myOrder->contactemail = $orderInformation['contactemail'];
		$myOrder->comment = $orderInformation['comment'];
		$myOrder->shipService = $orderInformation['ship_service'];
		$myOrder->shipServiceName = $orderInformation['ship_service_name'];
		$myOrder->shipServiceCost = $orderInformation['ship_cost'];
		$myOrder->shipIsset = 1;
		$myOrder->shipIssetManual = 0;
		$myOrder->billingFirstname = $orderInformation['billing_firstname'];
		$myOrder->billingMid = $orderInformation['billing_mid'];
		$myOrder->billingLastname = $orderInformation['billing_lastname'];
		$myOrder->billingAddress = $orderInformation['billing_address'];
		$myOrder->billingAddress2 = $orderInformation['billing_address2'];
		$myOrder->billingZipcode = $orderInformation['billing_zipcode'];
		$myOrder->billingCity = $orderInformation['billing_city'];
		$myOrder->billingCityText = $orderInformation['billing_city_text'];
		$myOrder->billingRegion = $orderInformation['billing_region'];
		$myOrder->billingRegionText = $orderInformation['billing_region_text'];
		$myOrder->billingCountry = $orderInformation['billing_country'];
		$myOrder->billingCountryText = $orderInformation['billing_country_text'];
		$myOrder->billingPhone = $orderInformation['billing_phone'];
		$myOrder->billingPhone2 = $orderInformation['billing_phone2'];
		$myOrder->shippingFirstname = $orderInformation['shipping_firstname'];
		$myOrder->shippingMid = $orderInformation['shipping_mid'];
		$myOrder->shippingLastname = $orderInformation['shipping_lastname'];
		$myOrder->shippingAddress = $orderInformation['shipping_address'];
		$myOrder->shippingAddress2 = $orderInformation['shipping_address2'];
		$myOrder->shippingZipcode = $orderInformation['shipping_zipcode'];
		$myOrder->shippingCity = $orderInformation['shipping_city'];
		$myOrder->shippingCityText = $orderInformation['shipping_city_text'];
		$myOrder->shippingRegion = $orderInformation['shipping_region'];
		$myOrder->shippingRegionText = $orderInformation['shipping_region_text'];
		$myOrder->shippingCountry = $orderInformation['shipping_country'];
		$myOrder->shippingCountryText = $orderInformation['shipping_country_text'];
		$myOrder->shippingPhone = $orderInformation['shipping_phone'];
		$myOrder->shippingPhone2 = $orderInformation['shipping_phone2'];
		
		$myOrder->addData();
		
		return $myOrder;
	}
	
	
	private function invoiceRandomString($length)
	{
		$str = "";
	   	$chars = array("2","3","4","5","6","7","8","9");
	
		$count = count($chars) - 1;
	
	   	srand((double)microtime()*1000000);
	
		for($i = 0; $i < $length; $i++)
		{
			$str .= $chars[rand(0, $count)];
		}
	
	   return($str);
	}
	
	private function monthList()
	{
		$monthArray = array(
							'1'	=> 'January',
							'2' => 'February',
							'3' => 'March',
							'4' => 'April',
							'5' => 'May',
							'6' => 'June',
							'7' => 'July',
							'8' => 'August',
							'9' => 'September',
							'10' => 'October',
							'11' => 'November',
							'12' => 'December'
							);
		
		return $monthArray;
	}
	
	private function yearList($startYear = 0, $endYear = 0, $length = 10)
	{
		$today = getdate();
		
		if($startYear == 0)
		{
			$startYear = $today['year'];	
		}
		
		if($endYear == 0)
		{
			if($startYear == $today['year'])
			{
				$endYear = $startYear + $length;
			}
		}
		
		$yearArray = array();
		for($i = $startYear; $i <= $endYear; $i++)
		{
			$yearArray[$i] = $i;
		}
		
		return $yearArray;
	}
	
		
	/**
	* Create new order
	* 
	* @param array $error
	* @return Core_Order $myOrder
	*/
	private function processNewOrder(&$error)
	{
		//check & redirect if cart is empty
		$this->checkCartEmpty();
		
		
		//INIT CURRENT ORDER SHIPPING INFORMATION
		$orderInformation = $_SESSION['orderTemp'];
		
		$memberId = $this->registry->me->id;
		
		//insert new order
		$myOrder = $this->insertneworder($orderInformation, $memberId);
		
		if($myOrder->id > 0)
		{
			$invoiceId = $myOrder->id . $this->invoiceRandomString(5); 
			try 
			{
				$myOrder->invoiceid = $invoiceId;
				$myOrder->paymentmethod = 'placeorder';
				
				//UPDATE ORDER CODE TO IDENTIFY THIS ORDER     
				if($myOrder->updateData() == 0)
				{
					throw new Exception('update order failed.');	
				}
				
				
				//insert successfully
				$totalprice = 0;
				$totalQuantity = 0;
				$cartProductList = $this->registry->cart->getCartProducts();
				$myOrder->productList = array();
				
				
				for($i = 0; $i < count($cartProductList); $i++)
				{
					//refine price cho truong hop khach hang cu da tung order section khac
					//$this->refineProductPrice($cartProductList[$i]->product);
					if (strtolower($this->registry->me->country) === 'vn') {
                        $price = $cartProductList[$i]->product->price_vn;
                        $product_name = $cartProductList[$i]->product->name_vn;
                    } else {
                        $price = $cartProductList[$i]->product->price_en;
                        $product_name = $cartProductList[$i]->product->name_en;
                    }
                    $totalprice += $price;
					$cartProductList[$i]->attributeList = explode(';', $cartProductList[$i]->attribute);
					
					$myOrderProduct = new Core_OrderProduct($cartProductList[$i]->product->id, $product_name, $price, $cartProductList[$i]->quantity, $cartProductList[$i]->attribute, $myOrder->id);
					$myOrderProduct->addData();
					
					
					
					
					$myOrder->productList[] = $myOrderProduct;
				}
				
				//CALCULATE SHIPPING PRICE
				$shippingprice = 0;
				
				//CALCULATE TAX
				$taxValue = 0;
				$taxprice = $totalprice * $taxValue;
				
				//update current order
				$myOrder->subtotal = $totalprice;
				$myOrder->shipprice = $shippingprice;
				$myOrder->tax = $taxValue;
				$myOrder->taxprice = $taxprice;
				$myOrder->updateData();
			}
			catch (Exception $e)
			{
				$error[] = $this->registry->lang['controller']['paymentErrCreateOrder'];
				$myOrder->delete();
				$myOrder = new Core_Order();	//reinit order
			}
		}
		else 
		{
			$error[] = $this->registry->lang['controller']['paymentErrCreateOrder'];
			$myOrder = new Core_Order(); //reinit order
		}
		
		return $myOrder;
	}
	
	private function finishOrder(Core_Order $myOrder, $clearCart = true)
	{
		if($clearCart)
		{
			//CLEAR CART
			$this->registry->cart->emptyCart();
			$this->registry->cart->saveToSession();
		}
		
		//Update user paid section flag cho cac order da hoan tat
		if($myOrder->datepaid > 0 && $myOrder->isTransactionFail == 0)
		{
			//var_dump($myOrder->productList);
			for($i =0; $i < count($myOrder->productList); $i++)
			{
				//var_dump($myOrder->productList[$i]);				
				$myProduct = new Core_Product($myOrder->productList[$i]->productId);
				if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeColor']))
				{
					$this->registry->me->paidColor = 1;
				}
				
				if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeMono']))
				{
					$this->registry->me->paidMono = 1;
				}
				
				if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeNature']))
				{
					$this->registry->me->paidNature = 1;
				}
                
                if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeTravel']))
                {
                    $this->registry->me->paidTravel = 1;
                }
				
				
			}
			$this->registry->me->updateData();     
		}
		
		
		//send mail to notify
		$this->registry->smarty->assign(array(	'datecreated' 	=> date("F j, Y, g:i a"),
												'myOrder'		=> $myOrder,
												'productList'	=> $myOrder->productList,
												'totalprice'	=> $myOrder->subtotal,
												'shippingprice'	=> $myOrder->shipprice,
												'taxValue'		=> $myOrder->tax,
												'taxprice'		=> $myOrder->taxprice,
												'totalpriceAfterTax'=> $myOrder->subtotal + $myOrder->shipprice + $myOrder->taxprice,
												'fullname' 		=> $myOrder->billingFirstname . ' ' . $myOrder->billingMid . ' ' . $myOrder->billingLastname,
												'account' 		=> $myOrder->contactemail,
												'invoiceId' 	=> $myOrder->invoiceid,
												));
		
		$orderDetailContents = $this->registry->smarty->fetch($this->registry->smartyControllerGroupContainer.'order_print.tpl');  
		$this->registry->smarty->assign(array('orderDetailContents' => $orderDetailContents));
											
		//send mail to admin
		$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'order_admin.tpl');
		$sender = new SendMail(	$this->registry, 
								$this->registry->setting['mail']['toEmail'],
								$this->registry->setting['mail']['toName'],
								str_replace('{INVOICE_ID}', $myOrder->invoiceid, $this->registry->setting['mail']['subjectOrderAdmin']), 
								$mailContents,
								$this->registry->setting['mail']['fromEmail'],
								$this->registry->setting['mail']['fromName']);
		$sender->Send();
		
							
		
		//send mail to customer
		$mailContents = $this->registry->smarty->fetch($this->registry->smartyMailContainer.'order_client.tpl');
		$sender2 = new SendMail($this->registry,
								$myOrder->contactemail,
								$myOrder->billingFirstname . ' ' . $myOrder->shippingLastname,
								str_replace('{INVOICE_ID}', $myOrder->invoiceid, $this->registry->setting['mail']['subjectOrderClient']),      
								$mailContents,
								$this->registry->setting['mail']['fromEmail'],
								$this->registry->setting['mail']['fromName']);
		$sender2->Send();
	}
	
	///////////////////////////////////////////////////////////
	//	PAYPAL PROCESS
	
	//Ham tra ve 1 so loi thong thuong trong qua trinh send Request trong Paypal Direct Payment Pro API
	// @return: array
	private function getDirectPaymentCheckoutError($errorCheckout = '')
	{
		$errorArray = '';
		
		if($errorCheckout != '')
		{
			$errorArray = array();
			
			foreach($errorCheckout as $k=>$v)
			{
				if(substr($k, 0, 13) == 'L_LONGMESSAGE')
				{
					$errorArray[] = urldecode($v);
				}
			}
		}
		
		return $errorArray;
	}
	
	
	private function Paypal_PPHttpPost($methodName_, $version_, $nvpStr_) 
	{
		//simulator error return form paypal
		
		if($methodName_ == 'DoDirectPayment')
		{
			//test VISA credit card number: 4012888888881881
			//bo comment neu muon test successfully response from direct payment
			return array('ACK' => 'Success', 'VERSION' => '5.1','BUILD' => '1241212','TIMESTAMP' => '21hasdfasdf23/2232/1/','CORRELATIONID' => 'a123123123','L_LONGMESSAGE'	=> 'Paypal simulator error');
		}
		if($this->registry->setting['payment']['paypal']['isTesting'] == '1')
		{
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = urlencode($this->registry->setting['payment']['paypal']['sandboxApiUsername']);
			$API_Password = urlencode($this->registry->setting['payment']['paypal']['sandboxApiPassword']);
			$API_Signature = urlencode($this->registry->setting['payment']['paypal']['sandboxApiSignature']);
			$API_Endpoint = $this->registry->setting['payment']['paypal']['sandboxApiEndpointSignatureNvp'];
		}
		else
		{
			// Set up your API credentials, PayPal end point, and API version.
			$API_UserName = urlencode($this->registry->setting['payment']['paypal']['liveApiUsername']);
			$API_Password = urlencode($this->registry->setting['payment']['paypal']['liveApiPassword']);
			$API_Signature = urlencode($this->registry->setting['payment']['paypal']['liveApiSignature']);
			$API_Endpoint = $this->registry->setting['payment']['paypal']['liveApiEndpointSignatureNvp'];
		}
		
		
		$version = urlencode($version_);

		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);

		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		//echo '<p>'.$nvpreq.'</p';

		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		// Get response from the server.
		$httpResponse = curl_exec($ch);

		if(!$httpResponse) 
		{
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}

		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
		
		

		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) 
		{
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) 
			{
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}

		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}

		return $httpParsedResponseAr;
	}
	
	/**
	* Dua theo section dang pay va cac section da pay truoc de, de tinh ra gia moi
	* 
	* CHu khong phai moi lan mua la lay gia moi.
	* 
	* VD: Mua 1 section gia 100, 2 section gia 150, 3 section gia 220
	* Neu User da tung mua 2 section roi, thi khi mua section con lai thi chi lay gia la (200-150) = 70 chu khong
	* phai lay gia cua 1 section rieng re la 100.
	* 
	* @param Core_Product $myProduct
	*/
	private function refineProductPrice(Core_NewProduct $myProduct)
	{
		$formData = array();
		
		//step 1: old order
		//xu ly thong tin ma user nay da order truoc do
		$formData['fpaylocation'] = Core_Product::getPayLocation();
		/*if($this->registry->me->paidColor == 1)
			$formData['fpaymentsection'][] = 'color';
			
		if($this->registry->me->paidMono == 1)
			$formData['fpaymentsection'][] = 'mono';
			
		if($this->registry->me->paidNature == 1)
			$formData['fpaymentsection'][] = 'nature';
        
        if($this->registry->me->paidTravel == 1)
            $formData['fpaymentsection'][] = 'travel';*/
			
		//lay thong tin cua packet ma user nay hien da paid
		/*$productOld = new Core_Product();
		if(!empty($formData['fpaymentsection']))
		{
			$packIdOld = Core_Product::calculatePackId($formData['fpaylocation'], $formData['fpaymentsection']);
			$productOld->getDataByBinCode($packIdOld);
		}
		
		//step 2: new order
		//xu ly thong tin cu va moi de tim ra gia moi co bao gom myProduct
		if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeColor']))
			$formData['fpaymentsection'][] = 'color';
		if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeMono']))
			$formData['fpaymentsection'][] = 'mono';
		if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeNature']))
			$formData['fpaymentsection'][] = 'nature';
        if(in_array($myProduct->bincode, $this->registry->setting['payment']['packBinCodeTravel']))
            $formData['fpaymentsection'][] = 'travel';
		//lay packID cua order moi
		$packIdNew = Core_Product::calculatePackId($formData['fpaylocation'], $formData['fpaymentsection']);
		$productNew = new Core_Product();
		$productNew->getDataByBinCode($packIdNew);
		
		//Check lech gia giua new va old chinh la gia ma user nay se phai tra cho order nay
		$myProduct->price = $productNew->price - $productOld->price;*/
	}
	
	
}

?>