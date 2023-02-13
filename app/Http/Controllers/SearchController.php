<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Expertise;
use App\Models\Forum;
use App\Models\Library;
use App\Models\News;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $items = [];
        if($request->has('search')) {
            $query = $request->search;
            if ($request->has('category') && $request->category != 'all') {
                $items[] = $this->searchByCategory($request->category, $query);
            } else {
                $items[] = $this->searchAll($query);
            }
        }

        $items = collect($items);
        return view('search', compact('items'));
    }

    private function searchAll($query) : array{
        $items = [];

        $items[] = News::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Rating::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Expertise::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Catalog::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Product::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Library::where('name', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
        $items[] = Forum::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();

        return $items;
    }

    private function searchByCategory($category, $query) : array{
        $items = [];
        switch ($category){
            case "news":
                $items[] = News::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "rating":
                $items[] = Rating::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "expertise":
                $items[] = Expertise::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "catalog":
                $items[] = Catalog::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "product":
                $items[] = Product::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "library":
                $items[] = Library::where('name', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
            case "forum":
                $items[] = Forum::where('title', 'LIKE', '%'.$query.'%')->orWhere('description', 'LIKE', '%'.$query.'%')->get();
                break;
        }

        return $items;
    }
}
