<?php

Class Core_Language extends Core_Object
{
	public $id = 0;
	public $code = '';
	public $name = '';
	public $editorder = 0;
	
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
		$this->datecreated = time();
	
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'language(l_id, l_code, l_name, l_editorder)
				VALUES(?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->id, 
		    	(string)$this->code,
		    	(string)$this->name,
		    	(int)$this->editorder
			))->rowCount();
			
				
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		global $setting;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'language
        		WHERE l_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'language l
				WHERE l_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['l_id'];
			$this->code = $row['l_code'];
			$this->name = $row['l_name'];
			$this->editorder = $row['l_editorder'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'language
        		SET l_code = ?,
        			l_name = ?,
        			l_editorder = ?
        		WHERE l_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->code,
				$this->name,
				$this->editorder,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'l_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'language l
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'l_id > 0', $order = 'l_editorder ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'language l
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myLanguage = new Core_Language();
			
			$myLanguage->id = $row['l_id'];
			$myLanguage->code = $row['l_code'];
			$myLanguage->name = $row['l_name'];
			$myLanguage->editorder = $row['l_editorder'];
				
			$outputList[] = $myLanguage;
		}
		return $outputList;
	}
	
	public static function getLanguages($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'l_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND l_id = '.(int)$formData['fid'].' ';
		}
		
			
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'id')
			$orderString = ' l_id  ' . $sorttype;    
		else
			$orderString = ' l_editorder ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>