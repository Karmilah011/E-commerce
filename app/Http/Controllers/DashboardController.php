<?php

namespace App\Http\Controllers;
use App\Models\Dashboard;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finish = Transaction::where('status', 'finish')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->join('users','transactions.user_id','=','users.id')
            ->select('transaction_details.process_code as process_code','transactions.transaction_date as transaction_date','users.name as name','users.phone as phone','users.address as address','transactions.status as status',DB::raw('SUM((products.price * transaction_details.qty)) as price'))
            ->distinct()
            ->groupBy('process_code','transaction_date','status','name','phone','address')
            ->orderBy('transaction_details.process_code','DESC')
            ->limit(5)
            ->get();

            $ProductSell = TransactionDetail::join('products','products.id','=','transaction_details.product_id')
                        ->select('products.name as name','products.id as id','products.price as price',DB::raw('SUM(transaction_details.qty) as sold'))
                        ->groupBy('id','name','price')
                        ->orderBy('sold','DESC')
                        ->limit(5)
                        ->get();
            // dd($ProductSell);
        return view('home.dashboard',compact('finish','ProductSell'));
    }
    public function generatePDFSelling(Request $request)
    {
        // Query data top selling product
        $ProductSell = TransactionDetail::join('products','products.id','=','transaction_details.product_id')
                            ->select('products.name as name','products.id as id','products.price as price',DB::raw('SUM(transaction_details.qty) as sold'))
                            ->groupBy('id','name','price')
                            ->orderBy('sold','DESC')
                            ->limit(5)
                            ->get();

        // Load view untuk laporan PDF
        $pdf = \PDF::loadView('invoice.pdf-topSelling', compact('ProductSell'));

        // Render PDF (menghasilkan PDF)
        return $pdf->stream('laporan.pdf');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }
}
