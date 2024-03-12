<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = DB::table('products')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'ilike', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        \App\Models\Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product successfully created');
    }

    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('pages.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = \App\Models\Product::findOrFail($id);
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Product Successfully updated');
    }

    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Successfully deleted');
    }
}
