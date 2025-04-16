<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'cpf',
        'rg',
        'birth_date',
        'email',
        'phone',
        'gender',
        'marital_status',
        'nationality',
        'occupation',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
