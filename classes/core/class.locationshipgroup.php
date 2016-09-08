<?php

Class Core_LocationShipGroup extends Core_Object
{
	public $id = '';
	public $code = '';
	public $name = '';
	public $weightMin = '';
	public $weightMax = '';
	public $description = '';
	public $order = '';
	
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
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'loc_ship_group(lsg_code, lsg_name, lsg_weight_min, lsg_weight_max, lsg_description, lsg_order)
				VALUES(?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->code, 
		    	(string)$this->name,
		    	(float)$this->weightMin,
		    	(float)$this->weightMax,
		    	(string)$this->description,
		    	(int)$this->order
			))->rowCount();
			
				
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		global $setting;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship_group
        		WHERE lsg_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($rowCount > 0)
		{
			//tien hanh xoa ship price cua country nay
			Core_LocationShip::deleteFromLocation(array('fgroup' => $this->id));
		}
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_ship_group lsg
				WHERE lsg_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['lsg_id'];
			$this->code = $row['lsg_code'];
			$this->name = $row['lsg_name'];
			$this->weightMin = $row['lsg_weight_min'];
			$this->weightMax = $row['lsg_weight_max'];
			$this->description = $row['lsg_description'];
			$this->order = $row['lsg_order'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'loc_ship_group
        		SET lsg_code = ?,
        			lsg_name = ?,
        			lsg_weight_min = ?,
        			lsg_weight_max = ?,
        			lsg_description = ?,
        			lsg_order = ?
        		WHERE lsg_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->code,
				$this->name,
				$this->weightMin,
		    	$this->weightMax,
		    	$this->description,
		    	$this->order,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'lsg_id > 0')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'loc_ship_group  lsg
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'lsg_id > 0', $order = 'lsg_order ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_ship_group lsg
				WHERE '. $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myShipGroup = new Core_LocationShipGroup();
			
			$myShipGroup->id = $row['lsg_id'];
			$myShipGroup->code = $row['lsg_code'];
			$myShipGroup->name = $row['lsg_name'];
			$myShipGroup->weightMin = $row['lsg_weight_min'];
			$myShipGroup->weightMax = $row['lsg_weight_max'];
			$myShipGroup->description = $row['lsg_description'];
			$myShipGroup->order = $row['lsg_order'];
				
			$outputList[] = $myShipGroup;
		}
		return $outputList;
	}
	
	public static function getGroups($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'lsg_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND lsg_id = '.(int)$formData['fid'].' ';
		}
		
				
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'id')
			$orderString = ' lsg_id  ' . $sorttype;    
		else
			$orderString = ' lsg_order ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(lsg_order) FROM ' . TABLE_PREFIX . 'loc_ship_group';
		return $this->db->query($sql, array())->fetchSingle() + 1;
	}
	
	
	
	
}


?>