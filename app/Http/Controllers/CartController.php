<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    public function add($id)
    {
        return (new CartService())->addToCart($id);
    }

    public function update(Request $request)
    {
        return (new CartService())->update($request);
    }
}
