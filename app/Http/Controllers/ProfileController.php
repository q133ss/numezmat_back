<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\StoreCoinRequest;
use App\Http\Requests\ProfileController\UpdateCoinRequest;
use App\Http\Requests\ProfileController\UpdateRequest;
use App\Http\Resources\ProfileController\GetCoinResource;
use App\Models\Coin;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        if(isset($request->password_new)){
            $data['password'] = Hash::make($request->password_new);
        }

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

    public function money()
    {
        $coins = Auth()->user()->coins;
        return view('profile.money', compact('coins'));
    }

    public function getCoin($id)
    {
        $coin = Coin::findOrFail($id);
        if($coin->user_id == Auth()->id()) {
            return new GetCoinResource($coin);
        }else{
            return response('You dont have permissions', 403);
        }
    }

    public function updateCoin(UpdateCoinRequest $request)
    {
        $data = $request->validated();
        unset($data['id']);
        unset($data['img']);

        $coin = Coin::findOrFail($request->id)->update($data);
        if($request->hasFile('img')){
            $file = File::where('morphable_type', 'App\Models\Coin')
                ->where('morphable_id', $request->id)
                ->first();
            $path = $request->file('img')->store('coins', 'public');
            $file->src = '/storage/'.$path;
            $file->save();
        }
        return back();
    }

    public function storeCoin(StoreCoinRequest $request)
    {
        $data = $request->validated();
        unset($data['img']);
        $data['user_id'] = Auth()->id();

        $coin = Coin::create($data);

        $path = $request->file('img')->store('coins', 'public');
        $file = File::create(
            [
                'morphable_type' => 'App\Models\Coin',
                'morphable_id' => $coin->id,
                'src' => '/storage/'.$path,
                'category' => 'img'
            ]
        );

        return back();
    }

    public function deleteCoin($id)
    {
        $coin = Coin::findOrFail($id);
        if($coin->user_id == Auth()->id()) {
            #TODO удалить картинку!
            File::where('morphable_type', 'App\Models\Rating')
                ->where('morphable_id', $coin->id)
                ->delete();
            $coin->delete();
        }else{
            return response('You dont have permissions', 403);
        }

        return back();
    }
}
