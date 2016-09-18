<?php

Class Core_CartProduct extends Core_Object
{
	
	public $product;
	public $quantity = 0;
	public $attribute = '';
	public $encodedattribute = '';
	public $subtotal = '';
	
	public function __construct(Core_NewProduct $product, $quantity, $attribute, $encodedattribute)
	{
		parent::__construct($id);                
		
		$this->product = $product;
		$this->quantity = $quantity;
		$this->attribute = $attribute;		
		$this->encodedattribute = $encodedattribute;
        if (strtolower($this->register->me->country) === 'vn') {
            $price = $product->price_vn;
        } else {
            $price = $product->price_en;
        }
		$this->subtotal = $quantity * $price;
	}
	
	
	
	
	
	
}


?>