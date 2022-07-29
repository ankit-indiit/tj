<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload_files(Request $request){
       $file = $request->file('file');
       if(!empty($file)){
           //Move Uploaded File
           $destinationPath = public_path('/images/product');
           $original_name = $file->getClientOriginalName();
           $file_name = rand(10,9999).'_'.time() . '.' . $file->getClientOriginalExtension();
           if($file->move($destinationPath,$file_name)){
               $image_name = $file_name;
               $data['status'] = 1;
               $data['image_name'] = $image_name;
           }
           else{
               $data['status'] = 0;
           }
       }
       else{
           $data['status'] = 0;
       }
       return json_encode($data);
   }
}
