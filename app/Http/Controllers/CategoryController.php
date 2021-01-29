<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\SaveCategoryRequest;
use App\Models\Product;

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

        $cates->load('products');
        
        return view('cate.index', [
            'cates' => $cates,
            'keyword' => $request->keyword
        ]);
    }

    public function remove($id){
        Category::destroy($id);
        return redirect(route('cate.index'));
    }

    public function removeCate($id){
        Product::where('cate_id', $id)->delete();
        Category::destroy($id);
        return true;
    }

    public function addForm(){
        return view('cate.add-form');
    }

    public function editForm($id){
        $model = Category::find($id);
        if(!$model) return redirect(route('cate.index'));

        return view('cate.edit-form', ['model' => $model]);
    }

    public function saveEdit($id, SaveCategoryRequest $request)
    {
        $model = Category::find($id);
        $model->name = $request->name;
        $model->detail = $request->detail;
        $model->save();
        return redirect(route('cate.index'));
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
