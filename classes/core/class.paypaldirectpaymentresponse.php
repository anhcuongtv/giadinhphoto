<?php

Class Core_PaypalDirectPaymentResponse extends Core_Object
{
	public $orderId = 0;
	public $id = 0;
	public $ack = '';
	public $apiversion = '';
	public $apibuild = '';
	public $timestamp = '';
	public $correlationid = '';
	public $ipaddress = '';
	public $serializeddata = '';
	public $datecreated  = '';
	
	public function __construct($id = 0)
	{
		parent::__construct($id);                
		
		if($id > 0)
		{
			$this->getData($id);
		}
		
	}
	
	public function addData()
	{
		$this->datecreated = time();
				
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'order_paymentpro_response(`o_id`, `opr_ack`, `opr_apiversion`, 
																			`opr_apibuild`, `opr_timestamp`, `opr_correlationid`, 
																			`opr_ipaddress`, `opr_serializeddata`, `opr_datecreated`)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)';
				
		$rowCount = $this->db->query($sql, array(
		    	(int)$this->orderId,
		    	(string)$this->ack,
		    	(string)$this->apiversion,
		    	(string)$this->apibuild,
		    	(string)$this->timestamp,
		    	(string)$this->correlationid,
		    	(string)$this->ipaddress,
		    	(string)$this->serializeddata,
		    	$this->datecreated,
			))->rowCount();
			
				
		$this->id = $this->db->lastInsertId();
		
		return $this->id;
	}
	
	
}


?>