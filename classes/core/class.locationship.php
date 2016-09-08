<?php

Class Core_LocationShip extends Core_Object
{
	public $countrycode = '';
	public $regionid = 0;
	public $cityid = 0;
	public $groupid = 0;
	public $id = '';
	public $price = '';
	public $datemodified = '';
	
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
		$this->datemodified = time();
		
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'loc_ship(ls_country, ls_regionid, ls_cityid, ls_groupid, ls_price, ls_datemodified)
				VALUES(?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->countrycode, 
		    	(int)$this->regionid,
		    	(int)$this->cityid,
		    	(int)$this->groupid,
		    	(float)$this->price,
		    	(int)$this->datemodified
			))->rowCount();
			
				
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship
        		WHERE ls_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
	}
	
	public static function deleteFromLocation($formData)
	{
		global $db;
		
		if($formData['fcountry'] != '' && $formData['fregion'] > 0 && $formData['fcity'] > 0)
		{
			$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship
					WHERE ls_country = ? AND ls_regionid = ? AND ls_cityid = ?';
			$rowCount = $db->query($sql, array($formData['fcountry'], $formData['fregion'], $formData['fcity']))->rowCount();
		}
		elseif($formData['fcountry'] != '' && $formData['fregion'] > 0)
		{
			$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship
					WHERE ls_country = ? AND ls_regionid = ?';
			$rowCount = $db->query($sql, array($formData['fcountry'], $formData['fregion']))->rowCount();
		}
		elseif($formData['fcountry'] != '')
		{
			$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship
					WHERE ls_country = ?';
			$rowCount = $db->query($sql, array($formData['fcountry']))->rowCount();
		}
		elseif($formData['fgroup'] > 0)
		{
			$sql = 'DELETE FROM ' . TABLE_PREFIX . 'loc_ship
					WHERE ls_groupid = ?';
			$rowCount = $db->query($sql, array($formData['fgroup']))->rowCount();
		}
		else
		{
			$rowCount = 0;
		}
		
		return $rowCount;
	}
	
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_ship ls
				WHERE ls_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->countrycode = $row['ls_country'];
			$this->regionid = $row['ls_regionid'];
			$this->cityid = $row['ls_cityid'];
			$this->groupid = $row['ls_groupid'];
			$this->id = $row['ls_id'];
			$this->price = $row['ls_price'];
			$this->datemodified = $row['ls_datemodified'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                       
		$this->datemodified = time();
		          
        $sql = 'UPDATE ' . TABLE_PREFIX . 'loc_ship
        		SET ls_country = ?,
        			ls_regionid = ?,
        			ls_cityid = ?,
        			ls_groupid = ?,
        			ls_price = ?,
        			ls_datemodified = ?
        		WHERE ls_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->countrycode,
				$this->regionid,
				$this->cityid,
				$this->groupid,
				$this->price,
		    	$this->datemodified,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'ls_id > 0')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'loc_ship  ls
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'ls_id > 0', $order = 'ls_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'loc_ship ls
				WHERE '.$where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit; 
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myShip = new Core_LocationShip();
			
			$myShip->countrycode = $row['ls_country'];
			$myShip->regionid = $row['ls_regionid'];
			$myShip->cityid = $row['ls_cityid'];
			$myShip->groupid = $row['ls_groupid'];
			$myShip->id = $row['ls_id'];
			$myShip->price = $row['ls_price'];
			$myShip->datemodified = $row['ls_datemodified'];
				
			$outputList[] = $myShip;
		}
		return $outputList;
	}
	
	public static function getShips($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'ls_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND ls_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fgroupid'] > 0)
		{
			$whereString .= ' AND ls_groupid = '.(int)$formData['fgroupid'].' ';
		}
		
		if($formData['fcityid'] >= 0)
		{
			$whereString .= ' AND ls_cityid = '.(int)$formData['fcityid'].' ';
		}
		
		if($formData['fregionid'] > 0)
		{
			$whereString .= ' AND ls_regionid = '.(int)$formData['fregionid'].' ';
		}
		
		if($formData['fcountrycode'] != '')
		{
			$whereString .= ' AND ls_country = "'.$formData['fcountrycode'].'" ';
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'id')
			$orderString = ' ls_id  ' . $sorttype;    
		else
			$orderString = ' ls_id  ' . $sorttype;         
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
}


?>