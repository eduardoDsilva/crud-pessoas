<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'type',
        'number',
        'issuer',
        'issue_date',
        'expiration_date',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
