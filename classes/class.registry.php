<?php

Class Registry Implements ArrayAccess 
{
	private $vars = array();
	public static $base_dir = '';
	
	function __construct() 
	{
	}

	function set($key, $var) 
	{
		$this->vars[$key] = $var;
		return true;
	}

	function get($key) 
	{
		if (isset($this->vars[$key]) == false) 
		{
			return null;
		}

		return $this->vars[$key];
	}
	
	function __set($key, $var)
	{
		$this->vars[$key] = $var;
		return true;
	}
	
	function __get($key)
	{
		if (isset($this->vars[$key])) 
		{
			return $this->vars[$key];
		}

		return null;
	}

	function remove($var) 
	{
		unset($this->vars[$key]);
	}

	function offsetExists($offset) 
	{
		return isset($this->vars[$offset]);
	}

	function offsetGet($offset) 
	{
		return $this->get($offset);
	}

	function offsetSet($offset, $value) 
	{
		$this->set($offset, $value);
	}

	function offsetUnset($offset) 
	{
		unset($this->vars[$offset]);
	}
}

