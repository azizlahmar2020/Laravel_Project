<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture; // Ensure the Source model is imported

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Facture::all(); 
        return view('Facture.indexFacture', compact('factures'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Facture.createFacture');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validate_data = $request->validate([
           'consommateur' => 'required|string|max:255',
            'date_facture' => 'required|date', 
            'montant_totale' => 'required|numeric|min:0', 
            'periode_facture' => 'required|string|max:255', 
            'consommation_totale' => 'required|numeric|min:0', 
            'prix_unitaire' => 'required|numeric|min:0', 
            'type_energie' => 'required|string|max:255', 
            'emission_carbone' => 'required|numeric|min:0',
            'moyen_paiement' => 'required|string|max:255',
            'statut' => 'required|string|max:255',      
        ]);
    
        // Create a new Facture instance with validated data
        $facture = Facture::create($validate_data);
    
        // Redirect to the invoices (factures) index page with a success message
        return redirect('/facture/')->with('success', 'Facture created successfully!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facture  = Facture::findOrfail($id);
        return view('Facture.editFacture',compact('facture'));
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
        // Validate the incoming request data for facture fields
        $validatedData = $request->validate([
            'consommateur' => 'required|string|max:255',            // Consumer
            'date_facture' => 'required|date',                      // Invoice date
            'periode_facture' => 'required|string|max:255',        // Billing period
            'consommation_totale' => 'required|numeric|min:0',     // Total consumption
            'prix_unitaire' => 'required|numeric|min:0',           // Unit price
            'montant_totale' => 'required|numeric|min:0',          // Total amount
            'type_energie' => 'required|string|max:255',           // Energy type
            'emission_carbone' => 'required|numeric|min:0',        // Carbon emission (optional)
            'moyen_paiement' => 'required|string|max:255',         // Payment method
            'statut' => 'required|string|max:255',                  // Status
        ]);
    
        // Find the facture by ID and update it with validated data
        Facture::whereId($id)->update($validatedData);
    
        // Redirect to the 'facture' index with a success message
        return redirect('/facture/')->with('success', 'Facture updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facture= Facture::findOrFail($id);
        $facture->delete();
        return redirect('/facture/')->with('success','Facture deleted successfully');
    }
}
