<?php

namespace Modules\Gallery\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Gallery\Entities\Collections;
use Modules\Gallery\Entities\Tags;
use Modules\Gallery\Entities\Images;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('gallery::index');
        return Images::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('gallery::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeImage(Request $request)
    {
        $newImage = new Image;
        $newImageTag = $request->image[['tags']];
        if (count($newImageTag) == 0) { return; }
        else {
            foreach ($newImageTag as $tag) {
                $newTag = new Tags;
                $newTag->name =  $tag;
                $newTag->save();
                $tag_ids = [];
                array_push($tag_ids, $newTag->id);
                return $tag_ids;
            }
        }

        $newImageCollection = $request->image[['collections']];
        if (count($newImageCollection) == 0) { return; }
        else {
            foreach ($newImageCollection as $collection) {
                $newCollection = new Collections;
                $newCollection->name =  $collection;
                $newCollection->save();
                $collection_ids = [];
                array_push($collection_ids, $newCollection->id);
                return $collection_ids;
            }
        }

        $newImage->name = $request->image['name'];
        $newImage->image_url = $request->image['image_url'];
        $newImage->tag = $tag_ids;
        $newImage->author_id = $request->image['author_id'];
        $newImage->type = $request->image['type'];
        $newImage->collection_id = $collection_ids;
        $newImage->save();

        return $newImage;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('gallery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gallery::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $existing_image_tags = $request->image[['tags']];
        if (count($existing_image_tags) == 0) { return; }
        else {
            foreach ($existing_image_tags->tag as $tag) {
                $newTag = new Tags;
                $newTag->name =  $tag;
                $newTag->save();
                $tag_ids = [];
                array_push($tag_ids, $newTag->id);
                return $tag_ids;
            }
        }

        $existing_image_collection = $request->image[['collection']];
        if (count($existing_image_collection) == 0) { return; }
        else {
            foreach ($existing_image_collection as $collection) {
                $newCollection = new Collections;
                $newCollection->name =  $collection;
                $newCollection->save();
                $collection_ids = [];
                array_push($collection_ids, $newCollection->id);
                return $collection_ids;
            }
        }

        $existingImage = Images::find($id);
        if ( $existingImage ) {
            $existingImage->name = $request->image['name'];
            $existingImage->image_url = $request->image['image_url'];
            $existingImage->tags = $tag_ids;
            $existingImage->collection = $collection_ids;
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
