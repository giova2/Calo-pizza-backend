<?php

namespace App\Http\Controllers;

// use App\Model\Imageitem;
use App\Model\Item;
use App\Tools\ImageIntervention;
use Image;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemImageController extends Controller
{
    private $FilesFolderName = '/itemsFiles';
    private $configs = [
        ['path' => 'itemsFiles', 'size' => '', 'type' => 'original'],
        ['path' => 'itemsFiles/thumbs_medium', 'size' => 386, 'type' => 'medium'],
        ['path' => 'itemsFiles/thumbs_small', 'size' => 100, 'type' => 'small'],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($item_id)
    {
        $image     = Item::select('url')->where('id', $item_id)->get();
        return response()->json(['image' => $image]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        //we loop around every config and we generate a different file for each configuration
        foreach($this->configs as $config){
            $url = $file->store($config['path'], 'public');
            // we define the entire route file
            $file_path        = implode('/', [$config['path'], $file->hashName()]);
            $public_file_path = public_path('storage/'.$file_path);
            // -- resize and save image with the same name and path
            $img    = ImageIntervention::resizeImg($public_file_path, $config);
            $stored = ImageIntervention::cloudStore($file_path, $img->encoded);
            if(!$stored){
                return response()->json(['error' => "Some files couldn't be saved" ], 500);
            }
            // Imageitem::create(['url' => Storage::disk('s3')->url($url), 
            //     'name' => $file->hashName(), 
            //     'mime' => $img->mime(),
            //     'type' => $config['type'],
            //     'size' => $img->filesize(),
            //     'item_id'=> null]
            // );
        }
        return response()->json(['filename' => $file->hashName()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  string  $img_name
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $img_name)
    {
        // $deleted = Item::where('name', $img_name)->delete();
        // if($deleted){
        //     return response()->json(['success'=>true, 'resultado' => ImageIntervention::delete($this->configs, $img_name)], 200);
        // }
        // return response()->json(['error'=>'Was not possible to delete de file'], 500);
    }

}
