<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barangay;

class BusinessClearance extends Model
{
    protected $fillable = [
        'barangay_id',
        'clearance_no',
        'applicant_name',
        'applicant_address',
        'business_name',
        'business_type',
        'business_address',
        'purpose',
        'issued_date',
        'or_number',
        'amount_paid',
        'status',
    ];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}