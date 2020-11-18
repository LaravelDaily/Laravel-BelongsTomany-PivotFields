<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' => 'Meat'],
            ['name' => 'Potato'],
            ['name' => 'Garlic'],
            ['name' => 'Onion'],
            ['name' => 'Carrot'],
            ['name' => 'Sugar'],
            ['name' => 'Salt'],
            ['name' => 'Virgin blood'],
            ['name' => 'Pepper'],
            ['name' => 'Tomato'],
            ['name' => 'Wine'],
        ])->each(function ($i) {
            Ingredient::create($i);
        });
    }
}
