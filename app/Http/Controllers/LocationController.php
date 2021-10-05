<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $locationList = Location::all();
      return view('location.index')->with('locationList', $locationList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
      return view('location.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateLocationRequest $request)
    {
      $validatedData = $request->validated();

      $location = new Location();
      foreach ($validatedData as $key => $value) {
        if ('path_id' === $key) {
          $path = \App\Models\Path::find($value);
          if ($path) {
            $location->path()->save($path);
          }
        }
        else {
          $location->$key = $value;
        }
      }
      $location->save();

      return redirect('/location')->with('success', 'Location created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('location.show')->with('location', $location);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('location.edit')->with('location', $location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
      $validatedData = $request->validated();
      foreach ($validatedData as $key => $value) {
        if ('path_id' === $key) {
          $path = \App\Models\Path::find($value);
          if ($path) {
            $location->path()->save($path);
          }
        }
        else {
          $location->$key = $value;
        }
      }
      $location->save();

      return redirect('/location')->with('success', 'Location updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect('/location')->with('success', 'Location removed');
    }
}
