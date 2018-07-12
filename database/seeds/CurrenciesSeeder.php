<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    const DATA = [
        [
            'title' => 'Bitcoin',
            'short_name' => 'btc',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/1831.png',
            'price' => 725.55
        ],
        [
            'title' => 'Ethereum',
            'short_name' => 'eth',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/1027.png',
            'price' => 454.03
        ],
        [
            'title' => 'XRP',
            'short_name' => 'xrp',
            'logo_url' => 'https://s2.coinmarketcap.com/static/img/coins/32x32/52.png',
            'price' => 0.455
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::query()->insert(self::DATA);
    }
}
