<?php

Class Core_OrderProduct extends Core_Object
{
	public $orderId = 0;
	public $id;
	public $productId = 0;
	public $productName = '';
	public $quantity = 0;
	public $attribute = '';
	public $attributeList = array();
	public $unitCost = 0;
	public $subtotal = 0;
	
	public function __construct($productId = 0, $productName = '', $unitCost = 0, $quantity = 0, $attribute = '', $orderId = 0)
	{
		global $registry;
		
		parent::__construct($id);                
		
		$this->orderId = $orderId;
		$this->quantity = $quantity;
		$this->attribute = $attribute;	
		$this->productId = $productId;
		$this->productName = $productName;
		$this->unitCost = $unitCost;
		$this->subtotal = $quantity * $unitCost;
	}
	
	public function addData()
	{
		global $registry;
		
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'order_detail(o_id, p_id, od_productname, od_quantity, od_attribute, od_unitcost)
				VALUES(?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->orderId, 
		    	(int)$this->productId,
		    	(string)$this->productName,
		    	(string)$this->quantity,
		    	(string)$this->attribute,
		    	(string)$this->unitCost,
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'order_detail
        		WHERE od_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
	}
	
	public static function deleteFromOrder($orderId)
	{
		global $registry;
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'order_detail
				WHERE o_id = ?';
				
		$rowCount = $registry->db->query($sql, array((int)$orderId))->rowCount();
		
		return $rowCount;
	}
	
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'order_detail
				WHERE od_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->orderId = $row['o_id'];
			$this->productId = $row['p_id'];
			$this->id = $row['od_id'];
			$this->productName = $row['od_productname'];
			$this->quantity = $row['od_quantity'];
			$this->attribute = $row['od_attribute'];
			$this->unitCost = $row['od_unitcost'];
			$this->subtotal = $row['od_quantity'] * $row['od_unitcost'];
		}
	}
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'order_detail
        		SET od_productname = ?,
        			od_quantity = ?,
        			od_attribute = ?,
        			od_unitcost = ?
        		WHERE od_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->productName,
				$this->quantity,
				$this->attribute,
				$this->unitCost,
		    	$this->id
			));
			
		
		return $stmt;
	}
	
	public static function countList($where = 'od_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'order_detail
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'od_id > 0', $order = 'od_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'order_detail
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myOrderProduct = new Core_OrderProduct();
			
			$myOrderProduct->orderId = $row['o_id'];
			$myOrderProduct->productId = $row['p_id'];
			$myOrderProduct->id = $row['od_id'];
			$myOrderProduct->productName = $row['od_productname'];
			$myOrderProduct->quantity = $row['od_quantity'];
			$myOrderProduct->attribute = $row['od_attribute'];
			$myOrderProduct->attributeList = explode(';', $row['od_attribute']);
			$myOrderProduct->unitCost = $row['od_unitcost'];
			$myOrderProduct->subtotal = $row['od_quantity'] * $row['od_unitcost'];
				
			$outputList[] = $myOrderProduct;
		}
		return $outputList;
	}
	
	public static function getProducts($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'od_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND od_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['forderid'] > 0)
		{
			$whereString .= ' AND o_id = '.(int)$formData['forderid'].' ';
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'id')
			$orderString = ' od_id ' . $sorttype;    
		else
			$orderString = ' od_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>