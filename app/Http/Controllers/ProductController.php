<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $products->load('category');
        return view('products.index', compact('products'));
    }

    public function detail($id){
        $product = Product::find($id);
        // dd($product);
        return view('products.detail', compact('product'));
    }

    public function tangView(Request $request){
        $product = Product::find($request->id);
        $product->views += 1;
        $product->save();
        return response()->json($product);
    }
}
