<?php

namespace Lpmatrix\Cartie;

use Illuminate\Support\Collection;

class Cartie
{
	protected $CartContents;

    public function __construct() {
    	session_start();
        // Grab the shopping cart array from the session array
        if (isset($_SESSION['Cartie'])) {
            $this->CartContents = $_SESSION['Cartie'];
        } elseif ($this->CartContents === NULL) {
            // No cart exists so we'll set some base values
            $this->CartContents = array('cart_total' => 0, 'total_items' => 0);
        }
    }

    //add items to cart
    public function add($item = array()) {
        // Was any cart data passed?...
        if (!is_array($item) || count($item) === 0) {
            die('Error , The add method must be passed an array containing data.');
            return FALSE;
        } else {
            if (is_numeric($item['id']) && is_numeric($item['quantity']) && is_numeric($item['price']) && isset($item['name'])) {
                if (isset($item['options']) && count($item['options']) > 0) {
                    $rowid = md5($item['id'] . serialize($item['options']));
                } else {
                    $rowid = md5($item['id']);
                }
                if (isset($this->CartContents[$rowid])) {
                    $old_quantity = $this->CartContents[$rowid]['quantity'];
                    $this->update(
                            array(
                                'rowid' => $rowid,
                                'id' => $item['id'],
                                'name' => $item['name'],
                                'quantity' => $item['quantity'] + $old_quantity,
                                'price' => $item['price'],
                                'options' => (isset($item['options'])) ? $item['options'] : NULL
                            )
                    );
                    return TRUE;
                }
                $item['rowid'] = $rowid;
                $this->CartContents[$rowid] = $item;
                $this->save_cart();
            } else {
                die('Error , The cart array must contain a product ID, quantity, price, and name.');
                return FALSE;
            }
        }
    }

    //
    //update cart
    //
    public function update($item = array()) {
        if (!is_array($item) || count($item) === 0 || empty($item['rowid'])) {
            die('Error , The update method must be passed an array containing rowid.');
            return FALSE;
        } else {
            $rowid = strval($item['rowid']);
            if (isset($this->CartContents[$rowid])) {
                if (isset($item['price'])) {
                    $item['price'] = (int) $item['price'];
                }
                if (isset($item['quantity'])) {
                    if ($item['quantity'] === 0) {
                        $this->remove($rowid);
                        return TRUE;
                    } else {
                        $item['quantity'] = (int) $item['quantity'];
                    }
                }

                $keys = array_intersect(array_keys($this->CartContents[$rowid]), array_keys($item));
                foreach (array_diff($keys, array('id', 'name')) as $key) {
                    $this->CartContents[$rowid][$key] = $item[$key];
                }
                $this->save_cart();
            }
            return TRUE;
        }
    }

    //
    //calculate prices and total amount
    //
    protected function save_cart() {
        $this->CartContents['total_items'] = $this->CartContents['cart_total'] = 0;
        foreach ($this->CartContents as $key => $val) {
            if (!is_array($val) OR ! isset($val['price'], $val['name'], $val['quantity'], $val['id'], $val['rowid'])) {
                continue;
            }

            $this->CartContents['cart_total'] += ($val['price'] * $val['quantity']);
            $this->CartContents['total_items'] += $val['quantity'];
            $this->CartContents[$key]['subtotal'] = ($this->CartContents[$key]['price'] * $this->CartContents[$key]['quantity']);
        }
        if (count($this->CartContents) <= 2) {
            unset($_SESSION);
            return FALSE;
        }
        $_SESSION['Cartie'] = $this->CartContents;
        return TRUE;
    }

    //cart total
    public function totalPrice() {
        return $this->CartContents['cart_total'];
    }

    //cart total
    public function totalItems() {
        return $this->CartContents['total_items'];
    }

    //remove item
    public function remove($rowid) {
        // unset & save
        $r = settype($rowid, 'string');
        if (isset($this->CartContents[$r])) {
            unset($this->CartContents[$r]);
            $this->save_cart();
            return TRUE;
        } else {
            die('Error , The item doesn\'t exist');
        }
    }

    public function get(){
    	foreach ($this->CartContents as $key => $value) {
    		$rowid = $key;
    	}
    	
    	return $rowid;
    }

    public function contents() {
        // arrange to the newest first
        $cart = array_reverse($this->CartContents);
        unset($cart['total_items']);
        unset($cart['cart_total']);
        $rowid = $this->get();
        dd( collect($cart)->pull($rowid));
    }

    public function clear() {
        $this->CartContents = array('cart_total' => 0, 'total_items' => 0);
        unset($_SESSION['Cartie']);
    }

}
