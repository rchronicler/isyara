<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array(
            0 =>
                array(
                    'category_id' => 1,
                    'category_name' => 'Kata Benda',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'category_id' => 2,
                    'category_name' => 'Kata Kerja',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            2 =>
                array(
                    'category_id' => 3,
                    'category_name' => 'Kata Sifat',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'category_id' => 4,
                    'category_name' => 'Kata Keterangan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'category_id' => 5,
                    'category_name' => 'Kata Ganti',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            5 =>
                array(
                    'category_id' => 6,
                    'category_name' => 'Kata Sambung',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            6 =>
                array(
                    'category_id' => 7,
                    'category_name' => 'Kata Depan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            7 =>
                array(
                    'category_id' => 8,
                    'category_name' => 'Kata Seru',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            8 =>
                array(
                    'category_id' => 9,
                    'category_name' => 'Istilah Khusus',
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
        ));
    }
}
