<?php

Class Core_NewProduct extends Core_Object
{
    const ERROR_OK = 1;
    const ERROR_UPLOAD_IMAGE = 2;
    const ERROR_UNKNOWN = 4;
    
    public $id = 0;
    public $name_vn = '';
    public $name_en = '';
    public $price_vn = '';
    public $price_en = 0;
    public $description_vn = '';
    public $description_en = 0;
    public $status = 0;
    
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
        $sql = 'INSERT INTO ' . TABLE_PREFIX . 'new_product
                (name_vn, name_en, description_vn, price_vn, description_en, price_en, pStatus)
                VALUES(?, ?, ?, ?, ?, ?, ?)';
        $rowCount = $this->db->query($sql, array(
                (string)$this->name_vn,
                (string)$this->name_en,
                $this->description_vn,
                $this->price_vn,
                $this->description_en,
                $this->price_en,
                (int)$this->status,
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

        $sql = 'UPDATE ' . TABLE_PREFIX . 'new_product
                SET name_vn = ?,
                	price_vn = ?,
                	description_vn = ?,
                	name_en = ?,
                	price_en = ?,
                	description_en = ?,
                	pStatus = ?
                WHERE id = ?';
               
        $stmt = $this->db->query($sql, array(
        		$this->name_vn,
                $this->price_vn,
                $this->description_vn,
                $this->name_en,
                $this->price_en,
                $this->description_en,
                $this->status,
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
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'new_product p
                WHERE p.id = ?';
        $stmt = $this->db->query($sql, array($id)); 
        while($row=$stmt->fetch())
        {
            $this->id = $row['id'];
            $this->name_vn = $row['name_vn'];
            $this->price_vn = $row['price_vn'];
            $this->description_vn = $row['description_vn'];
            $this->name_en = $row['name_en'];
            $this->price_en = $row['price_en'];
            $this->description_en = $row['description_en'];
            $this->status = $row['pStatus'];
        }
    }
    
    public function delete()
    {
        //Xoa du lieu chinh
        $sql = 'DELETE FROM ' . TABLE_PREFIX . 'new_product
                WHERE id = ?
        ';
        $rowCount = $this->db->query($sql, array($this->id))->rowCount();

        
        return $rowCount;
    }
    
    
     //Dem so record thoa man dk trong $where   
    public static function countList($where = 'p.id > 0 ', $joinString = '')
    {
        global $db;
        $sql = 'SELECT COUNT(*) FROM ' . TABLE_PREFIX . 'new_product p
                WHERE ' . $where;
                
        return $db->query($sql)->fetchSingle();
    }
    
    public static function getList($where = 'p.id > 0', $order = 'p.id DESC' , $limit = '', $joinString = '')
    {
        global $db,$registry;
       
        if($limit == '')
            $limitString = '';
        else
            $limitString = ' LIMIT ' . $limit;
            
        $outputList = array();
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'new_product p
                WHERE ' . $where . ' GROUP BY p.id
                ORDER BY ' . $order . '
                ' . $limitString;
        $stmt = $db->query($sql, array($registry->langCode));
        while($row = $stmt->fetch())
        {
            $myProduct = new Core_NewProduct();
            $myProduct->id = $row['id'];
            $myProduct->name_vn = $row['name_vn'];
            $myProduct->price_vn = $row['price_vn'];
            $myProduct->description_vn = $row['description_vn'];
            $myProduct->name_en = $row['name_en'];
            $myProduct->price_en = $row['price_en'];
            $myProduct->description_en = $row['description_en'];
            $myProduct->status = $row['pStatus'];
                
            $outputList[] = $myProduct;
        }
        return $outputList;
    }
   //danh sach san pham
	public static function getProducts($formData, $sortby, $sorttype, $limit = '', $countOnly = false)
	{
		global $registry;
			
		$whereString = 'p.id > 0 ';
		$joinString = '';
		
		if($formData['fid'] > 0)
		{
			$whereString .= ' AND p.id = '.(int)$formData['fid'].' ';
		}
		
		if(count($formData['fidlist']) > 0)
		{
			$whereString .= ' AND p.id IN( '.implode(', ', $formData['fidlist']).' )';
		}
        
		//checking sort by & sort type
		if($sorttype != 'DESC' && $sorttype != 'ASC')
			$sorttype = 'ASC';
			
		if($sortby == 'id')
			$orderString = ' p.id ' . $sorttype;
        else
            $orderString = ' p.id ' . $sorttype;
				
		if($countOnly)
			return self::countList($whereString, $joinString);
		else
			return self::getList($whereString, $orderString, $limit, $joinString);
	}
}
?>