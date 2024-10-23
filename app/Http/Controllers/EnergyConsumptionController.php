<?php

namespace App\Http\Controllers;

use App\Models\energy_consumption;
use App\Http\Requests\Storeenergy_consumptionRequest;
use App\Http\Requests\Updateenergy_consumptionRequest;
use Illuminate\Support8\Facades\Validator;
use Illuminate\Http\Request;

class EnergyConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // Récupérer les données d'énergie
        $consumptions = $consumptions = energy_consumption::paginate(10); // Adjust the number as needed

        return view('frontoffice.energyconso.index', compact('consumptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('frontoffice.energyconso.createenergy');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storeenergy_consumptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation des champs avec des messages personnalisés
        $validate = $request->validate([
            'electricity_consumption' => 'required|numeric|min:0',
            'gas_consumption' => 'required|numeric|min:0',
            'heating_oil_consumption' => 'required|numeric|min:0',
            'solar_energy_generated' => 'required|numeric|min:0',
            'period' => 'required|in:monthly,semiannual,annual',
        ], [
            'required' => 'Ce champ est requis.',
            'numeric' => 'Veuillez entrer une valeur numérique.',
            'min' => 'La valeur ne peut pas être inférieure à 0.',
            'in' => 'Veuillez sélectionner une période valide.',
        ]);



        // Création de l'enregistrement
        energy_consumption::create([
            'user_id' => auth()->id(),
            'electricity_consumption' => $request->electricity_consumption,
            'gas_consumption' => $request->gas_consumption,
            'heating_oil_consumption' => $request->heating_oil_consumption,
            'solar_energy_generated' => $request->solar_energy_generated,
            'period' => $request->period,
        ]);

        return redirect('/energyconso')->with('success', 'Données d\'énergie ajoutées avec succès.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\energy_consumption  $energy_consumption
     * @return \Illuminate\Http\Response
     */
    public function show(energy_consumption $energy_consumption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\energy_consumption  $energy_consumption
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $energyConsumption = energy_consumption::findOrFail($id);
        return view('frontoffice.energyconso.edit', compact('energyConsumption'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateenergy_consumptionRequest  $request
     * @param  \App\Models\energy_consumption  $energy_consumption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // Validation des données

        // Vérifiez si la validation a échoué
        $energy_consumption = energy_consumption::findOrFail($id);

        // Mise à jour de l'entrée dans la base de données
        $energy_consumption->update([
            'electricity_consumption' => $request->electricity_consumption,
            'gas_consumption' => $request->gas_consumption,
            'heating_oil_consumption' => $request->heating_oil_consumption,
            'solar_energy_generated' => $request->solar_energy_generated,
            'period' => $request->period,
        ]);
        //  dd($energy_consumption);

        // Redirection avec un message de succès
        return redirect('/energyconso')->with('success', 'Données d\'énergie mises à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\energy_consumption  $energy_consumption
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $energie = energy_consumption::findOrFail($id);
        $energie->delete();
        return redirect('/energyconso')->with('success', 'Données d\'énergie supprimées avec succès.');
    }
}
