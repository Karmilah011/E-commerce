<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoiceCustomer(Request $request){
        $processCode = $request->process_code;
        $status = $request->status;

        $data = TransactionDetail::join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('products', 'products.id', '=', 'transaction_details.product_id')
            ->select(
                'transaction_details.*',
                'transactions.transaction_date as transaction_date',
                'transactions.status as transaction_status',
                'users.name as user_name',
                'users.phone as user_phone',
                'users.email as user_email',
                'users.address as user_address',
                'products.*',
                'products.price as product_price',
                'products.name as product_name',
                'transaction_details.qty as product_qty'
            )
            ->where('transaction_details.process_code', '=', $processCode)
            ->where('transactions.status', '=', $status)
            ->get();
        $dataDetail = $data->first();
        return view('invoice.invoice-customer',compact('data','dataDetail'));
    }
}
