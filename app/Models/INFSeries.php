<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class INFSeries extends Model
{
    use HasFactory;

    protected $table = 'inf_series';

    protected $fillable = ['series', 'start_number', 'issued_numbers'];

    // Get the advertisements associated with this INF series
    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }
}
