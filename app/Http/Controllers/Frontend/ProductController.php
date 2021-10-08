<?php

namespace App\Http\Controllers\Frontend;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Services\AddToCartService;
use App\Http\Requests\AddToCartRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $sortBy = $request->sort_by;
        $order = $request->order ? 'DESC': 'ASC';
        $category = $request->category;
        if( $request->has('search') && !empty($search))
        {
            $query = Product::where('name', 'like',"%$search%")
            ->orWhere('desc', 'like',"%$search%");
        }
        if( $request->has('sort_by') && !empty($sortBy) && !empty($order))
        {
            $query->orderBy($sortBy, $order);
        }
        if( $request->has('category') && !empty($category))
        {
            $query->whereHas('category', function($query) use ($category){
                $query->find($id);
            });
        }

        $products = $query->get();
    }

    public function addToCart(AddToCartRequest $request, AddToCartService $cartService)
    {
        $productId = $request->productId;
        $quantity = $request->quantity ?? 1;
        if (session()->has('cart')) {
            $cartService->updateCart($productId, $quantity, session('cart'));
        } else {
            $cart = $cartService->addToCart($productId, $quantity);
            session(['cart' => $cart]);
        }
        return response()->json(['status' => 200, 'message' => 'Add to cart successfully']);
    }
}
