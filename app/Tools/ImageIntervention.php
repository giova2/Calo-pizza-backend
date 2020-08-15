<?php

namespace App\Tools;

use Image;
use Illuminate\Support\Facades\Storage;

class ImageIntervention{


    /** Resizes the image given with the entire path for the given path
     * 
     * @param  string  $path is like dir/filename.ext
     * @param  ['path' => string, 'size' => integer, 'type' => string]  $config
     */
    
    static function resizeImg($path, $config){
        $img = Image::make($path);
        if(!empty($config['size'])){
            $img->fit($config['size'], $config['size']);
        }
        $img->save();
        return $img;
    }

    /** Store the given contents (an image or a video) in amazon
     * 
     * @param  string  $path is like dir/filename.ext
     * @param  binary  $contents file contents
     */

    static function cloudStore($path, $contents){
        $status = Storage::disk('s3')->put($path, $contents);
        Storage::disk('s3')->setVisibility($path, 'public');
        return $status;
    }

    /** deletes all the files from the given configs which has the given name
     *  
     * @param  string  $img_name name of the image to be deleted
     * @param  [['path' => string, 'size' => integer, 'type' => string],...] $configs 
     */

    static function delete($configs, $img_name){
        $response = [];
        foreach($configs as $config){
            $filepath = implode('/', [$config['path'], $img_name]);
            // for the delete operation to work we have to pass the relative path, in this case i specified the disk as well
            $response[]['public'] = Storage::disk('public')->delete($filepath);
            $response[]['s3']     = Storage::disk('s3')->delete($filepath);
        }
        return $response;
    }

}