<?php

Class Core_LocationRegion extends Core_Object
{
	public $id = 0;
	public $countrycode = '';
	public $name = '';
	public $tax = 0;
	public $enable = 1;
	public $order = 0;
	
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
		$this->order = $this->getOrder();
		
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'loc_region(lr_country, lr_name, lr_tax, lr_enable, lr_order)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->countrycode, 
		    	(string)$this->name,
		    	(float)$this->tax,
		    	(int)$this->enable,
		    	(int)$this->order
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
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_region
        		WHERE lr_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($rowCount > 0)
		{
			//xoa tat ca city
			
			//tien hanh xoa ship price cua country nay
			Core_LocationShip::deleteFromLocation(array('fcountry' => $this->countrycode, 'fregion' => $this->id));
		}
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_region lr
				WHERE lr_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['lr_id'];
			$this->countrycode = $row['lr_country'];
			$this->name = $row['lr_name'];
			$this->tax = $row['lr_tax'];
			$this->enable = $row['lr_enable'];
			$this->order = $row['lr_order'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'loc_region
        		SET lr_country = ?,
        			lr_name = ?,
        			lr_tax = ?,
        			lr_enable = ?,
        			lr_order = ?
        		WHERE lr_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->countrycode,
				$this->name,
				$this->tax,
		    	$this->enable,
		    	$this->order,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'lr_id > 0')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'loc_region  lr
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function checkExisted($formData)
	{
		
		if($type == 'add')
		{
			$where = 'lr_country = "'.$formData['fcountrycode'].'" AND lr_name = "'.$formData['fname'].'" ';
		}
		elseif($type = 'edit')
		{
			$where = 'lr_country = "'.$formData['fcountrycode'].'" AND lr_name = "'.$formData['fname'].'" AND lr_id <> "'.$formData['fid'].'" ';
		}
		
		
		if(self::countList($where) > 0)
			return true;
		else
			return false;
	}
	
	public static function getList($where = 'lr_id > 0', $order = 'lr_order ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_region lr
				WHERE '. $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myRegion = new Core_LocationRegion();
			
			$myRegion->id = $row['lr_id'];
			$myRegion->countrycode = $row['lr_country'];
			$myRegion->name = $row['lr_name'];
			$myRegion->tax = $row['lr_tax'];
			$myRegion->enable = $row['lr_enable'];
			$myRegion->order = $row['lr_order'];
				
			$outputList[] = $myRegion;
		}
		return $outputList;
	}
	
	public static function getRegions($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'lr_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND lr_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fcountrycode'] != '')
		{
			$whereString .= ' AND lr_country = "'.$formData['fcountrycode'].'" ';
		}
		
		if($formData['fenable'] == 1)
		{
			$whereString .= ' AND lr_enable = 1 ';
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'name')
			$orderString = ' lr_name  ' . $sorttype;    
		elseif($sortby == 'id')
			$orderString = ' lr_id  ' . $sorttype;    
		else
			$orderString = ' lr_order ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(lr_order) FROM ' . TABLE_PREFIX . 'loc_region WHERE lr_country = ?';
		return $this->db->query($sql, array($this->countrycode))->fetchSingle() + 1;
	}
	
	
	
	
}


?>