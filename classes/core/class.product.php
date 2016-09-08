<?php

Class Core_Product extends Core_Object
{
    const ERROR_OK = 1;
    const ERROR_UPLOAD_IMAGE = 2;
    const ERROR_UNKNOWN = 4;
    
    public $id = 0;
    public $name = '';
    public $price = 0;
    public $realPrice = 0;
    public $bincode = 0;
    
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
        global $registry;
        
        $this->datecreated = time();//Thoi diem them
        $sql = 'INSERT INTO ' . TABLE_PREFIX . 'product 
                (p_name, p_price, p_bincode)
                VALUES(?, ?, ?)';
        $rowCount = $this->db->query($sql, array(
               (string)$this->name, 
               (float)$this->price, 
               (float)$this->bincode, 
            ))->rowCount();
            
        $this->id = $this->db->lastInsertId();
        
        if($this->id > 0) 
        	return self::ERROR_OK;  
        else
        	return self::ERROR_UNKNOWN;  
    }
    //Cap nhat thong tin 
    public function updateData()
    {                   
        global $registry;
                                 
        $this->datemodified = time();
            
        $sql = 'UPDATE ' . TABLE_PREFIX . 'product
                SET p_price = ?,
                	p_bincode = ?
                WHERE p_id = ?';
               
        $stmt = $this->db->query($sql, array(
        		(float)$this->price, 
        		(float)$this->bincode, 
                $this->id
            ));
            
        if($stmt)
        	return self::ERROR_OK;
        else
        	return self::ERROR_UNKNOWN;
    }
   
    //Lay du lieu cua object co id la $id
    public function getData($id)
    {
        $id = (int)$id;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'product p
                WHERE p.p_id = ?';
        $stmt = $this->db->query($sql, array($id)); 
        while($row=$stmt->fetch())
        {
            $this->id = $row['p_id'];   
            $this->name = $this->getFormatedName($row['p_name']);   
            $this->price = $row['p_price'];   
            $this->realPrice = $row['p_price'];   
            $this->bincode = $row['p_bincode'];   
        }
    }
    
    //Lay du lieu cua object co id la $id
    public function getDataByBinCode($bincode)
    {
        $bincode = (int)$bincode;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'product p
                WHERE p.p_bincode = ?';
        $stmt = $this->db->query($sql, array($bincode)); 
        while($row=$stmt->fetch())
        {
            $this->id = $row['p_id'];   
            $this->name = $this->getFormatedName($row['p_name']);
            $this->price = $row['p_price'];   
            $this->realPrice = $row['p_price'];   
            $this->bincode = $row['p_bincode'];   
        }
    }
    
   
    
    public function delete()
    {
        //Xoa du lieu chinh
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'product
                WHERE p_id = ?
        ';
        $rowCount = $this->db->query($sql, array($this->id))->rowCount();

        
        return $rowCount;
    }
    
    
     //Dem so record thoa man dk trong $where   
    public static function countList($where = 'p.p_id > 0 ', $joinString = '')
    {
        global $db;
        $sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'product p
                WHERE ' . $where;
                
        return $db->query($sql)->fetchSingle();
    }
    
    public static function getList($where = 'p.p_id > 0', $order = 'p.p_id DESC' , $limit = '', $joinString = '')
    {
        global $db,$registry;
       
        if($limit == '')
            $limitString = '';
        else
            $limitString = ' LIMIT ' . $limit;
            
        $outputList = array();
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'product p
                WHERE ' . $where . ' GROUP BY p.p_id
                ORDER BY ' . $order . '
                ' . $limitString;
        $stmt = $db->query($sql, array($registry->langCode));
        while($row = $stmt->fetch())
        {
            $myProduct = new Core_Product();
            $myProduct->id = $row['p_id'];
            $myProduct->name = $myProduct->getFormatedName($row['p_name']);
            $myProduct->price = $row['p_price'];   
            $myProduct->realPrice = $row['p_price'];   
            $myProduct->bincode = $row['p_bincode'];   
                
            $outputList[] = $myProduct;
        }
        return $outputList;
    }
   //danh sach san pham
	public static function getProducts($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'p.p_id > 0 ';
		$joinString = '';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.p_id = '.(int)$formData['fid'].' ';
		}
		
		if(count($formData['fidlist']) > 0)
		{
			$whereString .= ' AND p.p_id IN( '.implode(', ', $formData['fidlist']).' )';
		}
		
		if($formData['fpaylocation'] == 'vn')
		{
			$whereString .= ' AND p.p_id <= 7 ';
		}
		elseif($formData['fpaylocation'] == 'other')
		{
			$whereString .= ' AND p.p_id >= 8 AND p.p_id <= 14';
		}
		
        
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'id')
			$orderString = ' p.p_id ' . $sorttype;
        else
            $orderString = ' p.p_id ' . $sorttype;    
				
		if($countOnly)
			return self::countList($whereString, $joinString);
		else
			return self::getList($whereString, $orderString, $limit, $joinString);
	}
    
   /**
   * Ham tinh ra duoc price thuc te, sau khi da tru discount
   * 
   */
   	public function updateRealPrice()
	{
		$this->realPrice = $this->price;
		
		if($this->discount > 0)
		{
			if($this->isDiscountPercent == 1)
			{
				$this->realPrice = $this->price - ($this->price * ($this->discount / 100));
			}
			else 
			{
				$this->realPrice = $this->price - $this->discount;
			}
		}
		if($this->realPrice < 0)
			$this->realPrice = 0;
	}
	
	
	/**
	* Tra ve product id tu option ma user chon (color, mono, nature, travel)
	* 
	* @param mixed $sectionOptions
	*/
	public static function calculatePackId($paidLocation, $sectionOptions)
	{
		$packId = 0;
		
		if($paidLocation == 'vn')
		{
			if(in_array('color', $sectionOptions))
				$packId += 1;
			if(in_array('mono', $sectionOptions))
				$packId += 2;
			if(in_array('nature', $sectionOptions))
				$packId += 4;
            if(in_array('travel',$sectionOptions))
                $packId += 8;
		}
		else
		{
			if(in_array('color', $sectionOptions))
				$packId += 16;
			if(in_array('mono', $sectionOptions))
				$packId += 32;
			if(in_array('nature', $sectionOptions))
				$packId += 64;
            if(in_array('travel',$sectionOptions))
                $packId += 128;
		}
		
		return $packId;
	}
	
	/**
	* dua tren IP or something else de lay duoc location de pay
	* boi voi moi location (vn & other) co gia khac nhau
	* 
	*/
	public static function getPayLocation()
	{
		global $registry;
		
		if($registry->me->country == 'VN')
			$location = 'vn';
		else
			$location = 'other';
		
		return $location;
	}
	
	
	public function getFormatedName($name)
	{
		global $lang;
		$group = explode('.', $name);
		
		//$group[0] la pay location (vn/usd)
		//group[1] co dang color_mono_nature...
		
		$name = '';
		switch($group[1])
		{
			case 'color' : $name = $lang['global']['mProductColor']; break;
			case 'mono'	: $name = $lang['global']['mProductMono']; break;
			case 'nature'	: $name = $lang['global']['mProductNature']; break;
			case 'travel'   : $name = $lang['global']['mProductTravel']; break;
            
            case 'color_mono' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductMono']  ; break; 
			case 'color_nature' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductNature']  ; break; 
            case 'color_travel' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductTravel']  ; break;
            case 'mono_travel' : $name = $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductTravel']  ; break;
            case 'mono_nature' : $name = $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductNature']  ; break;  
            case 'nature_travel' : $name = $lang['global']['mProductNature'] . ' - ' . $lang['global']['mProductTravel']  ; break;  
            
            
            case 'color_mono_nature' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductNature']  ; break; 
            case 'color_mono_travel' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductTravel']  ; break; 
            case 'color_nature_travel' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductNature'] . ' - ' . $lang['global']['mProductTravel']  ; break; 
            case 'mono_nature_travel' : $name = $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductNature'] . ' - ' . $lang['global']['mProductTravel']  ; break; 
            
            case 'color_mono_nature_travel' : $name = $lang['global']['mProductColor'] . ' - ' . $lang['global']['mProductMono'] . ' - ' . $lang['global']['mProductNature'].' - '.$lang['global']['mProductTravel']  ; break; 
		}
		
		if($group[0] == 'vnd')
		{
			$name .= ' (A)';
		}
		elseif($group[0] == 'usd')
		{
			$name .= ' (B)';
		}
		
		return $name;
	}
	
	   
}


?>