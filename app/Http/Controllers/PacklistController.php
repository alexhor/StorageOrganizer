<?php

namespace App\Http\Controllers;

use App\Models\Packlist;
use App\Models\Container;
use App\Http\Requests\UpdatePacklistRequest;
use Illuminate\Http\Request;

class PacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $packlistList = Packlist::all();
      return view('packlist.index')->with('packlistList', $packlistList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packlist.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePacklistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdatePacklistRequest $request)
    {
      $validatedData = $request->validated();

      $packlist = new Packlist();
      foreach ($validatedData as $key => $value) {
        $packlist->$key = $value;
      }
      $packlist->save();

      return redirect('/packlist/' . $packlist->id)->with('success', 'Container created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function show(Packlist $packlist)
    {
        return view('packlist.show')->with('packlist', $packlist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Packlist $packlist)
    {
        return view('packlist.edit')->with('packlist', $packlist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePacklistRequest  $request
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacklistRequest $request, Packlist $packlist)
    {
      $validatedData = $request->validated();
      foreach ($validatedData as $key => $value) {
        $packlist->$key = $value;
      }
      $packlist->save();

      return redirect('/packlist')->with('success', 'Packlist updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Packlist $packlist)
    {
      $packlist->delete();
      return redirect('/packlist')->with('success', __('Packlist removed'));
    }


    /**
     * Pack a packlist
     *
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function pack(Packlist $packlist) {
      return view('packlist.pack')->with('packlist', $packlist);
    }

    /**
     * Get the first x suggested containers for a given search string
     *
     * @param  \App\Models\Packlist  $packlist
     * @param  String $searchString
     * @return \Illuminate\Http\Response
     */
    public function getContainerSuggestionList(Packlist $packlist, String $searchString) {
      // Get all container data
      $ContainerList = Container::all()->sortBy('title');
      $addedContainerList = $this->getAddedContainerList($packlist);
      $containerSuggestionList = [];

      // Prepare search terms
      $searchArray = explode(' ', $searchString);
      foreach ($searchArray as $i => $searchItem) {
        $searchArray[$i] = strtolower(trim($searchItem));
      }

      // Search the list
      foreach ($ContainerList as $container) {
        // Check if the container matches the search
        $title = strtolower($container->title);
        $searchMatch = true;
        foreach ($searchArray as $searchItem) {
          if (false === strpos($title, $searchItem)) {
            $searchMatch = false;
            break;
          }
        }
        if (!$searchMatch) {
          continue;
        }

        // Check if the container was already added
        $alreadyAdded = false;
        foreach($addedContainerList as $addedContainer) {
          if ($addedContainer->equals($container)) {
            $alreadyAdded = true;
            break;
          }
        }
        if ($alreadyAdded) {
          continue;
        }

        // Check if there are already enough suggestions
        if (7 <= count($containerSuggestionList)) {
          break;
        }

        // Add the container to the list of suggestions
        $containerSuggestionList[] = $container;
      }

      return response()->json($containerSuggestionList);
    }

    /**
     * Get all containers added to this packlist
     *
     * @param  \App\Models\Packlist  $packlist
     * @return Array// TODO: set correct type
     */
    public function getAddedContainerList(Packlist $packlist) {
      return $packlist->containerList()->get();
    }

    /**
     * Get all containers added to this packlist as json
     *
     * @param  \App\Models\Packlist  $packlist
     * @return \Illuminate\Http\Response
     */
    public function getContainerListAsJson(Packlist $packlist) {
      return response()->json($this->getAddedContainerList($packlist));
    }

    /**
     * Add a container to the packlist
     *
     * @param  \App\Models\Packlist  $packlist
     * @param  \App\Models\Container $container
     * @return \Illuminate\Http\Response
     */
    public function addContainer(Packlist  $packlist, Container $container) {
      $packlist->containerList()->attach($container);
      return response()->json(['status' => 'success']);
    }

    /**
     * Delete a container from the packlist
     *
     * @param  \App\Models\Packlist  $packlist
     * @param  \App\Models\Container $container
     * @return \Illuminate\Http\Response
     */
    public function deleteContainer(Packlist  $packlist, Container $container) {
      $packlist->containerList()->detach($container);
      return response()->json(['status' => 'success']);
    }
}
