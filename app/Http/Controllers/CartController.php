<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $checked = Cart::where('product_id','=',$id)->where('user_id','=',Auth::user()->id)->first();
        
        if(isset($checked->id)){
            $cart = Cart::find($checked->id);
            if(isset($request->quantity)){
                $cart->quantity = $cart->quantity + $request->quantity;
            }else{
                $cart->quantity = $cart->quantity + 1;
            }
            $cart->save();
            // dd($cart);
        }else{
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = Auth::user()->id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        Alert::success('Success', 'Successfully Added Cart');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $cart = Cart::find($id);
            // dd($cart);
            $cart->delete();
            return back()->with(['success' => 'cart deleted successfully']);
    }
}
