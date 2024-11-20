<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'category_name' => 'Vocabulary',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            1 => 
            array (
                'category_id' => 2,
                'category_name' => 'Grammar',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            2 => 
            array (
                'category_id' => 3,
                'category_name' => 'Phrases',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            3 => 
            array (
                'category_id' => 4,
                'category_name' => 'Idioms',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            4 => 
            array (
                'category_id' => 5,
                'category_name' => 'Common Mistakes',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            5 => 
            array (
                'category_id' => 6,
                'category_name' => 'Slang',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            6 => 
            array (
                'category_id' => 7,
                'category_name' => 'Formal Expressions',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
            7 => 
            array (
                'category_id' => 8,
                'category_name' => 'Informal Expressions',
                'created_at' => '2024-11-20 11:20:08',
                'updated_at' => '2024-11-20 11:20:08',
            ),
        ));
        
        
    }
}