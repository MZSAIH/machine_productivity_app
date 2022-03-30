<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class CustomController extends Controller
{
    public function uploadImage($image)
    {
        $file = $image;
        $fileName = uniqid() . '.' .$image->getClientOriginalExtension();
        $path = public_path() . '/images/upload';
        $file->move($path, $fileName);
        return $fileName;
    }

    public function deleteImage($file_name)
    {
        if($file_name != 'product_default.jpg' && $file_name != 'noimage.png' && $file_name != 'vendor-logo.png' && $file_name != 'impageplaceholder.png')
        {
            if(File::exists(public_path('images/upload/'.$file_name))){
                File::delete(public_path('images/upload/'.$file_name));
            }
            return true;
        }
    }
}
