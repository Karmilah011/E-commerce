<?php

namespace App\Http\Controllers;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $category = Category::all();
            return view('category.index', compact('category'));
        } catch (\Exception $e) {
            return view('category.index')->with('error', 'Error retrieving Category: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
                'name' => 'required',
            ]);

            Category::create([
                'name' => $request->name,
                'image' => $request->image

            ]);

            return redirect()->route('category.index')->with('info', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            return view('category.index')->with('error', 'Error storing Product: ' . $e->getMessage());
        }
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
        try {
            $category = Category::find($id);           
            $category->delete();

            return redirect()->route('category.index')->with(['success' => 'category deleted successfully']);
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}
