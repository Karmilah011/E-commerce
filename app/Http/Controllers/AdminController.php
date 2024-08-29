<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Carbon\Carbon;

class AdminController extends Controller
{
    //
    public function waitToPayment(Request $request){
        $keyword = $request->input('search');
    
        $waiting = Transaction::where('status', 'waiting')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transaction_details.process_code as process_code', 'transactions.transaction_date as transaction_date', 'users.name as name', 'users.phone as phone', 'transaction_details.address as address')
            ->distinct();
    
        if ($keyword) {
            $waiting->where(function ($query) use ($keyword) {
                $query->where('transaction_details.process_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transactions.transaction_date', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transaction_details.address', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $waiting = $waiting->orderBy('transaction_details.process_code', 'ASC')->get();
    
        return view('admin.waitingpayment', compact('waiting'));
    }
    
    public function packed(Request $request){
        $keyword = $request->input('search');
    
        $packed = Transaction::where('status', 'packed')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transaction_details.process_code as process_code', 'transactions.transaction_date as transaction_date', 'users.name as name', 'users.phone as phone', 'transaction_details.address as address')
            ->distinct();
    
        if ($keyword) {
            $packed->where(function ($query) use ($keyword) {
                $query->where('transaction_details.process_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transactions.transaction_date', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transaction_details.address', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $packed = $packed->orderBy('transaction_details.process_code', 'ASC')->get();
    
        return view('admin.packed', compact('packed'));
    }
    
    public function inDelivery(Request $request){
        $keyword = $request->input('search');
    
        $inDelivery = Transaction::where('status', 'in_delivery')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transaction_details.process_code as process_code', 'transactions.transaction_date as transaction_date', 'users.name as name', 'users.phone as phone', 'transaction_details.address as address')
            ->distinct();
    
        if ($keyword) {
            $inDelivery->where(function ($query) use ($keyword) {
                $query->where('transaction_details.process_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transactions.transaction_date', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transaction_details.address', 'LIKE', '%' . $keyword . '%');
            });
        }
    
        $inDelivery = $inDelivery->orderBy('transaction_details.process_code', 'ASC')->get();
    
        return view('admin.inDelivery', compact('inDelivery'));
    }
    
    public function finish(){

        $keyword = request('search');

        $finish = Transaction::where('status', 'finish')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transaction_details.process_code as process_code', 'transactions.transaction_date as transaction_date', 'users.name as name', 'users.phone as phone', 'transaction_details.address as address')
            ->distinct();

        if ($keyword) {
            $finish->where(function ($query) use ($keyword) {
                $query->where('transaction_details.process_code', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transactions.transaction_date', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('users.phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('transaction_details.address', 'LIKE', '%' . $keyword . '%');
            });
        }

        $finish = $finish->orderBy('transaction_details.process_code', 'ASC')->get();

        return view('admin.finish', compact('finish'));
    }
    public function updateStatus(Request $request){
        $processCode = $request->process_code;
        $newStatus = $request->status;

        $orders = TransactionDetail::join('transactions','transactions.id','=','transaction_details.transaction_id')->where('transaction_details.process_code', '=', $processCode);
        
        // $transactionId = $orders->first()->transaction_id;
        // Transaction::where('id', $transactionId)
        $orders = $orders->update(['transactions.status' => $newStatus]);
        Alert::success('Success', 'Successfully Update Status');
        if ($newStatus == 'packed') {
            return redirect()->route('admin.packed');
        }else if($newStatus == 'in_delivery'){
            return redirect()->route('admin.inDelivery');
        }else if($newStatus == 'finish'){
            return redirect()->route('admin.finish');
        }else{
            return redirect()->route('admin.waiting');
        }
    }

    public function showData(Request $request){
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
        return view('admin.showData', compact('data', 'dataDetail'));
    }
    public function laporan(){
        return view('invoice.laporan-admin');
    }
    public function generatePDF(Request $request)
    {
            // Mendapatkan nilai dari input date_range
        $dateRange = $request->input('date_range');

        // Memeriksa apakah string dateRange mengandung karakter pemisah " - "
        if (strpos($dateRange, ' - ') !== false) {
            // Jika mengandung, maka pisahkan rentang tanggal menjadi tanggal awal dan akhir
            list($startDate, $endDate) = explode(' - ', $dateRange);
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);

            // Query data transaksi yang telah selesai (status = finish)
            $data = Transaction::where('status', 'finish')
                ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                ->join('products', 'transaction_details.product_id', '=', 'products.id')
                ->join('users', 'transactions.user_id', '=', 'users.id')
                ->select('transaction_details.process_code as process_code', 'transactions.transaction_date as transaction_date', 'users.name as name', 'users.phone as phone', 'transaction_details.address as address')
                ->whereBetween('transactions.transaction_date', [$startDate, $endDate])
                ->distinct()
                ->get();

            // Load view untuk laporan PDF
            $pdf = \PDF::loadView('invoice.pdf-admin', compact('data', 'startDate', 'endDate'));

            // Render PDF (menghasilkan PDF)
            return $pdf->stream('laporan.pdf');
        } else {
            // Jika tidak mengandung, berikan pesan kesalahan atau tangani dengan cara lain
            return "Invalid date range format";
        }

    }
}
