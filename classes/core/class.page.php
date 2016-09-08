<?php

Class Core_Page extends Core_Object
{
	public $id = 0;
	public $idtext = '';
	public $enable = 1;
	public $title = array();
	public $contents = array();
	public $seoTitle = array();
	public $seoKeyword = array();
	public $seoDescription = array();
	public $lang = '';
	
	public function __construct($id = 0, $langcode = '')
	{
		global $setting;
		
		parent::__construct($id);                
		
		$this->lang = $langcode;
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData()
	{
		$this->datecreated = time();
	
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'page(p_id, p_idtext, p_enable)
				VALUES(?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->id, 
		    	(string)$this->idtext,
		    	(string)$this->enable
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		if($this->id > 0)
		{
			$sql = 'INSERT INTO ' . TABLE_PREFIX . 'page_language(p_id, l_code, pl_title, pl_contents, pl_seotitle, pl_seokeyword, pl_seodescription)
					VALUES(?, ?, ?, ?, ?, ?, ?)';
			foreach($this->title as $langcode=>$value)
			{
				$this->db->query($sql, array($this->id, $langcode, $this->title[$langcode],  $this->contents[$langcode],  $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode], ));
			}
		}
		
		return $this->id;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		global $setting;
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'page
        		WHERE p_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		//delte from language binding
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'page_language
        		WHERE p_id =  ?
        			';
		$this->db->query($sql, array($this->id));
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		if($this->lang != '')
		{
			
		}
		else
		{
			$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'page p
					INNER JOIN ' . TABLE_PREFIX . 'page_language pl ON p.p_id = pl.p_id
					WHERE p.p_id = ?';
			$stmt = $this->db->query($sql, array($id));
			
			while($row = $stmt->fetch())
			{
				$this->id = $row['p_id'];
				$this->idtext = $row['p_idtext'];
				$this->enable = $row['p_enable'];
				$this->title[$row['l_code']] = $row['pl_title'];
				$this->contents[$row['l_code']] = $row['pl_contents'];
				$this->seoTitle[$row['l_code']] = $row['pl_seotitle'];
				$this->seoKeyword[$row['l_code']] = $row['pl_seokeyword'];
				$this->seoDescription[$row['l_code']] = $row['pl_seodescription'];
			}
		}
	}
	
	public function getDataByText($idtext)
	{
		if($this->lang == '')
		{
		}
		else
		{
			$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'page p
					INNER JOIN ' . TABLE_PREFIX . 'page_language pl ON p.p_id = pl.p_id
					WHERE p_idtext = ? AND l_code = ?
					LIMIT 1';
			$row = $this->db->query($sql, array($idtext, $this->lang))->fetch();
			if($row['p_id'] > 0)
			{
				$this->id = $row['p_id'];
				$this->idtext = $row['p_idtext'];
				$this->title[$this->lang] = $row['pl_title'];
				$this->contents[$this->lang] = $row['pl_contents'];
				$this->seoTitle[$this->lang] = $row['pl_seotitle'];
				$this->seoKeyword[$this->lang] = $row['pl_seokeyword'];
				$this->seoDescription[$this->lang] = $row['pl_seodescription'];
			}
		}
	}
	
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'page
        		SET p_idtext = ?,
        			p_enable = ?
        		WHERE p_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->idtext,
				$this->enable,
		    	$this->id
			));
			
		if($stmt)
		{
			foreach($this->title as $langcode=>$value)
			{
				//check binding with language            
				$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'page_language
						WHERE p_id = ? AND l_code = ?
						LIMIT 1';
				if($this->db->query($sql, array($this->id, $langcode))->fetchSingle() > 0)
				{
					//binding existed, begin update
					$sql = 'UPDATE ' . TABLE_PREFIX . 'page_language
							SET pl_title = ?,
								pl_contents = ?,
								pl_seotitle = ?,
								pl_seokeyword = ?,
								pl_seodescription = ?
							WHERE p_id = ? AND l_code = ?';
					$this->db->query($sql, array($this->title[$langcode],  $this->contents[$langcode],  $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode], $this->id, $langcode));
				}
				else
				{
					//binding not existed, insert this
					$sql = 'INSERT INTO ' . TABLE_PREFIX . 'page_language(p_id, l_code, pl_title, pl_contents, pl_seotitle, pl_seokeyword, pl_seodescription)
							VALUES(?, ?, ?, ?, ?, ?, ?)';
					$this->db->query($sql, array($this->id, $langcode, $this->title[$langcode],  $this->contents[$langcode],  $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode] ));
				}
			}
		}
			
		return $stmt;
	}
	
	public static function countList($where = 'p.p_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'page p
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'p.p_id > 0', $order = 'p.p_idtext ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'page p
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPage = new Core_Page();
			
			$myPage->id = $row['p_id'];
			$myPage->idtext = $row['p_idtext'];
			$myPage->enable = $row['p_enable'];
				
			$outputList[] = $myPage;
		}
		return $outputList;
	}
	
	public static function getPages($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'p.p_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
			
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'idtext')
			$orderString = ' p.p_idtext ' . $sorttype;    
		else
			$orderString = ' p.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	
	
	
	
}


?>