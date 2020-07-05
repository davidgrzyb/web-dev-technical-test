<?php

namespace Tests\Feature;

use App\Photo;
use App\Gallery;
use Carbon\Carbon;
use Tests\TestCase;
use App\Photographer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhotographerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up the database before each test.
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        // Creating on photographer with 6 images
        // using the data provided in landscapes.json.
        $photographer = factory(Photographer::class)->create();
        $gallery = factory(Gallery::class)->create([
            'photographer_id' => $photographer->id,
        ]);
        $photoOne = factory(Photo::class)->create([
            'id' => 1,
            'title' => 'Nandhaka Pieris',
            'img' => 'img/landscape1.jpg',
            'taken_at' => Carbon::parse('2015-05-01'),
            'featured' => true,
            'gallery_id' => $gallery->id,
        ]);
        $photoTwo = factory(Photo::class)->create([
            'id' => 2,
            'title' => 'New West Calgary',
            'img' => 'img/landscape2.jpg',
            'taken_at' => Carbon::parse('2016-05-01'),
            'featured' => false,
            'gallery_id' => $gallery->id,
        ]);
        $photoThree = factory(Photo::class)->create([
            'id' => 3,
            'title' => 'Australian Landscape',
            'img' => 'img/landscape3.jpg',
            'taken_at' => Carbon::parse('2015-02-02'),
            'featured' => false,
            'gallery_id' => $gallery->id,
        ]);
        $photoFour = factory(Photo::class)->create([
            'id' => 4,
            'title' => 'Halvergate Marsh',
            'img' => 'img/landscape4.jpg',
            'taken_at' => Carbon::parse('2014-04-01'),
            'featured' => true,
            'gallery_id' => $gallery->id,
        ]);
        $photoFive = factory(Photo::class)->create([
            'id' => 5,
            'title' => 'Rikkis Landscape',
            'img' => 'img/landscape5.jpg',
            'taken_at' => Carbon::parse('2010-09-01'),
            'featured' => false,
            'gallery_id' => $gallery->id,
        ]);
        $photoSix = factory(Photo::class)->create([
            'id' => 6,
            'title' => 'Kiddi Kristjans Iceland',
            'img' => 'img/landscape6.jpg',
            'taken_at' => Carbon::parse('2015-07-21'),
            'featured' => true,
            'gallery_id' => $gallery->id,
        ]);
    }

    /**
     * Testing the correct JSON output of the API for individual photographers (show route).
     *
     * @return void
     */
    public function testGetPhotographerShowApiEndpoint()
    {
        $response = $this->get('/api/photographers/1');

        $response->assertStatus(200)
            ->assertJson(json_decode(
                '{
                    "name": "Nick Reynolds",
                    "phone": "555-555-5555",
                    "email": "nick.reynolds@domain.co",
                    "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",
                    "profile_picture": "img/profile.jpg",
                    "album" : [
                        {
                            "id":1,
                            "title": "Nandhaka Pieris",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape1.jpg",
                            "date": "2015-05-01",
                            "featured": true
                        },
                        {
                            "id":2,
                            "title": "New West Calgary",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape2.jpg",
                            "date": "2016-05-01",
                            "featured": false
                        },
                        {
                            "id":3,
                            "title": "Australian Landscape",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape3.jpg",
                            "date": "2015-02-02",
                            "featured": false
                        },
                        {
                            "id":4,
                            "title": "Halvergate Marsh",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape4.jpg",
                            "date": "2014-04-01",
                            "featured": true
                        },
                        {
                            "id":5,
                            "title": "Rikkis Landscape",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape5.jpg",
                            "date": "2010-09-01",
                            "featured": false
                        },
                        {
                            "id":6,
                            "title": "Kiddi Kristjans Iceland",
                            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                            "img": "img/landscape6.jpg",
                            "date": "2015-07-21",
                            "featured": true
                        }
                    ]
                }', true)
            );
    }

    /**
     * Testing the correct JSON output of the API for all photographers (index route).
     *
     * @return void
     */
    public function testGetPhotographersIndexApiEndpoint()
    {
        $response = $this->get('/api/photographers');

        // dd($response);

        $response->assertStatus(200)
            ->assertJson(json_decode(
                '[
                    {
                        "name": "Nick Reynolds",
                        "phone": "555-555-5555",
                        "email": "nick.reynolds@domain.co",
                        "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",
                        "profile_picture": "img/profile.jpg",
                        "album": [
                            {
                                "id": 1,
                                "title": "Nandhaka Pieris",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape1.jpg",
                                "date": "2015-05-01",
                                "featured": true
                            },
                            {
                                "id": 2,
                                "title": "New West Calgary",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape2.jpg",
                                "date": "2016-05-01",
                                "featured": false
                            },
                            {
                                "id": 3,
                                "title": "Australian Landscape",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape3.jpg",
                                "date": "2015-02-02",
                                "featured": false
                            },
                            {
                                "id": 4,
                                "title": "Halvergate Marsh",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape4.jpg",
                                "date": "2014-04-01",
                                "featured": true
                            },
                            {
                                "id": 5,
                                "title": "Rikkis Landscape",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape5.jpg",
                                "date": "2010-09-01",
                                "featured": false
                            },
                            {
                                "id": 6,
                                "title": "Kiddi Kristjans Iceland",
                                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                                "img": "img/landscape6.jpg",
                                "date": "2015-07-21",
                                "featured": true
                            }
                        ]
                    }
                ]', true)
            );
    }

    /**
     * Testing the correct updating of a photographer (update route).
     *
     * @return void
     */
    public function testUpdatePhotographerApiEndpoint()
    {
        $photographer = Photographer::first();

        $this->assertEquals($photographer->name, 'Nick Reynolds');
        $this->assertEquals($photographer->phone, '555-555-5555');
        $this->assertEquals($photographer->email, 'nick.reynolds@domain.co');
        $this->assertEquals($photographer->bio, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ');

        $response = $this->putJson('/api/photographers/' . $photographer->id, [
            'name' => 'David Grzyb',
            'phone' => '647-202-8105',
            'email' => 'grzybdavid@gmail.com',
            'bio' => 'This is Davids bio.',
            'profile_picture' => 'img/profile.jpg',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'David Grzyb',
                'phone' => '647-202-8105',
                'email' => 'grzybdavid@gmail.com',
                'bio' => 'This is Davids bio.',
                'profile_picture' => 'img/profile.jpg',
            ]);

        $photographer = Photographer::find($photographer->id);

        $this->assertEquals($photographer->name, 'David Grzyb');
        $this->assertEquals($photographer->phone, '647-202-8105');
        $this->assertEquals($photographer->email, 'grzybdavid@gmail.com');
        $this->assertEquals($photographer->bio, 'This is Davids bio.');
    }

    /**
     * Testing the deletion of a photographer (destory route).
     *
     * @return void
     */
    public function testDeletePhotographerApiEndpoint()
    {
        $photographer = Photographer::first();

        $this->assertDatabaseHas('photographers', [
            'id' => $photographer->id,
        ]);

        $response = $this->delete('/api/photographers/' . $photographer->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('photographers', [
            'id' => $photographer->id,
        ]);
    }

    /**
     * Testing the creation of a photographer (store route).
     *
     * @return void
     */
    public function testCreatePhotographerApiEndpoint()
    {
        $this->assertDatabaseCount('photographers', 1);

        // Had to change the domain to use the .ca TLD to avoid validation returning a 422 do the existing .co record.
        $response = $this->postJson('/api/photographers', json_decode(
            '{
                "name": "Nick Reynolds",
                "phone": "555-555-5555",
                "email": "nick.reynolds@domain.ca",
                "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",
                "profile_picture": "img/profile.jpg",
                "album" : [
                    {
                        "id":1,
                        "title": "Nandhaka Pieris",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape1.jpg",
                        "date": "2015-05-01",
                        "featured": true
                    },
                    {
                        "id":2,
                        "title": "New West Calgary",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape2.jpg",
                        "date": "2016-05-01",
                        "featured": false
                    },
                    {
                        "id":3,
                        "title": "Australian Landscape",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape3.jpg",
                        "date": "2015-02-02",
                        "featured": false
                    },
                    {
                        "id":4,
                        "title": "Halvergate Marsh",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape4.jpg",
                        "date": "2014-04-01",
                        "featured": true
                    },
                    {
                        "id":5,
                        "title": "Rikkis Landscape",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape5.jpg",
                        "date": "2010-09-01",
                        "featured": false
                    },
                    {
                        "id":6,
                        "title": "Kiddi Kristjans Iceland",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape6.jpg",
                        "date": "2015-07-21",
                        "featured": true
                    }
                ]
            }', true));

        $response->assertStatus(201);

        $this->assertDatabaseCount('photographers', 2);
    }

    /**
     * Testing the creation of a photographer with duplicate email (store route).
     *
     * @return void
     */
    public function testCreateValidationPhotographerApiEndpoint()
    {
        $this->assertDatabaseCount('photographers', 1);

        $response = $this->postJson('/api/photographers', json_decode(
            '{
                "name": "Nick Reynolds",
                "phone": "555-555-5555",
                "email": "nick.reynolds@domain.co",
                "bio": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ",
                "profile_picture": "img/profile.jpg",
                "album" : [
                    {
                        "id":1,
                        "title": "Nandhaka Pieris",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape1.jpg",
                        "date": "2015-05-01",
                        "featured": true
                    },
                    {
                        "id":2,
                        "title": "New West Calgary",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape2.jpg",
                        "date": "2016-05-01",
                        "featured": false
                    },
                    {
                        "id":3,
                        "title": "Australian Landscape",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape3.jpg",
                        "date": "2015-02-02",
                        "featured": false
                    },
                    {
                        "id":4,
                        "title": "Halvergate Marsh",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape4.jpg",
                        "date": "2014-04-01",
                        "featured": true
                    },
                    {
                        "id":5,
                        "title": "Rikkis Landscape",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape5.jpg",
                        "date": "2010-09-01",
                        "featured": false
                    },
                    {
                        "id":6,
                        "title": "Kiddi Kristjans Iceland",
                        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "img": "img/landscape6.jpg",
                        "date": "2015-07-21",
                        "featured": true
                    }
                ]
            }', true));

        $response->assertStatus(422);

        $this->assertDatabaseCount('photographers', 1);
    }
}
