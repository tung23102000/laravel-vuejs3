<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function allCategory(){
        $categories= Category::all();
        return response()->json([
            'categories' => $categories,
            'message' => 'Category',
            'code' => 200
        ]);
    }

    public function addCategory(Request $request)
    {
        $category = new Category();
        $category->cat_title = $request->cat_title;
     
        $category->save();
        return response()->json([
            'message' => 'Category created successfully',
            'code' => 200
        ]);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json([
                'message' => 'Category deleted successfully',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => "Category with id:$id does not exist",
                'code' => 404
            ]);
        }
    }


    public function editCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function updateCategory($id, Request $request){
        $category = Category::where('_id', $id)->first();
      
        $category->cat_title = $request->cat_title;
       
        $category->save();
        return response()->json([
            'message' => 'Contact updated successfully',
            'code' => 200
        ]);
    }
}

