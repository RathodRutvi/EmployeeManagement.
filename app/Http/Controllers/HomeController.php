<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Book;
use App\Models\Cart;
use Auth;

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
    public function index(Request $request)
    {
       if(!empty($request->input('search')) || !empty($request->input('order'))){
        $query = Book::query();
       
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
        
        if ($request->has('order')) {
            $orderOption = $request->input('order');
            
            if ($orderOption === 'high_to_low') {
                $query->orderBy('price', 'desc');
            } elseif ($orderOption === 'low_to_high') {
                $query->orderBy('price', 'asc');
            }
        }
        $books = $query->get();

    }
    else
    {
        $books = Book::all();
    }
        return view('home',compact('books'));
    }


    public function addToCart(Request $request, $bookId)
    {
            $book = Book::findOrFail($bookId);
            $cart = new Cart();
            $cart->book_id = $book->id;
            $cart->price = $book->price;
            $cart->user_id = Auth::id();
            $cart->save();
        return redirect()->route('cart.show');
    }

       public function showCart()
        {
            $user = Auth::user();
            
            $carts = Cart::where('user_id',$user->id)->get();
            
            $total= Cart::where('user_id',$user->id)->sum('price');
            return view('show',compact('carts','total'));
        }
    
}