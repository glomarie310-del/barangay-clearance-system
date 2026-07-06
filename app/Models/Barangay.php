<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact_no',
        'email',
        'captain',
        'secretary',
        'logo',
        'dry_seal',
        'captain_signature',
    ];

    public function businessClearances()
    {
        return $this->hasMany(BusinessClearance::class);
    }
}