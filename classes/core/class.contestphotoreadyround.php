<?php

Class Core_ContestPhotoReadyRound extends Core_Object
{
	public $pid = 0;
	public $section = '';
	public $rid = 0;
	public $isfinished = 0;
	public $totalScore = 0;
	public $unscoredlist = '';
		
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
	
		$sql = 'INSERT IGNORE INTO ' . TABLE_PREFIX . 'contest_photo_ready_round(p_id, p_section, r_id)
				VALUES(?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->pid, 
		    	(string)$this->section, 
		    	(int)$this->rid 
			))->rowCount();
			
				
		return $rowCount;
	}
	
	public static function addDataFromList($photoIdSectionList, $roundid)
	{
		global $db;
		
		//clear current round & photo binding
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_ready_round
				WHERE r_id = ?';
		$db->query($sql, array($roundid));
		
		//begin to insert new binding
		foreach($photoIdSectionList as $pid => $section)
		{
			if($pid > 0)
			{
				$sql = 'INSERT IGNORE INTO ' . TABLE_PREFIX . 'contest_photo_ready_round(p_id, p_section, r_id)
						VALUES(?, ?, ?)';
				$db->query($sql, array($pid, $section, $roundid));		
			}
			
		}
	}
	
	public function updateData()
	{               
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_photo_ready_round
        		SET pr_isfinished = ?,
        			pr_totalscore = ?,
        			pr_unscoredlist = ?
        		WHERE p_id = ? AND r_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(int)$this->isfinished,
				(int)$this->totalScore,
				(string)$this->unscoredlist,
				(int)$this->pid,
				(int)$this->rid,
			));
			
		if($stmt)
			return true;
		else
			return false;
	}
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_ready_round
        		WHERE p_id =  ? 
        			AND r_id = ? 
        		LIMIT 1
        			';
		$rowCount = $this->db->query($sql, array($this->pid, $this->rid))->rowCount();
				
		return $rowCount;
       
	}
	
	
	
	public static function countList($where = '')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr
				WHERE ' . $where;
        //var_dump($sql);
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'prrr.r_id > 0', $order = 'prr.p_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myReadyRound = new Core_ContestPhotoReadyRound();
			
			$myReadyRound->pid = $row['p_id'];
			$myReadyRound->section = $row['p_section'];
			$myReadyRound->rid = $row['r_id'];
			$myReadyRound->isfinished = $row['pr_isfinished'];
			$myReadyRound->totalScore = $row['pr_totalscore'];
			$myReadyRound->unscoredlist = $row['pr_unscoredlist'];
			$outputList[] = $myReadyRound;
		}
		return $outputList;
	}
	
	public static function getPhotos($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'prr.p_id > 0 ';
		
		if($formData['fpid'] > 0)
		{
			$whereString .= ' AND prr.p_id = '.(int)$formData['fpid'].' ';
		}
		
		if($formData['frid'] > 0)
		{
			$whereString .= ' AND prr.r_id = '.(int)$formData['frid'].' ';
		}
		
		if($formData['fisfinished'] == 'YES')
		{
			$whereString .= ' AND prr.pr_isfinished = 1 ';
		}
		elseif($formData['fisfinished'] == 'NO')
		{
			$whereString .= ' AND prr.pr_isfinished = 0 ';
		}
		
		if($formData['funscored'] > 0)
		{
			$whereString .= ' AND prr.pr_totalscore = 0 ';
		}
		
		if($formData['funscoredid'] > 0)
		{
			$whereString .= ' AND prr.pr_unscoredlist LIKE "%,'.$formData['funscoredid'].',%" ';
		}
		
        
		if(count($formData['fpasspoint']) > 0)
		{
			$whereString .= ' AND ((prr.p_section LIKE "color-c" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColor'].')
                             OR (prr.p_section LIKE "landscape-c" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColorBestPortrait'].')
                             OR (prr.p_section LIKE "sport-c" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColorBestAction'].')
                             OR (prr.p_section LIKE "idea-c" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColorBestIdea'].')
                             OR (prr.p_section LIKE "mono-m" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMono'].')
                             OR (prr.p_section LIKE "landscape-m" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMonoBestPortrait'].')
                             OR (prr.p_section LIKE "sport-m" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMonoBestAction'].')
                             OR (prr.p_section LIKE "idea-m" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMonoBestCreative'].')
                             OR (prr.p_section LIKE "nature-n" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionNature'].')
                             OR (prr.p_section LIKE "snow-n" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionNatureBestSnow'].')
                             OR (prr.p_section LIKE "bird-n" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionNatureBestBird'].')
                             OR (prr.p_section LIKE "flower-n" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionNatureBestFlower'].')
                             OR (prr.p_section LIKE "travel-t" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionTravel'].')
                             OR (prr.p_section LIKE "transportation-t" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionTravelBestTransportation'].')
                             OR (prr.p_section LIKE "dress-t" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionTravelBestTraditional'].')
                             OR (prr.p_section LIKE "country-t" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionTravelBestCountry'].'))';
		}
        
		
		if(!empty($formData['fsection']))
			$whereString .= ' AND prr.p_section = "'.$formData['fsection'].'" ';
    
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'color')
            $whereString .= ' AND prr.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono-m' || $formData['fsection'] == 'mono')
            $whereString .= ' AND prr.p_section LIKE "%-m" ';
           if($formData['fsection'] == 'travel-t' || $formData['fsection'] == 'travel')
            $whereString .= ' AND prr.p_section LIKE "%-t" ';
              if($formData['fsection'] == 'nature-n' || $formData['fsection'] == 'nature')
            $whereString .= ' AND prr.p_section LIKE "%-n" ';  
        
		
		if(is_array($formData['fsection']) && count($formData['fsection']) > 0)
		{
			for($i = 0; $i < count($formData['fsection']); $i++)
			{
				$formData['fsection'][$i] = '"' . $formData['fsection'][$i] . '"';
			}
			$whereString .= ' AND prr.p_section IN ('.implode(',', $formData['fsection']).') ';
		}
		
				
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'round')
			$orderString = ' prr.r_id ' . $sorttype;    
		else
			$orderString = ' prr.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	public static function getPhotosBackend($roundId,$limit = '' ,$countOnly = false){
		global $db;
		if($countOnly == false){
			
			$sql = 'SELECT p_id FROM '.TABLE_PREFIX.'contest_photo_ready_round WHERE r_id ='.$roundId;
			if($limit != ''){
				$sql.=' LIMIT '.$limit;
			}
			$stmt = $db->query($sql);
			while($row = $stmt->fetch()){
				$myPhoto = new Core_ContestPhoto($row['p_id']);
				// $myPhoto->id = $row['p_id'];
				// $myPhoto->uid = $row['u_id'];
				// $myPhoto->section = $row['p_section'];
				// $myPhoto->name = $row['p_name'];
				// $myPhoto->fileserver = $row['p_fileserver'];
				// $myPhoto->filepath = $row['p_filepath'];
				// $myPhoto->filethumb1 = $row['p_filethumb1'];
				// $myPhoto->view = $row['p_view'];
				// $myPhoto->enable = $row['p_enable'];
				// $myPhoto->datecreated = $row['p_datecreated'];
				// $myPhoto->poster = new Core_User();
				// $myPhoto->poster->getByArray($row);	
				$outputList[] = $myPhoto;	
			}
			return $outputList;
		}else{
			$sql = 'SELECT COUNT(p_id) FROM '.TABLE_PREFIX.'contest_photo_ready_round WHERE r_id ='.$roundId;
			$result = $db->query($sql)->fetchSingle();
			return $result;
		}	
	}
	
	
	
	public static function getListFull($where = 'prrr.r_id > 0', $order = 'prr.p_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_ready_round prr
				INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready p ON p.p_id = prr.p_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON up.u_id = u.u_id
				WHERE ' . $where . '
				ORDER BY ' . $order;      
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;	
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myReadyRound = new Core_ContestPhotoReadyRound();
			
			$myReadyRound->pid = $row['p_id'];
			$myReadyRound->section = $row['p_section'];
			$myReadyRound->rid = $row['r_id'];
			$myReadyRound->isfinished = $row['pr_isfinished'];
			$myReadyRound->totalScore = $row['pr_totalscore'];
			$myReadyRound->unscoredlist = $row['pr_unscoredlist'];
			$myReadyRound->photo = new Core_ContestPhotoReady();
			$myReadyRound->photo->getDataByArray($row);
			$myReadyRound->poster = new Core_User();
			$myReadyRound->poster->getByArray($row);
			$outputList[] = $myReadyRound;
		}
		return $outputList;
	}
	
	public static function getPhotosFull($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'prr.p_id > 0 ';
		
		if($formData['fpid'] > 0)
		{
			$whereString .= ' AND prr.p_id = '.(int)$formData['fpid'].' ';
		}
		
		if($formData['frid'] > 0)
		{
			$whereString .= ' AND prr.r_id = '.(int)$formData['frid'].' ';
		}
		
		if($formData['fisfinished'] == 'YES')
		{
			$whereString .= ' AND prr.pr_isfinished = 1 ';
		}
		elseif($formData['fisfinished'] == 'NO')
		{
			$whereString .= ' AND prr.pr_isfinished = 0 ';
		}
		
		if($formData['funscored'] > 0)
		{
			$whereString .= ' AND prr.pr_totalscore = 0 ';
		}
		
		if($formData['funscoredid'] > 0)
		{
			$whereString .= ' AND prr.pr_unscoredlist LIKE "%,'.$formData['funscoredid'].',%" ';
		}
		
		if(count($formData['fpasspoint']) > 0)
        {
            $whereString .= ' AND ((prr.p_section LIKE "color-c" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColor'].')
                             OR (prr.p_section IN("landscape-c","sport-c","idea-c") AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionColorBest'].')
                             OR (prr.p_section LIKE "mono-m" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMono'].')
                             OR (prr.p_section IN("landscape-m","sport-m","idea-m") AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionMonoBest'].')
                             OR (prr.p_section LIKE "nature" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionNature'].')
                             OR (prr.p_section LIKE "travel" AND prr.pr_totalscore >=  ' . (int)$formData['fpasspoint']['sectionTravel'].'))';
        }
		
		//Filter by section
		if($formData['fsection'] == 'color' || $formData['fsection'] == 'mono' || $formData['fsection'] == 'nature' )
		{
			//$whereString .= ' AND prr.p_section = "'.$formData['fsection'].'" ';
            if($formData['fsection'] == 'color')
            {
                $whereString .= ' AND prr.p_section LIKE "%-c" ';
            }
            elseif($formData['fsection'] == 'mono')
            {
                $whereString .= ' AND prr.p_section LIKE "%-m" ';
            }
            elseif($formData['fsection'] == 'travel' || $formData['fsection'] == 'nature' )
            {
                $whereString .= ' AND prr.p_section = "'.$formData['fsection'].'" ';
            }
            
		}

		if(is_array($formData['fsection']) && count($formData['fsection']) > 0)
		{   
			for($i = 0; $i < count($formData['fsection']); $i++)
			{				
                if($formData['fsection'][$i] != 'colorbest' AND $formData['fsection'][$i] != 'monobest')
                    if($formData['fsection'][$i] == 'color')
                        $formData['fsection'][$i] = '"color-c"';
                    elseif($formData['fsection'][$i] == 'mono')
                        $formData['fsection'][$i] = '"mono-m"';
                    else
                    $formData['fsection'][$i] = '"' . $formData['fsection'][$i] . '"';
                else
                {
                    if($formData['fsection'][$i] == 'colorbest')
                    {
                        unset($formData['fsection'][$i]);
                       $formData['fsection'][$i] = '"landscape-c","sport-c","idea-c"';  
                    }
                    
                    if($formData['fsection'][$i] == 'monobest')
                    {
                       unset($formData['fsection'][$i]);
                       $formData['fsection'][$i] = '"landscape-m","sport-m","idea-m"';   
                    }                    
                }                
			}
            
			$whereString .= ' AND prr.p_section IN ('.implode(',', $formData['fsection']).') ';
		}
		
				
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		$orderString = ' prr.p_section ASC, prr.pr_totalscore DESC ';
		/*
		if($sortby == 'round')
			$orderString = ' prr.r_id ' . $sorttype;    
		elseif($sortby == 'score')
			$orderString = ' prr.pr_totalscore ' . $sorttype;    
		else
			$orderString = ' prr.p_id ' . $sorttype;   
		*/         		
		return self::getListFull($whereString, $orderString, $limit);
			
	}
	
	
}


?>