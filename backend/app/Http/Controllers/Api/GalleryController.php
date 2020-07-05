<?php

namespace App\Http\Controllers\Api;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\GalleryResource;

class GalleryController extends Controller
{
    /**
     * Display a listing of all galleries.
     *
     * @return \App\Http\Resources\Api\GalleryResource
     */
    public function index()
    {
        $galleries = Gallery::with('photos')->get();
        return GalleryResource::collection($galleries);
    }

    /**
     * Display the specified gallery.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\GalleryResource
     */
    public function show($id)
    {
        $gallery = Gallery::with('photos')->findOrFail($id);
        return new GalleryResource($gallery);
    }
}
