<?php

Class Core_Order extends Core_Object
{
	public $id = 0;
	public $invoiceid = 0;
	public $subtotal = 0;
	public $shipprice = 0;
	public $tax = '';
	public $taxprice = '';
	public $weightinkg = '';
	public $datecreated = 0;
	public $datemodified = 0;
	public $dateshipped = 0;
	public $status = '';	//cancel, pending, completed, error
	public $datepaid = 0;
	public $transactionid = '';
	public $paymentmethod = '';	//paypal_direct, paypal_expresscheckout, nganluongvn_advanced, money_transfer
	public $isTransactionFail = 0;
	public $updateQuantityCompleted = 0;
	public $comment = '';
	public $memberid = 0;
	public $contactemail = '';
	public $shipService = 0;
	public $shipServiceName = '';
	public $shipServiceCost = 0;
	public $shipIsset = 0;
	public $shipIssetManual = 0;
	public $shipEachAdditional = 0;
	public $shipSurcharge = 0;
	public $shipFree = 0;
	public $billingFirstname = '';
	public $billingMid = '';
	public $billingLastname = '';
	public $billingAddress = '';
	public $billingAddress2 = '';
	public $billingZipcode = '';
	public $billingCity = 0;
	public $billingCityText = '';
	public $billingRegion = 0;
	public $billingRegionText = '';
	public $billingCountry = '';
	public $billingCountryText = '';
	public $billingPhone = '';
	public $billingPhone2 = '';
	public $shippingFirstname = '';
	public $shippingMid = '';
	public $shippingLastname = '';
	public $shippingAddress = '';
	public $shippingAddress2 = '';
	public $shippingZipcode = '';
	public $shippingCity = 0;
	public $shippingCityText = '';
	public $shippingRegion = 0;
	public $shippingRegionText = '';
	public $shippingCountry = '';
	public $shippingCountryText = '';
	public $shippingPhone = '';
	public $shippingPhone2 = '';
	
	public $productList;
	
	
	public function __construct($id = 0)
	{
		parent::__construct($id);                
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData()
	{
		$this->datecreated = time();
		
	
		//them thong tin chung
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'order( `o_datecreated`, `o_status`, `o_memberid`, `o_contactemail`, `o_comment`,
													   `o_ship_service`, `o_ship_service_name`, `o_ship_cost`, `o_ship_isset`, `o_ship_isset_manual`,
													   `o_billing_firstname`, `o_billing_mid`, `o_billing_lastname`, `o_billing_address`, `o_billing_address2`, 
													   `o_billing_city`, `o_billing_region`, `o_billing_country`,
													   `o_billing_city_text`, `o_billing_region_text`, `o_billing_country_text`,
													   `o_billing_zipcode`, `o_billing_phone`, `o_billing_phone2`,
													   `o_shipping_firstname`, `o_shipping_mid`, `o_shipping_lastname`, `o_shipping_address`, `o_shipping_address2`, 
													   `o_shipping_city`, `o_shipping_region`, `o_shipping_country`,
													   `o_shipping_city_text`, `o_shipping_region_text`, `o_shipping_country_text`,
													   `o_shipping_zipcode`, `o_shipping_phone`, `o_shipping_phone2`)
					VALUES(?, ?, ?, ?, ?,
						   ?, ?, ?, ?, ?,
						   ?, ?, ?, ?, ?, 
						   ?, ?, ?,
						   ?, ?, ?,
						   ?, ?, ?,  
						   ?, ?, ?, ?, ?, 
						   ?, ?, ?,
						   ?, ?, ?,
						   ?, ?, ?)';
				
		$rowCount = $this->db->query($sql, array(
		    	$this->datecreated, (string)$this->status, (int)$this->memberid, (string)$this->contactemail, (string)$this->comment,
		    	(int)$this->shipService, (string)$this->shipServiceName, (float)$this->shipServiceCost, (int)$this->shipIsset, (int)$this->shipIssetManual,
		    	(string)$this->billingFirstname, (string)$this->billingMid, (string)$this->billingLastname, (string)$this->billingAddress, (string)$this->billingAddress2,
		    	(int)$this->billingCity, (int)$this->billingRegion, (string)$this->billingCountry,
		    	(string)$this->billingCityText, (string)$this->billingRegionText, (string)$this->billingCountryText,
		    	(string)$this->billingZipcode, (string)$this->billingPhone, (string)$this->billingPhone2,
		    	(string)$this->shippingFirstname, (string)$this->shippingMid, (string)$this->shippingLastname, (string)$this->shippingAddress, (string)$this->shippingAddress2,
		    	(int)$this->shippingCity, (int)$this->shippingRegion, (string)$this->shippingCountry,
		    	(string)$this->shippingCityText, (string)$this->shippingRegionText, (string)$this->shippingCountryText,
		    	(string)$this->shippingZipcode, (string)$this->shippingPhone, (string)$this->shippingPhone2,
		    	
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		global $setting;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'order
        		WHERE o_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		//xoa cac order_product
		Core_OrderProduct::deleteFromOrder($this->id);
					
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'order
				WHERE o_id = ?';
		$row = $this->db->query($sql, array($id))->fetch();
		
		$this->id = $row['o_id'];
		$this->invoiceid = $row['o_invoiceid'];
		$this->subtotal = $row['o_subtotal'];
		$this->shipprice = $row['o_ship_price'];
		$this->tax = $row['o_tax'];
		$this->taxprice = $row['o_tax_price'];
		$this->weightinkg = $row['o_weight_in_kg'];
		$this->datecreated = $row['o_datecreated'];
		$this->datemodified = $row['o_datemodified'];
		$this->dateshipped = $row['o_dateshipped'];
		$this->status = $row['o_status'];
		$this->datepaid = $row['o_datepaid'];
		$this->transactionid = $row['o_transactionid'];
		$this->paymentmethod = $row['o_paymentmethod'];
		$this->isTransactionFail = $row['o_is_transaction_failure'];
		$this->updateQuantityCompleted = $row['o_updatequantity_completed'];
		$this->comment = $row['o_comment'];
		$this->memberid = $row['o_memberid'];
		$this->contactemail = $row['o_contactemail'];
		$this->shipService = $row['o_ship_service'];
		$this->shipServiceName = $row['o_ship_service_name'];
		$this->shipServiceCost = $row['o_ship_cost'];
		$this->shipIsset = $row['o_ship_isset'];
		$this->shipIssetManual = $row['o_ship_isset_manual'];
		$this->shipEachAdditional = $row['o_ship_eachadditional'];
		$this->shipSurcharge = $row['o_ship_surcharge'];
		$this->shipFree = $row['o_ship_isfreeshipping'];
		$this->billingFirstname = $row['o_billing_firstname'];
		$this->billingMid = $row['o_billing_mid'];
		$this->billingLastname = $row['o_billing_lastname'];
		$this->billingAddress = $row['o_billing_address'];
		$this->billingAddress2 = $row['o_billing_address2'];
		$this->billingZipcode = $row['o_billing_zipcode'];
		$this->billingCity = $row['o_billing_city'];
		$this->billingCityText = $row['o_billing_city_text'];
		$this->billingRegion = $row['o_billing_region'];
		$this->billingRegionText = $row['o_billing_region_text'];
		$this->billingCountry = $row['o_billing_country'];
		$this->billingCountryText = $row['o_billing_country_text'];
		$this->billingPhone = $row['o_billing_phone'];
		$this->billingPhone2 = $row['o_billing_phone2'];
		$this->shippingFirstname = $row['o_shipping_firstname'];
		$this->shippingMid = $row['o_shipping_mid'];
		$this->shippingLastname = $row['o_shipping_lastname'];
		$this->shippingAddress = $row['o_shipping_address'];
		$this->shippingAddress2 = $row['o_shipping_address2'];
		$this->shippingZipcode = $row['o_shipping_zipcode'];
		$this->shippingCity = $row['o_shipping_city'];
		$this->shippingCityText = $row['o_shipping_city_text'];
		$this->shippingRegion = $row['o_shipping_region'];
		$this->shippingRegionText = $row['o_shipping_region_text'];
		$this->shippingCountry = $row['o_shipping_country'];
		$this->shippingCountryText = $row['o_shipping_country_text'];
		$this->shippingPhone = $row['o_shipping_phone'];
		$this->shippingPhone2 = $row['o_shipping_phone2'];
	}
	
	public function getDataByInvoiceid($invoiceid)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'order
				WHERE o_invoiceid = ?';
		$row = $this->db->query($sql, array($invoiceid))->fetch();
		
		$this->id = $row['o_id'];
		$this->invoiceid = $row['o_invoiceid'];
		$this->subtotal = $row['o_subtotal'];
		$this->shipprice = $row['o_ship_price'];
		$this->tax = $row['o_tax'];
		$this->taxprice = $row['o_tax_price'];
		$this->weightinkg = $row['o_weight_in_kg'];
		$this->datecreated = $row['o_datecreated'];
		$this->datemodified = $row['o_datemodified'];
		$this->dateshipped = $row['o_dateshipped'];
		$this->status = $row['o_status'];
		$this->datepaid = $row['o_datepaid'];
		$this->transactionid = $row['o_transactionid'];
		$this->paymentmethod = $row['o_paymentmethod'];
		$this->isTransactionFail = $row['o_is_transaction_failure'];
		$this->updateQuantityCompleted = $row['o_updatequantity_completed'];
		$this->comment = $row['o_comment'];
		$this->memberid = $row['o_memberid'];
		$this->contactemail = $row['o_contactemail'];
		$this->shipService = $row['o_ship_service'];
		$this->shipServiceName = $row['o_ship_service_name'];
		$this->shipServiceCost = $row['o_ship_cost'];
		$this->shipIsset = $row['o_ship_isset'];
		$this->shipIssetManual = $row['o_ship_isset_manual'];
		$this->shipEachAdditional = $row['o_ship_eachadditional'];
		$this->shipSurcharge = $row['o_ship_surcharge'];
		$this->shipFree = $row['o_ship_isfreeshipping'];
		$this->billingFirstname = $row['o_billing_firstname'];
		$this->billingMid = $row['o_billing_mid'];
		$this->billingLastname = $row['o_billing_lastname'];
		$this->billingAddress = $row['o_billing_address'];
		$this->billingAddress2 = $row['o_billing_address2'];
		$this->billingZipcode = $row['o_billing_zipcode'];
		$this->billingCity = $row['o_billing_city'];
		$this->billingCityText = $row['o_billing_city_text'];
		$this->billingRegion = $row['o_billing_region'];
		$this->billingRegionText = $row['o_billing_region_text'];
		$this->billingCountry = $row['o_billing_country'];
		$this->billingCountryText = $row['o_billing_country_text'];
		$this->billingPhone = $row['o_billing_phone'];
		$this->billingPhone2 = $row['o_billing_phone2'];
		$this->shippingFirstname = $row['o_shipping_firstname'];
		$this->shippingMid = $row['o_shipping_mid'];
		$this->shippingLastname = $row['o_shipping_lastname'];
		$this->shippingAddress = $row['o_shipping_address'];
		$this->shippingAddress2 = $row['o_shipping_address2'];
		$this->shippingZipcode = $row['o_shipping_zipcode'];
		$this->shippingCity = $row['o_shipping_city'];
		$this->shippingCityText = $row['o_shipping_city_text'];
		$this->shippingRegion = $row['o_shipping_region'];
		$this->shippingRegionText = $row['o_shipping_region_text'];
		$this->shippingCountry = $row['o_shipping_country'];
		$this->shippingCountryText = $row['o_shipping_country_text'];
		$this->shippingPhone = $row['o_shipping_phone'];
		$this->shippingPhone2 = $row['o_shipping_phone2'];
	}
	
	
	
	public function updateData()
	{               
		global $registry;    
		
		$this->datemodified = time();
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'order
        		SET o_invoiceid = ?,
        			o_subtotal = ?,
        			o_ship_price = ?,
        			o_tax = ?,
        			o_tax_price = ?,
        			o_weight_in_kg = ?,
        			o_datemodified = ?,
        			o_dateshipped = ?,
        			o_status = ?,
        			o_datepaid = ?,
        			o_transactionid = ?,
        			o_paymentmethod = ?,
        			o_is_transaction_failure = ?,
        			o_updatequantity_completed = ?,
        			o_comment = ?,
        			o_memberid = ?,
        			o_contactemail = ?,
        			o_ship_service = ?,
        			o_ship_service_name = ?,
        			o_ship_cost = ?,
        			o_ship_isset = ?,
        			o_ship_isset_manual = ?,
        			o_ship_eachadditional = ?,
        			o_ship_surcharge = ?,
        			o_ship_isfreeshipping = ?,
        			o_billing_firstname = ?,
        			o_billing_mid = ?,
        			o_billing_lastname = ?,
        			o_billing_address = ?,
        			o_billing_address2 = ?,
        			o_billing_zipcode = ?,
        			o_billing_city = ?,
        			o_billing_city_text = ?,
        			o_billing_region = ?,
        			o_billing_region_text = ?,
        			o_billing_country = ?,
        			o_billing_country_text = ?,
        			o_billing_phone = ?,
        			o_billing_phone2 = ?,
        			o_shipping_firstname = ?,
        			o_shipping_mid = ?,
        			o_shipping_lastname = ?,
        			o_shipping_address = ?,
        			o_shipping_address2 = ?,
        			o_shipping_zipcode = ?,
        			o_shipping_city = ?,
        			o_shipping_city_text = ?,
        			o_shipping_region = ?,
        			o_shipping_region_text = ?,
        			o_shipping_country = ?,
        			o_shipping_country_text = ?,
        			o_shipping_phone = ?,
        			o_shipping_phone2 = ?
        		WHERE o_id = ?';
        		
		$rowCount = $this->db->query($sql, array(
			(string)$this->invoiceid,
			(float)$this->subtotal,
			(float)$this->shipprice,
			(float)$this->tax,
			(float)$this->taxprice,
			(float)$this->weightinkg,
			(int)$this->datemodified,
			(int)$this->dateshipped,
			(string)$this->status,
			(int)$this->datepaid,
			(string)$this->transactionid,
			(string)$this->paymentmethod,
			(int)$this->isTransactionFail,
			(int)$this->updateQuantityCompleted,
			(string)$this->comment,
			(int)$this->memberid,
			(string)$this->contactemail,
			(int)$this->shipService,
			(string)$this->shipServiceName,
			(float)$this->shipServiceCost,
			(int)$this->shipIsset,
			(int)$this->shipIssetManual,
			(float)$this->shipEachAdditional,
			(float)$this->shipSurcharge,
			(int)$this->shipFree,
			(string)$this->billingFirstname,
			(string)$this->billingMid,
			(string)$this->billingLastname,
			(string)$this->billingAddress,
			(string)$this->billingAddress2,
			(string)$this->billingZipcode,
			(int)$this->billingCity,
			(string)$this->billingCityText,
			(int)$this->billingRegion,
			(string)$this->billingRegionText,
			(string)$this->billingCountry,
			(string)$this->billingCountryText,
			(string)$this->billingPhone,
			(string)$this->billingPhone2,
			(string)$this->shippingFirstname,
			(string)$this->shippingMid,
			(string)$this->shippingLastname,
			(string)$this->shippingAddress,
			(string)$this->shippingAddress2,
			(string)$this->shippingZipcode,
			(int)$this->shippingCity,
			(string)$this->shippingCityText,
			(int)$this->shippingRegion,
			(string)$this->shippingRegionText,
			(string)$this->shippingCountry,
			(string)$this->shippingCountryText,
			(string)$this->shippingPhone,
			(string)$this->shippingPhone2,
		    (int)$this->id
			))->rowCount();
			
		return $rowCount;
	}
	
	public static function countList($where = 'o_id > 0 ')
	{
		global $db, $registry;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'order
				WHERE ' . $where;
				
		return $db->query($sql, array())->fetchSingle();
	}
	
	public static function getList($where = 'o_id > 0', $order = 'o_id DESC' , $limit = '')
	{
		global $db, $registry;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'order
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql, array());
		while($row = $stmt->fetch())
		{
			$myOrder = new Core_Order();
			
			$myOrder->id = $row['o_id'];
			$myOrder->invoiceid = $row['o_invoiceid'];
			$myOrder->subtotal = $row['o_subtotal'];
			$myOrder->shipprice = $row['o_ship_price'];
			$myOrder->tax = $row['o_tax'];
			$myOrder->taxprice = $row['o_tax_price'];
			$myOrder->weightinkg = $row['o_weight_in_kg'];
			$myOrder->datecreated = $row['o_datecreated'];
			$myOrder->datemodified = $row['o_datemodified'];
			$myOrder->dateshipped = $row['o_dateshipped'];
			$myOrder->status = $row['o_status'];
			$myOrder->datepaid = $row['o_datepaid'];
			$myOrder->transactionid = $row['o_transactionid'];
			$myOrder->paymentmethod = $row['o_paymentmethod'];
			$myOrder->isTransactionFail = $row['o_is_transaction_failure'];
			$myOrder->updateQuantityCompleted = $row['o_updatequantity_completed'];
			$myOrder->comment = $row['o_comment'];
			$myOrder->memberid = $row['o_memberid'];
			$myOrder->contactemail = $row['o_contactemail'];
			$myOrder->shipService = $row['o_ship_service'];
			$myOrder->shipServiceName = $row['o_ship_service_name'];
			$myOrder->shipServiceCost = $row['o_ship_cost'];
			$myOrder->shipIsset = $row['o_ship_isset'];
			$myOrder->shipIssetManual = $row['o_ship_isset_manual'];
			$myOrder->shipEachAdditional = $row['o_ship_eachadditional'];
			$myOrder->shipSurcharge = $row['o_ship_surcharge'];
			$myOrder->shipFree = $row['o_ship_isfreeshipping'];
			$myOrder->billingFirstname = $row['o_billing_firstname'];
			$myOrder->billingMid = $row['o_billing_mid'];
			$myOrder->billingLastname = $row['o_billing_lastname'];
			$myOrder->billingAddress = $row['o_billing_address'];
			$myOrder->billingAddress2 = $row['o_billing_address2'];
			$myOrder->billingZipcode = $row['o_billing_zipcode'];
			$myOrder->billingCity = $row['o_billing_city'];
			$myOrder->billingCityText = $row['o_billing_city_text'];
			$myOrder->billingRegion = $row['o_billing_region'];
			$myOrder->billingRegionText = $row['o_billing_region_text'];
			$myOrder->billingCountry = $row['o_billing_country'];
			$myOrder->billingCountryText = $row['o_billing_country_text'];
			$myOrder->billingPhone = $row['o_billing_phone'];
			$myOrder->billingPhone2 = $row['o_billing_phone2'];
			$myOrder->shippingFirstname = $row['o_shipping_firstname'];
			$myOrder->shippingMid = $row['o_shipping_mid'];
			$myOrder->shippingLastname = $row['o_shipping_lastname'];
			$myOrder->shippingAddress = $row['o_shipping_address'];
			$myOrder->shippingAddress2 = $row['o_shipping_address2'];
			$myOrder->shippingZipcode = $row['o_shipping_zipcode'];
			$myOrder->shippingCity = $row['o_shipping_city'];
			$myOrder->shippingCityText = $row['o_shipping_city_text'];
			$myOrder->shippingRegion = $row['o_shipping_region'];
			$myOrder->shippingRegionText = $row['o_shipping_region_text'];
			$myOrder->shippingCountry = $row['o_shipping_country'];
			$myOrder->shippingCountryText = $row['o_shipping_country_text'];
			$myOrder->shippingPhone = $row['o_shipping_phone'];
			$myOrder->shippingPhone2 = $row['o_shipping_phone2'];
				
			$outputList[] = $myOrder;
		}
		return $outputList;
	}
	
	public static function getOrders($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'o_is_transaction_failure = 0';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND o_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['finvoiceid'] > 0)
		{
			$whereString .= ' AND o_invoiceid = '.(int)$formData['finvoiceid'].' ';
		}
		
		if($formData['fmemberid'] > 0 && $formData['fcontactemail'] != '')
		{
			$whereString .= ' AND (o_memberid = '.(int)$formData['fmemberid'].' OR o_contactemail = "'.$formData['fcontactemail'].'" )';
		}
		elseif($formData['fmemberid'] > 0)
		{
			$whereString .= ' AND o_memberid = '.(int)$formData['fmemberid'].' ';            
		}
		elseif($formData['fcontactemail'] != '')
		{
			$whereString .= ' AND o_contactemail = "'.$formData['fcontactemail'].'"';            	
		}
		
		if(strlen($formData['fkeyword']) > 0)
		{
			
			if($formData['fsearchin'] == 'invoiceid')
			{
				$whereString .= ' AND (o_invoiceid LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'status')
			{
				$whereString .= ' AND (o_status LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'paymentmethod')
			{
				$whereString .= ' AND (o_paymentmethod LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'firstname')
			{
				$whereString .= ' AND (o_billing_firstname LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_firstname LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'lastname')
			{
				$whereString .= ' AND (o_billing_lastname LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_lastname LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'phone')
			{
				$whereString .= ' AND (o_billing_phone LIKE \'%'.$formData['fkeyword'].'%\' OR o_billing_phone2 LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_phone LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_phone2 LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'comment')
			{
				$whereString .= ' AND (o_comment LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'email')
			{
				$whereString .= ' AND (o_contactemail LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'address')
			{
				$whereString .= ' AND (o_billing_address LIKE \'%'.$formData['fkeyword'].'%\' OR o_billing_address2 LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_address LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_address2 LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'city')
			{
				$whereString .= ' AND (o_billing_city_text LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_city_text LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'region')
			{
				$whereString .= ' AND (o_billing_region_text LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_region_text LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'country')
			{
				$whereString .= ' AND (o_billing_country_text LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_country_text LIKE \'%'.$formData['fkeyword'].'%\')';
			}
			elseif($formData['fsearchin'] == 'zipcode')
			{
				$whereString .= ' AND (o_billing_zipcode LIKE \'%'.$formData['fkeyword'].'%\' OR o_shipping_zipcode LIKE \'%'.$formData['fkeyword'].'%\')';
			}
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'subtotal')
			$orderString = ' o_subtotal ' . $sorttype;    
		elseif($sortby == 'dateship')
			$orderString = ' o_dateshipped ' . $sorttype;    
		elseif($sortby == 'status')
			$orderString = ' o_status ' . $sorttype;    
		elseif($sortby == 'datepaid')
			$orderString = ' o_datepaid ' . $sorttype;    
		else
			$orderString = ' o_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
}


?>