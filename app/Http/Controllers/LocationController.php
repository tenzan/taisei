<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Locations/Index', [
            'locations' => Location::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
        ]);

        $request->user()->locations()->create($validated);

        return redirect(route('locations.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Location $location
     * @return Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Location $location
     * @return Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Location $location
     * @return Response
     */
    public function update(Request $request, Location $location)
    {
        $this->authorize('update', $location);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $location->update($validated);

        return redirect(route('locations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Location $location
     * @return Response
     */
    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);

        $location->delete();

        return redirect(route('locations.index'));
    }
}
