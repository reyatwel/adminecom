<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;

class ProductListController extends Controller
{
    //
    public function ProductListByRemarks(Request $request)
    {
        $remarks = $request->remarks;
        $productList = ProductList::where('remarks', $remarks)->get();

        return $productList;
    }
}
