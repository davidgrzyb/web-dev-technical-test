<?php

namespace App\Http\Controllers\Api;

use App\Photo;
use App\Gallery;
use Carbon\Carbon;
use App\Photographer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PhotographerResource;
use App\Http\Requests\Api\CreatePhotographerRequest;
use App\Http\Requests\Api\UpdatePhotographerRequest;

class PhotographerController extends Controller
{
    /**
     * Get all photographers.
     *
     * @return \App\Http\Resources\Api\PhotographerResource
     */
    public function index()
    {
        $photographers = Photographer::with(['gallery.photos'])->get();
        return PhotographerResource::collection($photographers);
    }

    /**
     * Store a new photographer.
     *
     * @param  \App\Http\Requests\Api\CreatePhotographerRequest  $request
     * @return \App\Http\Resources\Api\PhotographerResource
     */
    public function store(CreatePhotographerRequest $request)
    {
        $photographer = Photographer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'profile_picture' => $request->profile_picture,
        ]);

        $gallery = Gallery::create([
            'photographer_id' => $photographer->id,
        ]);

        // Loop over album items and save them as photos.
        foreach ($request->album as $photo) {
            Photo::create([
                'assigned_id' => $photo['id'],
                'title' => $photo['title'],
                'description' => $photo['description'],
                'img' => $photo['img'],
                'featured' => $photo['featured'],
                'taken_at' => Carbon::parse($photo['date']),
                'gallery_id' => $gallery->id,
            ]);
        }

        return new PhotographerResource($photographer);
    }

    /**
     * Get data of a single specified photographer.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotographerResource
     */
    public function show($id)
    {
        $photographer = Photographer::query()
            ->with(['gallery.photos'])
            ->findOrFail($id);

        return new PhotographerResource($photographer);
    }

    /**
     * Update a single specified photographer.
     *
     * @param  \App\Http\Requests\Api\UpdatePhotographerRequest  $request
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotographerResource
     */
    public function update(UpdatePhotographerRequest $request, $id)
    {
        $photographer = Photographer::query()
            ->with('gallery.photos')
            ->findOrFail($id);

        $photographer->update($request->all());

        // Refreshing model after update.
        $photographer->refresh();

        return new PhotographerResource($photographer);
    }

    /**
     * Remove a single specified photographer.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\PhotographerResource
     */
    public function destroy($id)
    {
        $photographer = Photographer::query()
            ->with(['gallery.photos'])
            ->findOrFail($id);

        // Removing associated records.
        // These would be removed regardless as a result
        // of the foreign keys being used.
        $photographer->gallery->photos()->delete();
        $photographer->gallery()->delete();
        $photographer->delete();

        return new PhotographerResource($photographer);
    }
}
