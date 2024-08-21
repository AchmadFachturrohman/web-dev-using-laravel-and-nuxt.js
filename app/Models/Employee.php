<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
            'nip',
            'name',
            'city_of_birth',
            'address',
            'birth_date',
            'gender',
            'gol_id',
            'jabatan_id',
            'duty_loc',
            'religion',
            'unit_kerja',
            'phone_number',
            'npwp'
    ];

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'gol_id');
    }
    

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
