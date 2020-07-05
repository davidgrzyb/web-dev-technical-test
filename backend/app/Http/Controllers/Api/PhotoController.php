<?php

namespace App\Http\Controllers\Api;

use App\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PhotoResource;
use App\Http\Requests\Api\CreateOrUpdatePhotoRequest;

class PhotoController extends Controller
{
    /**
     * Display a listing of all photos.
     *
     * @return \App\Http\Resources\Api\PhotoResource
     */
    public function index()
    {
        $photos = Photo::all();
        return PhotoResource::collection($photos);
    }

    /**
     * Store a newly created photo.
     *
     * @param  \App\Http\Requests\Api\CreateOrUpdatePhotoRequest  $request
     * @return \App\Http\Resources\Api\PhotoResource
     */
    public function store(CreateOrUpdatePhotoRequest $request)
    {
        $photo = Photo::create([
            'assigned_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->img,
            'taken_at' => Carbon::parse($request->date),
            'featured' => $request->featured,
            'gallery_id' => $request->gallery_id,
        ]);

        return new PhotoResource($photo);
    }

    /**
     * Display the specified photo.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotoResource
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return new PhotoResource($photo);
    }

    /**
     * Update the specified photo.
     *
     * @param  \App\Http\Requests\Api\CreateOrUpdatePhotoRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotoResource
     */
    public function update(CreateOrUpdatePhotoRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);

        $photo->update([
            'assigned_id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'img' => $request->img,
            'taken_at' => Carbon::parse($request->date),
            'featured' => $request->featured,
            'gallery_id' => $request->gallery_id,
        ]);

        // Refreshing model after update.
        $photo->refresh();

        return new PhotoResource($photo);
    }

    /**
     * Remove the specified photo.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotoResource
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();

        return new PhotoResource($photo);
    }
}
