<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    //
    public function waitToPayment(){
        $processCodeWaiting = Transaction::where('status', 'waiting')
        ->where('user_id', Auth::user()->id)
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select('transaction_details.process_code')
        ->distinct()
        ->orderByDesc('transaction_details.process_code')
        ->get();

        $waiting = Transaction::where('status', 'waiting')
            ->where('user_id', Auth::user()->id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.name as name', 'products.price as price','products.image as image','transaction_details.qty as qty','transaction_details.process_code as process_code')
            ->orderByDesc('transactions.id')
            ->get();
            // dd($waiting);
        $snapToken = session('snapToken');
            // var_dump($snapToken);
        return view('template-landingPage.waitingpayment',compact('waiting','processCodeWaiting','snapToken'));
    }
    public function packed(){
        $processCodePacked = Transaction::where('status', 'packed')
        ->where('user_id', Auth::user()->id)
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select('transaction_details.process_code')
        ->distinct()
        ->orderByDesc('transaction_details.process_code')
        ->get();

        $packed = Transaction::where('status', 'packed')
            ->where('user_id', Auth::user()->id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.name as name', 'products.price as price','products.image as image','transaction_details.qty as qty','transaction_details.process_code as process_code')
            ->orderByDesc('transactions.id')
            ->get();
        return view('template-landingPage.packed',compact('packed','processCodePacked'));
    }
    public function inDelivery(){
        $processCodeInDelivery = Transaction::where('status', 'in_delivery')
        ->where('user_id', Auth::user()->id)
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select('transaction_details.process_code')
        ->distinct()
        ->orderByDesc('transaction_details.process_code')
        ->get();

        $inDelivery = Transaction::where('status', 'in_delivery')
            ->where('user_id', Auth::user()->id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transactions.*', 'products.name as name', 'products.price as price','products.image as image','transaction_details.qty as qty','transaction_details.process_code as process_code')
            ->orderByDesc('transactions.id')
            ->get();
        return view('template-landingPage.inDelivery',compact('inDelivery','processCodeInDelivery'));
    }
    public function finish(){
        $processCodeFinish = Transaction::where('status', 'finish')
        ->where('user_id', Auth::user()->id)
        ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->select('transaction_details.process_code')
        ->distinct()
        ->orderByDesc('transaction_details.process_code')
        ->get();

        $finish = Transaction::where('status', 'finish')
            ->where('user_id', Auth::user()->id)
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->select('transactions.*','products.name as name', 'products.price as price','products.image as image','transaction_details.qty as qty','transaction_details.process_code as process_code')
            ->orderByDesc('transactions.id')
            ->get();
        return view('template-landingPage.finish',compact('finish','processCodeFinish'));
    }
    public function updateStatus(Request $request){
        $processCode = $request->process_code;
        $newStatus = $request->status;
        if($newStatus != "finish"){
            Alert::success('Failed', 'Failed Update Status');
            return redirect()->back();
        }
        $orders = TransactionDetail::join('transactions','transactions.id','=','transaction_details.transaction_id')->where('transaction_details.process_code', '=', $processCode);
        
        // $transactionId = $orders->first()->transaction_id;
        // Transaction::where('id', $transactionId)
        $orders = $orders->update(['transactions.status' => $newStatus]);
        Alert::success('Success', 'Successfully Update Status');
        if($newStatus == 'finish'){
            return redirect()->route('finish');
        }else{
            return redirect()->back();
        }
    }
}
