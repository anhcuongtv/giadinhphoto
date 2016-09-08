<?php

Class Core_ContestPhotoAward extends Core_Object
{
	public $pid = 0;
	public $aid = 0;
	public $rid = 0;
	public $jid = 0;
	public $id = 0;
	public $datecreated = 0;
	public $photo = null;
	public $award = null;
		
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
	
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_photo_award(p_id, a_id, r_id, j_id, pa_datecreated)
				VALUES(?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->pid, 
		    	(int)$this->aid, 
		    	(int)$this->rid, 
		    	(int)$this->jid, 
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
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_award
        		WHERE pa_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
				
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_award pa
				INNER JOIN ' . TABLE_PREFIX . 'contest_award a ON a.a_id = pa.a_id
				INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready pr ON pa.p_id = pr.p_id
				WHERE pa.pa_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->pid = $row['p_id'];
			$this->aid = $row['a_id'];
			$this->rid = $row['r_id'];
			$this->jid = $row['j_id'];
			$this->id = $row['pa_id'];
			$this->datecreated = $row['pa_datecreated'];
			
			$this->photo = new Core_ContestPhotoReady();
			$this->photo->getDataByArray($row);
			
			$this->award = new Core_ContestAward();
			$this->award->getDataByArray($row);
		}
	}
	
		
	
	public static function countList($where = 'pa.pa_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_award pa
				INNER JOIN ' . TABLE_PREFIX . 'contest_award a ON a.a_id = pa.a_id
				INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready pr ON pa.p_id = pr.p_id
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'pa.pa_id > 0', $order = 'pa.pa_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_award pa
				INNER JOIN ' . TABLE_PREFIX . 'contest_award a ON a.a_id = pa.a_id
				INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready pr ON pa.p_id = pr.p_id
				WHERE ' . $where ;
		
		if($order != '')
			$sql .= ' ORDER BY ' . $order;
					
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPhotoAward = new Core_ContestPhotoAward();
			
			$myPhotoAward->pid = $row['p_id'];
			$myPhotoAward->aid = $row['a_id'];
			$myPhotoAward->rid = $row['r_id'];
			$myPhotoAward->jid = $row['j_id'];
			$myPhotoAward->id = $row['pa_id'];
			$myPhotoAward->datecreated = $row['pa_datecreated'];
			$myPhotoAward->photo = new Core_ContestPhotoReady();
			$myPhotoAward->photo->getDataByArray($row);
			$myPhotoAward->award = new Core_ContestAward();
			$myPhotoAward->award->getDataByArray($row);
			$outputList[] = $myPhotoAward;
		}
		return $outputList;
	}
	
	public static function getPhotoAwards($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'pa.pa_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND pa.pa_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fpid'] > 0)
		{
			$whereString .= ' AND pa.p_id = '.(int)$formData['fpid'].' ';
		}
		
		if($formData['faid'] > 0)
		{
			$whereString .= ' AND pa.a_id = '.(int)$formData['faid'].' ';
		}
		
		if($formData['frid'] > 0)
		{
			$whereString .= ' AND pa.r_id = '.(int)$formData['frid'].' ';
		}
		
		if($formData['fjid'] > 0)
		{
			$whereString .= ' AND pa.j_id = '.(int)$formData['fjid'].' ';
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'award')
			$orderString = ' pa.a_id ' . $sorttype;    
		elseif($sortby == 'id')
			$orderString = ' pa.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>