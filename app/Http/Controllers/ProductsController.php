<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $products = Product::select('products.*','categories.name as category','brands.name as brand')
                        ->join('categories','categories.id','=','products.category_id')
                        ->join('brands','brands.id','=','products.brand_id');
            if(isset($request->search)){
                $products =  $products->whereRaw("lower(products.name) LIKE ?", ['%' . strtolower($request->search) . '%'])
                            ->orWhereRaw("lower(products.description) LIKE ?", ['%' . strtolower($request->search) . '%'])
                            ->orWhereRaw("lower(categories.name) LIKE ?", ['%' . strtolower($request->search) . '%'])
                            ->orWhereRaw("lower(brands.name) LIKE ?", ['%' . strtolower($request->search) . '%']);
            }

            $products = $products->get();

            return view('product.index', compact('products'));
        } catch (\Exception $e) {
            return view('product.index')->with('error', 'Error retrieving Product: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('product.create',compact('brands','categories'));
    }

    public function store(Request $request)
    {
            // $this->validate($request, [
            //     'name' => 'required',
            //     'price' => 'required',
            //     'description' => 'required',
            //     'brand' => 'required',
            //     'size' => 'required',
            //     'tags' => 'required'
            // ]);

            $products = new Product;
            $products->name = $request->name;
            $products->price = str_replace('.', '', $request->price);
            $products->description = $request->description;
            $products->brand_id = $request->brand_id;
            $products->size = $request->size;
            $products->tags = $request->tags;
            // $products->image = $request->image;
            // $products->image_path = $request->image_path;
            if(isset($request->image)){
                $foto = $request->image;
                $v_foto = time().rand(100,999).".".$foto->getClientOriginalName();
            }
            if(isset($v_foto)){
                // dd($v_foto);
                $products->image = $v_foto;
                $products->image_path = public_path().'/'.'images/'.$v_foto;
            }
            if(isset($foto)){
                $foto->move(public_path().'/images',$v_foto);
            }
            $products->stock = $request->stock;
            $products->category_id = $request->category_id;
            $products->save();

            return redirect()->route('products.index')->with('info', 'Data Berhasil Disimpan');
    }

    public function show($id)
    {
        try {
            $products = Product::findOrFail($id);
            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            return view('products.index')->with('error', 'Product not found: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $products = Product::findOrFail($id);
            return view('products.edit', compact('products'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error editing product: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'brand' => 'required',
                'size' => 'required',
                'tags' => 'required'
            ]);

            $products->namaproduk = $request->namaproduk;
            $products->price = $request->price;
            $products->description = $request->description;
            $products->save();

            return redirect()->route('products.index');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $products = Product::find($id);           
            $products->delete();
            return redirect()->route('products.index')->with(['success' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }
}
