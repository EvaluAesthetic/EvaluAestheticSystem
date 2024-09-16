<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ClientForm extends Model
{
    use HasFactory;
    use HasSlug;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function () {
                return $this->client->user->name;
            })
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'client_form_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getVideoURL(){
        return Storage::disk('s3')->temporaryUrl($this->video_path, now()->addMinutes(10));
    }

}
