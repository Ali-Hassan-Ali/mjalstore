<?php

namespace App\Helpers;

class Cart
{
    public static function all()
    {
        return session()->has('cart_item') ? session()->get('cart_item') : [];

    }//end of fun all item

	public static function add($card)
	{
		$cartItem   = session()->get('cart_item');
        $quantity   = isset($cartItem[$card->slug]) ? (int) $cartItem[$card->slug]['quantity'] + 1 : 1;
        $totalPrice = $quantity * $card->price;
        $cartItem[$card->slug] = [
    								'uuid'        => $card->slug,
    								'quantity'    => (int) $quantity, 
                                    'price'       => (int) $card->price,
                                    'total_price' => (int) $totalPrice,
                                    'color_1'     => $card->subCategory?->color_1,
                                    'color_2'     => $card->subCategory?->color_2,
                                    'title_card'  => $card->subCategory?->title_card,
                                    'sub_category'=> $card->subCategory?->name,
                                    'market'      => $card->market?->name,
    							];

        session()->put('cart_item', $cartItem);

        return $cartItem[$card->slug] ?? [];

	}//end of fun add item

	public static function update($uuid, $quantity)
	{
		$cartItem   = session()->get('cart_item');
        $totalPrice = $quantity * $cartItem[$uuid]['price'];

        $cartItem[$uuid]['quantity'] = (int) $quantity;
        $cartItem[$uuid]['total_price'] = (int) $totalPrice;

        session()->put('cart_item', $cartItem);

        return $cartItem[$uuid] ?? [];

	}//end of fun update item

	public static function destroy($uuid)
    {   
        $cartItem = session()->get('cart_item');
        
        if(!empty($cartItem[$uuid])) {
        	
            unset($cartItem[$uuid]);

        } else {

            return false;

        }//end of fun


        session()->put('cart_item', $cartItem);

        return [];

    }//end of fun destroy item

    public static function destroyall()
    {
        return session()->forget('cart_item');
        
    }//end of fun destroyall item

    public static function count()
    {   
        return session()->has('cart_item') ? count(session()->get('cart_item')) : 0;

    }//end of fun count item

    public static function subtotal()
    {   

        if (session()->has('cart_item')) {

            $subtotal = 0;

            foreach (session()->get('cart_item') as $date => $item) {

                $subtotal += $item['quantity'] * preg_replace('/,/', '', $item['price']);

            }//end of foreach

            $currencyPrice = session('currency_price') ?? 0;
            $currencyName  = session('currency_name') ?? '$';

            return number_format(preg_replace('/,/', '', $subtotal * $currencyPrice), 2) . ' ' . $currencyName;

        } else {

            return 0.00;

        }//end of if has

    }//end of subtotal cart
	
}//end of class Cart