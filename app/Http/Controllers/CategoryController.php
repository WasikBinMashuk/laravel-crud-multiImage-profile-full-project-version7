<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function AllCat(){
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request){

        $request->validate([
            'category_name' => 'required|max:255',
            
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Category inserted');

        //return view('admin.category.index');
    }


    public function Edit($id){
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request,$id){
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' =>Auth::user()->id
        ]);

        return Redirect()->route('all.category')->with('success','Category updated');

    }

    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->route('all.category')->with('success','Category moved to trash list');
    }
    

    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restored');
    }

    public function Pdelete($id){
        $restore = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('delete','Category deleted permanently');
    }
}
