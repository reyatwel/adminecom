<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Favourites;

class FavouriteController extends Controller
{
    public function AddFavourite(Request $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;
        $productDetails = ProductList::where('product_code', $product_code)->get();
        $result = Favourites::insert([
            'email' => $email,
            'image' => $productDetails[0]['image'],
            'product_name' => $productDetails[0]['title'],
            'product_code' => $product_code
        ]);

        return $result;
    } //
}
