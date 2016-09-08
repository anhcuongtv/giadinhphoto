<?php

Class Core_Contact extends Core_Object
{
	public $userId = 0;
	public $username = '';
	public $id;
	public $fullname = '';
	public $email = '';
	public $phone = '';
	public $reason = 'general';
	public $message = '';
	public $ipaddress = '';
	public $status = 'new';
	public $note = '';
	public $datecreated = 0;
	
	
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
	
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contact(c_userid, c_username, c_fullname, c_email, c_phone, c_reason, c_message, c_ipaddress, c_status, c_note, c_datecreated)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->userId, 
		    	(string)$this->username,
		    	(string)$this->fullname,
		    	(string)$this->email,
		    	(string)$this->phone,
		    	(string)$this->reason,
		    	(string)$this->message,
		    	(string)Helper::getIpAddress(),
		    	$this->status,
		    	$this->note,
		    	$this->datecreated
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
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contact
        		WHERE c_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
       
	}
	
	private function getData($id)
	{
		global $registry;
		
		
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contact c
				WHERE c_id = ? ' . $whereString;
		$row = $this->db->query($sql, array($id))->fetch();
		$this->userId = $row['c_userid'];
		$this->username = $row['c_username'];
		$this->id = $row['c_id'];
		$this->fullname = $row['c_fullname'];
		$this->email = $row['c_email'];
		$this->phone = $row['c_phone'];
		$this->reason = $row['c_reason'];
		$this->message = $row['c_message'];
		$this->ipaddress = $row['c_ipaddress'];
		$this->status = $row['c_status'];
		$this->note = $row['c_note'];
		$this->datecreated = $row['c_datecreated'];
	}
	
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contact
        		SET c_fullname = ?,
        			c_email = ?,
        			c_phone = ?,
        			c_reason = ?,
        			c_message = ?,
        			c_status = ?,
        			c_note = ?
        		WHERE c_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->fullname,
				$this->email,
				$this->phone,
				$this->reason,
				$this->message,
				$this->status,
				$this->note,
		    	$this->id
			));
			
		return $stmt;
	}
	
	public static function countList($where = 'c_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contact c
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'c_id > 0', $order = 'c.c_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contact c
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myContact = new Core_Contact();
			
			$myContact->userId = $row['c_userid'];
			$myContact->username = $row['c_username'];
			$myContact->id = $row['c_id'];
			$myContact->fullname = $row['c_fullname'];
			$myContact->email = $row['c_email'];
			$myContact->phone = $row['c_phone'];
			$myContact->reason = $row['c_reason'];
			$myContact->message = $row['c_message'];
			$myContact->ipaddress = $row['c_ipaddress'];
			$myContact->status = $row['c_status'];
			$myContact->note = $row['c_note'];
			$myContact->datecreated = $row['c_datecreated'];
				
			$outputList[] = $myContact;
		}
		return $outputList;
	}
	
	public static function getContacts($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'c.c_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND c.c_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fuserid'] > 0)
		{
			$whereString .= ' AND c.c_userid = '.(int)$formData['fuserid'].' ';
		}
		
		if($formData['freason'] != '')
		{
			$whereString .= ' AND c.c_reason = "'.$formData['freason'].'" ';
		}
		
		if($formData['fstatus'] != '')
		{
			$whereString .= ' AND c.c_status = "'.$formData['fstatus'].'" ';
		}
		
		
		if(strlen($formData['fkeywordFilter']) > 0)
		{
			if($formData['fsearchKeywordIn'] == 'note')
			{
				$whereString .= ' AND a.a_note LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
			elseif($formData['fsearchKeywordIn'] == 'username')
			{
				$whereString .= ' AND c.c_username LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
			elseif($formData['fsearchKeywordIn'] == 'email')
			{
				$whereString .= ' AND c.c_email LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
			elseif($formData['fsearchKeywordIn'] == 'phone')
			{
				$whereString .= ' AND c.c_phone LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
			elseif($formData['fsearchKeywordIn'] == 'ipaddress')
			{
				$whereString .= ' AND c.c_ipaddress LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
			else
			{
				$whereString .= ' AND c.c_message LIKE \'%'.$formData['fkeywordFilter'].'%\'';	
			}
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'reason')
			$orderString = ' c.c_reason ' . $sorttype;    
		else if($sortby == 'status')
			$orderString = ' c.c_status ' . $sorttype ; 
		else
			$orderString = ' c.c_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>