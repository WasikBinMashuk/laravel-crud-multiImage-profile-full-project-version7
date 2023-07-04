<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Image;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);

        return view('admin.brand.index',compact('brands'));
    }

    

    public function StoreBrand(Request $request){

        $request->validate([
            'brand_name' => 'required|min:2',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
            
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_name.min' => 'Brand name longer than 2 characters'
        ]);

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_loction = 'img/brand/';
        // $last_img = $up_loction.$img_name;
        // $brand_image->move($up_loction,$img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,300)->save('img/brand/'.$name_gen);
        $last_img = 'img/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Brand Inserted');

    }

    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'brand_name' => 'required|min:2',
            
        ],
        [
            'brand_name.required' => 'Please input brand name',
            'brand_name.min' => 'Brand name longer than 2 characters'
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_loction = 'img/brand/';
            $last_img = $up_loction.$img_name;
            $brand_image->move($up_loction,$img_name);

            unlink($old_image);             //deleting old image

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('all.brand')->with('success','Brand Inserted');
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->route('all.brand')->with('success','Brand Inserted');
        }
        

    }

    public function delete($id){

        $img = Brand::find($id);
        $old_image = $img->brand_image;
        //print_r($old_image);
        //die();
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('delete','Brand Deleted');
    }
}
