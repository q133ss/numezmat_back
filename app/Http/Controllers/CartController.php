<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartController\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function add($id)
    {
        return (new CartService())->addToCart($id);
    }

    public function getTotal()
    {
        return (new CartService())->getTotal();
    }

    public function update(Request $request)
    {
        return (new CartService())->update($request);
    }

    public function getCartCount()
    {
        return count(session('cart'));
    }

    public function delete(Request $request)
    {
        return (new CartService())->remove($request);
    }

    public function storeOrder(StoreOrderRequest $request)
    {
        $total = 0;
        $products = [];
        foreach(session('cart') as $id => $details){
            $total += $details['price'] * $details['qty'];
            $products[] = ['id' => $id, 'qty' => $details['qty']];
        }

        $data = $request->validated();
        $data['status'] = 'В процессе';
        $data['total'] = $total;
        $data['products'] = json_encode($products);
        Order::create($data);
        Session()->forget('cart');

        return 'Тут будет оплата';
    }
}
