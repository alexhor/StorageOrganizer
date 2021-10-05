<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;
use App\Http\Requests\UpdateContainerRequest;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $containerList = Container::all();
      return view('container.index')->with('containerList', $containerList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('container.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContainerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateContainerRequest $request)
    {
        $validatedData = $request->validated();

        $container = new Container();
        foreach ($validatedData as $key => $value) {
          $container->$key = $value;
        }
        $container->save();

        return redirect('/container')->with('success', 'Container created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function show(Container $container)
    {
        return view('container.show')->with('container', $container);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function edit(Container $container)
    {
        return view('container.edit')->with('container', $container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContainerRequest  $request
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContainerRequest $request, Container $container)
    {
      $validatedData = $request->validated();
      foreach ($validatedData as $key => $value) {
        $container->$key = $value;
      }
      $container->save();

      return redirect('/container')->with('success', 'Container updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container $container)
    {
        $container->delete();
        return redirect('/container')->with('success', __('Container removed'));
    }

    /**
     * Mark the container as present
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function checkIn(Container $container) {
      $container->checkedIn = true;
      $container->save();
      return back();
    }

    /**
     * Mark the container as gone
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function checkOut(Container $container) {
      $container->checkedIn = false;
      $container->save();
      return back();
    }

    /**
     * Check if the container is checked in
     *
     * @param  \App\Model\Container  $container
     * @return \Illuminate\Http\Response
     */
     public function isCheckedIn(Container  $container) {
       return (int)$container->checkedIn;
     }

    /**
     * Get the containers current status
     *
     * @param  \App\Model\Container  $container
     * @return \App\Enums\ContainerStatus
     */
    public function getStatus(Container  $container) {
      return $container->status;
    }

    /**
     * Set the containers current status
     *
     * @param  \App\Model\Container  $container
     * @param int $statusId
     * @return \Illuminate\Http\Response
     */
    public function setStatus(Container  $container, int $statusId) {
      $container->status = $statusId;
      $container->save();
    }
}
