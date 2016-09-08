<?php

Class Controller_Site_Cart Extends Controller_Site_Base 
{
	
	/**
	* Xem gio hang
	* 
	*/
	function indexAction() 
	{
		if(!empty($_POST['btnUpdate']) || !empty($_POST['btnUpdate_x']))
		{
			//cap nhat so luong san pham
			if(!empty($_POST['fquantity']))
			{
				//clear current cart
				$this->registry->cart->emptyCart();
				
				$items = $_POST['fquantity'];
				
				foreach($items as $key=>$quantity)
				{
					$quantity = (int)$quantity;
					$group = explode(':', $key);
					
					if((int)$quantity > 0)
						$this->registry->cart->addItem($group[0], $quantity, $group[1]);
				}
				
				$this->registry->cart->saveToSession();
				
				$success[] = $this->registry->lang['controller']['quantityUpdateSucc'];
			}
			else 
			{
				$error[] = $this->registry->lang['controller']['quantityUpdateErrDataInvalid'];   
			}
		}
		
		
		//get all product in current cart
		$cartProductList = $this->registry->cart->getCartProducts();
		
		//var_dump($productList);
		
		$this->registry->smarty->assign(
			array('cartProductList' => $cartProductList,
					'success' => $success,
					'error'	=> $error
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
	
	/**
	* Them san pham vao gio hang
	* 
	*/
	function addAction()
	{
		$id = (int)$this->registry->router->getArg('id');
        $myProduct = new Core_Product($id);
        if($myProduct->id > 0)
        {             
        	$quantity = isset($_POST['fquantity'])?(int)($_POST['fquantity']):1;
			if($quantity < 1)
				$quantity = 1;
				                   
			/*
        	if(count($myProduct->attributeList) > 0)
        	{
        		$attributeList = Core_ProductAttribute::getAttributes(array(), '', '', '');
        		foreach($myProduct->attributeList as $aId => $aValue)
        		{            
        			//var_dump($_POST['fattribute'][$aId], $aValue);               
        			if(in_array($_POST['fattribute'][$aId], $aValue))
        			{
        				$itemAttribute .= $attributeList[$aId]->name[$this->registry->langCode] . ':' . $attributeList[$aId]->valueSetData[$this->registry->langCode][$_POST['fattribute'][$aId]] . ';';  
					}
					else
					{
						$redirectMsg = $this->registry->lang['controller']['errAttributeRequired'];
			            $this->registry->smarty->assign(array('redirect' => $myProduct->getFullUrl(),
			                                                    'redirectMsg' => $redirectMsg,
			                                                    ));
			            $this->registry->smarty->display('redirect.tpl');
			            exit();
					}
				}
			}
			*/
			
			//var_dump($id, $quantity, $itemAttribute);
			
			$this->registry->cart->addItem($id, $quantity, base64_encode($itemAttribute));
			$this->registry->cart->saveToSession();
			
			//redirect to cart page
			header('location: ' . $this->registry->conf['rooturl'] . 'site/cart');
			
		}
		else
		{
			$redirectMsg = $this->registry->lang['controller']['errNotFound'];
            $this->registry->smarty->assign(array('redirect' => $this->registry->conf['rooturl'].'cart',
                                                    'redirectMsg' => $redirectMsg,
                                                    ));
            $this->registry->smarty->display('redirect.tpl');
		}
	}

	/**
	* xoa 1 san pham khoi gio hang hoac xoa tat ca gio hang
	* 
	*/
	function deleteAction()
	{
		$id = (int)($this->registry->router->getArg('id'));
		//remove 1 item
		if($id > 0)
		{
			$attribute = $this->registry->router->getArg('attribute');
			$this->registry->cart->delItem($id, $attribute);
			
			$this->registry->cart->saveToSession();
			
		}
		else //empty card
		{
			//CLEAR CART
			$this->registry->cart->emptyCart();
			$this->registry->cart->saveToSession();
			$this->view();
		}
		
		$return = $this->registry->router->getArg('return');
		
		if($return == '')
		{
			header('location: ' . $this->registry->conf['rooturl'] . 'site/cart');
		}
	}
	
	
	
	
}

?>