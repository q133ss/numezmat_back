<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Illuminate\Http\Request;

class CartService{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart');

        // если корзина пустая,добавляем первый товар
        if(!$cart) {

            $cart = [
                $id => [
                    "name" => $product->title,
                    "qty" => 1,
                    "price" => $product->price,
                    "img" => $product->img()
                ]
            ];

            session()->put('cart', $cart);

            return redirect()->back();
        }

        // если корзина не пустая, проверяем, есть-ли в ней этот товар, если да, то увеличиваем кол-во
        if(isset($cart[$id])) {

            $cart[$id]['qty']++;

            session()->put('cart', $cart);

            return redirect()->back();

        }

        // если товара нет в корзине, то добавляем с количеством 1
        $cart[$id] = [
            "name" => $product->title,
            "qty" => 1,
            "price" => $product->price,
            "img" => $product->img()
        ];

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function getTotal()
    {
        $total = 0;
        if(session('cart')) {
            foreach (session('cart') as $id => $details) {
                $total += $details['price'] * $details['qty'];
            }
        }
        return $total;
    }

    public function update(Request $request)
    {
        if($request->id)
        {
            $cart = session()->get('cart');
            if($cart[$request->id]["qty"] > 1) {
                $cart[$request->id]["qty"] = $cart[$request->id]["qty"] - 1;

                session()->put('cart', $cart);
            }
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
}
