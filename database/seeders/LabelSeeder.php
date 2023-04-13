<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'warna' => '#ff0000' ,'nama' => 'No Respond', 'deskripsi' => 'tidak dapat respon'],
            [ 'warna' => '#ff0000' ,'nama' => 'Bad Respond', 'deskripsi' => 'dapat respon tidak baik'],
            [ 'warna' => '#ff0000' ,'nama' => 'Good Respond', 'deskripsi' => 'dapat respon baik tapi belum donasi zakat'],
            [ 'warna' => '#ff0000' ,'nama' => 'Closing', 'deskripsi' => 'mau donasi zakat'],
        ];

        Label::insert($data);
    }
}
