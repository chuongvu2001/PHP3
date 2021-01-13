<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $cates = Category::paginate(10);
        
        return view('cate.index', [
            'cates' => $cates,
        ]);
    }

    public function remove($id){
        Category::destroy($id);
        return redirect(route('cate.index'));
    }
}
