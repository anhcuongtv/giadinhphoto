<?php

Class Core_LocationCountry extends Core_Object
{
	public $code = '';
	public $name = '';
	public $tax = 0;
	public $enable = 1;
	public $order = 0;
	
	public function __construct($code = '')
	{
		parent::__construct(0);                
		
		if($code != '')
		{
			$this->getData($code);
		}
		
	}
	
	public function addData()
	{
		$this->order = $this->getOrder();
		
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'loc_country(lc_code, lc_name, lc_tax, lc_enable, lc_order)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->code, 
		    	(string)$this->name,
		    	(float)$this->tax,
		    	(int)$this->enable,
		    	(int)$this->order
			))->rowCount();
			
				
		return $rowCount;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		global $setting;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_country
        		WHERE lc_code =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->code))->rowCount();
		
		if($rowCount > 0)
		{
			//xoa tat ca region
			
			//xoa tat ca city
			
			//tien hanh xoa ship price cua country nay
			Core_LocationShip::deleteFromLocation(array('fcountry' => $this->code));
		}
		return $rowCount;
       
	}
	
	public function getData($code)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_country lc
				WHERE lc_code = ?';
		$stmt = $this->db->query($sql, array($code));
		
		while($row = $stmt->fetch())
		{
			$this->code = $row['lc_code'];
			$this->name = $row['lc_name'];
			$this->tax = $row['lc_tax'];
			$this->enable = $row['lc_enable'];
			$this->order = $row['lc_order'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'loc_country
        		SET lc_code = ?,
        			lc_name = ?,
        			lc_tax = ?,
        			lc_enable = ?,
        			lc_order = ?
        		WHERE lc_code = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->code,
				$this->name,
				$this->tax,
		    	$this->enable,
		    	$this->order,
		    	$this->code
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'lc_code != ""')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'loc_country lc
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function checkExisted($formData, $type = 'add')
	{
		if($type == 'add')
		{
			$where = 'lc_code = "'.$formData['fcode'].'" OR lc_name = "'.$formData['fname'].'" ';
		}
		elseif($type = 'edit')
		{
			$where = 'lc_code <> "'.$formData['fcode'].'" AND lc_name = "'.$formData['fname'].'" ';
		}
				
		if(self::countList($where) > 0)
			return true;
		else
			return false;
	}
	
	public static function getList($where = 'lc_code != ""', $order = 'lc_order ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_country lc
				WHERE '. $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myCountry = new Core_LocationCountry();
			
			$myCountry->code = $row['lc_code'];
			$myCountry->name = $row['lc_name'];
			$myCountry->tax = $row['lc_tax'];
			$myCountry->enable = $row['lc_enable'];
			$myCountry->order = $row['lc_order'];
				
			$outputList[] = $myCountry;
		}
		return $outputList;
	}
	
	public static function getCountries($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'lc_code <> "" ';
		
		
		if($formData['fcode'] != '')
		{
			$whereString .= ' AND lc_code = "'.$formData['fcode'].'" ';
		}
		
		if($formData['fenable'] == 1)
		{
			$whereString .= ' AND lc_enable = 1 ';
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'name')
			$orderString = ' lc_name  ' . $sorttype;    
		else
			$orderString = ' lc_order ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(lc_order) FROM ' . TABLE_PREFIX . 'loc_country';
		return $this->db->query($sql, array())->fetchSingle() + 1;
	}
	
	
	
	
}


?>