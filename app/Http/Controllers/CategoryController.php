<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\SaveCategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request){
        if($request->keyword){
            $cates = Category::where(
                    'name', 'like', "%".$request->keyword."%"
                )->paginate(10);
            $cates->withPath('?keyword=' . $request->keyword);
        }else{
            $cates = Category::paginate(10);
        }
        
        
        return view('cate.index', [
            'cates' => $cates,
            'keyword' => $request->keyword
        ]);
    }

    public function remove($id){
        Category::destroy($id);
        return redirect(route('cate.index'));
    }

    public function addForm(){
        return view('cate.add-form');
    }

    public function saveAdd(SaveCategoryRequest $request)
    {
        $model = new Category();
        $model->name = $request->name;
        $model->detail = $request->detail;
        $model->save();

        return redirect(route('cate.index'));
    }
}
