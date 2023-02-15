<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexController\ProductResource;
use App\Models\Expertise;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $classes = [
            News::class => (new News())->commentsLastDate('App\Models\News'),
            Product::class => (new Product())->commentsLastDate('App\Models\Product'),
            Expertise::class => (new Expertise())->commentsLastDate('App\Models\Expertise')
        ];

        arsort($classes);
        $items = [];

        foreach ($classes as $key => $class){
            $items[$key] = $key::get();
        }
        return view('index', compact('items'));
    }

    public function getData($type, $id)
    {
        switch ($type){
            case 'product':
                return new ProductResource(Product::findOrFail($id));
            case 'expertise':
                return Expertise::findOrFail($id);
            case 'news':
                return News::findOrFail($id);
        }
    }
}
