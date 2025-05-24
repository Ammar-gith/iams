<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\BorderType;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use Illuminate\Notifications\Notifiable;


class Advertisement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUploader, Notifiable;
    //  'newspaper_id', 'agency_id',
    protected $fillable = ['inf_number', 'inf_series_id', 'memo_number', 'memo_date', 'publish_on_or_before', 'urdu_size', 'english_size', 'urdu_lines', 'english_lines', 'ad_rejection_reasons_id', 'user_id', 'department_id', 'office_id', 'ad_category_id', 'ad_worth_id', 'status_id', 'created_at', 'news_pos_rate_id', 'newspaper_id', 'agency_id', 'forwarded_by_role_id', 'forwarded_to_role_id', 'updated_at'];


    // Cast to a datetime type
    protected $casts = [
        'publish_on_or_before' => 'datetime',
        'ad_rejection_reasons_id' => 'array',
        'newspaper_id' => 'array',
    ];


    // Register the media collections and retriving as thumbnail
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->performOnCollections('covering_letters', 'urdu_ads', 'english_ads')
            ->fit(Fit::Contain, 100, 100)
            ->nonQueued();

        // $this->addMediaConversion('old-picture')
        //     ->sepia()
        //     ->border(10, BorderType::Overlay, '#000000');
    }



    // Get the INF series this advertisement belongs to
    public function infSeries()
    {
        return $this->belongsTo(INFSeries::class, 'inf_series_id');
    }

    // User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Category
    public function category()
    {
        return $this->belongsTo(AdCategory::class, 'ad_category_id');
    }

    // Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // Estimated cost
    public function estimated_cost()
    {
        return $this->belongsTo(AdWorthParameter::class, 'status_id');
    }

    //Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    //Office
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
