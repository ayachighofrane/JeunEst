<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function beneficiaire()
    {
        return $this->belongsTo(Beneficier::class);
    }
}
