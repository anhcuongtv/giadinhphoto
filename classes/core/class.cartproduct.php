<?php

Class Core_CartProduct extends Core_Object
{
	
	public $product;
	public $quantity = 0;
	public $attribute = '';
	public $encodedattribute = '';
	public $subtotal = '';
	
	public function __construct(Core_Product $product, $quantity, $attribute, $encodedattribute)
	{
		parent::__construct($id);                
		
		$this->product = $product;
		$this->quantity = $quantity;
		$this->attribute = $attribute;		
		$this->encodedattribute = $encodedattribute;
		$this->subtotal = $quantity * $product->realPrice;
	}
	
	
	
	
	
	
}


?>