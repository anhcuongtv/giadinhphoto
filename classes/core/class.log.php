<?php

Class Core_Log extends Core_Object
{
	public $id = 0;
	public $uid = 0;
	public $username = '';
	public $groupid = 0;
	public $ip = '';
	public $type = '';
	public $mainid = 0;
	public $moredata = array();
	public $datecreated = 0;
	
	
	public function __construct($id = 0)
	{
		parent::__construct();
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData()
	{
		$this->datecreated = time();
		
		$ipaddress = Helper::getIpAddress();
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'log(`u_id`, `u_username`, `u_groupid`, `l_ip`, `l_type`, `l_mainid`, `l_serialized_data`, `l_datecreated`)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
				
		$rowCount = $this->db->query($sql, array(
		    	$this->uid, $this->username, $this->groupid, $ipaddress, $this->type, $this->mainid, serialize($this->moredata), $this->datecreated
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		return $this->id;
	}
	
	
	
	public function delete()
	{
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'log
        		WHERE l_id = ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		return $rowCount;
	}
	
	public static function clear()
	{
		global $db;
		$sql = 'TRUNCATE TABLE ' . TABLE_PREFIX .'log';
		return $db->query($sql);
	}
	
	private function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'log
				WHERE l_id = ?';
		$row = $this->db->query($sql, array($id))->fetch();
		$this->id = $row['l_id'];
		$this->uid = $row['u_id'];
		$this->username = $row['u_username'];
		$this->groupid = $row['u_groupid'];
		$this->ip = $row['l_ip'];
		$this->type = $row['l_type'];
		$this->mainid = $row['l_mainid'];
		$this->moredata = unserialize($row['l_serialized_data']);
		$this->datecreated = $row['l_datecreated'];
	}
	
	public static function countList($where = 'l_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'log
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'l_id > 0', $order = 'l_id DESC' , $limit = 20)
	{
		global $db;
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'log
				WHERE ' . $where . '
				ORDER BY ' . $order . '
				LIMIT ' . $limit;
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myLog = new Core_Log();
			$myLog->id = $row['l_id'];
			$myLog->uid = $row['u_id'];
			$myLog->username = $row['u_username'];
			$myLog->groupid = $row['u_groupid'];
			$myLog->ip = $row['l_ip'];
			$myLog->type = $row['l_type'];
			$myLog->mainid = $row['l_mainid'];
			$myLog->moredata = unserialize($row['l_serialized_data']);
			$myLog->datecreated = $row['l_datecreated'];
			$outputList[] = $myLog;
		}
		return $outputList;
	}
	
	public static function getLogs($uidFilter = 0, $usernameFilter = '', $groupFilter = 0, $typeFilter = '', $ipFilter = '', $limit = 20, $countOnly = false)
	{
		$whereString = 'l_id > 0 ';
		
		if($uidFilter > 0)
		{
			$whereString .= ' AND u_id = \''.$uidFilter.'\' ';
		}
		
		if(strlen($usernameFilter) > 0)
		{
			$whereString .= ' AND u_username LIKE \'%'.$usernameFilter.'%\' ';
		}
		
		if($groupFilter > 0)
		{
			$whereString .= ' AND u_groupid = \''.$groupFilter.'\' ';
		}
		
		if(strlen($typeFilter) > 0)
		{
			$whereString .= ' AND l_type LIKE \'%'.$typeFilter.'%\' ';
		}
		
		if(strlen($ipFilter) > 0)
		{
			$whereString .= ' AND l_ip LIKE \'%'.$ipFilter.'%\' ';
		}
		
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, 'l_id DESC', $limit);
	}
	
		
	
}


?>