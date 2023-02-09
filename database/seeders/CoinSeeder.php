<?php

namespace Database\Seeders;

use App\Models\Coin;
use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coins = [
            [
                'title' => '10коп.-2003г.(М)',
                'description' => 'Состояние отличное!!!',
                'user_id' => 1
            ],
            [
                'title' => 'Победа-60- ММД',
                'description' => 'Состояние отличное!!!',
                'user_id' => 1
            ],
            [
                'title' => 'Вел.Устюг- СПМД',
                'description' => 'Состояние отличное!!!',
                'user_id' => 1
            ],

            [
                'title' => 'Смоленск- СПМД',
                'description' => 'Состояние отличное!!!',
                'user_id' => 2
            ],
            [
                'title' => 'Галич- СПМД',
                'description' => 'Состояние отличное!!!',
                'user_id' => 2
            ],
        ];

        $imgs = [
            'just-coin.jpg',
            'just-penny.jpg',
            'just-rub.jpg'
        ];

        foreach ($coins as $coin){
            $coin = Coin::create($coin);

            File::create([
                'morphable_type' => 'App\Models\Coin',
                'morphable_id' => $coin->id,
                'src' => '/assets/img/'.$imgs[rand(0,2)],
                'category' => 'img'
            ]);
        }
    }
}
