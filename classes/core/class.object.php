<?php
Abstract Class Core_Object
{
	protected $db;
    protected $sectiondata;
	
	public function __construct()
	{
		global $registry;
		
		$this->db = $registry->db;		
	}
}


?>