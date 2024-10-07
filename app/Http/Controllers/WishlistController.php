<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Display all wishlist items
    public function index()
    {
        $wishlistItems = Auth::user()->wishlist()->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    // Add a product to wishlist
    public function add(Request $request)
    {
        $productId = $request->product_id;
        $userId = Auth::id();

        // Check if product is already in wishlist
        if (!Wishlist::where('user_id', $userId)->where('product_id', $productId)->exists()) {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
        }

        return redirect()->back()->with('success', 'Product added to wishlist!');
    }

    // Remove a product from wishlist
    public function remove(Request $request)
    {
        $productId = $request->product_id;
        $userId = Auth::id();

        Wishlist::where('user_id', $userId)->where('product_id', $productId)->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }
}

