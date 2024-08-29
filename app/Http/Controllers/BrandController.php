<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $brands = Brand::all();
            return view('brand.index', compact('brands'));
        } catch (\Exception $e) {
            return view('brand.index')->with('error', 'Error retrieving brand: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required'
            ]);

            Brand::create([
                'name' => $request->name
            ]);

            return redirect()->route('brand.index')->with('info', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return view('brand.index')->with('error', 'Error storing brand: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $brand = Brand::find($id);
            if (!$brand) {
                return view('error')->with('error', 'Brand Not Found.');
            }
            $brand->delete();

            return redirect()->route('brand.index')->with(['success' => 'Brand deleted successfully']);
        } catch (\Exception $e) {
            return view('error')->with('error', 'Error deleting Brand: ' . $e->getMessage());
        }
    }
}
