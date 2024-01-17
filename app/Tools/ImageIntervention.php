<?php

namespace App\Tools;

use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageIntervention{


    /** Resizes the image given with the entire path for the given path
     * 
     * @param  string  $path is like dir/filename.ext
     * @param  ['path' => string, 'size' => integer, 'type' => string]  $config
     */
    
    static function resizeImg($path, $config){
        try {
            $img = Image::make($path);

            if(!empty($config['size'])){
                $img->fit($config['size'], $config['size']);
            }
            // $img->save();

            return $img;
        } catch (\Exception $e) {
            Log::error("Error al procesar la imagen: {$e->getMessage()}");
            throw $e;
        }
    }

    /** Store the given image in amazon
     * 
     * @param  string  $path is like dir/filename.ext
     * @param  binary  $image file image
     */

    static function cloudStore($path, $image){
        try {
            $image->encode('jpg'); 
            $status = Storage::disk('s3')->put($path, $image->stream());
            Storage::disk('s3')->setVisibility($path, 'public');
        
            return $status;
        } catch (\Exception $e) {
            Log::error("Error al guardar la imagen en cloud: {$e->getMessage()}");
            throw $e;
        }
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