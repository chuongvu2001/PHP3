<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){
        $cates = Category::all();
        
        return view('cate.index', [
            'cates' => $cates,
            'content' => json_encode(['name' => 'thienth'])
        ]);
    }

    public function remove($id){
        Category::destroy($id);
        return redirect(route('cate.index'));
    }
}
