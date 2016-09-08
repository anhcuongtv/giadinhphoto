<?php

Class Core_Helloworld extends Core_Object
{
	public $id = 0;
	public $text = '';
	
	
	
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
		
			
		$this->id = $this->id;
		
		return $this->id;
	}
	
	public function updateData(&$error = array())
	{                          
		global $registry;
		                  
		$this->datemodified = time();
		
		$moreupdate = '';
		if(strlen($this->newpass) > 0)
			$moreupdate = 'up_password = "'.viephpHashing::hash($this->newpass).'" ,';
			
		
		//update profile table	
		  $sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user_profile
        		SET up_fullname = ?,
        			'.$moreupdate.'
        			up_gender = ?,
        			up_lovestatus = ?,
        			up_birthday = ?,
        			up_phone1 = ?,
        			up_phone2 = ?,
        			up_address = ?,
        			up_region = ?,
        			up_country = ?,
        			up_website = ?,
        			up_datemodified = ? 
        		WHERE u_id = ?';
        		
		$stmt = $this->db->query($sql, array(
		    $this->fullname, $this->gender, $this->lovestatus, $this->birthday, $this->phone1, $this->phone2, $this->address, $this->region, $this->country, $this->website, $this->datemodified, $this->id	
			));
			
		
		if($stmt)
		{
			//image upload process
			$uploadImageResult = $this->uploadImage();
			if($uploadImageResult != Uploader::ERROR_UPLOAD_OK)
				$error[] = str_replace('###errorcode###', $uploadImageResult, $registry->lang['controller']['errImageUpload']);
			else
			{
				//if new image is not the same name, delete old image
				if($this->avatarCurrent != $this->avatar && $this->avatarCurrent != '')
					$this->deleteImage($this->avatarCurrent);
			}
			
		}
		
		return $stmt;
		
	}
	

	public function getData($id)
	{
		$id = (int)$id;
		
		$this->id = $id;
		$this->text = 'Hello world - ' . $this->id;
		
	}
	
	
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'ac_user
        		WHERE u_id = ?
        			';
		$this->db->query($sql, array($this->id));
		
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'ac_user_profile
        		WHERE u_id = ?
        			';
		$this->db->query($sql, array($this->id));
		
		//delete image
		$this->deleteImage();
		
		
		return true;
	}
	
	
		
	public static function countList($where = 'u_id > 0 ', $joinString = '')
	{
		global $db;
		$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'ac_user u
				'.$joinString.'
				WHERE ' . $where;
		return $db->query($sql)->fetchSingle();
	}
	
	public static function getList($where = 'u.u_id > 0', $joinString = '', $order = 'u.u_id DESC' , $limit = 20)
	{
		global $db;
		$outputList = array();
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user u
				
				'.$joinString.'
				WHERE ' . $where . '
				ORDER BY ' . $order . '
				LIMIT ' . $limit;
		$stmt = $db->query($sql);
		while($row = $stmt->fetch())
		{
			$myUser = new Core_User();
			$myUser->id = $row['u_id'];
			$myUser->username = $row['u_username'];
			$myUser->email = $row['up_email'];
			$myUser->password = $row['up_password'];
			$myUser->fullname = $row['up_fullname'];
			$myUser->groupid = $row['u_groupid'];
			$myUser->gender = $row['up_gender'];
			$myUser->lovestatus = $row['up_lovestatus'];
			$myUser->birthday = $row['up_birthday'];
			$myUser->phone1 = $row['up_phone1'];
			$myUser->phone2 = $row['up_phone2'];
			$myUser->address = $row['up_address'];
			$myUser->region = $row['up_region'];
			$myUser->country = $row['up_country'];
			$myUser->website = $row['up_website'];
			$myUser->avatar = $row['u_avatar'];
			$myUser->isactivated = $row['up_isactivated'];
			$myUser->activatedcode = $row['up_activatedcode'];
			$myUser->datecreated = $row['up_datecreated'];
			$myUser->datemodified = $row['up_datemodified'];
			$myUser->datelastlogin = $row['up_datelastlogin'];
			$outputList[] = $myUser;
		}
		return $outputList;
	}
	
	public static function getUsers($formData, $sortby = 'id', $sorttype = 'DESC', $limit = 20, $countOnly = false)
	{
		$whereString = 'u.u_id > 0 ';
		$joinString = 'INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND e.e_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['fgroupid'] > 0)
		{
			$whereString .= ' AND u_groupid = '.(int)$formData['fgroupid'].' ';
		}
		
		
		if(strlen($formData['fkeywordFilter']) > 0)
		{
			$formData['fkeywordFilter'] = preg_replace('/[~!@#$%^&*;,?:\'"]/', '', $formData['fkeywordFilter']);
			
			if($formData['fsearchKeywordIn'] == 'email')
			{
				$whereString .= ' AND up_email LIKE \'%'.$formData['fkeywordFilter'].'%\'';
			}
			else if($formData['fsearchKeywordIn'] == 'name')
			{
				$whereString .= ' AND up_fullname LIKE \'%'.$formData['fkeywordFilter'].'%\'';
			}
			{
				$whereString .= ' AND u_username LIKE \'%'.$formData['fkeywordFilter'].'%\'';
			}
		}
		
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'username')
			$orderString = ' u.u_username ' . $sorttype;    
		elseif($sortby == 'email')
			$orderString = ' up.up_email ' . $sorttype;    
		elseif($sortby == 'region')
			$orderString = ' up.up_region ' . $sorttype;    
		elseif($sortby == 'group')
			$orderString = ' u.u_groupid ' . $sorttype;    
		else
			$orderString = ' u.u_id ' . $sorttype;   
		
		if($countOnly)
			return self::countList($whereString, $joinString);
		else
			return self::getList($whereString, $joinString, $orderString, $limit);
	}
	
		
}


?>