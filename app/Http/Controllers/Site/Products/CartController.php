<?php

namespace App\Http\Controllers\Site\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cupon;
use App\Models\Card;
use App\Helpers\Cart;

class CartController extends Controller
{
    public function cart()
    {
        $breadcrumb = ['#' => trans('site.products.carts.cart')];

        return view('site.products.cart', compact('breadcrumb'));

    }//end of fun cart page

    public function add(Card $card)
    {
        if (request()->ajax()) {
            
        	return response([
                'item'     => Cart::add($card), 
                'count'    => Cart::count(), 
                'subtotal' => Cart::subtotal(), 
                'message'  => __('admin.global.added_successfully')
            ]);

        } else {

            Cart::add($card);

            return redirect()->route('site.products.cart.index');

        }//end of if

    }//end of add

    public function update(Request $request)
    {
        return response([
            'item'     => Cart::update($request->uuid, $request->quantity), 
            'count'    => Cart::count(), 
            'subtotal' => Cart::subtotal(), 
            'message'  => __('admin.global.updated_successfully')
        ]);

    }//end of update

    public function delete($uuid)
    {
        return response([
            'item'    => Cart::destroy($uuid), 
            'count'   => Cart::count(), 
            'subtotal'=> Cart::subtotal(), 
            'message' => __('admin.global.deleted_successfully')
        ]);

    }//end of delete

    public function cupon(Request $request)
    {
        $cupon = Cupon::whereDate('end_date', '<', now())->where('code', $request->code)->first();

        if ($cupon?->exists()) {
            
            session()->put('cupon_price', $cupon->price);
            session()->put('cupon_code', $cupon->code);

            return response(['code' => 200, 'message' => __('admin.global.added_successfully')]);

        } else {

            return response(['code' => 404, 'message' => __('admin.global.code_not_found')]);

        }//end of if

    }//end of delete

    public function cuponDelete(Request $request)
    {
        $cupon = Cupon::whereDate('end_date', '<', now())->where('code', $request->code)->first();

        if ($cupon?->exists()) {
            
            session()->forget(['cupon_price', 'cupon_code']);

            return response(['code' => 200, 'message' => __('admin.global.deleted_successfully')]);

        } else {

            return response(['code' => 404, 'message' => __('admin.global.code_not_found')]);

        }//end of if

    }//end of delete

    public function search()
    {
        $breadcrumb = ['#' => trans('site.products.carts.search_card')];

        $cards = Card::search(request()->search)->with('subCategory')->get();

        return view('site.products.search', compact('cards', 'breadcrumb'));

    }//end of search

}//end of controller