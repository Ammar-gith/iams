<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function departments()
    {
        return $this->hasMany(Department::class, 'category_id');
    }
}
