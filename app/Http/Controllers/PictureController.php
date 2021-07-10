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
        $picture = Picture::paginate(15);

        return $this->sendResponse(PictureResource::collection($picture), 'Picture retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postby($id)
    {
        $picture = Picture::get()->where("user_id",$id);

        return $this->sendResponse(PictureResource::collection($picture), 'Picture retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function related($id)
    {
        $picture = Picture::where("category_id",$id)->get();

        return $this->sendResponse(PictureResource::collection($picture), 'Picture retrieved successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $input = $request->all();
        $picture = Picture::query()->where('title', 'LIKE', "%{$input['q']}%")->orWhere('caption', 'LIKE', "%{$input['q']}%")->get();

        return $this->sendResponse(PictureResource::collection($picture), 'Picture retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'caption' => 'required',
            'pict_url' => 'required|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // Image
        $imageName = time() . '.' . $request->pict_url->extension();
        $request->pict_url->move(public_path('images/picture/'), $imageName);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();
        if($request->pict_url){
            $imageName = time() . '.' . $request->pict_url->extension();
            $request->pict_url->move(public_path('images/picture/'), $imageName);
            $input['pict_url'] = 'images/picture/' .$imageName;
        }
        $picture = Picture::findOrFail($id);
        $picture->update($input);

        return $this->sendResponse(new PictureResource($picture), 'Picture updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);
        $picture->delete();

        return $this->sendResponse([], 'Picture deleted successfully.');
    }
}
