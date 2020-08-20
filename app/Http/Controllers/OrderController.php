<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Item;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderRequestApi;
use App\Http\Requests\OrderRequestUpdate;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use Redirect;
use App\Jobs\OrderCreatedSendEmail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($items_per_pag=10)
    {
        $orders = Order::orderByDesc('created_at')->paginate($items_per_pag);
        $status_orders = [Order::approbed(),Order::pending(), Order::rejected()];
        return view('orders.orders', compact('orders','status_orders'));
    }

    public function api_list($user_id){
        $orders = Order::select('created_at',
        'id',
        'name',
        'email',
        'contact',
        'address',
        'currency',
        'status',
        'total')->orderByDesc('created_at')->where('user_id', $user_id)->get();
        $order_items = [];
        foreach($orders as $order){
            $order_items[] = ['order'=> $order, 'items'=>$order->orders_items()->join('items', 'items.id', '=', 'order_items.item_id')->select('items.*', 'order_items.quantity','order_items.id')->get()];
        }
        return response()->json($order_items, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();
        return view('orders.orders_form', compact('items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            $total = $request->fee;
            $items_order = [];
            foreach($request->item_id as $index => $item_id){
                if(!empty($request->quantity[$index])){
                    $total += $request->price[$index] * $request->quantity[$index];
                    $items_order[] =['item_id' => $item_id, 'quantity' => $request->quantity[$index]];
                }
            }
            DB::beginTransaction(); 
            $arr_order = [
                'name' => $request->name, 
                'email' => $request->email,
                'contact' => $request->contact, 
                'address' => $request->address, 
                'currency' => $request->currency,
                'total' => $total,
            ];
            $order = Order::create($arr_order);
            $order_items = [];
            foreach($items_order as $item){
                $order_items[] = OrderItem::create([
                    'order_id' => $order->id, 
                    'item_id' => $item['item_id'], 
                    'quantity' => $item['quantity'],
                ]);
            }
            OrderCreatedSendEmail::dispatch($request->all());
            DB::commit();
            return redirect('/orders');
        } catch(\Exception $e) { 
            dd($e);
            DB::rollback(); // In case of errors, we rollback the previous operations
        }
        return response()->json(['error' => 'An error ocurred when trying to save the order'], 500);
        
    }


    /**
     * Store a newly created resource in storage from an external request.
     *
     * @param  App\Http\Requests\OrderRequestApi  $request
     * @return \Illuminate\Http\Response
     */
    public function api_store(OrderRequestApi $request)
    {
        $err = '';
        try {
            DB::beginTransaction(); 
            $arr_order = [
                'user_id' => isset($request->user_id) ? $request->user_id : NULL,
                'name' => $request->name, 
                'email' => $request->email, 
                'contact' => $request->contact, 
                'address' => $request->address, 
                'currency' => $request->currency,
                'status' => Order::pending(),
                'total' => $request->total,
            ];
            $order = Order::create($arr_order);
            $order_items = [];
            foreach($request->items as $item){
                $order_items[] = OrderItem::create([
                    'order_id' => $order->id, 
                    'item_id' => $item['id'], 
                    'quantity' => $item['quantity'],
                ]);
            }
            OrderCreatedSendEmail::dispatch($request->all());
            DB::commit();
            return response()->json(['success' => $order, 'items'=>$order_items], 200);
        } catch(\Exception $e) { 
            $err = $e;
            DB::rollback(); // In case of errors, we rollback the previous operations
        }
        return response()->json(['error' => 'An error ocurred when trying to save the order: '.$err], 500);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $status_orders = [Order::approbed(), Order::pending(), Order::rejected()];
        $order_items = $order->orders_items()->join('items', 'items.id', '=', 'order_items.item_id')->select('items.*', 'order_items.quantity','order_items.id')->get();
        return view('orders.orders_form', compact('order','status_orders', 'order_items'));
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\OrderRequestUpdate  $request
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequestUpdate $request, $id)
    {
        $order           = Order::find($id);
        $order->name     = $request->name;
        $order->email    = $request->email;
        $order->contact  = $request->contact;
        $order->address  = $request->address;
        $order->status   = $request->status;
        $order->save();
        return Redirect::to('/orders');
    }

    public function updateStatus(Request $request){
        $order        = Order::find($request->id);
        $order->status = $request->status === Order::rejected() ? Order::rejected() : Order::approbed() ? Order::approbed() : Order::pending();
        $order->save();
        return response()->json(['success'=>'changed!'], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
