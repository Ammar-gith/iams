<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    // Department
    public function departments()
    {
        return $this->hasMany(Department::class, 'status_id');
    }

    // Office
    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    // Status
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'status_id');
    }
}
