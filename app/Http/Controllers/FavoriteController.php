<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Favorite;
use Validator;
use App\Http\Resources\Favorite as FavoriteResource;

class FavoriteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorite = Favorite::all();

        return $this->sendResponse(FavoriteResource::collection($favorite), 'Favorite retrieved successfully.');
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
        $input = $request->all();

        $validator = Validator::make($input, [
            'cat_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $favorite = Favorite::create($input);

        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorite = Favorite::find($id);

        if (is_null($favorite)) {
            return $this->sendError('Favorite not found.');
        }

        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite retrieved successfully.');
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
    public function update(Request $request, Favorite $favorite)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'cat_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $favorite->cat_id = $input['cat_id'];
        $favorite->user_id = $input['user_id'];
        $favorite->save();

        return $this->sendResponse(new FavoriteResource($favorite), 'Favorite updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return $this->sendResponse([], 'Favorite deleted successfully.');
    }
}
