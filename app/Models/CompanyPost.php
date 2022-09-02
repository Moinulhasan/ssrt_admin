<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPost extends Model
{
    use HasFactory;


    public function companyOwner()
    {
        return $this->belongsTo(CompanyDetails::class,'company_id','id');
    }
}
