<?php

Class Core_RelNewsCategory extends Core_Object
{
	public $news;
	
	public function __construct(Core_News $news = null)
	{
		parent::__construct();
		
		if(!empty($news))
		{
			$this->news = $news;
			$this->getData();
		}
	}
		
	public function addData()
	{
		$rowCount = 0;
		for($i = 0; $i < count($this->news->categoryList); $i++)
		{
			$sql = 'INSERT INTO ' . TABLE_PREFIX . 'rel_news_category 
					(`n_id`, `nc_id`)
					VALUES(?, ?)';
				$rowCount += $this->db->query($sql, array($this->news->id, $this->news->categoryList[$i]))->rowCount();
		}
		
		return $rowCount;
	}
	
	public function updateData()
	{   
		//delete all current binding                                         
		$this->delete();
			
		//create new binding
		return $this->addData();	
	}
	
	
	
	public function getData()
	{
		$sql = 'SELECT nc_id FROM ' . TABLE_PREFIX . 'rel_news_category
				WHERE n_id = ?';
		$this->news->categoryList = $this->db->query($sql, array($this->news->id))->fetchAll(PDO::FETCH_COLUMN, 0);
	}
	
	public function delete()
	{
		$sql = 'DELETE FROM ' . TABLE_PREFIX . 'rel_news_category
        		WHERE n_id = ?
        			';
		$rowCount = $this->db->query($sql, array($this->news->id))->rowCount();
		return $rowCount;
	}
	
		
	
	
	
}


?>