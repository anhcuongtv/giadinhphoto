<?php

Class Core_News extends Core_Object
{
    const ERROR_OK = 1;
    const ERROR_UPLOAD_IMAGE = 2;
    const ERROR_UNKNOWN = 4;
    
    public $id = 0;
    public $view = 0;
    public $enable = 1;
    public $seoUrl = '';
	public $datemodified = 0;
	
	public $name = array();     
	public $summary = array();     
    public $seoTitle = array();
    public $seoKeyword = array();
    public $seoDescription = array();
    public $contents = array();              
    public $tags = array();      
    
    public $categoryList = array();
            
    // Hinh anh
    public $image='';
    public $smallImage='';
    
    public function __construct($id = 0)
    {
        parent::__construct();
        
        if($id > 0)
        {
            $this->getData($id);
        }
    }
    //Ham upload anh
    //Da kiem tra co anh roi!!!
    public function uploadImage()
    {
        global $registry;
        
        $curDateDir = ''; 
        $extPart = substr(strrchr($_FILES['fimage']['name'],'.'),1);
        $namePart =  Helper::codau2khongdau($this->name[$registry->langCode], true);
        $name = $namePart . '.' . $extPart;
        $uploader = new Uploader($_FILES['fimage']['tmp_name'], $name, $registry->setting['news']['imageDirectory'] . $curDateDir, '', $registry->setting['news']['validType']);
        
        $uploadError = $uploader->upload(false, $name);
        if($uploadError != Uploader::ERROR_UPLOAD_OK)
        {
            return $uploadError;
        }
        else
        {
            //Resize big image if needed
            $myImageResizer = new ImageResizer( $registry->setting['news']['imageDirectory'] . $curDateDir, $name, 
                                                $registry->setting['news']['imageDirectory'] . $curDateDir, $name, 
                                                $registry->setting['news']['imageMaxWidth'], 
                                                $registry->setting['news']['imageMaxHeight'], 
                                                '', 
                                                $registry->setting['avatar']['imageQuality']);
            $myImageResizer->output();    
            unset($myImageResizer);
            
            //Create thum image
            $nameThumbPart = substr($name, 0, strrpos($name, '.'));
            $nameThumb = $nameThumbPart . '-small.' . $extPart;
            $myImageResizer = new ImageResizer(    $registry->setting['news']['imageDirectory'] . $curDateDir, $name, 
                                                $registry->setting['news']['imageDirectory'] . $curDateDir, $nameThumb, 
                                                $registry->setting['news']['imageThumbWidth'], 
                                                $registry->setting['news']['imageThumbHeight'], 
                                                '1:1', 
                                                $registry->setting['news']['imageQuality']);
            $myImageResizer->output();    
            unset($myImageResizer);
            //update database                
            $this->image = $curDateDir . $name;
        }
    }
    
    //Ham them record vao trong bang du lieu
    public function addData()
    {
        global $registry;
        
        $this->datemodified = time();//Thoi diem them
        //Thong tin chung cua con meo moi:
        $sql = 'INSERT INTO ' . TABLE_PREFIX . 'news 
                ( `n_enable`, `n_seourl`, `n_datemodified`,`n_image`)
                VALUES(?,?, ?, ?)';
        $rowCount = $this->db->query($sql, array(
               $this->enable, $this->seoUrl, $this->datemodified,$this->image
            ))->rowCount();
            
        $this->id = $this->db->lastInsertId();
        
        //Thong tin rieng lien quan ngon ngu cua cac con meo:
        if($this->id > 0)
        {
            $sql = 'INSERT INTO ' . TABLE_PREFIX . 'news_language                                                       
            (`n_id`, `l_code`, `nl_name`, `nl_summary`, `nl_contents`, `nl_tags`, `nl_seotitle`, `nl_seokeyword`, `nl_seodescription`)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            foreach($this->name as $langcode=>$value)//Chi lay so luong cua mang $this->name
            {
                $this->db->query($sql, array($this->id, $langcode, $this->name[$langcode], $this->summary[$langcode], $this->contents[$langcode], $this->tags[$langcode], $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode] ));
            }
            
            //create binding
			$myRelNewsCategory = new Core_RelNewsCategory();
			$myRelNewsCategory->news = $this;
			$myRelNewsCategory->addData();
        }
        //Xu ly anh
        if($this->id > 0)//Da luu cac thong tin quan trong cua tin tuc OK
        {
            if(strlen($_FILES['fimage']['name']) > 0)
            {
                //upload image
                $uploadImageResult = $this->uploadImage();
                
                if($uploadImageResult != Uploader::ERROR_UPLOAD_OK)
                    return self::ERROR_UPLOAD_IMAGE;
                else if($this->image != '')
                {      
                    //update source
                    $sql = 'UPDATE ' . TABLE_PREFIX . 'news
                            SET n_image = ?
                            WHERE n_id = ?';
                    $result=$this->db->query($sql, array($this->image, $this->id));
                    if(!$result)
                        return self::ERROR_UPLOAD_IMAGE;
                }
            }
        }
        else
            return self::ERROR_UNKNOWN;    
        return self::ERROR_OK;    
    }
    //Cap nhat thong tin 
    public function updateData()
    {                   
        global $registry;
                                 
        $this->datemodified = time();
            
        $sql = 'UPDATE ' . TABLE_PREFIX . 'news
                SET n_view = ?,
                	n_enable = ?,
                    n_seourl = ?,
                    n_datemodified = ?,
                    n_image=?
                WHERE n_id = ?';
               
        $stmt = $this->db->query($sql, array(
                $this->view, $this->enable, $this->seoUrl, $this->datemodified,$this->image, $this->id
            ));
            
        if($stmt)
        {
        	foreach($this->name as $langcode=>$value)
			{
				//check binding with language            
				$sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'news_language
						WHERE n_id = ? AND l_code = ?
						LIMIT 1';
				if($this->db->query($sql, array($this->id, $langcode))->fetchSingle() > 0)
				{
					//binding existed, begin update
					$sql = 'UPDATE ' . TABLE_PREFIX . 'news_language
		                    SET nl_name = ?,
                    			nl_summary = ?,
		                        nl_contents =?,
		                        nl_tags = ?,
		                        nl_seotitle = ?,
		                        nl_seokeyword = ?,
		                        nl_seodescription = ?
		                    WHERE n_id = ? AND l_code = ?';
					$this->db->query($sql, array($this->name[$langcode], $this->summary[$langcode], $this->contents[$langcode], $this->tags[$langcode], $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode], $this->id, $langcode));
				}
				else
				{
					//binding not existed, insert this
					$sql = 'INSERT INTO ' . TABLE_PREFIX . 'news_language                                                       
				            (`n_id`, `l_code`, `nl_name`, `nl_summary`, `nl_contents`, `nl_tags`, `nl_seotitle`, `nl_seokeyword`, `nl_seodescription`)
				                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
				    $this->db->query($sql, array($this->id, $langcode, $this->name[$langcode], $this->summary[$langcode], $this->contents[$langcode], $this->tags[$langcode], $this->seoTitle[$langcode],  $this->seoKeyword[$langcode],  $this->seoDescription[$langcode] ));
				}
			}
            
            //////////////////////////////////////////////////////////
			//binding with category
			$myRelNewsCategory = new Core_RelNewsCategory();
			$myRelNewsCategory->news = $this;  
			$myRelNewsCategory->updateData();
        }  
        
         //Xu ly anh
        if($stmt)//Da luu cac thong tin quan trong cua tin tuc OK
        {
            if(strlen($_FILES['fimage']['name']) > 0)//Neu co anh
            {                   
                //upload image                               
                $oldimage=$this->image;//Luu thong tin anh cu
                $uploadImageResult = $this->uploadImage();
                if($uploadImageResult != Uploader::ERROR_UPLOAD_OK)//Khong co loi
                    return self::ERROR_UPLOAD_IMAGE;
                else if($this->image != '')
                {      
                    //update source
                    $sql = 'UPDATE ' . TABLE_PREFIX . 'news
                            SET n_image = ?
                            WHERE n_id = ?';
                    $result=$this->db->query($sql, array($this->image, $this->id));
                    
                    if(!$result)
                        return self::ERROR_UPLOAD_IMAGE;
                        
                    else if($oldimage!=$this->image && $oldimage!='')
                    {
                        //Xoa anh cu
                        $this->deleteImage($oldimage);
                    }
                }
            }
             else//Khong co anh thi khong lam gi ca
             {}  
        }
        else
            return self::ERROR_UNKNOWN;    
        return self::ERROR_OK;     
    }
   
    //Lay du lieu cua object co id la $id
    public function getData($id)
    {
        $id = (int)$id;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'news n
                INNER JOIN ' . TABLE_PREFIX . 'news_language nl ON n.n_id = nl.n_id
                WHERE n.n_id = ?';
        $stmt = $this->db->query($sql, array($id)); 
        while($row=$stmt->fetch())
        {
            $this->id = $row['n_id'];             
            $this->view = $row['n_view'];             
            $this->enable = $row['n_enable'];
            $this->seoUrl = $row['n_seourl'];
            $this->datemodified = $row['n_datemodified'];
            // anh:
            $this->image=$row['n_image'];
            $this->smallImage= $this->getSmallImage();
            $this->name[$row['l_code']] = $row['nl_name'];
            $this->summary[$row['l_code']] = $row['nl_summary'];
            $this->seoTitle[$row['l_code']] = $row['nl_seotitle'];
            $this->seoKeyword[$row['l_code']] = $row['nl_seokeyword'];
            $this->seoDescription[$row['l_code']] = $row['nl_seodescription']; 
            $this->contents[$row['l_code']] = $row['nl_contents'];  
            $this->tags[$row['l_code']] = $row['nl_tags'];  
            //Thong tin muc tin cha cua tin tuc:
            $myRelNewsCategory = new Core_RelNewsCategory($this);
        }
    }
    
    public function getSmallImage($fileimage = '')
    {
        if($fileimage == '')
            $fileimage = $this->image;
            
        $out = str_replace('.','-small.',$fileimage);
        return $out;
    }
    
     //Xoa anh
    public function deleteImage($imagepath = '')
    {
        global $registry;
        
        //delete current image
        if($imagepath == '')
            $deletefile = $this->image;
        else
            $deletefile = $imagepath;
        
        if(strlen($deletefile) > 0)
        {
            $file = $registry->setting['news']['imageDirectory'] . $deletefile;
            $smallfile=$registry->setting['news']['imageDirectory'] . $this->getSmallImage($deletefile);//anh thumbnail
            if(file_exists($file) && is_file($file))
            {
                @unlink($file);
                @unlink($smallfile);//anh thumbnail
            }
            
            //delete current image
            if($imagepath == '')
                $this->image = '';
        }
    }
    public function delete()
    {
        //Xoa du lieu chinh
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'news
                WHERE n_id = ?
        ';
        $rowCount = $this->db->query($sql, array($this->id))->rowCount();
        //Xoa du lieu lien quan ngon ngu
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'news_language
                WHERE n_id =  ?
                    ';
        $this->db->query($sql, array($this->id));                
        if($rowCount > 0)
        {
            //Xoa anh
            $this->deleteImage();
            
            //delete rel_news_category
			$myRelNewsCategory = new Core_RelNewsCategory($this);
			$myRelNewsCategory->delete();
        }       
        
        
        return $rowCount;
    }
    
    
     //Dem so record thoa man dk trong $where   
    public static function countList($where = 'n.n_id > 0 ', $joinString = '')
    {
        global $db;
        $sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'news n
        		'.$joinString.'
                WHERE ' . $where;
        return $db->query($sql)->fetchSingle();
    }
    
    public static function getList($where = 'n.n_id > 0', $order = 'n.n_id DESC' , $limit = '', $joinString = '')
    {
        global $db,$registry;
       
        if($limit == '')
            $limitString = '';
        else
            $limitString = ' LIMIT ' . $limit;
            
        $outputList = array();
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'news n
                INNER JOIN '.TABLE_PREFIX.'news_language nl ON n.n_id=nl.n_id
                '.$joinString.'
                WHERE l_code=? AND ' . $where . '
                ORDER BY ' . $order . '
                ' . $limitString;
        $stmt = $db->query($sql, array($registry->langCode));
        while($row = $stmt->fetch())
        {
            $myNews = new Core_News();
            $myNews->id = $row['n_id'];
            $myNews->view = $row['n_view'];
            $myNews->name[$registry->langCode] = $row['nl_name'];
            $myNews->summary[$registry->langCode] = $row['nl_summary'];
            $myNews->tags[$registry->langCode] = $row['nl_tags'];
            $myNews->enable = $row['n_enable'];
            $myNews->seoUrl = $row['n_seourl'];
            $myNews->datemodified = $row['n_datemodified'];         
            //Hinh anh
            $myNews->image = $row['n_image'];
            $myNews->smallImage = $myNews->getSmallImage();
            //Thong tin muc tin cha cua tin tuc:
          	$myRelNewsCategory = new Core_RelNewsCategory($myNews);  
                
            $outputList[] = $myNews;
        }
        return $outputList;
    }
   
	public static function getNews($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'n.n_id > 0 ';
		$joinString = '';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND n.n_id = '.(int)$formData['fid'].' ';
		}
		
		if($formData['flessthanid'] > 0)
		{
			$whereString .= ' AND n.n_id < '.(int)$formData['flessthanid'].' ';
		}
		
		if($formData['fgreatthanid'] > 0)
		{
			$whereString .= ' AND n.n_id > '.(int)$formData['fgreatthanid'].' ';
		}
		
		if($formData['fexcludeid'] > 0)
		{
			$whereString .= ' AND n.n_id <> '.(int)$formData['fexcludeid'].' ';
		}
		
        if($formData['fparentid'] > 0)
        {
            $joinString .= 'INNER JOIN ' . TABLE_PREFIX . 'rel_news_category nc ON n.n_id = nc.n_id AND nc.nc_id = \''.$formData['fparentid'].'\' ';
        }
        
        if(strlen($formData['fenable'])>0)
        {
            if($formData['fenable']=='YES')
            {
                $whereString .= ' AND n.n_enable = '.'1'.' ';
            }
            else if($formData['fenable']=='YES')
            {
                $whereString .= ' AND n.n_enable = '.'0'.' ';
            }
        }
        if(strlen($formData['fkeyword']) > 0)
        {
            $formData['fkeyword'] = preg_replace('/[~!@#$%^&*;,?:\'"]/', '', $formData['fkeyword']);
            
            if($formData['fsearchIn'] == 'contents')
            {
                $whereString .= ' AND n.n_contents LIKE \'%'.$formData['fkeyword'].'%\'';
            }
            else//Truong hop khong chon search o dau
            {
            
            }
        }
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'DESC';
			
		if($sortby == 'id')
			$orderString = ' n.n_id ' . $sorttype;    
        else
            $orderString = ' n.n_id ' . $sorttype;         
				
		if($countOnly)
			return self::countList($whereString, $joinString);
		else
			return self::getList($whereString, $orderString, $limit, $joinString);
	}
	
	public function getFullUrl()
	{
		global $registry;
		
		$fullpath = $registry->conf['rooturl'] . 'site/news/detail/id/' . $this->id;
		
		return $fullpath;
	}
    
   
   
}


?>