<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'item_id' => 1101,
                'name' => 'Knife',
                'type' => 'Weapon',
                'description' => 'A small, sharp blade.',
                'image_url' => 'knife.png',
                'job' => 'Thief',
                'slot' => 'Right Hand',
            ],
            [
                'item_id' => 2201,
                'name' => 'Cotton Shirt',
                'type' => 'Armor',
                'description' => 'A simple shirt made of cotton.',
                'image_url' => 'cotton_shirt.png',
                'job' => 'Novice',
                'slot' => 'Armor',
            ],
            [
                'item_id' => 4001,
                'name' => 'Poring Card',
                'type' => 'Card',
                'description' => 'A card with a picture of a Poring.',
                'image_url' => 'poring_card.png',
                'job' => 'All',
                'slot' => 'Weapon',
            ],
            [
                'item_id' => 501,
                'name' => 'Red Potion',
                'type' => 'Usable Item',
                'description' => 'A potion that restores a small amount of HP.',
                'image_url' => 'red_potion.png',
                'job' => 'All',
                'slot' => 'Consumable',
            ],
        ]);
    }
}
