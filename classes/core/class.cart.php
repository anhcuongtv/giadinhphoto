<?php
###########################################################
#
#	Class dung de luu thong tin shopping cart
#		thong tin chi bao gom ID va QUANTITY cua san pham
############################################################
Class Core_Cart extends Core_Object
{
	protected $cartSession = '';
	protected $items = array();	//phan tu la {ID}_{ATTRIBUTE} de phan biet sp cung ID, nhung khac attribute
	protected $itemqtys = array();

	//constructor function
	public function __construct()
	{
		parent::__construct();
		$isInit = false;	//flag to check first time of connect
		
		//tim xem da tao cart trong cookie chua
		if(isset($_COOKIE['cartSession']) && strlen($_COOKIE['cartSession'])>0)
		{
			$this->cartSession = $_COOKIE['cartSession'];
			
			$this->syncCartSession();
			
		}
		else 
		{
			//kiem  tra session trong DB (if user not create cookie on remote host)
			$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'cart
					WHERE c_sessionid = ?
					LIMIT 1';
			$cart = $this->db->query($sql, array(Helper::getSessionId()))->fetch(); 
			if($cart['c_id'] > 0)
			{
				//tim thay cart
				$this->cartSession = $cart['c_sessionid'];
			}
			else 
			{
				//ko tim thay o ca cookie va cart table
				//init new cart session for current session
				$this->initCart();
				//echo 'init cart';
				$isInit = true;
			}
		}
		
		//if not first time, retrieve cart info has been saved before
		if(!$isInit)
		{
			$this->retrieveFromSession();
		}
	}
	
	/**
	 * ham dung de dong bo giua cartsession trong cookie,SESSION va cart session trong db
	 * - dung trong truong hop close browser, nhung cookie van con, do do server se generate sessionid khac
	 */
	private function syncCartSession()
	{
		//check cookie existed on database
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'cart
				WHERE c_sessionid = ?
				LIMIT 1';
		$cart = $this->db->query($sql, array($this->cartSession))->fetch();
		if($cart['c_id'] > 0)
		{
			//update new sessionid for current cart
			$this->cartSession = Helper::getSessionId();
			setcookie('cartSession',$this->cartSession,time() + 30*24*3600,'/');
			$_SESSION['cartSession'] = $this->cartSession;
			
			$sql = 'UPDATE ' . TABLE_PREFIX . 'cart
					SET c_sessionid = ?
					WHERE c_id = ?
					LIMIT 1';
			$this->db->query($sql,array($this->cartSession, $cart['c_id']));
			
		}
		else 
		{
			//cart not found, generate new cart
			$this->initCart();
		}
	}
	
	private function initCart()
	{
		$this->cartSession = Helper::getSessionId();
		setcookie('cartSession',$this->cartSession,time() + 30*24*3600, '/');
		$_SESSION['cartSession'] = $this->cartSession;
		
		//initialize cart in DB
		$sql = 'INSERT INTO ' . TABLE_PREFIX . 'cart(`c_sessionid`, `c_datecreated`)
				VALUES(?,?)';
		$this->db->query($sql, array($this->cartSession, time()));
	}
	
	/**
	 * Dung de lay du lieu trong database 
	 *
	 */
	public function retrieveFromSession()
	{
		$sql = 'SELECT * FROM ' . TABLE_PREFIX . 'cart
				WHERE c_sessionid = ?
				LIMIT 1';
		$cart = $this->db->query($sql, array($this->cartSession))->fetch();
		if($cart['c_id'] > 0)
		{
			
			//parse du lieu ve sp
			$this->emptyCart();
			
			//phan tich de lay cart detail
			$cartStoredItems = unserialize($cart['c_data']);
			
			if(is_array($cartStoredItems))
			{
				foreach($cartStoredItems as $item)
				{
					if($item['quantity'] > 0)
					{
						$this->addItem($item['id'], $item['quantity'], base64_encode($item['attribute']));
					}
				}
			}
			
			
		}
	}
	
	/**
	 * Luu thong tin hien tai cua cart vao database
	 *
	 */
	public function saveToSession()
	{
		//begin save
		$sql = 'SELECT c_id FROM ' . TABLE_PREFIX . 'cart
				WHERE c_sessionid = ?
				LIMIT 1';
		$cartid = $this->db->query($sql, array($this->cartSession))->fetchSingle();
		
		if($cartid > 0)
		{
			$items = $this->getContents();
			
			$sql = 'UPDATE ' . TABLE_PREFIX . 'cart
					SET c_data = ?
					WHERE c_id = ?';
			$this->db->query($sql, array(serialize($items), $cartid));
			
		}
		
		
	}

	public function getContents()
	{ // gets cart contents
		$items = array();
		foreach($this->items as $tmp_item)
		{
			$item = FALSE;
			$itemgroup = explode(':',$tmp_item);
			
			$item['id'] = $itemgroup[0];
			$item['attribute'] = base64_decode($itemgroup[1]);
			$item['quantity'] = $this->itemqtys[$tmp_item];
 			$items[] = $item;
		}
		return $items;
	} // end of get_contents
	
	/**
	* Ham dung tra ve day du thong tin cua cac product Object trong cart,
	* dung de show trong cac trang thanh toan
	* 
	*/
	public function getCartProducts()
	{
		$items = $this->getContents();
		
		$productIdList = array();
		foreach($items as $item)
		{
			$productIdList[] = $item['id'];
		}
		
		$products = Core_Product::getProducts(array('fidlist' => $productIdList), '', '', '');
		$cartProducts = array();
		foreach($items as $item)
		{
			for($i = 0; $i < count($products); $i++)
			{
				if($products[$i]->id == $item['id'])
				{
					$myCartProduct = new Core_CartProduct($products[$i], $item['quantity'],  $item['attribute'], base64_encode($item['attribute']));
					$cartProducts[] = $myCartProduct;
					break;	
				}
			}	
		}
		
		return $cartProducts;
	}


	//khi insert 1 item,
	//neu cung 1 product id nhung khac attribute thi coi nhu la 2 item khac
	//1 cap id-attribute goi la itemgroup
	public function addItem($itemid, $qty=1, $attribute = '')
	{ // adds an item to cart
		
		$itemgroup = $itemid . ':' . $attribute;
		if(strlen($itemgroup) > 1)
		{
			if(!empty($this->itemqtys[$itemgroup]) && $this->itemqtys[$itemgroup] > 0)
			{ // the item is already in the cart..
			  // so we'll just increase the quantity
				$this->itemqtys[$itemgroup] = $qty + $this->itemqtys[$itemgroup];
			} 
			else 
			{
				$this->items[]=$itemgroup;
				$this->itemqtys[$itemgroup] = $qty;
			}
		}
		
	} // end of add_item


	public function editItem($itemid,$qty, $attribute='')
	{ // changes an items quantity

		if($qty < 1) 
		{
			$this->delItem($itemid.':'.$attribute);
		} 
		else 
		{
			$this->itemqtys[$itemid.':'.$attribute] = $qty;
		}
	} // end of edit_item


	public function delItem($itemid, $attribute='')
	{ // removes an item from cart
		$ti = array();
		$this->itemqtys[$itemid.':'.$attribute] = 0;
		foreach($this->items as $item)
		{
			if($item != $itemid.':'.$attribute)
			{
				$ti[] = $item;
			}
		}
		$this->items = $ti;
	} //end of del_item


	public function emptyCart()
	{ // empties / resets the cart
	//die('xxx');
		$this->items = array();
		$this->itemqtys = array();
	} // end of empty cart


	public function itemCount()
	{
		return count($this->items);
	}
	
}
?>
