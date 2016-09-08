<?php

Class Core_ContestRound extends Core_Object
{
	public $id = 0;
	public $name = '';
	public $description = '';
	public $isactive = 0;
	public $isgiveaward = 0;
	public $datecreated = 0;
	public $passPoint = '';
	public $isEnableView = 0;
	
		
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
	
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_round(r_name, r_description, r_isactive, r_isgiveaward, r_datecreated, r_passpoint)
				VALUES(?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(string)$this->name, 
		    	(string)$this->description, 
		    	(int)$this->isactive, 
		    	(int)$this->isgiveaward, 
		    	(int)$this->datecreated, 
		    	(string)$this->passPoint,
		    	(int)$this->isEnableView,
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_round
        		WHERE r_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
				
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_round r
				WHERE r.r_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['r_id'];
			$this->name = $row['r_name'];
			$this->description = $row['r_description'];
			$this->isactive = $row['r_isactive'];
			$this->isgiveaward = $row['r_isgiveaward'];
			$this->datecreated = $row['r_datecreated'];
			$this->passPoint = $row['r_passpoint'];
			$this->isEnableView = $row['r_enable_view'];
		}
	}
	
		
	public function updateData()
	{               
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_round
        		SET r_name = ?,
        			r_description = ?,
        			r_isactive = ?,
        			r_isgiveaward = ?,
        			r_datecreated = ?,
        			r_passpoint = ?,
        			r_enable_view = ?
        		WHERE r_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(string)$this->name,
				(string)$this->description,
				(int)$this->isactive,
				(int)$this->isgiveaward,
				(int)$this->datecreated,
				(string)$this->passPoint,
				(int)$this->isEnableView,
				(int)$this->id
			));
					
		return $stmt;
	}
	
	public static function countList($where = 'r.r_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_round r
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'r.r_id > 0', $order = 'r.r_id ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_round r
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myRound = new Core_ContestRound();
			
			$myRound->id = $row['r_id'];
			$myRound->name = $row['r_name'];
			$myRound->description = $row['r_description'];
			$myRound->isactive = $row['r_isactive'];
			$myRound->isgiveaward = $row['r_isgiveaward'];
			$myRound->datecreated = $row['r_datecreated'];
            $sectionsPoint = unserialize($row['r_passpoint']);
            $myRound->isEnableView = $row['r_enable_view'];
            $myRound->passPoint =   'Color:'.$sectionsPoint['sectionColor']
			                        .'<br/> Color Best Portrait:'.$sectionsPoint['sectionColorBestPortrait']
                                    .'<br/> Color Best Action:'.$sectionsPoint['sectionColorBestAction']
                                    .'<br/> Color Best Idea:'.$sectionsPoint['sectionColorBestIdea']
                                    .'<br/> Mono:'.$sectionsPoint['sectionMono']
                                    .'<br/> Mono Best Portraint:'.$sectionsPoint['sectionMonoBestPortrait']
                                    .'<br/> Mono Best Action:'.$sectionsPoint['sectionMonoBestAction']
                                    .'<br/> Mono Best Idea:'.$sectionsPoint['sectionMonoBestCreative']
                                    .'<br/> Nature:'.$sectionsPoint['sectionNature']
                                    .'<br/> Nature Best Snow:'.$sectionsPoint['sectionNatureBestSnow']
                                    .'<br/> Nature Best Bird:'.$sectionsPoint['sectionNatureBestBird']
                                    .'<br/> Nature Best Flower:'.$sectionsPoint['sectionNatureBestFlower']
                                    .'<br/> Travel:'.$sectionsPoint['sectionTravel']
                                    .'<br/> Travel Transportation:'.$sectionsPoint['sectionTravelBestTransportation']
                                    .'<br/> Travel Country:'.$sectionsPoint['sectionTravelBestCountry']
                                    .'<br/> Travel Traditional:'.$sectionsPoint['sectionTravelBestTraditional'];
				
			$outputList[] = $myRound;
		}
		return $outputList;
	}
	
	public static function getRounds($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'r.r_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND r.r_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fisactive'] == 1)
		{
			$whereString .= ' AND r.r_isactive = 1';
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' r.r_name ' . $sorttype;    
		else
			$orderString = ' r.r_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>