<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'Prototype1',
            'remark' => 'Remark Prototype1',
        ]);

        Item::create([
            'name' => 'Prototype2',
            'remark' => 'Remark Prototype2',
        ]);

        Item::create([
            'name' => 'Prototype3',
            'remark' => 'Remark Prototype3',
        ]);

        Item::create([
            'name' => 'Prototype4',
            'remark' => 'Remark Prototype4',
        ]);

        Item::create([
            'name' => 'Prototype5',
            'remark' => 'Remark Prototype5',
        ]);                                
    }
}
