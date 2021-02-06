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
    public function store(Request $request)
    {
        $newImage = new Image;
        $newImage->name = $request->image['name'];
        $newImage->image_url = $request->image['image_url'];
        $newImage->tag = $request->image[['tag']];
        $newImage->author_id = $request->image['author_id'];
        $newImage->collection_id = $request->image[['coloection_id']];
        $newImage->name = $request->image['name'];
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
        //
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
