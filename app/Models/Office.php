<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public const office_status = [
        1 => 'Active',
        0 => 'In Active'
    ];

    protected $fillable = ['name', 'office_category_id', 'status_id', 'department_id', 'district_id', 'opening_dues', 'deactivation_date'];


    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'office_id');
    }

    public function officeCategory()
    {
        return $this->belongsTo(OfficeCategory::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
