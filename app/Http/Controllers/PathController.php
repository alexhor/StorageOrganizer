<?php

namespace App\Http\Controllers;

use App\Models\Path;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePathRequest;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pathList = Path::all();
      return view('path.index')->with('pathList', $pathList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request  $request)
    {
      return view('path.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePathRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdatePathRequest $request)
    {
      $validatedData = $request->validated();

      $path = new Path();
      foreach ($validatedData as $key => $value) {
        if ('location_id' === $key) {
          $location = \App\Models\Location::find($value);
          if ($location) {
            $path->location()->associate($location);
          }
        }
        else {
          $path->$key = $value;
        }
      }
      $path->save();

      return redirect('/path')->with('success', 'Path created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function show(Path $path)
    {
        return view('path.show')->with('path', $path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function edit(Path $path)
    {
        return view('path.edit')->with('path', $path);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePathRequest  $request
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePathRequest $request, Path $path)
    {
      $validatedData = $request->validated();

      foreach ($validatedData as $key => $value) {
        if ('location_id' === $key) {
          $location = \App\Models\Location::find($value);
          if ($location) {
            $path->location()->associate($location);
          }
          else {
            $path->location()->disassociate();
          }
        }
        else {
          $path->$key = $value;
        }
      }
      $path->save();

      return redirect('/path')->with('success', 'Path updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function destroy(Path $path)
    {
        $path->delete();
        return redirect('/path')->with('success', 'Path removed');
    }
}
