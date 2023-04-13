<?php

namespace App\Imports;

use App\Models\Donatur;
use App\Models\Label;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DonaturImport implements ToModel, WithStartRow
{

    public function model(array $row)
    {
        if($row[2]!='' || $row[2]!=' '){
            $label = Label::where('nama','LIKE','%'.$row[1].'%')->first();
            Donatur::create([
                'label_id' => $label->id ?? 1,
                'nama' => $row[2],
                'email' => $row[3],
                'alamat' => $row[4],
                'no_telp' => $row[5],
                'respon' => $row[6],
                'catatan' => $row[8],
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
