<?php

class MyPDO extends PDO 
{
	// luu tru tat ca cac query moi khi truy van va insert dung ham array_unshift();
	private $storedSQL = array();
	
	function logQuery($msg, $writemode = true, $isReturnArray = false, $viewall = false)
	{
		if($writemode)
		{
			if(strlen($msg) > 0)
			{
				array_unshift($this->storedSQL, $msg);
			}
		}
		else
		{
			if(count($this->storedSQL) > 0)
			{
				if($isReturnArray)
				{
					$returnArray = array_reverse($this->storedSQL);
					return $returnArray;   
				}
				else
				{
					if($viewall)
					{
						$returnArray = $this->storedSQL;
						echo '<br />' . join('<br />', array_reverse($this->storedSQL));
					}
					else
					{
						$returnArray = $this->storedSQL[0];
						echo '<br />' . $this->storedSQL[0];
					}
				}
				
				
				
			}
			else
			{
				echo 'No Executed Query.';
			}
		}
		
		return true;
		
	}
	
	
	
	function __construct($dsn, $username, $password) 
	{
		parent::__construct($dsn, $username, $password);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

  	function prepare($sql, $driverOptions = array()) 
  	{
  		if(DEBUG)
  			$this->logQuery($sql, true);
  			
		$stmt = parent::prepare($sql, array(
	  							PDO::ATTR_STATEMENT_CLASS => array('PDOStatement_')
								));

		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt;
  	}

  	function query($sql, $params = array()) 
  	{
		$stmt = $this->prepare($sql);
		$stmt->execute($params);
		return $stmt;
  	}
  	
  	function queryCountRow($sql, $params = array())
  	{
  		$sql = trim($sql);
		$sql = preg_replace('~^SELECT\s.*\sFROM~s', 'SELECT COUNT(*) FROM', $sql);
		$sql = preg_replace('~ORDER\s+BY.*?$~sD', '', $sql);
		$stmt = $this->prepare($sql);
		$stmt->execute($params);
		$r = $stmt->fetchColumn(0);
		return $r;
  	}
}


class PDOStatement_ extends PDOStatement 
{
/*
  	function execute($params = array()) 
  	{
		parent::execute($params);
		return $this;
  	}
*/
  	function fetchSingle() 
  	{
		return $this->fetchColumn(0);
  	}

  	function fetchAssoc() 
  	{
		$this->setFetchMode(PDO::FETCH_NUM);
		$data = array();
		while ($row = $this->fetch()) 
		{
	  		$data[$row[0]] = $row[1];
		}
		return $data;
  	}
}

class Transaction 
{

  	private $db = NULL;
  	private $finished = FALSE;

  	function __construct($db) 
  	{
		$this->db = $db;
		$this->db->beginTransaction();
  	}

  	function __destruct() 
  	{
		if (!$this->finished) 
		{
	  		$this->db->rollback();
		}
  	}

  	function commit() 
  	{
		$this->finished = TRUE;
		$this->db->commit();
  	}

  	function rollback() 
  	{
		$this->finished = TRUE;
		$this->db->rollback();
  	}
}
?>