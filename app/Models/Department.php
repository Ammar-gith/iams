<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public const department_statuses = [
        1 => 'Active',
        0 => 'In Active'
    ];

    protected $fillable = [
        'name',
        'category_id',
        'status_id',
    ];

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'department_id');
    }

    public function departmentCategory()
    {
        return $this->belongsTo(DepartmentCategory::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function offices()
    {
        return $this->hasMany(Office::class);
    }
}
