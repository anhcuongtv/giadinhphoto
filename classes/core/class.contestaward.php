<?php

Class Core_ContestAward extends Core_Object
{
	public $id = 0;
	public $name = '';
	public $order = 0;
	public $section = '';
	public $isactive = 0;
	public $datecreated = 0;
	
		
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
	
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_award(a_name, a_order, a_section, a_isactive, a_datecreated)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->name, 
		    	(int)$this->order, 
		    	(string)$this->section, 
		    	(int)$this->isactive, 
		    	(int)$this->datecreated 
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_award
        		WHERE a_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
				
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_award a
				WHERE a.a_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['a_id'];
			$this->name = $row['a_name'];
			$this->order = $row['a_order'];
			$this->section = $row['a_section'];
			$this->isactive = $row['a_isactive'];
			$this->datecreated = $row['r_datecreated'];
		}
	}
	
	public function getDataByArray($row)
	{
		$this->id = $row['a_id'];
		$this->name = $row['a_name'];
		$this->order = $row['a_order'];
		$this->section = $row['a_section'];
		$this->isactive = $row['a_isactive'];
		$this->datecreated = $row['r_datecreated'];
	}
	
		
	public function updateData()
	{               
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_award
        		SET a_name = ?,
        			a_order = ?,
        			a_section = ?,
        			a_isactive = ?
        		WHERE a_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(string)$this->name,
				(int)$this->order,
				(string)$this->section,
				(int)$this->isactive,
				(int)$this->id
			));
			
					
		return $stmt;
	}
	
	public static function countList($where = 'a.a_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_award a
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'a.a_id > 0', $order = 'a.a_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_award a
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myAward = new Core_ContestAward();
			
			$myAward->id = $row['a_id'];
			$myAward->name = $row['a_name'];
			$myAward->order = $row['a_order'];
			$myAward->section = $row['a_section'];
			$myAward->isactive = $row['a_isactive'];
			$myAward->datecreated = $row['a_datecreated'];
				
			$outputList[] = $myAward;
		}
		return $outputList;
	}
	
	public static function getAwards($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'a.a_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND a.a_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fisactive'] == 1)
		{
			$whereString .= ' AND a.a_isactive = 1';
		}
		
		if($formData['fsection'] != '')
		{
			//get specific section, and empty section (~all section)
			$whereString .= ' AND ( a.a_section = "'.$formData['fsection'].'" OR a.a_section = "" )';
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' a.a_name ' . $sorttype;    
		elseif($sortby == 'order')
			$orderString = ' a.a_order ' . $sorttype;    
		elseif($sortby == 'section')
			$orderString = ' a.a_section ' . $sorttype;    
		else
			$orderString = ' a.a_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>
