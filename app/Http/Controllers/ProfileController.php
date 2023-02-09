<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\UpdateRequest;
use App\Models\File;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        return view('profile.index', compact('user'));
    }

    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        unset($data['img']);

        #TODO удалить старый
        if($request->file('img')) {
            $path = $request->file('img')->store('avatars', 'public');
            $file = File::where('morphable_type', 'App\Models\User')
                ->where('morphable_id', Auth()->id())
                ->where('category', 'avatar')->first();
            $file->src = '/storage/' . $path;
            $file->save();
        }

        Auth()->user()->update($data);
        return to_route('profile.index');
    }
}
