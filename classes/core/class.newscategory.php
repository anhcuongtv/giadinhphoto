<?php

Class Core_NewsCategory extends Core_Object
{
	public $id = 0;
	public $name = array();
	public $parentid = 0;
	public $order = 0;
	public $enable = 1;
	public $seoUrl = '';
	public $seoTitle = array();
	public $seoKeyword = array();
	public $seoDescription = array();
	public $datemodified = 0;
	
	
	public function __construct($id = 0)
	{
		parent::__construct();
		
		if($id > 0)
		{
			$this->getData($id);
		}
	}
	
	
	//Ham them record vao trong bang du lieu
	public function addData()
	{
		$this->datemodified = time();
		$this->order = $this->getOrder();
		//Thong tin chung cho cac muc tin:
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'newscategory 
				(`nc_parentid`, `nc_order`, `nc_enable`, `nc_seourl`, `nc_datemodified`)
				VALUES(?, ?, ?, ?, ?)';
		$rowCount = $this->db->query($sql, array(
		    	$this->parentid, $this->order, $this->enable, $this->seoUrl, $this->datemodified
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
        
        //Thong tin rieng:
        if($this->id > 0)
        {
            $sql = 'INSERT INTO ' . TABLE_PREFIX . 'newscategory_language
            (`nc_id`, `l_code`, `ncl_name`, `ncl_seotitle`, `ncl_seokeyword`, `ncl_seodescription`)
                    VALUES(?, ?, ?, ?, ?, ?)';
            foreach($this->name as $langcode=>$value)//Chi lay so luong cua mang $this->name
            {
                $this->db->query($sql, array($this->id, $langcode, $this->name[$langcode], $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode] ));
               
            }
        }
		return $this->id;//Tra ve id cua muc tin
	}
	
	public function updateData()
	{              
        global $registry;                              
		$this->datemodified = time();
        $sql = 'UPDATE ' . TABLE_PREFIX . 'newscategory
        		SET nc_parentid = ?,
        			nc_order = ?,
        			nc_enable = ?,
        			nc_seourl = ?,
        			nc_datemodified = ?
        		WHERE nc_id = ?';
        		
		$stmt = $this->db->query($sql, array(
		    	 $this->parentid, $this->order, $this->enable, $this->seoUrl, $this->datemodified, $this->id
			));
		if($stmt)
        {
            foreach($this->name as $langcode=>$value)
            {
                $sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'newscategory_language nl
                        WHERE nc_id = ? AND l_code = ?
                        LIMIT 1';
                if($this->db->query($sql, array($this->id, $langcode))->fetchSingle() > 0)
                {
                    $sql = 'UPDATE ' . TABLE_PREFIX . 'newscategory_language
                            SET ncl_name = ?,
                                ncl_seotitle = ?,
                                ncl_seokeyword = ?,
                                ncl_seodescription = ?
                            WHERE nc_id = ? AND l_code = ?';
                            
                    $this->db->query($sql, array($this->name[$langcode], $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode], $this->id, $langcode));
                }
                else
                {
                    $sql = 'INSERT INTO ' . TABLE_PREFIX . 'newscategory_language(nc_id, l_code, ncl_name, ncl_seotitle, ncl_seokeyword, ncl_seodescription)
                            VALUES(?, ?, ?, ?, ?, ?)';
                    $this->db->query($sql, array($this->id, $langcode, (string)$this->name[$langcode],  (string)$this->seotitle[$langcode],(string)$this->seokeyword[$langcode],(string)$this->seoDescription[$langcode]));
                }
            }
        }	
		////////////////////
		return $stmt;
	}
	
	
	
	public function getData($id)
	{
		$id = (int)$id;
		
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'newscategory n
                INNER JOIN ' . TABLE_PREFIX . 'newscategory_language nl ON n.nc_id = nl.nc_id
				WHERE n.nc_id = ?';
		$stmt = $this->db->query($sql, array($id)); 
        while($row=$stmt->fetch())
        {
            $this->id = $row['nc_id'];             
            $this->order = $row['nc_order'];
            $this->enable = $row['nc_enable'];
            $this->seoUrl = $row['nc_seourl'];
            $this->parentid = $row['nc_parentid'];
            $this->datemodified = $row['nc_datemodified'];
            
            $this->name[$row['l_code']] = $row['ncl_name'];
            $this->seoTitle[$row['l_code']] = $row['ncl_seotitle'];
            $this->seoKeyword[$row['l_code']] = $row['ncl_seokeyword'];
            $this->seoDescription[$row['l_code']] = $row['ncl_seodescription'];   
        }
	}
	
	
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'newscategory
        		WHERE nc_id = ?
        ';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		//delte from language binding
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'newscategory_language
                WHERE nc_id =  ?
                    ';
        $this->db->query($sql, array($this->id));
		if($rowCount > 0)
		{
			//tien hanh xoa subcategory
			$subcat = $this->getSub($this->id);
			foreach($subcat as $cat)
			{
				$cat->delete();
			}	
		}
		
		return $rowCount;
	}
	
	public function getSub($getSub = false)
	{
		return $this->getCategories(array('fparentid' => $this->id), '', '', '', false, $getSub);
	}
	
		
	public static function countList($where = 'n.nc_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'newscategory n
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'n.nc_id > 0', $order = 'n.nc_order ASC' , $limit = '', $getSub = false)
	{
		global $db, $registry;
		
		if($limit == '')
			$limitString = '';
		else
			$limitString = ' LIMIT ' . $limit;
			
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'newscategory n
                INNER JOIN '.TABLE_PREFIX.'newscategory_language nl ON n.nc_id=nl.nc_id
				WHERE l_code=? AND ' . $where . '
				ORDER BY ' . $order . '
				' . $limitString;
		$stmt = $db->query($sql,array($registry->langCode));
		while($row = $stmt->fetch())
		{
			$myCat = new Core_NewsCategory();
			$myCat->id = $row['nc_id'];
			$myCat->name[$registry->langCode] = $row['ncl_name'];
			$myCat->parentid = $row['nc_parentid'];
			$myCat->order = $row['nc_order'];
			$myCat->enable = $row['nc_enable'];
			$myCat->seoUrl = $row['nc_seourl'];
            $myCat->datemodified = $row['nc_datemodified'];
            
			if($getSub)
				$myCat->sub = $myCat->getSub();
				
			$outputList[] = $myCat;
		}
		return $outputList;
	}
	
	public static function getCategories($formData, $sortby, $sorttype, $limit = '', $countOnly = false, $getSub = false)
	{
		
		$whereString = 'n.nc_id > 0';
		
		if($formData['fparentid'] >= 0)
		{
			$whereString .= ' AND n.nc_parentid = ' . (int)$formData['fparentid'];
		}
		
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, 'n.nc_order ASC', $limit, $getSub);
	}
	
	public static function getFullCategories($parentId = '0', $level = 0, $prefix='')
	{
		global $db, $registry;
		$output = array();
		
		$sql = 'SELECT * 
				FROM ' . TABLE_PREFIX . 'newscategory n
                INNER JOIN '.TABLE_PREFIX.'newscategory_language nl ON n.nc_id=nl.nc_id
				WHERE nc_parentid = ? AND l_code=? 
				ORDER BY nc_order';
		$categoryList = $db->query($sql, array($parentId,$registry->langCode))->fetchAll();
		$level++; 
		foreach($categoryList as $category)
		{
			
			$prefixTemp = $prefix . ' &raquo; ' . $category['ncl_name'];
			$myCat = new Core_NewsCategory();
            
			$myCat->level = $level;
			$myCat->id = $category['nc_id'];
			$myCat->name = $category['ncl_name'];
			$myCat->enable = $category['nc_enable'];
			$myCat->order = $category['nc_order'];
			$myCat->title = $prefixTemp;
			$output[] = $myCat;
			$output = array_merge($output, self::getFullCategories($category['nc_id'], $level, $prefixTemp ));
		}
		return $output;
	}
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(nc_order) FROM ' . TABLE_PREFIX . 'newscategory';
		return $this->db->query($sql)->fetchSingle() + 1;
	}
}


?>