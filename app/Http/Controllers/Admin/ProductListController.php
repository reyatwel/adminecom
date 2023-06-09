<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;

class ProductListController extends Controller
{
    public function ProductListByRemarks(Request $request)
    {
        $remarks = $request->remarks;
        $productList = ProductList::where('remarks', $remarks)->limit(8)->get();

        return $productList;
    }

    public function ProductListByCategory(Request $request)
    {
        $category = $request->category;
        $productList = ProductList::where('category', $category)->get();

        return $productList;
    }

    public function ProductListBySubCategory(Request $request)
    {
        $category = $request->category;
        $subCategory = $request->subcategory;

        $productList = ProductList
            ::where('category', $category)
            ->where('subcategory', $subCategory)
            ->get();

        return $productList;
    }

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $productList = ProductList
            ::where('title', 'LIKE', "%{$key}%")
            ->orWhere('brand', 'LIKE', "%{$key}%")
            ->get();

        return $productList;
    }

    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productList = ProductList
            ::where('subcategory', $subcategory)
            ->orderBy('id', 'DESC')
            ->limit(6)->get();

        return $productList;
    }

    //
}
