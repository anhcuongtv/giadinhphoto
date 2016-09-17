<?php

Class Core_ContestPhotoChild extends Core_Object
{
	const ERROR_OK = 1;
	const ERROR_UPLOAD_IMAGE = 2;
	const ERROR_UNKNOWN = 4;
	
	public $id = 0;
	public $uid = 0;
	public $section = 0;
	public $name = '';
	public $description = '';
	public $filesizeinbyte = 0;
	public $resolution = '';
	public $fileserver = '';
	public $filepath = '';
	public $filethumb1 = '';
	public $filethumb2 = '';
	public $comment = 0;
	public $view = 0;
	public $enable = 0;
	public $displaymode = 0;
	public $cancomment = 0;
	public $datecreated = 0;
	public $poster;
    public $parentSection = '';
    public $parentID = '';

	
	public function __construct($id = 0)
	{
		global $setting;
		
		parent::__construct($id);                
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData($ignoreuploadfile = false)
	{
		$this->datecreated = time();
	
		//them thong tin chung cua cac page
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'contest_photo_group(u_id, p_section, p_name, p_description, p_filesizeinbyte, p_resolution, p_fileserver, p_filepath, p_filethumb1, p_filethumb2, p_view, p_enable, p_displaymode, p_cancomment, p_datecreated,p_parentSection, p_parentID)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		
		$rowCount = $this->db->query($sql, array(
				$this->uid,
				$this->section,
				$this->name,
				$this->description,
				$this->filesizeinbyte,
				$this->resolution,
				$this->fileserver,
				$this->filepath,
				$this->filethumb1,
				$this->filethumb2,
				$this->view,
				$this->enable,
				$this->displaymode,
				$this->cancomment,
		    	$this->datecreated,
                $this->parentSection,
                $this->parentID,
			))->rowCount();
			
		$this->id = $this->db->lastInsertId();
		
		if($this->id > 0)
		{
			if(!$ignoreuploadfile)
			{
				//upload image
				$uploadImageResult = $this->uploadImage();
				if($uploadImageResult != Uploader::ERROR_UPLOAD_OK)
				{
					$this->delete();
					return self::ERROR_UPLOAD_IMAGE;
				}
				else if($this->filepath != '')
				{
					//update source
					$sql = 'UPDATE ' . TABLE_PREFIX . 'contest_photo_group
							SET p_fileserver = ?,
								p_filepath = ?,
								p_filethumb1 = ?,
								p_filethumb2 = ?
							WHERE p_id = ?';
					if(!$this->db->query($sql, array($this->fileserver, $this->filepath, $this->filethumb1, $this->filethumb2, $this->id)))
					{
						$this->delete();
						return self::ERROR_UPLOAD_IMAGE;
					}
					else
					{
						return self::ERROR_OK;
					}
				}
			}
			else
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
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'contest_photo_group
        		WHERE p_id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		if($rowCount > 0)
		{
			//xoa photo tren cung server US
			if($this->fileserver == '')
			{
				//do something here
				$this->deleteImage();
				
				//delete comment
				//$this->deleteComment();
			}
			
			
		}
		
		return $rowCount;
       
	}

    public static function checkSectionUpload($sectionID)
    {
        global $db;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_group
				WHERE p_section = ?';
        $stmt = $db->query($sql, array($sectionID));
        while($row = $stmt->fetch())
        {
            return $row;
        }
        return false;
    }
	
	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_group p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				WHERE p.p_id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['p_id'];
			$this->uid = $row['u_id'];
			$this->section = $row['p_section'];
			$this->name = $row['p_name'];
			$this->description = $row['p_description'];
			$this->filesizeinbyte = $row['p_filesizeinbyte'];
			$this->resolution = $row['p_resolution'];
			$this->fileserver = $row['p_fileserver'];
			$this->filepath = $row['p_filepath'];
			$this->filethumb1 = $row['p_filethumb1'];
			$this->filethumb2 = $row['p_filethumb2'];
			$this->comment = $row['p_comment'];
			$this->view = $row['p_view'];
			$this->enable = $row['p_enable'];
			$this->displaymode = $row['p_displaymode'];
			$this->cancomment = $row['p_cancomment'];
			$this->datecreated = $row['p_datecreated'];
			$this->poster = new Core_User();
			$this->poster->getByArray($row);
            $this->parentSection = $row['p_parentSection'];
            $this->parentID = $row['p_parentID'];
		}
	}
		
	public function updateData()
	{               
		global $registry;    
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_photo_group
        		SET u_id = ?,
        			p_section = ?,
        			p_name = ?,
        			p_description = ?,
        			p_filesizeinbyte = ?,
        			p_resolution = ?,
        			p_fileserver = ?,
        			p_filepath = ?,
        			p_filethumb1 = ?,
        			p_filethumb2 = ?,
        			p_comment = ?,
        			p_view = ?,
        			p_enable = ?,
        			p_displaymode = ?,
        			p_cancomment = ?,
        			p_parentSection = ?
        		WHERE p_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				$this->uid,
				$this->section,
				$this->name,
				$this->description,
				$this->filesizeinbyte,
				$this->resolution,
				$this->fileserver,
				$this->filepath,
				$this->filethumb1,
				$this->filethumb2,
				$this->comment,
				$this->view,
				$this->enable,
				$this->displaymode,
				$this->cancomment,
                $this->parentSection,
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
	
	public function increaseView($number=1)
	{               
		global $registry;  
		
		if(Helper::checkCookieEnable())
		{
			//if(!isset($_SESSION))
		}
		                                  
        $sql = 'UPDATE ' . TABLE_PREFIX . 'contest_photo
        		SET 
        			p_view = p_view + ?
        		WHERE p_id = ?';
        		
		$stmt = $this->db->query($sql, array(
				(int)$number,
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
	
	public static function countList($where = 'p.p_id > 0 ')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_group p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'p.p_id > 0', $order = 'p.p_id DESC' , $limit = '')
	{
		global $db;
		
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_group p
				INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
				WHERE ' . $where . '
				ORDER BY ' . $order;
		if($limit != '')
			$sql .= ' LIMIT ' . $limit;
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myPhoto = new Core_ContestPhotoChild();
			$myPhoto->id = $row['p_id'];
			$myPhoto->uid = $row['u_id'];
			$myPhoto->section = $row['p_section'];
			$myPhoto->name = $row['p_name'];
			$myPhoto->description = $row['p_description'];
			$myPhoto->filesizeinbyte = $row['p_filesizeinbyte'];
			$myPhoto->resolution = $row['p_resolution'];
			$myPhoto->fileserver = $row['p_fileserver'];
			$myPhoto->filepath = $row['p_filepath'];
			$myPhoto->filethumb1 = $row['p_filethumb1'];
			$myPhoto->filethumb2 = $row['p_filethumb2'];
			$myPhoto->comment = $row['p_comment'];
			$myPhoto->view = $row['p_view'];
			$myPhoto->enable = $row['p_enable'];
			$myPhoto->displaymode = $row['p_displaymode'];
			$myPhoto->cancomment = $row['p_cancomment'];
			$myPhoto->datecreated = $row['p_datecreated'];
			$myPhoto->poster = new Core_User();
			$myPhoto->poster->getByArray($row);
            $myPhoto->parentSection = $row['p_parentSection'];
            $myPhoto->parentID = $row['p_parentID'];
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
        
        if($formData['fgreaterthan'] > 0)
        {
            $whereString .= ' AND p.p_id > '.(int)$formData['fgreaterthan'].' ';
        }
        
        //Filter by section
        /*Vo Duy Tuan
        if($formData['fsection'] == 'color' || $formData['fsection'] == 'mono' || $formData['fsection'] == 'nature' )
        {
            $whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
        }
        */
        /*Le Ngoc Trung*/
        if(!empty($formData['fsection']))
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';

        //filter by time
        if($formData['ftime'] == '24hours')
            $whereString .= ' AND p.p_datecreated > ' . (time() - 24*60*60);
        elseif($formData['ftime'] == '3days')
            $whereString .= ' AND p.p_datecreated > ' . (time() - 3*24*60*60);
        elseif($formData['ftime'] == '1week')
            $whereString .= ' AND p.p_datecreated > ' . (time() - 7*24*60*60);
        elseif($formData['ftime'] == '1month')
            $whereString .= ' AND p.p_datecreated > ' . (time() - 30*24*60*60);
        
        if($formData['fuserid'] > 0)
        {
            $whereString .= ' AND p.u_id = '.(int)$formData['fuserid'].' ';
        }
        
        if(strlen($formData['fenable'])>0)
        {
            if($formData['fenable']=='YES')
            {
                $whereString .= ' AND p.p_enable = 1 ';
            }
            else if($formData['fenable']=='YES')
            {
                $whereString .= ' AND p.p_enable = 0 ';
            }
        }
        
        if(strlen($formData['fkeyword']) > 0)
        {
            if($formData['fsearchin'] == 'name')
            {
                $whereString .= ' AND p.p_name LIKE \'%'.$formData['fkeyword'].'%\'';
            }
            else
            {
                $whereString .= ' AND p.p_name LIKE \'%'.$formData['fkeyword'].'%\'';
            }
        }

        //checking sort by & sort type
        if($sorttype != 'DESC' && $sorttype != 'ASC')
            $sorttype = 'DESC';
            
        if($sortby == 'name')
            $orderString = ' p.p_name ' . $sorttype;    
        elseif($sortby == 'username')
            $orderString = ' u.u_username ' . $sorttype;    
        elseif($sortby == 'filesize')
            $orderString = ' p.p_filesizeinbyte ' . $sorttype;    
        elseif($sortby == 'resolution')
            $orderString = ' p.p_resolution ' . $sorttype;    
        elseif($sortby == 'view')
            $orderString = ' p.p_view ' . $sorttype;    
        else
            $orderString = ' p.p_id ' . $sorttype;            
                
        if($countOnly)
            return self::countList($whereString);
        else
            return self::getList($whereString, $orderString, $limit);
    }
    
    public static function countListx($where = 'p.p_id > 0 ')
    {
        global $db;
        $sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'contest_photo_group p
                INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
                INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready_round prr ON p.p_id = prr.p_id 
                WHERE ' . $where;
        return $db->query($sql)->fetchSingle();
    }
    public static function getRoundActive()
    {
        global $db;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_round p
                WHERE r_isactive = 1'  ;
        return $db->query($sql)->fetchSingle();
    }
    
    
    public static function getListx($where = 'p.p_id > 0', $order = 'p.p_id DESC' , $limit = '')
    {
        global $db;
        
        $outputList = array();
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'contest_photo_group p
                INNER JOIN ' . TABLE_PREFIX . 'ac_user u ON p.u_id = u.u_id
                INNER JOIN ' . TABLE_PREFIX . 'contest_photo_ready_round prr ON p.p_id = prr.p_id 
                WHERE ' . $where . '
                ORDER BY ' . $order;
        if($limit != '')
            $sql .= ' LIMIT ' . $limit;
        $stmt = $db->query($sql);
        while($row = $stmt->fetch())
        {
            $myPhoto = new Core_ContestPhoto();
            $myPhoto->id = $row['p_id'];
            $myPhoto->uid = $row['u_id'];
            $myPhoto->section = $row['p_section'];
            $myPhoto->name = $row['p_name'];
            $myPhoto->description = $row['p_description'];
            $myPhoto->filesizeinbyte = $row['p_filesizeinbyte'];
            $myPhoto->resolution = $row['p_resolution'];
            $myPhoto->fileserver = $row['p_fileserver'];
            $myPhoto->filepath = $row['p_filepath'];
            $myPhoto->filethumb1 = $row['p_filethumb1'];
            $myPhoto->filethumb2 = $row['p_filethumb2'];
            $myPhoto->comment = $row['p_comment'];
            $myPhoto->view = $row['p_view'];
            $myPhoto->enable = $row['p_enable'];
            $myPhoto->displaymode = $row['p_displaymode'];
            $myPhoto->cancomment = $row['p_cancomment'];
            $myPhoto->datecreated = $row['p_datecreated'];
            $myPhoto->poster = new Core_User();
            $myPhoto->poster->getByArray($row);
            $myPhoto->parentSection = $row['p_parentSection'];
            $myPhoto->isGroup = $row['p_isGroup'];
            $outputList[] = $myPhoto;
        }
        return $outputList;
    }
	public static function getEnableView($rid = 0){
		global $db;
		$sql = 'SELECT r_enable_view FROM '.TABLE_PREFIX.'contest_round WHERE r_id = '.$rid;
		$result = $db->query($sql)->fetchSingle();
		if($result == '1'){
			return true;
		}else{
			return false;
		}
	}
	public static function getPhotosx($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{   
        $whereString = 'p.p_id > 0 ';
        if(isset($formData['fround'])){
        	if(!self::getEnableView($formData['fround'])){
			return ;
			}
        }
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fgreaterthan'] > 0)
		{
			$whereString .= ' AND p.p_id > '.(int)$formData['fgreaterthan'].' ';
		}
		
        if($formData['fround'] > 0 )
        {
            $whereString .= ' AND prr.r_id = ' .(int)$formData['fround'] . ' ';
            
            if(count($formData['fcondition']) > 0)
            {
                $whereString .= ' AND ((p.p_section = "color-c" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColor']. ') 
                OR (p.p_section = "mono-m" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionMono'].') 
                OR (p.p_section = "nature" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionNature'].')
                OR (p.p_section = "travel" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionTravel'].')
                OR (p.p_section IN ("landscape-c", "sport-c", "idea-c") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColorBest'].')
                OR (p.p_section IN ("landscape-m", "sport-m", "idea-m") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColorBest'].')
                OR (p.p_section IN ("bird-n", "snow-n", "flower-n") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColorBest'].')
                OR (p.p_section IN ("transportation-t", "dress-t", "country-t") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColorBest'].')
				
                )';
            }
               
        }
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

        // if($formData['fsection'] != NULL && $formData['fround'] > 0)
        //     {
        //         $whereString .= ' AND prr.r_id = ' .(int)$formData['fround'] . ' ';
        //         //Filter by section new
        //         if($formData['fsection'] == 'color')
        //             $whereString .= ' AND p.p_section = "color-c" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColor'].' ';
        //         elseif($formData['fsection'] == 'colorbest')
        //             $whereString .= ' AND p.p_section IN ("landscape-c", "sport-c", "idea-c") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionColorBest'].' ';
        //         elseif($formData['fsection'] == 'mono')
        //             $whereString .= ' AND p.p_section = "mono-m" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionMono'].'';
        //         elseif($formData['fsection'] == 'monobest')
        //             $whereString .= ' AND p.p_section IN ("landscape-m", "sport-m", "idea-m") AND prr.pr_totalscore >= '.$formData['fcondition']['sectionMonoBest'].' ';
        //         elseif($formData['fsection'] == 'nature')
        //             $whereString .= ' AND p.p_section = "nature" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionNature'].' ';
        //         elseif($formData['fsection'] == 'travel')
        //             $whereString .= ' AND p.p_section = "travel" AND prr.pr_totalscore >= '.$formData['fcondition']['sectionTravel'].' ';
        //     }
        
		//Filter by section
        /*Vo Duy Tuan
		if($formData['fsection'] == 'color' || $formData['fsection'] == 'mono' || $formData['fsection'] == 'nature' )
		{
			$whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
		}
        
        Le NGoc Trung
        if($formData['fsection'] == 'color-c' || $formData['fsection'] == 'landscape-c' || $formData['fsection'] == 'sport-c' || $formData['fsection'] == 'idea-c' || $formData['fsection'] == 'mono-m' || $formData['fsection'] == 'landscape-m' || $formData['fsection'] == 'sport-m' || $formData['fsection'] == 'idea-m' || $formData['fsection'] == 'nature' || $formData['fsection'] == 'travel')
        {
            $whereString .= ' AND p.p_section = "'.$formData['fsection'].'" ';
        }
       
        if($formData['fsection'] == 'color')
            $whereString .= ' AND p.p_section LIKE "%-c" ';
        if($formData['fsection'] == 'mono')
            $whereString .= ' AND p.p_section LIKE "%-m" ';
        */
		
		if($formData['fuserid'] > 0)
		{
			$whereString .= ' AND p.u_id = '.(int)$formData['fuserid'].' ';
		}
		
		if(strlen($formData['fenable'])>0)
        {
            if($formData['fenable']=='YES')
            {
                $whereString .= ' AND p.p_enable = 1 ';
            }
            else if($formData['fenable']=='YES')
            {
                $whereString .= ' AND p.p_enable = 0 ';
            }
        }
		
		if(strlen($formData['fkeyword']) > 0)
		{
			
			if($formData['fsearchin'] == 'name')
			{
				$whereString .= ' AND p.p_name LIKE \'%'.$formData['fkeyword'].'%\'';
			}
			else
			{
				$whereString .= ' AND p.p_name LIKE \'%'.$formData['fkeyword'].'%\'';
			}
		}
		
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'name')
			$orderString = ' p.p_name ' . $sorttype;    
		elseif($sortby == 'username')
			$orderString = ' u.u_username ' . $sorttype;    
		elseif($sortby == 'filesize')
			$orderString = ' p.p_filesizeinbyte ' . $sorttype;    
		elseif($sortby == 'resolution')
			$orderString = ' p.p_resolution ' . $sorttype;    
		elseif($sortby == 'view')
			$orderString = ' p.p_view ' . $sorttype;    
		else
			$orderString = ' p.p_id ' . $sorttype;            
				
		if($countOnly)
			return self::countListx($whereString);
		else
			return self::getListx($whereString, $orderString, $limit);
	}
	
	public static function getTotalView()
	{
		global $db;
		$sql = 'SELECT SUM(p_view) FROM ' . TABLE_PREFIX . 'contest_photo';
		return $db->query($sql)->fetchSingle();
	}
	
	public function uploadImage()
	{
		global $registry;
		
		if(strlen($_FILES['fimage']['name']) > 0)
		{
			//check landscape image or portrait
			$imageinfo = getimagesize($_FILES['fimage']['tmp_name']);
			
			//padding image with image's width
			$namePadding = '';
			if($imageinfo[0] < $imageinfo[1])
			{
				//it's portrait image, padding _p after image
				$namePadding = '_p';
			}
			else
			{
				//it's landscape image, padding _l after image
				$namePadding = '_l';
			}
			
			
			$curDateDir = Helper::getCurrentDateDirName(); 
			$extPart = strtolower(substr(strrchr($_FILES['fimage']['name'],'.'),1));
			$namePart =  $registry->me->username . '-' . Helper::codau2khongdau( $this->name, true)  . '-' . Helper::RandomNumber(1000,9999) . '-' . strtoupper($this->section[0]);
			$name = $namePart . $namePadding . '.' . $extPart;
			
			$uploader = new Uploader($_FILES['fimage']['tmp_name'], $name, $registry->setting['contestphoto']['imageDirectory'] . $curDateDir, '', $registry->setting['contestphoto']['validType']);
			
			$uploadError = $uploader->upload(false, $name);
			if($uploadError != Uploader::ERROR_UPLOAD_OK)
			{
				return $uploadError;
			}
			else
			{
				//Create thum 1 image
				$nameThumb1 = $registry->me->username . '-' . Helper::codau2khongdau( $this->name, true) . '-thumb1-' . Helper::RandomNumber(1000,9999) . '-' . strtoupper($this->section[0]) . $namePadding . '.' . $extPart;
				$myImageResizer = new ImageResizer(	$registry->setting['contestphoto']['imageDirectory'] . $curDateDir, $name, 
													$registry->setting['contestphoto']['imageDirectory'] . $curDateDir, $nameThumb1, 
													$registry->setting['contestphoto']['imageThumb1Width'], 
													$registry->setting['contestphoto']['imageThumb1Height'], 
													'', 
													$registry->setting['contestphoto']['imageQuality']);
				$myImageResizer->output();	
				unset($myImageResizer);
				
				//Create thum 2 image
				$nameThumb2 = $registry->me->username . '-' . Helper::codau2khongdau( $this->name, true) . '-thumb2-' . Helper::RandomNumber(1000,9999) . '-' . strtoupper($this->section[0]) . $namePadding . '.' . $extPart;
				$myImageResizer = new ImageResizer(	$registry->setting['contestphoto']['imageDirectory'] . $curDateDir, $name, 
													$registry->setting['contestphoto']['imageDirectory'] . $curDateDir, $nameThumb2, 
													$registry->setting['contestphoto']['imageThumb2Width'], 
													$registry->setting['contestphoto']['imageThumb2Height'], 
													'1:1', 
													$registry->setting['contestphoto']['imageQuality']);
				$myImageResizer->output();	
				unset($myImageResizer);
				
				//update database
				$this->filepath = $curDateDir . $name;
				$this->filethumb1 = $curDateDir . $nameThumb1;
				$this->filethumb2 = $curDateDir . $nameThumb2;
			}
		}
	}
	
	public function deleteImage()
	{
		global $registry;
		
		//delete current image
		if(strlen($this->filepath) > 0)
		{
			$file = $registry->setting['contestphoto']['imageDirectory'] . $this->filepath;
			if(file_exists($file) && is_file($file))
			{
				@unlink($file);
			}
			
			//delete current image
			$this->filepath = '';
		}
		
		//delete current thumb 1
		if(strlen($this->filethumb1) > 0)
		{
			$file = $registry->setting['contestphoto']['imageDirectory'] . $this->filethumb1;
			if(file_exists($file) && is_file($file))
			{
				@unlink($file);
			}
			
			//delete current image
			$this->filethumb1 = '';
		}
		
		//delete current thumb 2
		if(strlen($this->filethumb2) > 0)
		{
			$file = $registry->setting['contestphoto']['imageDirectory'] . $this->filethumb2;
			if(file_exists($file) && is_file($file))
			{
				@unlink($file);
			}
			
			//delete current image
			$this->filethumb2 = '';
		}
	}
	
	
	
	public function getSection()
	{
		global $registry;
		/* Vo Duy Tuan
		$out = '';
		if($this->section == 'color')
			$out = $registry->lang['global']['photoSectionColor'];
		elseif($this->section == 'mono')
			$out = $registry->lang['global']['photoSectionMono'];
		elseif($this->section == 'nature')
			$out = $registry->lang['global']['photoSectionNature'];
        elseif($this->section == 'travel')
            $out = $registry->lang['global']['photoSectionTravel'];
		return $out;
        */
        /* Le Ngoc Trung */
        $out = '';
        /*$parsesection = explode('-',$this->section);
        
		if($parsesection[1] == 'c')
		{
			if($parsesection[0]=='landscape')
				$out = $registry->lang['global']['subphotoSectionColorLandscape'];
			elseif($parsesection[0]=='sport')
				$out = $registry->lang['global']['subphotoSectionColorSport'];
			elseif($parsesection[0]=='idea')
				$out = $registry->lang['global']['subphotoSectionColorIdea'];
			elseif($parsesection[0]=='color')
				$out = $registry->lang['global']['subphotoSectionColor'];
		}
		elseif($parsesection[1] == 'm')
		{
			if($parsesection[0]=='landscape')
				$out = $registry->lang['global']['subphotoSectionMonoLandscape'];
			elseif($parsesection[0]=='sport')
				$out = $registry->lang['global']['subphotoSectionMonoSport'];
			elseif($parsesection[0]=='idea')
				$out = $registry->lang['global']['subphotoSectionMonoIdea'];
			elseif($parsesection[0]=='mono')
			{
				$out = $registry->lang['global']['subphotoSectionMono'];
			}
		}
		elseif($parsesection[1] == 'n')
		{
			if($parsesection[0]=='bird')
				$out = $registry->lang['global']['subphotoSectionNatureBird'];
			elseif($parsesection[0]=='snow')
				$out = $registry->lang['global']['subphotoSectionNatureSnow'];
			elseif($parsesection[0]=='flower')
				$out = $registry->lang['global']['subphotoSectionNatureFlower'];
			else
			{
				$out = $registry->lang['global']['subphotoSectionNature'];
			}
		}
		elseif($parsesection[1] == 't')
		{
			if($parsesection[0]=='transportation')
				$out = $registry->lang['global']['subphotoSectionTravelTransportation'];
			elseif($parsesection[0]=='dress')
				$out = $registry->lang['global']['subphotoSectionTravelDress'];
			elseif($parsesection[0]=='country')
				$out = $registry->lang['global']['subphotoSectionTravelCountry'];
			else
			{
				$out = $registry->lang['global']['subphotoSectionTravel'];
			}
		}*/
        $out = Core_ContestPhotoGroup::getDataSectionName($this->section);
        return $out;
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
	
	public function formatFileSize($unit = 'KB')
	{
		if(strtoupper($unit) == 'KB')
			return round($this->filesizeinbyte / 1024, 1) . ' Kb';
		else
			return round($this->filesizeinbyte / (1024 * 1024), 1) . ' Mb';
		
	}
	
	
	public function getPhotoPath()
	{
		global $registry;
		
		$path = $registry->conf['rooturl'] . 'site/photo/detail/group/'.$this->parentID.'/id/' . self::encodePhotoId($this->id) . '-' . Helper::codau2khongdau($this->name, true, true) . '.html';
		return $path;
	}
	
	/**
	* Dua vao thong tin file luu tren server nao, de tra ve duong dan tuong ung
	* vi hien tai co 2 server us,vn nen dua vao thong tin fileserver de lay thong tin server path
	* mac dinh la server voi cau hinh trong setting (vi cung server)
	* 
	*/
	public function getImage($size = 'thumb1')
	{
		global $registry;
		
		if($this->fileserver == 'vn')
		{
			$imagepath = $registry->setting['extra']['imageDirectoryRemoteServer']['vn'];
		}
		else
		{
			$imagepath = $registry->conf['rooturl'] . $registry->setting['contestphoto']['imageDirectory'];
		}
		
		
		switch($size)
		{
			case 'thumb1' : $imagepath .= $this->filethumb1; break;
			case 'thumb2' : $imagepath .= $this->filethumb2; break;
			default: $imagepath .= $this->filepath;
		}
		return $imagepath;
	}
	
	/**
	* Ham dung de obfuscate ID tren URL de khong tu go ID duoc
	* 
	* @param mixed $id
	*/
	public static function encodePhotoId($input, $process = 'encode')
	{
		$output = '';
		if($process == 'encode')
		{
			$output = ((($input * 232 ) - 231)*13)+7;
		}
		else
		{
			$output = ((($input - 7)/13)+231)/232;
		}
		return $output;
	}

	
	
}


?>