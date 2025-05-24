<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvAgency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_date',
        'registered_with_kpra',
        'website',
        'profile_pba',
        'status_id',
        'phone_local',
        'email_local',
        'fax_local',
        'mailing_address_local',
        'person_name_local',
        'person_cell_local',
        'phone_hq',
        'email_hq',
        'fax_hq',
        'mailing_address_hq',
        'person_name_hq',
        'person_cell_hq',

    ];
}