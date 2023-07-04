<?php

namespace App\Http\Controllers;

use App\Models\Multiimg;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Image;
use Intervention\Image\ImageManagerStatic as Image;


class MultiImgController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index(){
        $images = Multiimg::latest()->get();
        return view('admin.multi_img.index', compact('images'));
    }

    public function StoreImg(Request $request){

        $request->validate([
            'image' => 'required',
            
        ]);

        $image = $request->file('image');
        foreach($image as $multi_img){
            // $name_gen = hexdec(uniqid());
            // $img_ext = strtolower($multi_img->getClientOriginalExtension());
            // $img_name = $name_gen.'.'.$img_ext;
            // $up_loction = 'img/multiple_image/';
            // $last_img = $up_loction.$img_name;
            // $multi_img->move($up_loction,$img_name);

            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,300)->save('img/multiple_image/'.$name_gen);
            $last_img = 'img/multiple_image/'.$name_gen;
            

            Multiimg::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);

        }

        return Redirect()->back()->with('success','Brand Inserted');
    }

    public function delete($id){

        $img = Multiimg::find($id);
        $old_image = $img->image;
        // print_r($old_image);
        // die();
        unlink($old_image);

        Multiimg::find($id)->delete();
        return Redirect()->back()->with('delete','Brand Deleted');
    }
}
