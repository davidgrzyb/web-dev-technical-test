<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'img', 'featured', 'taken_at', 'gallery_id',
    ];
    
    /**
     * Defines the one-to-many relationship between Photo and Gallery.
     * Returns the associated gallery record.
     */
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
