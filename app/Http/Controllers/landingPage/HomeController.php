<?php

namespace App\Http\Controllers\landingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Transaction;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public function index()
    {
        $data = Product::select('products.*','categories.name as category','brands.name as brand')
                ->join('categories','products.category_id','=','categories.id')
                ->join('brands','products.brand_id','=','brands.id')->where("products.stock",'!=',0)->orderBy('products.id','desc')->limit(4)->get();   
        return view('template-landingPage.home',compact('data'));
    }
    public function shop(Request $request){
        $table = Product::select('products.*','categories.name as category','brands.name as brand')
                ->join('categories','products.category_id','=','categories.id')
                ->join('brands','products.brand_id','=','brands.id')->where("products.stock",'!=',0);
        
        if ($request->input('price') != NULL) {
            $price = $request->input('price');
            // dd($price);
            // Rp.0 - Rp.250.000,00
            if ($price == '0-250') {
                $table = $table->where('price', '>=', 0)->where('price', '<=', 250000);
                // dd($table);
            }
            
            if ($price == '250-500') {
                $table = $table->where('price', '>=', 250000)->where('price', '<=', 500000);
            }

            if ($price == '500-750') {
                $table = $table->where('price', '>=', 500000)->where('price', '<=', 750000);
            }
            if ($price == '750-1jt') {
                $table = $table->where('price', '>=', 750000)->where('price', '<=', 1000000);
            }
            if ($price == '>1jt') {
                $table = $table->where('price', '>', 1000000);
            }
        }

        if ($request->input('searchByProduct') != NULL && $request->input('searchByProduct') != '') {
            $table = $table->where('products.name', 'LIKE', '%'. trim($request->input('searchByProduct')) .'%');
        }

        if ($request->input('categories') != NULL && $request->input('categories') != '') {
            $table = $table->where('categories.name', '=',  $request->input('categories'));
        }

        if ($request->input('brands') != NULL && $request->input('brands') != '') {
            $table = $table->where('brands.name', '=',  $request->input('brands'));
        }

        if ($request->input('tags') != NULL && $request->input('tags') != '') {
            $table = $table->where('products.tags', '=',  $request->input('tags'));
        }

        $totalData = $table->count();
        $perPage = ($request->input('size') != NULL && $request->input('size') != 0) ? $request->input('size') : 9;
        $page = ($request->input('page') != NULL && $request->input('page') != 0) ? $request->input('page') : 1;
        $currentPage = $page - 1;
        $offset = ($page - 1) * $perPage;

        $totalPage = ceil($totalData / $perPage);
        $data = $table->offset($offset)->limit($perPage)->orderBy('products.id','desc')->get();

        // dd($products);
        $categories =Product::select('categories.name as name')->distinct()->leftJoin('categories','products.category_id','=','categories.id')->get();
        $brands = Product::select('brands.name as name')->distinct()->leftJoin('brands','products.brand_id','=','brands.id')->get();
        $tags = Product::select('tags as name')->distinct()->get();

        // dd($categories);
        // dd($tags);
        return view('template-landingPage.shop',compact('data', 'totalData', 'page', 'perPage', 'totalPage', 'categories', 'brands','tags'));
    }
    public function shopDetail($id){
        $data = Product::select('products.*','categories.name as category','brands.name as brand')
        ->join('categories','products.category_id','=','categories.id')
        ->join('brands','products.brand_id','=','brands.id')->where('products.id','=',$id)->first();
        return view('template-landingPage.shopDetail',compact('data'));
    }

    public function checkout()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        $data = Cart::select('products.*', 'products.price as price', 'carts.qty as qty')
                    ->join('products', 'products.id', '=', 'carts.product_id')
                    ->where('user_id', $userId)
                    ->get();
                    
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add some products to your cart before proceeding to checkout.');
        }
        
        return view('template-landingPage.checkout', compact('data','user'));
    }
    
    public function cart(){
        $getMyId = Auth::user()->id;
        // dd($getMyId);
        $data = Cart::select('products.*','products.price as price','products.stock as stock','carts.qty as qty','carts.id as cart_id')->join('products','products.id','=','carts.product_id')->where('user_id',$getMyId)->get();
        return view('template-landingPage.cart',compact('data'));
    }
    // go to select payment
    public function selectPayment($processCode){
        $getMyId = Auth::user()->id;
        // dd($getMyId);
        // $data = Cart::select('products.*','products.price as price','carts.qty as qty','carts.id as cart_id')->join('products','products.id','=','carts.product_id')->where('user_id',$getMyId)->get();
        
        $data = Transaction::where('process_code','=',$processCode)
            ->where('user_id', Auth::user()->id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.name as name', 'products.price as price','products.image as image','transaction_details.qty as qty','transaction_details.process_code as process_code')
            ->where('transactions.status','=','waiting')
            ->orderByDesc('transactions.id')
            ->get();
            Alert::success('Success', 'Successfully Checkout');
            if(count($data) < 1){
                return redirect()->back();
            }
            $idTransaction = $data[0]->id;
            
            // dd($data);
            $transaction = Transaction::where("id",'=',$idTransaction)->first();

            // dd($transaction);
        return view('template-landingPage.selectPayment',compact('data','transaction'));
    }
    public function successPayment(Request $request){
        $transaction = Transaction::find($request->transaction_id);
        $transaction->status = "packed";
        $transaction->save();

        // return response()->json([
        //     'message' => 'Pembayaran berhasil, dan status transaksi telah diperbarui.',
        //     'transaction' => $transaction
        // ]);
        return redirect()->route('packed');
    }

    public function goToPackedWithReturn($transactionID){
        $transaction = Transaction::find($transactionID);
        $transaction->status = "packed";
        $transaction->save();

        return redirect()->route('packed');
    }
    public function contact(){
        return view('template-landingPage.contact');
    }
}
