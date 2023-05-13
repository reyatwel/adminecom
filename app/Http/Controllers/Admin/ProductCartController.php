<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCart;
use App\Models\ProductList;
use App\Models\CartOrder;

class ProductCartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $email = $request->input('email');
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input('quantity');
        $product_code = $request->input('product_code');

        $productDetails = ProductList::where('product_code', $product_code)->get();

        $price = $productDetails[0]['price'];
        $special_price = $productDetails[0]['special_price'];

        if ($special_price === "na") {
            $total_price = $price * $quantity;
            $unit_price = $price;
        } else {
            $total_price = $special_price * $quantity;
            $unit_price = $special_price;
        }

        $result = ProductCart::insert([
            'email' => $email,
            'image' => $productDetails[0]['image'],
            'product_name' => $productDetails[0]['title'],
            'product_code' => $productDetails[0]['product_code'],
            'size' => 'Size: ' . $size,
            'color' => 'Color: ' . $color,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_price' => $total_price
        ]);

        return $result;
    }

    public function CartCount(Request $request)
    {
        $product_code = $request->product_code;
        $result = ProductCart::count();

        return $result;
    }

    public function CartList(Request $request)
    {
        $email = $request->email;
        $result = ProductCart::where('email', $email)->get();
        return $result;
    }

    public function RemoveCartList(Request $request)
    {
        $id = $request->id;
        $result = ProductCart::where('id', $id)->delete();
        return $result;
    }

    public function CartItemPlus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $quantity++;
        $total_price = $quantity * $price;
        $result = ProductCart::where('id', $id)->update([
            'quantity' => $quantity,
            'total_price' => $total_price
        ]);

        return $result;
    }

    public function CartItemMinus(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $quantity--;
        $total_price = $quantity * $price;
        $result = ProductCart::where('id', $id)->update([
            'quantity' => $quantity,
            'total_price' => $total_price
        ]);

        return $result;
    }

    public function CartOrder(Request $request)
    {
        $city = $request->input('city');
        $paymentMethod = $request->input('paymentMethod');
        $yourName = $request->input('name');
        $email = $request->input('email');
        $deliveryAddress = $request->input('delivery_address');
        $invoiceNo = $request->input('invoice_no');
        $deliveryCharge = $request->input('delivery_charge');

        date_default_timezone_set('Asia/Manila');

        $request_time = date('h:i:sa');
        $request_date = date('d-m-Y');

        $cartList = ProductCart::where('email', $email)->get();

        foreach ($cartList as $order) {
            $cartInsertDeleteResult = "";

            $result = CartOrder::insert([
                'invoice_no' => 'PVBI' . $invoiceNo,
                'product_name' => $order['product_name'],
                'product_code' => $order['product_code'],
                'size' => $order['size'],
                'color' => $order['color'],
                'quantity' => $order['quantity'],
                'unit_price' => $order['unit_price'],
                'total_price' => $order['total_price'],
                'email' => $order['email'],
                'name' => $yourName,
                'payment_method' => $paymentMethod,
                'delivery_address' => $deliveryAddress,
                'city' => $city,
                'delivery_charge' => $deliveryCharge,
                'order_date' => $request_date,
                'order_time' => $request_time,
                'order_status' => 'Pending'
            ]);

            if ($result === 1) {
                $delete = ProductCart::where('id', $order['id'])->delete();

                if ($delete === 1) {
                    $cartInsertDeleteResult = 1;
                } else {
                    $cartInsertDeleteResult = 0;
                }
            }
        }

        return $cartInsertDeleteResult;
    } //
}
