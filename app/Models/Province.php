<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name'];

    public function districts()
    {
        return $this->hasMany(District::class,);
    }
}
