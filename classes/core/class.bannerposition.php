<?php

Class Core_BannerPosition extends Core_Object
{
	public $id = 0;
	public $name = '';
	public $description = '';
	
	public function __construct($id = 0)
	{
		global $setting;
		
		parent::__construct($id);                
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData()
	{
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'adv_banner_position(abp_id, abp_name, abp_description)
				VALUES(?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->id, 
		    	(string)$this->name,
		    	(string)$this->description
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete($removeAllBanner = false)
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'adv_banner_position
        		WHERE abp_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($removeAllBanner)
		{
			$banners = Core_Banner::getBanners(array('position' => $this->id));
			foreach($banners as $banner)
			{
				$banner->delete();
			}
		}
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'adv_banner_position abp
				WHERE abp.abp_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['abp_id'];
			$this->name = $row['abp_name'];
			$this->description = $row['abp_description'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'adv_banner_position
        		SET abp_name = ?,
        			abp_description = ?
        		WHERE abp_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->name,
				$this->description,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'abp.abp_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'adv_banner_position abp
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'abp.abp_id > 0', $order = 'abp.abp_name ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'adv_banner_position abp
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPosition = new Core_BannerPosition();
			
			$myPosition->id = $row['abp_id'];
			$myPosition->name = $row['abp_name'];
			$myPosition->description = $row['abp_description'];
			$outputList[] = $myPosition;
		}
		return $outputList;
	}
	
	public static function getPositions($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'abp.abp_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND abp.abp_id = '.(int)$formData['fid'].' ';
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' abp.abp_name ' . $sorttype;    
		else
			$orderString = ' abp.abp_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>