<?php

Class Core_UserJudge extends Core_Object
{
	
	public $uid = 0;
	public $isColor = 0;
	public $isColorBestPortrait = 0;
	public $isColorBestIdea = 0;
	public $isColorBestAction = 0;
	public $isMono = 0;
	public $isMonoBestPortrait = 0;
	public $isMonoBestAction = 0;
	public $isMonoCreative = 0;
	public $isNature = 0;
	public $isNatureBestBird = 0;
	public $isNatureBestSnow = 0;
	public $isNatureBestFlower = 0;
	public $isTravel = 0;
    public $isTravelTransportation = 0;
	public $isTravelTraditional = 0;
    public $isTravelCountry = 0;
	public $isViewOnly = 0;
	public $datecreated = '';
    public $group = '';
	public $user;
	
	
	
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
	
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'ac_user_judge(u_id, uj_datecreated, uj_photogroup)
				VALUES(?, ?, ?)';
				
		$rowCount = $this->db->query($sql, array(
				(int)$this->uid,
				(int)$this->datecreated,
                $this->group,
			))->rowCount();
			
		
		return $this->uid;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'ac_user_judge
        		WHERE u_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->uid))->rowCount();
		
		return $rowCount;
       
	}
	
		
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user_judge uj
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON uj.u_id = u.u_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id
				WHERE uj.u_id = ?';
		$stmt = $this->db->query($sql, array($id));
		while($row = $stmt->fetch())
		{
			$this->uid = $row['u_id'];
            $this->isColor = $row['uj_iscolor'];
            $this->isColorBestPortrait = $row['uj_iscolorbestportrait'];
            $this->isColorBestAction = $row['uj_iscolorbestaction'];
            $this->isColorBestIdea = $row['uj_iscolorbestidea'];
            $this->isMono = $row['uj_ismono'];
            $this->isMonoBestAction = $row['uj_ismonobestaction'];
            $this->isMonoBestPortrait = $row['uj_ismonobestportrait'];
            $this->isMonoCreative = $row['uj_ismonobestcreative'];
            $this->isNature = $row['uj_isnature'];
            $this->isNatureBestBird = $row['uj_isnaturebestbird'];
            $this->isNatureBestSnow = $row['uj_isnaturebestsnow'];
            $this->isNatureBestFlower = $row['uj_isnaturebestflower'];
            $this->isTravel = $row['uj_istravel'];
            $this->isTravelTransportation = $row['uj_istraveltransportation'];
            $this->isTravelCountry = $row['uj_istravelcountry'];
            $this->isTravelTraditional = $row['uj_istraveltraditional'];
            $this->group = $row['uj_photogroup'];
            
			$this->isViewOnly = $row['uj_isviewonly'];
			$this->datecreated = $row['uj_datecreated'];
			$this->user = new Core_User();
			$this->user->getByArray($row);
		}
	}
	
	public function updateData()
	{               
        $sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user_judge
                SET uj_iscolor = ?,
        		    uj_iscolorbestportrait = ?,
                    uj_iscolorbestidea = ?,
        			uj_iscolorbestaction = ?,
                    uj_ismono = ?,
        			uj_ismonobestportrait = ?,
        			uj_ismonobestaction = ?,
        			uj_ismonobestcreative = ?,
                    uj_isnature = ?,
        			uj_isnaturebestbird = ?,
        			uj_isnaturebestsnow = ?,
        			uj_isnaturebestflower = ?,
                    uj_istravel = ?,
        			uj_istraveltransportation = ?,
                    uj_istraveltraditional = ?,
        			uj_istravelcountry = ?,
        			uj_isviewonly = ?
			
        		WHERE u_id = ?';
        		
		$stmt = $this->db->query($sql, array(
                (int)$this->isColor,
				(int)$this->isColorBestPortrait,
				(int)$this->isColorBestIdea,
				(int)$this->isColorBestAction,
				(int)$this->isMono,
				(int)$this->isMonoBestPortrait,
				(int)$this->isMonoBestAction,
				(int)$this->isMonoCreative,
				(int)$this->isNature,
				(int)$this->isNatureBestBird,
                (int)$this->isNatureBestSnow,
				(int)$this->isNatureBestFlower,
				(int)$this->isTravel,
				(int)$this->isTravelTransportation,
				(int)$this->isTravelTraditional,
				(int)$this->isTravelCountry,
				(int)$this->isViewOnly,
				(int)$this->uid
			));	
		return $stmt;
	}
	
	
	
	public static function countList($where = 'uj.u_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'ac_user_judge uj
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON uj.u_id = u.u_id
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'uj.u_id > 0', $order = 'uj.u_id DESC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user_judge uj
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON uj.u_id = u.u_id
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id
				WHERE ' . $where . '
				ORDER BY ' . $order;
			if($limit != '')
			$sql .= ' LIMIT ' . $limit;
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myJudge = new Core_UserJudge();
						$myJudge->uid = $row['u_id'];

            $myJudge->group = $row['uj_photogroup'];
			$myJudge->isViewOnly = $row['uj_isviewonly'];
			$myJudge->datecreated = $row['uj_datecreated'];
			$myJudge->user = new Core_User();
			$myJudge->user->getByArray($row);
			
			$outputList[] = $myJudge;
		}
		return $outputList;
	}
	
	public static function getJudges($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'uj.u_id > 0 ';
		
		if($formData['fuserid'] > 0)
			$whereString .= ' AND uj.u_id = '.(int)$formData['fuserid'].' ';
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		$orderString = ' uj.u_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
}


?>