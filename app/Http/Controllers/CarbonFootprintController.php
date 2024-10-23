<?php

namespace App\Http\Controllers;

use App\Models\carbon_footprint;
use App\Http\Requests\Storecarbon_footprintRequest;
use App\Http\Requests\Updatecarbon_footprintRequest;
use App\Models\energy_consumption;
use Illuminate\Http\Request;

class CarbonFootprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storecarbon_footprintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // Récupérer l'enregistrement d'énergie
        $energy_consumption = energy_consumption::findOrFail($request->energy_consumption_id);

        // Créer un nouvel enregistrement de bilan carbone
        $carbon_footprint = new carbon_footprint();
        $carbon_footprint->energyconsumption_id = $energy_consumption->id;
        $carbon_footprint->electricity_carbon_emission = $energy_consumption->electricity_consumption * 0.233;
        $carbon_footprint->gas_carbon_emission = $energy_consumption->gas_consumption * 2.3;
        $carbon_footprint->heating_oil_carbon_emission = $energy_consumption->heating_oil_consumption * 2.68;

        // Calculer le total des émissions de carbone
        $carbon_footprint->total_carbon_footprint = $carbon_footprint->electricity_carbon_emission
            + $carbon_footprint->gas_carbon_emission
            + $carbon_footprint->heating_oil_carbon_emission;

        $carbon_footprint->calculation_date = $request->calculation_date; // Enregistrez la date de calcul
        $carbon_footprint->save();

        // Afficher le bilan carbone dans la console
        dd($carbon_footprint);

        // Rediriger avec un message de succès (non atteint avec dd())
        // return redirect('/energyconso')->with('success', 'Le bilan carbone a été enregistré avec succès.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carbon_footprint  $carbon_footprint
     * @return \Illuminate\Http\Response
     */
    public function show(carbon_footprint $carbon_footprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carbon_footprint  $carbon_footprint
     * @return \Illuminate\Http\Response
     */
    public function edit(carbon_footprint $carbon_footprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatecarbon_footprintRequest  $request
     * @param  \App\Models\carbon_footprint  $carbon_footprint
     * @return \Illuminate\Http\Response
     */
    public function update(Updatecarbon_footprintRequest $request, carbon_footprint $carbon_footprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carbon_footprint  $carbon_footprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(carbon_footprint $carbon_footprint)
    {
        //
    }
}
