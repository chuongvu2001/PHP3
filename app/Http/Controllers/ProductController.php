<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $products->load('category');
        return view('products.index', compact('products'));
    }

    public function homepage(){
        $products = Product::orderBy('id', 'desc')->take(10)->get();
        
        return view('homepage.index', compact('products'));
    }

    public function detail($id){
        $product = Product::find($id);
        $totalViews = ProductView::where('product_id', $id)->sum('views');
        return view('products.detail', compact('product', 'totalViews'));
    }

    public function tangView(Request $request){
        // 1 kiểm tra xem có views của sản phẩm đang cần tìm trong ngày hôm nay không ?
        // nếu có thì tăng view
        // nếu không có thì tạo mới và add views = 1
        $today = Carbon::yesterday()->format('Y-m-d');
        $productView = ProductView::where('product_id', $request->id)
                                ->where('created_at', '>=', $today . " 00:00:00")
                                ->where('created_at', '<=', $today . " 23:59:59")
                                ->first();
        if($productView){
            $productView->views += 1;
        }else{
            $productView = new ProductView();
            $productView->product_id = $request->id;
            $productView->views = 1;
        }
        $productView->save();
        return response()->json($productView);
    }
}
