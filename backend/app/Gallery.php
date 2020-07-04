<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photographer_id',
    ];

    /**
     * Defines the one-to-many relationship between Photo and Gallery.
     * Returns the associated photo records.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Defines the one-to-many relationship between Photo and Gallery.
     * Returns the associated photographer record.
     */
    public function photographer()
    {
        return $this->belongsTo(Photographer::class);
    }
}
