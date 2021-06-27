<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Picture;
use Validator;
use App\Http\Resources\Picture as PictureResource;

class PictureController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $picture = Picture::all();

        return $this->sendResponse(PictureResource::collection($picture), 'Picture retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($input, [
            'title' => 'required',
            'caption' => 'required',
            'pict_url' => 'required|mimes:jpeg,png,jpg|max:2048',
            'cat_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        // Image
        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('images/picture/'), $imageName);
        $input['pict_url'] = 'images/picture/' .$imageName;
        $picture = Picture::create($input);

        return $this->sendResponse(new PictureResource($picture), 'Picture created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picture = Picture::find($id);

        if (is_null($picture)) {
            return $this->sendError('Picture not found.');
        }

        return $this->sendResponse(new PictureResource($picture), 'Picture retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Picture $picture)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'caption' => 'required',
            'pict_url' => 'required',
            'cat_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $picture->title = $input['title'];
        $picture->caption = $input['caption'];
        $picture->pict_url = $input['pict_url'];
        $picture->cat_id = $input['cat_id'];
        $picture->user_id = $input['user_id'];
        $picture->save();

        return $this->sendResponse(new PictureResource($picture), 'Picture updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picture $picture)
    {
        $picture->delete();

        return $this->sendResponse([], 'Picture deleted successfully.');
    }
}
