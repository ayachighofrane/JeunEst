<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficier extends Model
{
    // protected $fillable = [
    //     'nom',
    //     'prenom',
    //     'role',
    //     'email',
    //     'password',
    // ];
    use HasFactory;
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
