<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;
use Redirect;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
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
        $items = Item::select('id', 'name', 'ingredients', 'price', 'currency')->where('status', 'available')->get();
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
        $item = Item::create([
            'name'         => $request->name,
            'ingredients'  => $request->ingredients,
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
        $item->price        = $request->price;
        $item->currency     = Item::default_currency();
        $item->status       = $request->status;
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
