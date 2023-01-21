<?php

namespace App\Console\Commands\Ads;

use App\Models\Ad;
use App\Models\AdsOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AdsClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Блокирует старую рекламу';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ads_orders = AdsOrder::where('last_date', '>', Carbon::yesterday())->get();

        foreach($ads_orders as $ad_order){
            foreach ($ad_order->ads->where('active', true) as $ad) {
                if ($ad->last_date < Carbon::now()) {
                    $ad->active = false;
                    $ad->save();
                }
            }
        }
        return Command::SUCCESS;
    }
}
