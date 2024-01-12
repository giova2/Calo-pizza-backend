<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Model\Order;
use Carbon\Carbon;

class order_example {
    public $user_id = '123124124421';
    public $name = 'pepito';
    public $email = '';
    public $contact = 34225533423;
    public $address = 'Fake 4248';
    public $currency = 'EUR';
    public $status = 'pending';
    public $total = 8;
    public $items= [[
                    'name' => 'Prueba',
                    'ingredients' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestias ipsa atque provident sapiente consequatur ex facere, labore in aliquam doloremque impedit placeat dignissimos minima ullam aspernatur mollitia et! Natus, recusandae.',
                    'size' => 'small',
                    'price' => 7,
                    'quantity' => 1,
                ],[
                    'name' => 'Prueba2',
                    'ingredients' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dicta repellendus sequi dolore voluptates quisquam eligendi ipsum asperiores ex earum veritatis vitae, perferendis mollitia pariatur fugiat cumque temporibus consectetur quo inventore.',
                    'size' => 'small',
                    'price' => 7,
                    'quantity' => 1,
                ],[
                    'name' => 'Prueba3',
                    'ingredients' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia blanditiis id iusto distinctio rem illo harum numquam rerum odio sapiente debitis eum tenetur, eaque cumque nisi consequuntur unde, dolor perspiciatis!',
                    'size' => 'small',
                    'price' => 7,
                    'quantity' => 1,
                ],[
                    'name' => 'Prueba4',
                    'ingredients' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ducimus expedita veniam quis labore sit velit! Fugiat numquam omnis quaerat fugit veniam, quam alias id quod eos, nam unde architecto.',
                    'size' => 'medium',
                    'price' => 13,
                    'quantity' => 1,
                ],[
                    'name' => 'Prueba5',
                    'ingredients' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse vero quis eos mollitia optio ipsam accusantium odio dolores officiis quod, facilis eaque perspiciatis fugiat, sit voluptatum? Accusamus sunt provident hic!',
                    'size' => 'large',
                    'price' => 18,
                    'quantity' => 2,
                ],
                ];

    public function __construct(){
        $this->email = config('mail.forward'); 
        $this->status = Order::pending();
    }
}

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(){
        return view('welcome');
    }

    public function orderMailTest(){
        $order = new order_example();
        $email = $order->email;
        $mailable = new OrderMail( (array) $order);
        try{
            Mail::to($email)->bcc(config('mail.forward'))->send($mailable);
        }catch(\Exception $e) { 
            print($e);
        }
            
        return response()->json(['success'=> true, 'response'=>$order], 200);
    }
    public function templateOrderMailTest(){
        $order = new order_example();
        $date = Carbon::now();
        return new OrderMail((array) $order);
    }

}
