<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;
use App\Models\User; 

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
        $transports = Transport::with('owner')->get(); 
        return view('transports.index', compact('transports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); 
        // Return a view to create a new transport
        return view('transports.createTransport',compact('users'));
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
            'consommateur' => 'required|exists:users,id', 
            'type' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

 // Calcul des émissions de CO2 et du coût
 $calculations = $this->calculateCO2AndCost($validated['type'], $validated['distance']);
 $validated['emissions_CO2'] = $calculations['emissions_CO2'];
 $validated['cost'] = $calculations['cost'];

        // Create a new transport record
        Transport::create($validated);

        // Redirect to the list of transports with a success message
        return redirect()->route('transports.index')->with('success', 'Transport crée avec succès!')->with('calculations', $calculations);
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
        $users = User::all(); // Récupérer tous les utilisateurs
        // Retrieve the specific transport record to edit
        $transport = Transport::findOrFail($id);
        return view('transports.editTransport', compact('transport','users'));
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
            'consommateur' => 'required|string|max:255', 
            'type' => 'required|string|max:255',
            'distance' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);
 // Calculate CO2 emissions and cost
 $calculations = $this->calculateCO2AndCost($validated['type'], $validated['distance']);
 $validated['emissions_CO2'] = $calculations['emissions_CO2'];
 $validated['cost'] = $calculations['cost'];

        // Retrieve the transport record to update
        $transport = Transport::findOrFail($id);

        // Update the transport record with validated data
        $transport->update($validated);

        // Redirect back with a success message
        return redirect()->route('transports.index')->with('success', 'Transport modifié avec succès!')->with('calculations', $calculations);
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
        return redirect()->route('transports.index')->with('success', 'Transport supprimé avec succès!');
    }

    public function calculateCO2AndCost($type, $distance)
{
    // Exemple de calcul simple (ajuste selon tes critères réels)
    $co2PerKm = [
        'Voiture' => 120, // g CO2 par km pour voiture
        'Vélo' => 0, // g CO2 par km pour vélo
        'Moto' => 60, // g CO2 par km pour vélo
    ];

    $costPerKm = [
        'Voiture' => 0.5, // Coût par km pour voiture
        'Vélo' => 0, // Coût par km pour vélo
        'Moto' => 0.2, // g CO2 par km pour vélo
    ];

    $emissions_CO2 = isset($co2PerKm[$type]) ? $co2PerKm[$type] * $distance : 0;
    $cost = isset($costPerKm[$type]) ? $costPerKm[$type] * $distance : 0;

    return [
        'emissions_CO2' => $emissions_CO2,
        'cost' => $cost,
    ];
}

public function statistics()
{
    // Retrieve available transport types
    $types = ['Voiture', 'Moto', 'Vélo'];

    // Calculate total cost by vehicle type
    $costByType = Transport::select('type')
        ->selectRaw('SUM(cost) as total_cost')
        ->groupBy('type')
        ->pluck('total_cost', 'type');

    // Calculate total CO2 emissions by vehicle type
    $consumptionByType = Transport::select('type')
        ->selectRaw('SUM(emissions_CO2) as total_emissions')
        ->groupBy('type')
        ->pluck('total_emissions', 'type');

    // Pass the data to the view
    return view('transports.statistics', compact('costByType', 'consumptionByType', 'types'));
}



}
