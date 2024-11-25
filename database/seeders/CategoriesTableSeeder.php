<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
                    'description' => 'Belajar Kata Benda',
                    'img_url' => Storage::url('images/kata-benda.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            1 =>
                array(
                    'category_id' => 2,
                    'category_name' => 'Kata Kerja',
                    'description' => 'Belajar Kata Kerja',
                    'img_url' => Storage::url('images/kata-kerja.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            2 =>
                array(
                    'category_id' => 3,
                    'category_name' => 'Kata Sifat',
                    'description' => 'Belajar Kata Sifat',
                    'img_url' => Storage::url('images/kata-sifat.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            3 =>
                array(
                    'category_id' => 4,
                    'category_name' => 'Kata Keterangan',
                    'description' => 'Belajar Kata Keterangan',
                    'img_url' => Storage::url('images/keterangan.png'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            4 =>
                array(
                    'category_id' => 5,
                    'category_name' => 'Kata Ganti',
                    'description' => 'Belajar Kata Ganti',
                    'img_url' => Storage::url('images/pronoun.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            5 =>
                array(
                    'category_id' => 6,
                    'category_name' => 'Kata Sambung',
                    'description' => 'Belajar Kata Sambung',
                    'img_url' => Storage::url('images/kata-sambung.png'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            6 =>
                array(
                    'category_id' => 7,
                    'category_name' => 'Kata Depan',
                    'description' => 'Belajar Kata Depan',
                    'img_url' => Storage::url('images/kata-depan.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            7 =>
                array(
                    'category_id' => 8,
                    'category_name' => 'Kata Seru',
                    'description' => 'Belajar Kata Seru',
                    'img_url' => Storage::url('images/kata-seru.png'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
            8 =>
                array(
                    'category_id' => 9,
                    'category_name' => 'Istilah Khusus',
                    'description' => 'Belajar Istilah Khusus',
                    'img_url' => Storage::url('images/istilah-khusus.jpg'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ),
        ));
    }
}
