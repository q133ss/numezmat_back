<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdController\ActionRequest;
use App\Http\Requests\Admin\AdController\UpdateRequest;
use App\Models\Ad;
use App\Models\AdRequest;
use App\Models\AdsOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function requests()
    {
        $requests = AdRequest::orderBy('created_at', 'DESC')->get();
        return view('admin.ads.requests', compact('requests'));
    }

    public function show($id)
    {
        $request = AdRequest::findOrFail($id);
        return view('admin.ads.show', compact('request'));
    }

    public function action(ActionRequest $req, $id, $action)
    {
        $request = AdRequest::findOrFail($id);
        switch ($action) {
            case 'accept':
                //создаем рекламу и удаляем заявку
                $data = [];
                $data['img'] = $request->img;
                $data['link'] = $request->link;
                $data['page_url'] = $request->page_url;
                $data['in_footer'] = $request->in_footer;
                $data['user_id'] = $request->user_id;
                $data['category_type'] = ($request->category == null) ? null : $request->category;
                $data['active'] = true;

                $start = Carbon::parse($req->start_date)->format('Y-m-d H:i:s');
                $end = Carbon::parse($req->last_date)->format('Y-m-d H:i:s');

                $ad = Ad::create($data);
                AdsOrder::create(
                    [
                        'url' => $data['page_url'],
                        'category' => $data['category_type'],
                        'ad_id' => $ad->id,
                        'start_date' => $start,
                        'last_date' => $end
                    ]
                );
                $request->delete();
                return to_route('admin.ads.show', $ad->id);
            case 'reject':
                //удаляем заявку и все
                $request->delete();
                return to_route('admin.ads.requests')->withSuccess('Заявка успешно удалена');
        }
    }

    public function ads()
    {
        $ads = Ad::orderBy('created_at')->get();
        return view('admin.ads.index', compact('ads'));
    }

    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        return view('admin.ads.adsEdit', compact('ad'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        unset($data['img']);

        if(isset($request->in_footer)){
            unset($data['in_footer']);
            $data['in_footer'] = true;
        }else{
            $data['in_footer'] = false;
        }

        if(isset($request->active)){
            unset($data['active']);
            $data['active'] = true;
        }else{
            $data['active'] = false;
        }

        if($request->hasFile('img')){
            $img_path = '/storage/'.$request->file('img')->store('ads', 'public');
            $data['img'] = $img_path;
        }

        $ad = Ad::findOrFail($id);
        $ad->update($data);
        return to_route('admin.ads.index')->withSuccess('Реклама успешно обновлена');
    }
}
