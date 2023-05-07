<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $cats = Category::all();

        $arrCatDetails = [];

        foreach ($cats as $cat) {
            $subcategory = Subcategory::where(
                'category_name',
                $cat['category_name']
            )->get();

            $item = [
                'category_name' => $cat['category_name'],
                'category_image' => $cat['category_image'],
                'subcategory_name' => $subcategory
            ];

            array_push($arrCatDetails, $item);
        }

        return $arrCatDetails;
    }
}
