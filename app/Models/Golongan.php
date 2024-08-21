<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = 'golongans';
    public $timestamps = false;

    protected $fillable = [
        'name', 'eselon', 'details'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'gol_id');
    }
}
