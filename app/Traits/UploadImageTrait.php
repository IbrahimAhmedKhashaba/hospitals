<?php

namespace App\Traits;
use App\Models\Image;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    //
    public function verifyAndStoreImage( $request, $inputname , $foldername , $disk , $imageable_id , $imageable_type){
        if($request->hasFile($inputname)){
            if(!$request->file($inputname)->isValid()){
                session()->flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }

            $photo = $request->file($inputname);
            $name = Str::slug($request->input('name'));
            $randomString = Str::random(10);
            $filename = $randomString.$name.'.'.$photo->getClientOriginalExtension();

            $image = new Image();
            $image->file_name = $filename;
            $image->imageable_id = $imageable_id;
            $image->imageable_type = $imageable_type;
            $image->save();

            return $request->file($inputname)->storeAs($foldername , $filename , $disk);
        }
    }

    public function deleteAttachment($disk , $path , $id){
        Storage::disk($disk)->delete($path);
        Image::where('id' , $id)->delete();
        return true;
    }
}
