<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetails extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(Customer::class,'owner_id','id');
    }

    public function pos()
    {
        return $this->hasMany(CompanyPost::class,'company_id','id');
    }
}
