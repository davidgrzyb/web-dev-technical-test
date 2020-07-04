<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photographer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'bio', 'profile_picture',
    ];

    /**
     * Defines the one-to-one relationship between Photographer and Gallery.
     * Returns the associated gallery record.
     */
    public function gallery()
    {
        return $this->hasOne(Gallery::class);
    }
}
