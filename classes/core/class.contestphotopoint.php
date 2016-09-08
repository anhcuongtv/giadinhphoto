<?php

Class Core_ContestPhotoPoint extends Core_Object
{
	public $pid = 0;
	public $rid = 0;
	public $id = 0;
	public $point = 0;
	public $judgerid = 0;
	public $datecreated = 0;
	public $datemodified = 0;
	public $modifyhistory = '';
		
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
	
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_photo_point(p_id, r_id, cpp_point, cpp_judgerid, cpp_datecreated)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->pid, 
		    	(int)$this->rid, 
		    	(int)$this->point, 
		    	(int)$this->judgerid, 
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
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_point
        		WHERE cpp_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
				
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_point cpp
				WHERE cpp.cpp_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->pid = $row['p_id'];
			$this->rid = $row['r_id'];
			$this->id = $row['cpp_id'];
			$this->point = $row['cpp_point'];
			$this->judgerid = $row['cpp_judgerid'];
			$this->datecreated = $row['cpp_datecreated'];
			$this->datemodified = $row['cpp_datemodified'];
			$this->modifyhistory = $row['cpp_modifyhistory'];
		}
	}
	
		
	public function updateData()
	{               
		$this->datemodified = time();
		
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_photo_point
        		SET cpp_point = ?,
        			cpp_datemodified = ?,
        			cpp_modifyhistory = ?
        		WHERE cpp_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(int)$this->point,
				(int)$this->datemodified,
				(string)$this->modifyhistory,
				(int)$this->id
			));
			
					
		return $stmt;
	}
	
	public static function countList($where = 'r.r_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_point cpp
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'cpp.cpp_id > 0', $order = 'cpp.cpp_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_point cpp
				WHERE ' . $where ;
		if($order != '')
			$sql .= ' ORDER BY ' . $order;
					
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
	
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPoint = new Core_ContestPhotoPoint();
			
			$myPoint->pid = $row['p_id'];
			$myPoint->rid = $row['r_id'];
			$myPoint->id = $row['cpp_id'];
			$myPoint->point = $row['cpp_point'];
			$myPoint->judgerid = $row['cpp_judgerid'];
			$myPoint->datecreated = $row['cpp_datecreated'];
			$myPoint->datemodified = $row['cpp_datemodified'];
			$myPoint->modifyhistory = $row['cpp_modifyhistory'];
				
			$outputList[] = $myPoint;
		}
		return $outputList;
	}
	
	public static function getPoints($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'cpp.cpp_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND cpp.cpp_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fpid'] > 0)
		{
			$whereString .= ' AND cpp.p_id = '.(int)$formData['fpid'].' ';
		}
		
		if($formData['frid'] > 0)
		{
			$whereString .= ' AND cpp.r_id = '.(int)$formData['frid'].' ';
		}
		
		if($formData['fjudgerid'] > 0)
		{
			$whereString .= ' AND cpp.cpp_judgerid = '.(int)$formData['fjudgerid'].' ';
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'round')
			$orderString = ' cpp.r_id ' . $sorttype;    
		elseif($sortby == 'id')
			$orderString = ' cpp.cpp_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>