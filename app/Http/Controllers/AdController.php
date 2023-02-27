<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdController\SendRequest;
use App\Models\AdRequest;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function send(SendRequest $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['user_id'] = Auth()->id();
        $data['img'] = '/storage/'.$request->file('img')->store('ads', 'public');
        if($data['type'] != 'all'){
            unset($data['category']);
        }

        AdRequest::create($data);
        return true;
    }
}
