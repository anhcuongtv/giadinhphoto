<?php

Class Core_LocationCity extends Core_Object
{
	public $countrycode = '';
	public $regionid = 0;
	public $id = 0;
	public $name = '';
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
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'loc_city(lct_country, lct_regionid, lct_name, lct_enable, lct_order)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->countrycode, 
		    	(int)$this->regionid,
		    	(string)$this->name,
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
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_city
        		WHERE lct_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($rowCount > 0)
		{
			//xoa tat ca city
			
			//tien hanh xoa ship price cua country nay
			Core_LocationShip::deleteFromLocation(array('fcountry' => $this->countrycode, 'fregion' => $this->regionid, 'fcity' => $this->id));
		}
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_city lct
				WHERE lct_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->countrycode = $row['lct_country'];
			$this->regionid = $row['lct_regionid'];
			$this->id = $row['lct_id'];
			$this->name = $row['lct_name'];
			$this->enable = $row['lct_enable'];
			$this->order = $row['lct_order'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'loc_city
        		SET lct_country = ?,
        			lct_regionid = ?,
        			lct_name = ?,
        			lct_enable = ?,
        			lct_order = ?
        		WHERE lct_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->countrycode,
				$this->regionid,
				$this->name,
		    	$this->enable,
		    	$this->order,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'lct_id > 0')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'loc_city  lct
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	
	public static function checkExisted($formData, $type = 'add')
	{
		if($type == 'add')
		{
			$where = 'lct_country = "'.$formData['fcountrycode'].'" AND lct_regionid = '.(int)$formData['fregion'].' AND lct_name = "'.$formData['fname'].'" ';
		}
		elseif($type = 'edit')
		{
			$where = 'lct_country = "'.$formData['fcountrycode'].'" AND lct_regionid = '.(int)$formData['fregion'].' AND lct_name = "'.$formData['fname'].'" AND lct_id <> '.(int)$formData['fid'].' ';
		}
		
		
		
		if(self::countList($where) > 0)
			return true;
		else
			return false;
	}
	
	public static function getList($where = 'lct_id > 0', $order = 'lct_order ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_city lct
				WHERE '. $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myCity = new Core_LocationCity();
			
			$myCity->countrycode = $row['lct_country'];
			$myCity->regionid = $row['lct_regionid'];
			$myCity->id = $row['lct_id'];
			$myCity->name = $row['lct_name'];
			$myCity->enable = $row['lct_enable'];
			$myCity->order = $row['lct_order'];
				
			$outputList[] = $myCity;
		}
		return $outputList;
	}
	
	public static function getCities($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'lct_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND lct_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fregionid'] > 0)
		{
			$whereString .= ' AND lct_regionid = '.(int)$formData['fregionid'].' ';
		}
		
		if($formData['fcountrycode'] != '')
		{
			$whereString .= ' AND lct_country = "'.$formData['fcountrycode'].'" ';
		}
		
		if($formData['fenable'] == 1)
		{
			$whereString .= ' AND lct_enable = 1 ';
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'name')
			$orderString = ' lct_name  ' . $sorttype;    
		elseif($sortby == 'id')
			$orderString = ' lct_id  ' . $sorttype;    
		else
			$orderString = ' lct_order ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(lct_order) FROM ' . TABLE_PREFIX . 'loc_city WHERE lct_regionid = ?';
		return $this->db->query($sql, array($this->regionid))->fetchSingle() + 1;
	}
	
	
	
	
}


?>