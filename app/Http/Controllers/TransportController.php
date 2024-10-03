<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all transport records from the database
        $transports = Transport::all();
        return view('transports.index', compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return a view to create a new transport
        return view('transports.createTransport');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'emissions_CO2' => 'required|numeric',
            'cost' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        // Create a new transport record
        Transport::create($validated);

        // Redirect to the list of transports with a success message
        return redirect()->route('transports.index')->with('success', 'Transport created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve a specific transport record
        $transport = Transport::findOrFail($id);
        return view('transports.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieve the specific transport record to edit
        $transport = Transport::findOrFail($id);
        return view('transports.editTransport', compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request inputs
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'emissions_CO2' => 'required|numeric',
            'cost' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        // Retrieve the transport record to update
        $transport = Transport::findOrFail($id);

        // Update the transport record with validated data
        $transport->update($validated);

        // Redirect back with a success message
        return redirect()->route('transports.index')->with('success', 'Transport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retrieve the transport record to delete
        $transport = Transport::findOrFail($id);

        // Delete the transport record
        $transport->delete();

        // Redirect back with a success message
        return redirect()->route('transports.index')->with('success', 'Transport deleted successfully.');
    }
}
