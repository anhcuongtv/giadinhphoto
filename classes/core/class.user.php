<?php

Class Core_User extends Core_Object
{
	public $id = 0;
	public $username = '';
	public $groupid = 0;
	public $email = '';
	public $password = '';
	public $fullname = '';
	public $firstname = '';
	public $lastname = '';
	public $honor = '';
	public $phone1 = '';
	public $phone2 = '';
	public $gender = 'unknown';
	public $birthday = '';
	public $address = '';
	public $address2 = '';
	public $zipcode = '';
	public $city = '';
	public $region = 0;
	public $country = 'VN';
	public $psamembership = '';
	public $photoclub = 0;
	public $avatar = '';
	public $avatarCurrent = '';
	public $isactivated = 1;
	public $activatedcode = '';
	public $datecreated = 0;
	public $datemodified = 0;
	public $datelastlogin = 0;
	public $newpass = '';
	public $sessionid = '';
	
	public $paidColor = 0;
	public $paidMono = 0;
	public $paidNature = 0;
    public $paidTravel = 0;
	
	
	public function __construct($id = 0)
	{
		parent::__construct();
		$this->sessionid = session_id();
		
		if($id > 0)
		{
			$this->getData($id);
		}
	}
	
	public function checkPerm()
	{
		global $registry, $groupPermisson, $smarty;       
		
		//echo $GLOBALS['controller_group'] . '<br />';
		//echo $GLOBALS['controller'] . '<br />';
		//echo $GLOBALS['action'] . '<br />';
		 
		//print_r($groupPermisson[$this->groupid][$GLOBALS['controller_group']]);
		//var_dump(!in_array($GLOBALS['controller'].'_*', $groupPermisson[$this->groupid][$GLOBALS['controller_group']]));
		//exit();
		if(!isset($groupPermisson[$this->groupid][$GLOBALS['controller_group']]) || (!in_array($GLOBALS['controller'].'_'.$GLOBALS['action'], $groupPermisson[$this->groupid][$GLOBALS['controller_group']]) && !in_array($GLOBALS['controller'].'_*', $groupPermisson[$this->groupid][$GLOBALS['controller_group']])))
		{    
			if($GLOBALS['controller_group'] == 'admin')
			{
				//if not login
				if($this->id == 0)
				{
					$redirectUrl = $registry->conf['rooturl'].substr($_SERVER['REQUEST_URI'],1);
					
					header('location: '.$registry->conf['rooturl'].'site/login?refer=1&redirect=' . base64_encode($redirectUrl));
					exit();	
				}
			}
			
			header('location: ' . $registry->conf['rooturl'] . 'notpermission.html');
			exit();
		}
	}
	
	/**
	* Lay thong tin user tu session (danh cho user da login hoac su dung `remember me`
	* 
	*/
	public function updateFromSession()
	{
		if(isset($_SESSION['userLogin']) && $_SESSION['userLogin'] > 0)
		{
			$this->getData($_SESSION['userLogin']);
		}
		else
		{
			//"remember me" function
			if(isset($_COOKIE['myHashing']) && strlen($_COOKIE['myHashing']) > 0)
			{
				$cookieRememberMeInfo = viephpHashing::cookiehasingParser($_COOKIE['myHashing']);
				
				
				$this->getData($cookieRememberMeInfo['userid']);
				
								
				
				if(viephpHashing::authenticateCookiehashing($cookieRememberMeInfo['shortPasswordString'], $this->password))
				{
					session_regenerate_id(true);
					
					////////////////////////////////////////////////////////////////////////////////////
					//UPDATE LAST LOGIN TIME
					$sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user_profile
							SET up_datelastlogin = ? 
							WHERE u_id = ?
							LIMIT 1';
					$this->db->query($sql, array(time(), $this->id));
					
					$_SESSION['userLogin'] = $this->id;
					$_SESSION['loginauto'] = 1;
					
				}
			}//end remember me
		}
	}
	
	public function addData()
	{
		$this->datecreated = time();
		
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'ac_user 
				(`u_username`, `u_groupid`, `u_avatar`)
				VALUES(?, ?, ?)';
		$this->db->query($sql, array(
		    	$this->username, $this->groupid, $this->avatar
			));
			
		$this->id = $this->db->lastInsertId();
		
		if($this->id > 0)
		{
			$sql = 'INSERT INTO ' . TABLE_PREFIX . 'ac_user_profile 
					(`u_id`, `up_email`, `up_password`, `up_fullname`, up_firstname, up_lastname, up_honor, `up_gender`,`up_birthday`, `up_phone1`, `up_phone2`, `up_address`, up_address2, up_zipcode, up_city, `up_region`, `up_country`, up_psamembership, up_photoclub, `up_isactivated`, `up_activatedcode`, `up_datecreated`)
					VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			$this->db->query($sql, array(
		    		$this->id, 
		    		$this->email, 
		    		$this->password, 
		    		$this->fullname, 
		    		$this->firstname, 
		    		$this->lastname, 
		    		$this->honor, 
		    		$this->gender, 
		    		$this->birthday, 
		    		$this->phone1, 
		    		$this->phone2,
		    		$this->address, 
		    		$this->address2, 
		    		$this->zipcode, 
		    		$this->city, 
		    		$this->region, 
		    		$this->country, 
		    		$this->psamembership, 
		    		$this->photoclub, 
		    		$this->isactivated, 
		    		$this->activatedcode, 
		    		$this->datecreated
				));	
				
		}
		
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
        			up_firstname = ?,
        			up_lastname = ?,
        			up_honor = ?,
        			'.$moreupdate.'
        			up_gender = ?,
        			up_birthday = ?,
        			up_phone1 = ?,
        			up_phone2 = ?,
        			up_address = ?,
        			up_address2 = ?,
        			up_zipcode = ?,
        			up_city = ?,
        			up_region = ?,
        			up_country = ?,
        			up_psamembership = ?,
        			up_photoclub = ?,
        			up_paid_color = ?,
        			up_paid_mono = ?,
        			up_paid_nature = ?,
                    up_paid_travel = ?,
        			up_activatedcode = ?,
        			up_datemodified = ? 
        		WHERE u_id = ?';
        		
		$stmt = $this->db->query($sql, array(
		    $this->fullname, 
		    $this->firstname, 
		    $this->lastname, 
		    $this->honor, 
		    $this->gender, 
		    $this->birthday, 
		    $this->phone1, 
		    $this->phone2, 
		    $this->address, 
		    $this->address2, 
		    $this->zipcode, 
		    $this->city, 
		    $this->region, 
		    $this->country, 
		    $this->psamembership, 
		    $this->photoclub, 
		    $this->paidColor,
		    $this->paidMono,
		    $this->paidNature,
            $this->paidTravel,
		    $this->activatedcode,
		    $this->datemodified, 
		    $this->id	
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
	
	public function uploadImage()
	{
		global $registry;
		
		if(strlen($_FILES['fimage']['name']) > 0)
		{
			$curDateDir = Helper::getCurrentDateDirName();  //path format: ../2009/September/  
			$extPart = substr(strrchr($_FILES['fimage']['name'],'.'),1);
			$namePart =  Helper::codau2khongdau( $this->username, true);
			$name = $namePart . '.' . $extPart;
			
			$uploader = new Uploader($_FILES['fimage']['tmp_name'], $name, $registry->setting['avatar']['imageDirectory'] . $curDateDir);
			
			$uploadError = $uploader->upload(false, $name);
			
			if($uploadError != Uploader::ERROR_UPLOAD_OK)
			{
				return $uploadError;
				
			}
			else
			{
				
				//Resize big image if needed
				$myImageResizer = new ImageResizer(	$registry->setting['avatar']['imageDirectory'] . $curDateDir, $name, 
													$registry->setting['avatar']['imageDirectory'] . $curDateDir, $name, 
													$registry->setting['avatar']['imageMaxWidth'], 
													$registry->setting['avatar']['imageMaxHeight'], 
													'', 
													$registry->setting['avatar']['imageQuality']);
				$myImageResizer->output();	
				unset($myImageResizer);
				
				//Create thum image
				$nameThumbPart = substr($name, 0, strrpos($name, '.'));
				$nameThumb = $nameThumbPart . '-small.' . $extPart;
				$myImageResizer = new ImageResizer(	$registry->setting['avatar']['imageDirectory'] . $curDateDir, $name, 
													$registry->setting['avatar']['imageDirectory'] . $curDateDir, $nameThumb, 
													$registry->setting['avatar']['imageThumbWidth'], 
													$registry->setting['avatar']['imageThumbHeight'], 
													'1:1', 
													$registry->setting['avatar']['imageQuality']);
				$myImageResizer->output();	
				unset($myImageResizer);
				
				//update database
				$this->avatar = $curDateDir . $name;
				//update profile table	
				$sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user
        				SET u_avatar = ?
        				WHERE u_id = ?';
        				
				$this->db->query($sql, array(
				    $this->avatar, $this->id	
				));
			}
		}
	}
	
	public function deleteImage($imagepath = '')
	{
		global $registry;
		
		//delete current image
		if($imagepath == '')
			$deletefile = $this->avatar;
		else
			$deletefile = $imagepath;
		
		if(strlen($deletefile) > 0)
		{
			$file = $registry->setting['avatar']['imageDirectory'] . $deletefile;
			if(file_exists($file) && is_file($file))
			{
				@unlink($file);
				
				//delete thumb image
				$extPart = substr(strrchr($deletefile,'.'),1);
				$nameThumbPart = substr($deletefile, 0, strrpos($deletefile, '.'));
				$nameThumb = $nameThumbPart . '-small.' . $extPart;
				$filethumb = $registry->setting['avatar']['imageDirectory'] . $nameThumb;
				if(file_exists($filethumb) && is_file($filethumb))
				{
					@unlink($filethumb);
				}
			}
			
			//delete current image
			if($imagepath == '')
				$this->avatar = '';
		}
	}
	
	public function updateLastLogin()
	{
		//update profile table	
		$sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user_profile
        		SET 
        			up_datelastlogin = ? 
        		WHERE u_id = ?';
        	
		$this->db->query($sql, array(
			time(), $this->id	
		));
		
	
	}
	
	public function getData($id)
	{
		$id = (int)$id;
		
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user u
				INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id
				WHERE u.u_id = ?';
		$row = $this->db->query($sql, array($id))->fetch();
		
		$this->id = $row['u_id'];
		$this->username = $row['u_username'];
		$this->email = $row['up_email'];
		$this->password = $row['up_password'];
		$this->fullname = $row['up_fullname'];
		$this->firstname = $row['up_firstname'];
		$this->lastname = $row['up_lastname'];
		$this->honor = $row['up_honor'];
		$this->groupid = $row['u_groupid'];
		$this->gender = $row['up_gender'];
		$this->birthday = $row['up_birthday'];
		$this->phone1 = $row['up_phone1'];
		$this->phone2 = $row['up_phone2'];
		$this->address = $row['up_address'];
		$this->address2 = $row['up_address2'];
		$this->zipcode = $row['up_zipcode'];
		$this->city = $row['up_city'];
		$this->region = $row['up_region'];
		$this->country = $row['up_country'];
		$this->psamembership = $row['up_psamembership'];
		$this->photoclub = $row['up_photoclub'];
		$this->paidColor = $row['up_paid_color'];
		$this->paidMono = $row['up_paid_mono'];
		$this->paidNature = $row['up_paid_nature'];
        $this->paidTravel = $row['up_paid_travel'];
		$this->avatar = $row['u_avatar'];
		$this->isactivated = $row['up_isactivated'];
		$this->activatedcode = $row['up_activatedcode'];
		$this->datecreated = $row['up_datecreated'];
		$this->datemodified = $row['up_datemodified'];
		$this->datelastlogin = $row['up_datelastlogin'];
		
	}
	
	public static function getByUsername($username)
	{
		global $db;
		$username = preg_replace('/[^a-z0-9_]/', '', $username);
		$myUser = new Core_User();
		if(strlen($username) > 0)
		{
			$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user u
					INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id
					WHERE u_username = ?
					LIMIT 1';    
			$row = $db->query($sql, array($username))->fetch();
			if($row['u_id'] > 0)
			{
				$myUser->id = $row['u_id'];
				$myUser->username = $row['u_username'];
				$myUser->email = $row['up_email'];
				$myUser->password = $row['up_password'];
				$myUser->fullname = $row['up_fullname'];
				$myUser->firstname = $row['up_firstname'];
				$myUser->lastname = $row['up_lastname'];
				$myUser->honor = $row['up_honor'];
				$myUser->groupid = $row['u_groupid'];
				$myUser->gender = $row['up_gender'];
				$myUser->birthday = $row['up_birthday'];
				$myUser->phone1 = $row['up_phone1'];
				$myUser->phone2 = $row['up_phone2'];
				$myUser->address = $row['up_address'];
				$myUser->address2 = $row['up_address2'];
				$myUser->zipcode = $row['up_zipcode'];
				$myUser->city = $row['up_city'];
				$myUser->region = $row['up_region'];
				$myUser->country = $row['up_country'];
				$myUser->psamembership = $row['up_psamembership'];
				$myUser->photoclub = $row['up_photoclub'];
				$myUser->paidColor = $row['up_paid_color'];
				$myUser->paidMono = $row['up_paid_mono'];
				$myUser->paidNature = $row['up_paid_nature'];
                $myUser->paidTravel = $row['up_paid_travel'];
				$myUser->avatar = $row['u_avatar'];
				$myUser->isactivated = $row['up_isactivated'];
				$myUser->activatedcode = $row['up_activatedcode'];
				$myUser->datecreated = $row['up_datecreated'];
				$myUser->datemodified = $row['up_datemodified'];
				$myUser->datelastlogin = $row['up_datelastlogin'];
			}
			
		}
		
		return $myUser;
	}
	
	public static function getByEmail($email)
	{
		global $db;
		$myUser = new Core_User();
		if(Helper::ValidatedEmail($email))
		{
			$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'ac_user u
					INNER JOIN ' . TABLE_PREFIX . 'ac_user_profile up ON u.u_id = up.u_id
					WHERE up_email = ?
					LIMIT 1';
			$row = $db->query($sql, array($email))->fetch();
			if($row['u_id'] > 0)
			{
				$myUser->id = $row['u_id'];
				$myUser->username = $row['u_username'];
				$myUser->email = $row['up_email'];
				$myUser->password = $row['up_password'];
				$myUser->fullname = $row['up_fullname'];
				$myUser->firstname = $row['up_firstname'];
				$myUser->lastname = $row['up_lastname'];
				$myUser->honor = $row['up_honor'];
				$myUser->groupid = $row['u_groupid'];
				$myUser->gender = $row['up_gender'];
				$myUser->birthday = $row['up_birthday'];
				$myUser->phone1 = $row['up_phone1'];
				$myUser->phone2 = $row['up_phone2'];
				$myUser->address = $row['up_address'];
				$myUser->address2 = $row['up_address2'];
				$myUser->zipcode = $row['up_zipcode'];
				$myUser->city = $row['up_city'];
				$myUser->region = $row['up_region'];
				$myUser->country = $row['up_country'];
				$myUser->psamembership = $row['up_psamembership'];
				$myUser->photoclub = $row['up_photoclub'];
				$myUser->paidColor = $row['up_paid_color'];
				$myUser->paidMono = $row['up_paid_mono'];
				$myUser->paidNature = $row['up_paid_nature'];
                $myUser->paidTravel = $row['up_paid_travel'];
				$myUser->avatar = $row['u_avatar'];
				$myUser->isactivated = $row['up_isactivated'];
				$myUser->activatedcode = $row['up_activatedcode'];
				$myUser->datecreated = $row['up_datecreated'];
				$myUser->datemodified = $row['up_datemodified'];
				$myUser->datelastlogin = $row['up_datelastlogin'];
			}
			
		}
		
		return $myUser;
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
	
	public function getByArray($info)
	{
		$this->id = $info['u_id'];
		$this->username = $info['u_username'];
		$this->email = $info['up_email'];
		$this->password = $info['up_password'];
		$this->fullname = $info['up_fullname'];
		$this->firstname = $info['up_firstname'];
		$this->lastname = $info['up_lastname'];
		$this->honor = $info['up_honor'];
		$this->groupid = $info['u_groupid'];
		$this->gender = $info['up_gender'];
		$this->birthday = $info['up_birthday'];
		$this->phone1 = $info['up_phone1'];
		$this->phone2 = $info['up_phone2'];
		$this->address = $info['up_address'];
		$this->address2 = $info['up_address2'];
		$this->zipcode = $info['up_zipcode'];
		$this->city = $info['up_city'];
		$this->region = $info['up_region'];
		$this->country = $info['up_country'];
		$this->psamembership = $info['up_psamembership'];
		$this->photoclub = $info['up_photoclub'];
		$this->paidColor = $info['up_paid_color'];
		$this->paidMono = $info['up_paid_mono'];
		$this->paidNature = $info['up_paid_nature'];
        $this->paidTravel = $info['up_paid_travel'];
		$this->avatar = $info['u_avatar'];
		$this->isactivated = $info['up_isactivated'];
		$this->activatedcode = $info['up_activatedcode'];
		$this->datecreated = $info['up_datecreated'];
		$this->datemodified = $info['up_datemodified'];
		$this->datelastlogin = $info['up_datelastlogin'];
	}
	
	
	public function writelog($type, $mainid = 0, $arraymoredata = array())
	{
		$myLog = new Core_Log();
		$myLog->uid = $this->id;
		$myLog->username = $this->username;
		$myLog->groupid = $this->groupid;
		$myLog->type = $type;
		$myLog->mainid = $mainid;
		$myLog->moredata = $arraymoredata;
		
		$myLog->addData();
	}
	
	public static function getUserGroups()
	{
		global $db;
		global $lang;
		global $groupPriority;
		
		$sql = 'SELECT g_id 
				FROM ' . TABLE_PREFIX . 'ac_group
				ORDER BY g_id';
		$groupTmp =  $db->query($sql)->fetchAll();
		$groups = array();
		foreach($groupTmp as $group)
		{
				$groups[$group['g_id']] = self::groupname($group['g_id'], $lang);
		}
		
		return $groups;
	}
	
	public static function groupname($groupid, $lang)
	{
		$groupname = '';
		
		if($groupid == GROUPID_ADMIN)
			$groupname = $lang['global']['groupNameAdmin'];
		elseif($groupid == GROUPID_MEMBER)
			$groupname = $lang['global']['groupNameMember'];
		elseif($groupid == GROUPID_JUDGE)
			$groupname = $lang['global']['groupNameJudge'];
		elseif($groupid == GROUPID_MODERATOR)
			$groupname = $lang['global']['groupNameModerator'];
			
		return $groupname;
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
			$myUser->firstname = $row['up_firstname'];
			$myUser->lastname = $row['up_lastname'];
			$myUser->honor = $row['up_honor'];
			$myUser->groupid = $row['u_groupid'];
			$myUser->gender = $row['up_gender'];
			$myUser->birthday = $row['up_birthday'];
			$myUser->phone1 = $row['up_phone1'];
			$myUser->phone2 = $row['up_phone2'];
			$myUser->address = $row['up_address'];
			$myUser->address2 = $row['up_address2'];
			$myUser->zipcode = $row['up_zipcode'];
			$myUser->city = $row['up_city'];
			$myUser->region = $row['up_region'];
			$myUser->country = $row['up_country'];
			$myUser->psamembership = $row['up_psamembership'];
			$myUser->photoclub = $row['up_photoclub'];
			$myUser->paidColor = $row['up_paid_color'];
			$myUser->paidMono = $row['up_paid_mono'];
			$myUser->paidNature = $row['up_paid_nature'];
            $myUser->paidTravel = $row['up_paid_travel'];
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
			else if($formData['fsearchKeywordIn'] == 'fullname')
			{
				$whereString .= ' AND up_fullname LIKE \'%'.$formData['fkeywordFilter'].'%\'';
			}
			else
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
	
	public function thumbImage()
	{
		global $registry;
		
		$pos = strrpos($this->avatar, '.');
		$extPart = substr($this->avatar, $pos+1);
		$namePart =  substr($this->avatar,0, $pos);
		$filesmall = $namePart . '-small.' . $extPart;	
		
		
		if(file_exists($registry->setting['avatar']['imageDirectory'] . $filesmall))
		{
			return $filesmall;
		}
		else
		{
			return $this->image;
		}
	}
	
	public function getCountryName()
	{
		global $lang, $setting;
		
			return $setting['country'][$this->country];
		
	}
	
	public function getRegionName()
	{
		global $lang, $setting;
		
		if($this->region > 0)
		{
			return $setting['region'][$this->region];
		}
		else
		{
			return $lang['controllergroup']['regionNotUpdate'];
		}
		
	}
	
	public function resetpass($newpass)
	{
		$sql = 'UPDATE ' . TABLE_PREFIX . 'ac_user_profile
				SET up_password = ?
				WHERE u_id = ?
				LIMIT 1';
		$stmt = $this->db->query($sql, array($newpass, $this->id));
		if($stmt)
			return true;
		else
			return false;
	}
	
	/**
	* Kiem tra xem user voi tai khoan nay co the xem photo duoc khong
	* 
	*/
	public function canViewPhoto()
	{
		return ($this->groupid == GROUPID_ADMIN || $this->groupid == GROUPID_MODERATOR || $this->groupid == GROUPID_JUDGE);
	}
    
    public static function countCountry()
    {   global $db;
        $sql = 'SELECT COUNT(*) FROM (SELECT DISTINCT up_country FROM pex_ac_user_profile p JOIN pex_ac_user u ON p.u_id = u.u_id WHERE u_groupid NOT IN ( 1, 2, 3 )) as COUNTRY ';
        return $db->query($sql)->fetchSingle();    
    }
	
	
}


?>