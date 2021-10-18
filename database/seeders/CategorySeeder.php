<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = [
            'Sport',
            'IT',
            'Music',
            'Politics',
        ];

        foreach ($categoryNames as $categoryName) {
            if (!Category::where('name', $categoryName)) {
                Category::factory()->create([
                    'name' => $categoryName,
                ]);
            }
        }
    }
}
