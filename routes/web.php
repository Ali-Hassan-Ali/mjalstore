<?php

use Illuminate\Support\Facades\Route;

Route::get('/dd', function () {
        dd(route('site.products.cart.index'));
        return session()->forget('cart_item');
        return session()->get('cart_item');
        if (session()->has('cart_item')) {
                $cartItem                   = session()->get('cart_item')['items'] ?? [];
                
        } else {
                session()->put('cart_item', ['items' => []]);
                $cartItem                   = session()->get('cart_item');
        }
        // return session()->get('cart_item');
        $cartItem['items'][str()->random(4)] = [
                                'quantity' => 1, 
                                'uuid'     => 'ffffff',
                                'price'    => '$card->price'];


        session()->put('cart_item', $cartItem);

        return session()->get('cart_item');
        dd(Cartt()->addd());

        $cartItem       = session()->get('cart_item');
        unset($cartItem['3148']);
        session()->put('cart_item', $cartItem);
        return session()->get('cart_item');
});
