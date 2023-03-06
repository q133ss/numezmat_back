<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Expertise;
use App\Models\Forum;
use App\Models\Library;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\News;

class BlockController extends Controller
{
    public function index($model)
    {
        switch ($model){
            case 'news':
                $items = News::where('is_block', true)->get();
                break;
            case 'rating':
                $items = Rating::where('is_block', true)->get();
                break;
            case 'expertise':
                $items = Expertise::where('is_block', true)->get();
                break;
            case 'catalog':
                $items = Catalog::where('is_block', true)->get();
                break;
            case 'shop':
                $items = Product::where('is_block', true)->get();
                break;
            case 'library':
                $items = Library::where('is_block', true)->get();
                break;
            case 'forum':
                $items = Forum::where('is_block', true)->get();
                break;
            default:
                abort('404');
        }

        return view('admin.blocks.index', compact('items'));
    }

    public function restore($type, $id)
    {
        $model = "\App\Models\\$type"::findOrFail($id);
        $model->is_block = false;
        $model->save();
        return back()->withSuccess('Запись успешно восстановлена!');
    }

    public function delete($type, $id)
    {
        $model = "\App\Models\\$type"::findOrFail($id);
        $model->delete();
        return back()->withSuccess('Запись успешно удалена!');
    }
}
