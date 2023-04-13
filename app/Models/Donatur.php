<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $table = 'donatur';
    protected $fillable = [
        'label_id',
        'nama',
        'email',
        'alamat',
        'no_telp',
        'info_telp',
        'respon',
        'terakhir_chat',
        'catatan',
        'status',
    ];

    public function label()
    {
        return $this->belongsTo(Label::class,'label_id');
    }
}
