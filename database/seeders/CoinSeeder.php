<?php

namespace Database\Seeders;

use App\Models\Coin;
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

        foreach ($coins as $coin){
            Coin::create($coin);
        }
    }
}
