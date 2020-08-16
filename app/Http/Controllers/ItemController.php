<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;
use Redirect;
use App\Http\Requests\ItemRequest;
use App\Tools\ImageIntervention;
use Image;
use Str;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
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
    public function index($items_per_pag=5)
    {
        $items = Item::paginate($items_per_pag);
        $status_items = [Item::available(),Item::unavailable()];
        return view('items.items', compact('items','status_items'));
    }
    /**
     * Display a listing of the availables items.
     *
     * @return \Illuminate\Http\Response
     */
    public function availables()
    {
        $items = Item::select('id', 'name', 'ingredients', 'image_url', 'size', 'price', 'currency')->where('status', 'available')->orderBy('size')->orderBy('id')->get();
        return response()->json($items, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.items_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        if($request->hasFile('image')) {
            $url = $this->saveImg($request);
            if(is_array($url)){
                $error = $url['error'];
            }
            $item = Item::create([
                'name'         => $request->name,
                'ingredients'  => $request->ingredients,
                'image_url'    => $url,
                'size'         => $request->size,
                'price'        => $request->price,
                'currency'     => $request->currency,
                'status'       => Item::unavailable(),
            ]);
        }
        $item = Item::create([
            'name'         => $request->name,
            'ingredients'  => $request->ingredients,
            'size'         => $request->size,
            'price'        => $request->price,
            'currency'     => $request->currency,
            'status'       => Item::unavailable(),
        ]);
        return Redirect::to('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $status_items = [Item::available(),Item::unavailable()];
        return view('items.items_form', compact('item','status_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item        = Item::find($id);
        $item->name         = $request->name;
        $item->ingredients  = $request->ingredients;
        $item->size         = $request->size;
        $item->price        = $request->price;
        $item->currency     = Item::default_currency();
        $item->status       = $request->status;
        if($request->hasFile('image')) {
            $url = $this->saveImg($request);
            if(!is_array($url)){
                $item->image_url = $url; 
            }else{
                $error = $url['error'];
            }
        }
        $item->save();
        return Redirect::to('/items');
    }

    public function updateStatus(Request $request){
        $item        = Item::find($request->id);
        $item->status = $request->status === Item::unavailable() ? Item::unavailable() : Item::available();
        $item->save();
        return response()->json(['success'=>'changed!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function saveImg(Request $request){
        $file = $request->file('image');
        if(!$file->isValid()) {
            return ['error' => "file type is invalid"];
        }
        //we loop around every config and we generate a different file for each configuration
        $urls = [];
        foreach($this->configs as $config){
            $urls[] = $file->store($config['path'], 'public');
            // we define the entire route file
            $file_path        = implode('/', [$config['path'], $file->hashName()]);
            $public_file_path = public_path('storage/'.$file_path);

            // -- resize and save image with the same name and path
            $img    = ImageIntervention::resizeImg($public_file_path, $config);
            $stored = ImageIntervention::cloudStore($file_path, $img->encoded);
            if(!$stored){
                return ['error' => "Some files couldn't be saved" ];
            }
        }
        return Storage::disk('s3')->url($urls[1]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
