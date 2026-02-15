<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class CartController extends Controller
{
    /**
     * Display the contents of the customer's shopping cart.
     */
    public function index(){
        $cart = session()->get('cart', []);
        $cartlist = [];

        foreach ($cart as $list) {
            $value = $list['product_id'];
            $product = DB::table('products as p')->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
            ->where('p.id', $value)
            ->select(
                'p.id',
                'p.subcategory_id',
                's.category_id',
                'p.product_name',
                'p.description',
                'p.price',
                'p.stock_quatity',
                'p.image_url',
                'p.ratings',
                'p.previews'
            )->get();

           $product = $product[0] ?? null;

        if ($product) {
            $product->quantity = $list['quantity'];

            $cartlist[] = $product;
        }
        }
        //session()->put('cart', []);
        //dd($cart);
        //dd($cartlist);
        return view('customer.cart' , [
            'cartitems' => $cartlist,
        ]);
    }

    /**
     * Add products to the cart session
     */
    public function add(Request $request){
        $productId = $request->product_id;
        $productQuantity = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        $cart[$productId] = [
            'product_id' => $productId,
            'quantity' => $productQuantity,
        ];

        session()->put('cart', $cart);
        $json = [
            'success'=> true,
            'message' => '',
            'type' => 'success',
            'toastNotification' => 'Product Added!!!',
        ];

        return response()->json($json);
    }

    /**
     * Updates the quantity of products in the cart
     */
    public function update(Request $request){

        if ($request->item_id && $request->quantity) {
            $cart = session()->get('cart');
             
            if (isset($cart[$request->item_id])) {
                $cart[$request->item_id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
                return response()->json(['success'=> true]);
            }

            return response()->json([
                'success'=> false,
                'message'=> 'Item Not in Cart',
            ]);
           
        }        
    }

    /**
     * Removes items from the cart
     */
    public function remove(Request $request){
        $cart = session()->get('cart');

        if (isset($cart[$request->item_id])) {
            unset($cart[$request->item_id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }
    
    /**
     * Get the number of items in the cart
     */
    public function cartCount(){
        return response()->json(['count' => count(session('cart', []))]);
    }

    /**
     * Display the checkout page
     */
    public function checkoutIndex()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);
        $cartlist = [];

        foreach ($cart as $list) {
            $value = $list['product_id'];
            $product = DB::table('products as p')->join('sub_categories as s', 'p.subcategory_id', '=', 's.id')
            ->where('p.id', $value)
            ->select(
                'p.id',
                'p.subcategory_id',
                's.category_id',
                'p.product_name',
                'p.description',
                'p.price',
                'p.stock_quatity',
                'p.image_url',
                'p.ratings',
                'p.previews'
            )->get();

           $product = $product[0] ?? null;

        if ($product) {
            $product->quantity = $list['quantity'];

            $cartlist[] = $product;
        }
        }
                       
        return view('customer.checkout', ['cartitems'=> $cartlist]);
    }

    /**
     * Validate billing info and choosing payment option
     */
    public function checkoutProcess(Request $request){
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:credit_card,mobile_money,cash_on_delivery',
            'phone_number' => 'required_if:payment_method,mobile_money',
            
        ]);

        
        // Process payment based on selected method
        switch($validated['payment_method']) {
            case 'credit_card':
                return $this->paymentGatewayView($request);
                break;
            case 'mobile_money':
                dd('Feature Coming !!!');
                break;
            case 'cash_on_delivery':
                return $this->createOrder($request);
                break;
        }
        
    }

    /**
     * Function to create an order and clear cart
     */
    public function createOrder(Request $request){
        $order = Order::create([
            'id' => \App\Functions\Randomizer::generateID('ORD') ,
            'user_id' => $request->id,
            'status' => 'pending',
            'amount' => $request->total,
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->address,
        ]);

        $cartItems = session()->get('cart', []);

        // Add items to the order
        foreach ($cartItems as $item) {
            $price = DB::table('products')->where('id', $item['product_id'])->value('price');
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $price,
            ]);
        }
        
        // Clear cart
        session()->put('cart', []);

        // Redirect to confirmation page
        return redirect()->route('confirmation');

    }

    /**
     * Display the payment page from MX bank
     */
    public function paymentGatewayView($request){
        try {
            $htmlCode = Http::get('http://localhost:5050');
            $htmlCode = str_replace('@csrf', csrf_field(), $htmlCode);
            $htmlCode = str_replace("paymentProcessurl", route('paymentProcess'), $htmlCode);
            $htmlCode = str_replace("shippingAddressValue", $request->address , $htmlCode);
            $htmlCode = str_replace("baseAmountValue", $request->total , $htmlCode);

            return view('customer.paymentGateway' , ['htmlCode'=> $htmlCode]);
        } catch (\Throwable $th) {
            $error = true;
            $msg = $th;
            return view('customer.paymentGateway' , ['error'=> $error, 'msg' => $msg]);
        }
        
    }

    /**
     * Function to Handle the credit payment
     */
    public function paymentGatewayProcess(Request $request){

        $data = [
            'cardholder-name' => $request->input('cardholder-name'),
            'card-number' => $request->input('card-number'),
            'expiry' => $request->expiry,
            'cvv' => $request->cvv,
            'total' => $request->total,
        ];

        $response = Http::asForm()->post('http://localhost:5050/submit', $data);


        if($response->successful()){
            $responseData = $response->json();
            if($responseData['success']){
                $this->createOrder(new Request([
                    'id' => Auth::user()->id,
                    'status' => 'pending',
                    'amount' => $request->total,
                    'payment_method' => 'credit_card',
                    'shipping_address' => $request->address,

                ]));
            }else{
                //server error
            }
        }else{
            //cant connect
            dd($response->body());
        }
    }
    
}
