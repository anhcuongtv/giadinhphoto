<?php

Class Core_ContestPhotoGroup extends Core_Object
{
	
	public $id = 0;
	public $name = '';
	public $order = '';
	public $parent = '';
	public $status = '';
	public $limit = '';
    public $isGroup = '';
    public $isSection = '';
    public $child = '';
	
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
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'photogroup(`name`, parent, `order`, `limit`, `status`, isGroup, isSection)
				VALUES(?, ?, ?, ?, ?, ?, ?)';
				
		$rowCount = $this->db->query($sql, array(
				(string)$this->name,
				(int)$this->parent,
				(int)$this->order,
				(int)$this->limit,
				(int)$this->status,
                (int)$this->isGroup,
                (int)$this->isSection,
			))->rowCount();

        $this->id = $this->db->lastInsertId();

        if($this->id > 0)
		{
			return true;
		}
		else
			return false;
	}

    public function updateData()
    {
        global $registry;

        $sql = 'UPDATE ' . TABLE_PREFIX . 'photogroup
        		SET name = ?,
        			`parent` = ?,
        			`limit` = ?,
        			`order` = ?,
        			`status` = ?,
        			isGroup = ?,
        			isSection= ?
        		WHERE id = ?';

        $stmt = $this->db->query($sql, array(
            $this->name,
            $this->parent,
            $this->limit,
            $this->order,
            $this->status,
            $this->isGroup,
            $this->isSection,
            $this->id
        ));

        if($stmt) {
            return true;
        } else {
            return false;
        }
    }

	/**
	* 
	*/
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'photogroup
        		WHERE id =  ?
        			';
		$rowCount = $this->db->query($sql, array($this->id))->rowCount();
		
		return $rowCount;
       
	}

	public function getData($id)
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'photogroup
				WHERE id = ?';
		$stmt = $this->db->query($sql, array($id));
		
		while($row = $stmt->fetch())
		{
			$this->id = $row['id'];
            $this->parent = $row['parent'];
            $this->name = $row['name'];
            $this->order = $row['order'];
            $this->limit = $row['limit'];
            $this->status = (int)$row['status'];
            $this->isGroup = (int)$row['isGroup'];
            $this->isSection = (int)$row['isSection'];
		}
	}

    public static function getDataSectionName($id)
    {
        global $db;
        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'photogroup
				WHERE id = ?';
        $stmt = $db->query($sql, array($id));

        while($row = $stmt->fetch())
        {
            return $row['name'];
        }
        return '';
    }

    public static function getLimitForSection($id)
    {
        global $db;
        $sql = 'SELECT `limit` FROM ' . TABLE_PREFIX . 'photogroup
				WHERE id = ?';
        $stmt = $db->query($sql, array($id));

        while($row = $stmt->fetch())
        {
            return $row['limit'];
        }
        return 0;
    }
	
	public function getDataByArray($row)
	{
		$this->id = $row['pid'];
	}

	public static function getAllSection()
    {
        global $db;

        $sql = 'SELECT * FROM ' . TABLE_PREFIX . 'photogroup
		        WHERE isSection = 1 and status = 1 order by `order` asc';
        $stmt = $db->query($sql);
        $section = array();
        $i = 0;
        while($row = $stmt->fetch())
        {
            $section['detail'][$row['id']] = $row['name'];
            $section['all'][] = $row['id'];
            $i++;
        }
        return $section;
    }

    public static function getAllPhotoGroup()
    {
        global $db;

        $sql = 'SELECT id FROM ' . TABLE_PREFIX . 'photogroup
		        WHERE isSection = 0 and `limit` !=0 and `status` = 1 order by `order` asc';
        $stmt = $db->query($sql);
        $group = array();
        while($row = $stmt->fetch())
        {
            $group[] = $row['id'];
        }
        return $group;
    }
	
	public static function getList($parent = 0, $onlyActive = false)
	{
		global $db;
		
		$outputList = array();
        $sqlMore = '';
        if ($onlyActive) {
            $sqlMore = ' and status = 1 ';
        }
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'photogroup
		        WHERE parent = '.$parent.$sqlMore.' order by `order` asc';
		$stmt = $db->query($sql);
        $group = array();
        $i = 0;
		while($row = $stmt->fetch())
		{
            $groupDetail = new Core_ContestPhotoGroup();
            $groupDetail->id = $row['id'];
            $groupDetail->name = $row['name'];
            $groupDetail->parent = $row['parent'];
            $groupDetail->status = (int)$row['status'];
            $groupDetail->limit = (int)$row['limit'];
            $groupDetail->order = (int)$row['order'];
            $groupDetail->isGroup = (int)$row['isGroup'];

			$group[$i] = $groupDetail;
            //check child
            $childs = self::getList($row['id'], $onlyActive);
            if (count($childs) > 0) {
                $group[$i]->child = $childs;
            }
            $i++;
		}
		return $group;
	}
}
?>
