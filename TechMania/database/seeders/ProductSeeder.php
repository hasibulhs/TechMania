<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name'=>'RAZER KRAKEN',
                "price"=>7500,
                "description"=>"7.1 V2 DIGITAL GAMING HEADSET",
                "category"=>"Headphone",
                "gallery"=>"https://www.techlandbd.com/image/cache/catalog/Headphone-Headset/Razer/Techland-Razer%20Kraken%207.1%20V2%20-%20Digital%20Gaming%20Headset-1000x1000w.jpg"
            ],
            [
                'name'=>'RAZER DEATHADDER ESSENTIAL',
                "price"=>4800,
                "description"=>"MOUSE + RAZER GOLIATHUS SPEED PIKACHU LIMITED EDITION MOUSE PAD COMBO",
                "category"=>"Mouse",
                "gallery"=>"https://www.techlandbd.com/image/cache/catalog/Mouse%20Pad/Razer/DeathAdder%20Essential%20Mouse%20Goliathus%20Speed%20Pikachu/razer-deathadder-essential-goliathus-pikachu-combo-1-1000x1000.jpg"
            ],
            [
                'name'=>'REDRAGON K568',
                "price"=>6999,
                "description"=>"DARK AVENGER RGB MECHANICAL GAMING KEYBOARD",
                "category"=>"Keyboard",
                "gallery"=>"https://www.techlandbd.com/image/cache/catalog/Keyboard/Redragon/K568%20DARK%20AVENGER/redragon-k568-dark-avenger-rgb-keyboard-2-1000x1000.jpg"
            ],
            [
                'name'=>'CORSAIR H150',
                "price"=>12750,
                "description"=>"RGB 360MM ALL IN ONE LIQUID CPU COOLER",
                "category"=>"CPU Cooler",
                "gallery"=>"https://www.techlandbd.com/image/cache/catalog/Cooler/corsair/corsair-h150-rgb-cpu-cooler-1000x1000.jpg"
             ]
        ]);
    }
}
