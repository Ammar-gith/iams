<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Advertisements
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
