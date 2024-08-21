<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';
    public $timestamps = false;

    protected $fillable = [
        'name', 'detail'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'jabatan_id');
    }
}
