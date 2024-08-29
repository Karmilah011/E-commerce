<?php

namespace App\Http\Controllers\landingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function addCart(Request $request){
        
        $checked = Cart::where('product_id','=',$request->input('product_id'))->where('user_id','=',Auth::user()->id)->first();
        
        if(isset($checked->id)){
            $cart = Cart::find($checked->id);
            if($request->input('qty') != null){
                $cart->qty = $request->input('qty');
            }else{
                $cart->qty = $cart->qty + 1;
            }
            $cart->save();
            // dd($cart);
        }else{
            // dd($request->input('product_id'));
            $cart = new Cart();
            $cart->product_id = $request->input('product_id');
            $cart->user_id = Auth::user()->id;
            $cart->qty = $request->input('qty');
            $cart->save();
        }
        Alert::success('Success', 'Successfully Checkout');
        return redirect()->route('cart');
    }

    public function storeCart($id,Request $request){
        
        $checked = Cart::where('product_id','=',$id)->where('user_id','=',Auth::user()->id)->first();
        
        if(isset($checked->id)){
            $cart = Cart::find($checked->id);
            if($request->qty != null){
                $cart->qty = $request->qty;
            }else{
                $cart->qty = $cart->qty + 1;
            }
            $cart->save();
            // dd($cart);
        }else{
            // dd($id);
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = Auth::user()->id;
            $cart->qty = $request->qty;
            $cart->save();
        }
        Alert::success('Success', 'Successfully Checkout');
        return redirect()->route('cart');
    }
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $getMyId = $user->id;
        $total_price = 0;

        // Cek apakah pengguna memilih menggunakan alamat default atau alamat baru
        if ($request->has('use_default_address') && $request->use_default_address == 'on') {
            $address = $user->address; // Menggunakan alamat default dari tabel users
        } else {
            $address = $request->address; // Menggunakan alamat baru dari form
        }

        $data = Cart::select('products.*','products.price as price','carts.qty as qty','carts.id as cart_id')
                    ->join('products','products.id','=','carts.product_id')
                    ->where('user_id',$getMyId)
                    ->get();

        // get price all data
        $priceAll = 0;            
        foreach ($data as $key => $value) {
            $priceAll +=  $value->qty * $value->price;
        }


        // Simpan transaksi
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_date = now();
        $transaction->price = $priceAll;
        $transaction->snap_token = NULL;
        $transaction->status = "waiting";
        
        // Simpan transaksi untuk mendapatkan ID transaksi
        $transaction->save();
        
        // Ambil ID transaksi yang baru saja disimpan
        $transactionId = $transaction->id;


        foreach ($data as $key => $value) {
            $transactionDetail = new TransactionDetail();
            $transactionDetail->transaction_id = $transactionId; // Gunakan ID transaksi yang telah disimpan
            $transactionDetail->process_code = time(); // or you may assign process code here
            $transactionDetail->product_id = $value->id;
            $transactionDetail->qty = $value->qty;
            $transactionDetail->total_price = $value->qty * $value->price;
            $transactionDetail->address = $address; // Menggunakan alamat sesuai pilihan pengguna
            $transactionDetail->save();

            // $total_price += ($value->qty * $value->price);

            $product = Product::find($value->id);
            $totalItem = $product->stock;
            $product->stock = $totalItem - $value->qty;
            $product->save();

            $deleteCart = Cart::where('id',$value->cart_id)->delete();
        }

        // Simpan snap token
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => time(),
                'gross_amount' => $priceAll
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap token
        $transaction = Transaction::find($transactionId);
        $transaction->snap_token = $snapToken; // Setelah Anda menerima snap token dari Midtrans
        $transaction->save();
        return redirect()->route('waitingToPayment');
    }

    
    
              
    // public function placeOrder(Request $request){
    //     $getMyId = Auth::user()->id;
    //     $data = Cart::select('products.*','products.price as price','carts.qty as qty','carts.id as cart_id')->join('products','products.id','=','carts.product_id')->where('user_id',$getMyId)->get();
    //         $process_code = time();
    //         foreach ($data as $key => $value) {
    //             $transaction = new Transaction();
    //             $transaction->user_id = Auth::user()->id;
    //             $transaction->transaction_date = date('Y-m-d H:i:s');
    //             $transaction->status = "waiting";
    //             $transaction->save();
    
    //             $transactionDetail = new TransactionDetail();
    //             $transactionDetail->transaction_id = $transaction->id;
    //             $transactionDetail->process_code = $process_code;
    //             $transactionDetail->product_id = $value->id;
    //             $transactionDetail->qty = $value->qty;
    //             $transactionDetail->address = $request->address;
    //             $transactionDetail->save();

    //             $product = Product::find($value->id);
    //             $totalItem = $product->stock;
    //             $product->stock = $totalItem - $value->qty;

    //             $deleteCart = Cart::where('id',$value->cart_id)->delete();
    //         }
    //         Alert::success('Success', 'Successfully Checkout');
    //         dd($data);
    //         // return redirect()->route('waitingToPayment');
    // }
}
