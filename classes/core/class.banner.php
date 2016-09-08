<?php

Class Core_Banner extends Core_Object
{
	const ERROR_OK = 1;
	const ERROR_UPLOAD_IMAGE = 2;
	const ERROR_UNKNOWN = 4;
	
	public $id = 0;
	public $positionid;
	public $name = '';
	public $link = '';
	public $source = '';
	public $extension = '';
	public $width = 0;
	public $height = 0;
	public $enable = 1;
	public $order = 0;
	public $datecreated = 0;
	public $position;
	
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
		$this->order = $this->getOrder();
	
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'adv_banner(abp_id, ab_name, ab_link, ab_source, ab_width, ab_height, ab_enable, ab_order, ab_datecreated)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';  
				
		$rowCount = $this->db->query($sql, array(
				(int)$this->positionid,
		    	(string)$this->name,
		    	(string)$this->link,
		    	(string)$this->source,
		    	(int)$this->width,
		    	(int)$this->height,
		    	(int)$this->enable,
		    	(int)$this->order,
		    	$this->datecreated
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		if($this->id > 0)
		{
			//upload image
			$uploadImageResult = $this->uploadImage();
			if($uploadImageResult != Uploader::ERROR_UPLOAD_OK)
				return self::ERROR_UPLOAD_IMAGE;
			else if($this->source != '')
			{
				//update source
				$sql = 'UPDATE ' . TABLE_PREFIX . 'adv_banner
						SET ab_source = ?
						WHERE ab_id = ?';
				if(!$this->db->query($sql, array($this->source, $this->id)))
					return self::ERROR_UPLOAD_IMAGE;
			}
			
			return self::ERROR_OK;
		}
		else
			return self::ERROR_UNKNOWN;
	}
	
	
	
	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'adv_banner
        		WHERE ab_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($rowCount > 0)
		{
			//do something here
			$this->deleteImage();
		}
		
		return $rowCount;
       
	}
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'adv_banner ab
				LEFT JOIN ' . TABLE_PREFIX . 'adv_banner_position abp ON ab.abp_id = abp.abp_id
				WHERE ab.ab_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->positionid = $row['abp_id'];
			$this->id = $row['ab_id'];
			$this->name = $row['ab_name'];
			$this->link = $row['ab_link'];
			$this->source = $row['ab_source'];
			$this->width = $row['ab_width'];
			$this->height = $row['ab_height'];
			$this->enable = $row['ab_enable'];
			$this->order = $row['ab_order'];
			$this->datecreated = $row['ab_datecreated'];
			$this->extension = strtoupper(substr($this->source, strrpos($this->source, '.') + 1));
			$this->position = new Core_BannerPosition();
			$this->positionid = $this->position->id = $row['abp_id'];
			$this->position->name = $row['abp_name'];
			$this->position->description = $row['abp_description'];
		}
	}
	
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'adv_banner
        		SET abp_id = ?,
        			ab_name = ?,
        			ab_link = ?,
        			ab_source = ?,
        			ab_width = ?,
        			ab_height = ?,
        			ab_enable = ?,
        			ab_order = ?
        		WHERE ab_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(int)$this->positionid,
				(string)$this->name,
				(string)$this->link,
				(string)$this->source,
				(int)$this->width,
				(int)$this->height,
				(int)$this->enable,
				(int)$this->order,
		    	$this->id
			));
			
		if($stmt)
		{
			return self::ERROR_OK;
		}
		else
		{
			return self::ERROR_UNKNOWN;
		}
	}
	
	public static function countList($where = 'ab.ab_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'adv_banner ab
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'ab.ab_id > 0', $order = 'ab.ab_name ASC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'adv_banner ab
				LEFT JOIN ' . TABLE_PREFIX . 'adv_banner_position abp ON ab.abp_id = abp.abp_id
				WHERE ' . $where . '
				ORDER BY ' . $order;
				
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
				
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myBanner = new Core_Banner();
			$myBanner->positionid = $row['abp_id'];
			$myBanner->id = $row['ab_id'];
			$myBanner->name = $row['ab_name'];
			$myBanner->link = $row['ab_link'];
			$myBanner->source = $row['ab_source'];
			$myBanner->width = $row['ab_width'];
			$myBanner->height = $row['ab_height'];
			$myBanner->enable = $row['ab_enable'];
			$myBanner->order = $row['ab_order'];
			$myBanner->datecreated = $row['ab_datecreated'];
			$myBanner->extension = strtoupper(substr($myBanner->source, strrpos($myBanner->source, '.') + 1));
			$myBanner->position = new Core_BannerPosition();
			$myBanner->positionid = $myBanner->position->id = $row['abp_id'];
			$myBanner->position->name = $row['abp_name'];
			$myBanner->position->description = $row['abp_description'];
			
			$outputList[] = $myBanner;
		}
		return $outputList;
	}
	
	public static function getBanners($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		$whereString = 'ab.ab_id > 0 ';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND ab.ab_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fposition'] > 0)
		{
			$whereString .= ' AND ab.abp_id = '.(int)$formData['fposition'].' ';
		}
		
		if(strlen($formData['fkeyword']) > 0)
		{
			
			if($formData['fsearchin'] == 'name')
			{
				$whereString .= ' AND ab.ab_name LIKE \'%'.$formData['fkeyword'].'%\'';
			}
			else
			{
				$whereString .= ' AND ab.ab_name LIKE \'%'.$formData['fkeyword'].'%\'';
			}
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' ab.ab_name ' . $sorttype;    
		if($sortby == 'position')
			$orderString = ' abp.abp_name ' . $sorttype . ', ab.ab_order ASC';    
		else
			$orderString = ' ab.ab_id ' . $sorttype;            
				
		if($countOnly)
			return self::countList($whereString);
		else
			return self::getList($whereString, $orderString, $limit);
	}
	
	public function uploadImage()
	{
		global $registry;
		
		if(strlen($_FILES['fimage']['name']) > 0)
		{
			$curDateDir = ''; 
			$extPart = substr(strrchr($_FILES['fimage']['name'],'.'),1);
			$namePart =  Helper::codau2khongdau( $this->name, true);
			$name = $namePart . '.' . $extPart;
			
			$uploader = new Uploader($_FILES['fimage']['tmp_name'], $name, $registry->setting['banner']['imageDirectory'] . $curDateDir, '', $registry->setting['banner']['validType']);
			
			$uploadError = $uploader->upload(false, $name);
			if($uploadError != Uploader::ERROR_UPLOAD_OK)
			{
				return $uploadError;
			}
			else
			{
				//update database
				$this->source = $curDateDir . $name;
			}
		}
	}
	
	public function deleteImage($imagepath = '')
	{
		global $registry;
		
		//delete current image
		if($imagepath == '')
			$deletefile = $this->source;
		else
			$deletefile = $imagepath;
		
		if(strlen($deletefile) > 0)
		{
			$file = $registry->setting['banner']['imageDirectory'] . $deletefile;
			if(file_exists($file) && is_file($file))
			{
				@unlink($file);
			}
			
			//delete current image
			if($imagepath == '')
				$this->source = '';
		}
	}
	
	private function getOrder()
	{
		$sql = 'SELECT MAX(ab_order) FROM ' . TABLE_PREFIX . 'adv_banner WHERE abp_id = ?';
		return $this->db->query($sql, array($this->positionid))->fetchSingle() + 1;
	}
	
	
	
	
}


?>