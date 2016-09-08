<?php

Class Core_ContestPhotoReady extends Core_Object
{
	
	public $id = 0;
	public $uid = 0;
	public $section = 0;
	public $name = '';
	public $resolution = '';
	public $filepath = '';
	public $filethumb1 = '';
	public $filethumb2 = '';
	public $datecreated = 0;
	public $userCountry = '';
	public $poster;
    public $fileserver = '';
	
	
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
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_photo_ready(p_id, u_id, p_section, p_name,  p_resolution, p_filepath, p_filethumb1, p_filethumb2, p_usercountry, p_datecreated)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
				(int)$this->id,
				(int)$this->uid,
				(string)$this->section,
				(string)$this->name,
				(string)$this->resolution,
				(string)$this->filepath,
				(string)$this->filethumb1,
				(string)$this->filethumb2,
				(string)$this->userCountry,
		    	(int)$this->datecreated
			))->rowCount();
			
		
		if($this->id > 0)
		{
			return true;
		}
		else
			return false;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_ready
        		WHERE p_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
       
	}
	
	
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
                INNER JOIN ' . TABLE_PREFIX . 'contest_photo cp ON cp.p_id = p.p_id
				WHERE p.p_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['p_id'];
			$this->uid = $row['u_id'];
			$this->section = $row['p_section'];
			$this->name = $row['p_name'];
			$this->resolution = $row['p_resolution'];
			$this->filepath = $row['p_filepath'];
			$this->filethumb1 = $row['p_filethumb1'];
			$this->filethumb2 = $row['p_filethumb2'];
			$this->userCountry = $row['p_usercountry'];
			$this->datecreated = $row['p_datecreated'];
            $this->fileserver = $row['p_fileserver'];
			$this->poster = new Core_User();
			$this->poster->getByArray($row);
		}
	}
	
	public function getDataByArray($row)
	{
		$this->id = $row['p_id'];
		$this->uid = $row['u_id'];
		$this->section = $row['p_section'];
		$this->name = $row['p_name'];
		$this->resolution = $row['p_resolution'];
		$this->filepath = $row['p_filepath'];
		$this->filethumb1 = $row['p_filethumb1'];
		$this->filethumb2 = $row['p_filethumb2'];
		$this->userCountry = $row['p_usercountry'];
		$this->datecreated = $row['p_datecreated'];
	}
	
	
	
	
	public static function countList($where = 'p.p_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON up.u_id = u.u_id
				WHERE ' . $where;
        //var_dump($sql);
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'p.p_id > 0', $order = 'p.p_id DESC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON up.u_id = u.u_id
                INNER JOIN ' . TABLE_PREFIX . 'contest_photo cp ON cp.p_id = p.p_id
				WHERE ' . $where . '
				ORDER BY ' . $order;
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPhoto = new Core_ContestPhotoReady();
			$myPhoto->id = $row['p_id'];
			$myPhoto->uid = $row['u_id'];
			$myPhoto->section = $row['p_section'];
			$myPhoto->name = $row['p_name'];
			$myPhoto->resolution = $row['p_resolution'];
			$myPhoto->filepath = $row['p_filepath'];
			$myPhoto->filethumb1 = $row['p_filethumb1'];
			$myPhoto->filethumb2 = $row['p_filethumb2'];
			$myPhoto->userCountry = $row['p_usercountry'];
			$myPhoto->datecreated = $row['p_datecreated'];
            $myPhoto->fileserver = $row['p_fileserver'];
			$myPhoto->poster = new Core_User();
			$myPhoto->poster->getByArray($row);
			
			$outputList[] = $myPhoto;
		}
		return $outputList;
	}
	
	public static function getPhotos($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'p.p_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
		//Filter by section
         if(!empty($formData['fsection']))
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
    
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'color')
            $whereString .= ' AND p.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono-m' || $formData['fsection'] == 'mono')
            $whereString .= ' AND p.p_section LIKE "%-m" ';
           if($formData['fsection'] == 'travel-t' || $formData['fsection'] == 'travel')
            $whereString .= ' AND p.p_section LIKE "%-t" ';
              if($formData['fsection'] == 'nature-n' || $formData['fsection'] == 'nature')
            $whereString .= ' AND p.p_section LIKE "%-n" ';  

		
        
		if(is_array($formData['fsection']))
		{   
            //$secs = array();
            
			for($i = 0; $i < count($formData['fsection']); $i++)
			{
				$formData['fsection'][$i] = '"' . $formData['fsection'][$i] . '"';
			}
			
			$whereString .= ' AND p.p_section IN ('.implode(',', $formData['fsection']).') ';            
		}
		
				
		if($formData['fuserid'] > 0)
		{
			
			$whereString .= ' AND p.u_id = '.(int)$formData['fuserid'].' ';
		}
		
		if($formData['fgreaterthan'] > 0)
		{
			$whereString .= ' AND p.p_id > '.(int)$formData['fgreaterthan'].' ';
		}
		
		if($formData['flessthan'] > 0)
		{
			$whereString .= ' AND p.p_id < '.(int)$formData['flessthan'].' ';
		}
		
		if(strlen($formData['fcountry']) > 0)
		{
			$whereString .= ' AND p.p_usercountry = "'.$formData['fcountry'].'" ';
		}
		
		if($formData['froundid'] > 0)
		{
			$whereString .= ' AND p.p_id IN (SELECT p_id FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr WHERE prr.r_id = '.(int)$formData['froundid'].') ';	
		}
		
		
		if(strlen($formData['fkeyword']) > 0)
		{
			if($formData['fsearchin'] == 'name')
			{
				$whereString .= ' AND p.p_name LIKE \'%'.$formData['fkeyword'].'%\'';
			}
			elseif($formData['fsearchin'] == 'section')
			{
				$whereString .= ' AND p.p_section LIKE \'%'.$formData['fkeyword'].'%\'';
			}
			elseif($formData['fsearchin'] == 'country')
			{
				$whereString .= ' AND p.p_usercountry = \''.$formData['fkeyword'].'\'';
			}
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' p.p_name ' . $sorttype;    
		elseif($sortby == 'username')
			$orderString = ' u.u_username ' . $sorttype;    
		elseif($sortby == 'resolution')
			$orderString = ' p.p_resolution ' . $sorttype; 
		elseif($sortby == 'country')
			$orderString = ' p.p_usercountry ' . $sorttype;    
		else
			$orderString = ' p.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	public static function countMarkedList($where = 'p.p_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				LEFT JOIN ' . TABLE_PREFIX . 'contest_photo_point pp ON p.p_id = pp.p_id
				WHERE ' . $where;
        //var_dump($sql);
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getMarkedList($where = 'p.p_id > 0', $order = 'p.p_id DESC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT p.* FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				LEFT JOIN ' . TABLE_PREFIX . 'contest_photo_point pp ON p.p_id = pp.p_id  
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
		$stmt = $db->query($sql); 
		while($row = $stmt->fetch())
		{
			$myPhoto = new Core_ContestPhotoReady();
			$myPhoto->id = $row['p_id'];
			$myPhoto->uid = $row['u_id'];
			$myPhoto->section = $row['p_section'];
			$myPhoto->name = $row['p_name'];
			$myPhoto->resolution = $row['p_resolution'];
			$myPhoto->filepath = $row['p_filepath'];
			$myPhoto->filethumb1 = $row['p_filethumb1'];
			$myPhoto->filethumb2 = $row['p_filethumb2'];
			$myPhoto->userCountry = $row['p_usercountry'];
			$myPhoto->datecreated = $row['p_datecreated'];
			$myPhoto->poster = new Core_User();
			$myPhoto->poster->getByArray($row);
			
			$outputList[] = $myPhoto;
		}
		return $outputList;
	}
	
	public static function getMarkedPhotos($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		if($formData['fpointnull'])
		{
			$whereString = 'pp.p_id IS NOT NULL ';	
		}
		else
		{
			$whereString = 'pp.p_id IS NULL';
		}
		
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
		//Filter by section
        /* Vo Duy Tuan
		if($formData['fsection'] == 'color' || $formData['fsection'] == 'mono' || $formData['fsection'] == 'nature' || $formData['fsection'] == 'travel')
		{
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
		}
        */
        /*Le Ngoc Trung*/
        //Filter by section
       	//Filter by section
         if(!empty($formData['fsection']))
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
    
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'color')
            $whereString .= ' AND p.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono-m' || $formData['fsection'] == 'mono')
            $whereString .= ' AND p.p_section LIKE "%-m" ';
           if($formData['fsection'] == 'travel-t' || $formData['fsection'] == 'travel')
            $whereString .= ' AND p.p_section LIKE "%-t" ';
              if($formData['fsection'] == 'nature-n' || $formData['fsection'] == 'nature')
            $whereString .= ' AND p.p_section LIKE "%-n" ';  

        
		
				
		if($formData['fuserid'] > 0)
		{
			$whereString .= ' AND p.u_id = '.(int)$formData['fuserid'].' ';
		}
		
		if($formData['fjudgerid'] > 0)
		{
			$whereString .= ' AND pp.cpp_judgerid = '.(int)$formData['fjudgerid'].' ';
		}
		
		if(strlen($formData['fcountry']) > 0)
		{
			$whereString .= ' AND p.p_usercountry = "'.$formData['fcountry'].'" ';
		}
		
		if($formData['froundid'] > 0)
		{
			//$whereString .= ' AND p.p_id IN (SELECT p_id FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr WHERE prr.r_id = '.(int)$formData['froundid'].') ';	
			$whereString .= ' AND pp.r_id = '.(int)$formData['froundid'].' ';
		}       
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		
		$orderString = ' p.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countMarkedList($whereString);
		else
			return self::getMarkedList($whereString, $orderString, $limit);
	}
	
	public static function countUnmarkedList($where = 'pr.p_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_ready p
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getUnmarkedList($where = 'pr.p_id > 0', $order = 'pr.p_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_ready p
                INNER JOIN ' . TABLE_PREFIX . 'contest_photo cp ON cp.p_id = p.p_id
				WHERE ' . $where . '
				ORDER BY ' . $order;
        //echo $sql;
        //die('here core');
                		
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
            
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPhoto = new Core_ContestPhotoReady();
			$myPhoto->id = $row['p_id'];
			$myPhoto->uid = $row['u_id'];
			$myPhoto->section = $row['p_section'];
			$myPhoto->name = $row['p_name'];
			$myPhoto->resolution = $row['p_resolution'];
			$myPhoto->filepath = $row['p_filepath'];
			$myPhoto->filethumb1 = $row['p_filethumb1'];
			$myPhoto->filethumb2 = $row['p_filethumb2'];
			$myPhoto->userCountry = $row['p_usercountry'];
			$myPhoto->datecreated = $row['p_datecreated'];
            $myPhoto->fileserver = $row['p_fileserver'];
			$myPhoto->poster = new Core_User();
			$myPhoto->poster->getByArray($row);
			
			$outputList[] = $myPhoto;
		}
		return $outputList;
	}
	
	public static function getUnmarkedPhotos($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'p.p_id > 0';
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
        /*Vo Duy Tuan
		//Filter by section
		if($formData['fsection'] == 'color' || $formData['fsection'] == 'mono' || $formData['fsection'] == 'nature' || $formData['fsection'] == 'travel' )
		{
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
		}
        */
        /*Le Ngoc Trung*/
        //Filter by section
       	//Filter by section
         if(!empty($formData['fsection']))
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
    
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'color')
            $whereString .= ' AND p.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono-m' || $formData['fsection'] == 'mono')
            $whereString .= ' AND p.p_section LIKE "%-m" ';
           if($formData['fsection'] == 'travel-t' || $formData['fsection'] == 'travel')
            $whereString .= ' AND p.p_section LIKE "%-t" ';
              if($formData['fsection'] == 'nature-n' || $formData['fsection'] == 'nature')
            $whereString .= ' AND p.p_section LIKE "%-n" ';  

		
				
		if($formData['fjudgerid'] > 0)
		{
			$whereString .= ' AND p.p_id NOT IN (
								SELECT pp.p_id FROM '.TABLE_PREFIX.'contest_photo_point pp
								WHERE cpp_judgerid='.(int)$formData['fjudgerid'].'
									AND pp.r_id = '.(int)$formData['froundid'].') ';
		}
		
		if($formData['froundid'] > 0)
		{
			$whereString .= ' AND p.p_id IN (SELECT p_id FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr WHERE prr.r_id = '.(int)$formData['froundid'].') ';	
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		
		$orderString = ' p.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countUnmarkedList($whereString);
		else
			return self::getUnmarkedList($whereString, $orderString, $limit);
			
		
	}
	
    
    //find image unmark
    public static function findListImage($formData)
    {
        global $db;
        $whereString = 'p.p_id > 0';
       	//Filter by section
         if(!empty($formData['fsection']))
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
    
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'color')
            $whereString .= ' AND p.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono-m' || $formData['fsection'] == 'mono')
            $whereString .= ' AND p.p_section LIKE "%-m" ';
           if($formData['fsection'] == 'travel-t' || $formData['fsection'] == 'travel')
            $whereString .= ' AND p.p_section LIKE "%-t" ';
              if($formData['fsection'] == 'nature-n' || $formData['fsection'] == 'nature')
            $whereString .= ' AND p.p_section LIKE "%-n" ';  

    
        if($formData['fround'] > 0)
            $round = $formData['fround'];
               
        $sql = 'SELECT * FROM '. TABLE_PREFIX .'contest_photo_ready p 
                INNER JOIN '. TABLE_PREFIX .'contest_photo cp ON cp.p_id = p.p_id 
                WHERE '. $whereString .'
                AND p.p_id IN (SELECT p_id FROM '. TABLE_PREFIX .'contest_photo_ready_round prr WHERE prr.r_id = '.$round.') ORDER BY p.p_id ASC 
                ';
        $stmt = $db->query($sql);
        $outlist = array();
        while($row = $stmt->fetch())
        {
         $outlist[] = $row['p_id'];    
        }
        return $outlist;   
    }
    
    public static function findPhotoMark($judgerid, $round)
    {   
        global $db;
        $sql = 'SELECT pp.p_id FROM '. TABLE_PREFIX .'contest_photo_point pp WHERE cpp_judgerid= '. $judgerid .' AND pp.r_id = '.$round;        
        $stmt = $db->query($sql);
        $outlist = array();
        while($row = $stmt->fetch())
        {
         $outlist[] = $row['p_id'];    
        }
        return $outlist;            
    }
    
    //end find
    
    
    
	public static function clean()
	{
		global $db;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_ready';
		$rowCount = $db->query($sql)->rowCount();
		
		return true;
	}
	
	public static function generateList()
	{
		global $db;
		
		//clear list first
		self::clean();
		
		//begin select valid image
		$sql = 'SELECT p_id, p_section, p_name, p_resolution, p_filepath, p_filethumb1, p_filethumb2, p_datecreated, up.u_id, up_country, up_paid_color, up_paid_mono, up_paid_nature, up_paid_travel
				FROM pex_contest_photo p
				INNER JOIN pex_ac_user_profile up ON p.u_id = up.u_id
				WHERE  (p_section LIKE "%-c" AND up_paid_color = "1")
					OR (p_section LIKE "%-t" AND up_paid_travel = "1")
					OR (p_section LIKE "%-m" AND up_paid_mono = "1")
					OR (p_section LIKE "%-n" AND up_paid_nature = "1")
					OR (p_section = "nature" AND up_paid_nature = "1")
					OR (p_section = "color" AND up_paid_color = "1")
					OR (p_section = "mono" AND up_paid_mono = "1")
                    OR (p_section = "travel" AND up_paid_travel = "1")
				';
		$stmt = $db->query($sql);
		echo '<pre>';
		while($row = $stmt->fetch())
		{
			$myPhoto = new Core_ContestPhotoReady();
			$myPhoto->id = $row['p_id'];
			$myPhoto->uid = $row['u_id'];
			$myPhoto->section = $row['p_section'];
			$myPhoto->name = $row['p_name'];
			$myPhoto->resolution = $row['p_resolution'];
			$myPhoto->filepath = $row['p_filepath'];
			$myPhoto->filethumb1 = $row['p_filethumb1'];
			$myPhoto->filethumb2 = $row['p_filethumb2'];
			$myPhoto->userCountry = $row['up_country'];
			$myPhoto->datecreated = $row['p_datecreated'];
			//print_r($my)
			//save to ready list	
			$myPhoto->addData();
			unset($myPhoto);
		}
		echo '</pre>';
		
		return $stmt;
	}
	
	public static function getIdSectionList()
	{
		global $db;
		
		$readyIdList = array();
		$sql = 'SELECT p_id, p_section FROM ' . TABLE_PREFIX . 'contest_photo_ready';
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$readyIdList[$row['p_id']] = $row['p_section'];	
		}
		
		return $readyIdList;
	}
	
	
	
	/**
	* base on the filename of the avatar image of entry
	* 
	* return the value landscape or portrait (if end with "_p" in name part of file)
	* 
	*/
	public function getImageDirection($imagepath = '')
	{
		if($imagepath == '')
			$testImage = $this->filepath;
		else
			$testImage = $imagepath;
			
		if(strpos($testImage, '_p') !== false)
			return 'portrait';
		elseif(strpos($testImage, '_l') !== false)
			return 'landscape';
		else
			return '';
	}
}

?>